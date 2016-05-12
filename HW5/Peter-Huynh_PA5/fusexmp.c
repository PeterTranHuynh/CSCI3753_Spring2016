/*
  FUSE: Filesystem in Userspace
  Copyright (C) 2001-2007  Miklos Szeredi <miklos@szeredi.hu>

  Minor modifications and note by Andy Sayler (2012) <www.andysayler.com>

  Source: fuse-2.8.7.tar.gz examples directory
  http://sourceforge.net/projects/fuse/files/fuse-2.X/

  This program can be distributed under the terms of the GNU GPL.
  See the file COPYING.

  gcc -Wall `pkg-config fuse --cflags` fusexmp.c -o fusexmp `pkg-config fuse --libs`

  Note: This implementation is largely stateless and does not maintain
        open file handels between open and release calls (fi->fh).
        Instead, files are opened and closed as necessary inside read(), write(),
        etc calls. As such, the functions that rely on maintaining file handles are
        not implmented (fgetattr(), etc). Those seeking a more efficient and
        more complete implementation may wish to add fi->fh support to minimize
        open() and close() calls and support fh dependent functions.
*/


#define FUSE_USE_VERSION 28
#define HAVE_SETXATTR

#ifdef HAVE_CONFIG_H
#include <config.h>

#endif
#ifdef linux
/* For pread()/pwrite() */
#define _XOPEN_SOURCE 500
#endif

#include <fuse.h>
#include <stdio.h>
#include <string.h>
#include <unistd.h>
#include <fcntl.h>
#include <dirent.h>
#include <errno.h>
#include <sys/time.h>
    // Added
#include <stdlib.h>
#include <limits.h>

#ifdef HAVE_SETXATTR
#include <sys/xattr.h>
#endif

#include "aes-crypt.h"

// MOST INFORMATION INSPIRED FROM Joseph J. Pfeiffer, Jr., Ph.D. CS135 FUSE Documentation
// http://www.cs.nmsu.edu/~pfeiffer/fuse-tutorial/
// http://www.cs.nmsu.edu/~pfeiffer/fuse-tutorial/src/bbfs.c

/* 
 * Citation: Private Data
 * http://www.cs.nmsu.edu/~pfeiffer/fuse-tutorial/html/private.html
 *
 * #define BB_DATA ((struct bb_state *) fuse_get_context() -> private_data)
 *
 * struct bb_state {
 *   char *rootdir;
 *   FILE *logfile;
 * };
 *
 */
    // All information within the type file_info is private data
#define XMP_DATA ((file_info *) fuse_get_context() -> private_data)

    // Stores the mirror file, directory, and passphrase
typedef struct
{
	char *filePath;
	char *passPhrase;
}file_info;

FILE *open_memstream(char **ptr, size_t *sizeloc);

/* 
 * Citation: From bb_fullpath 
 * http://www.cs.nmsu.edu/~pfeiffer/fuse-tutorial/src/bbfs.c
 * 
 * All the paths are relative to the root (fpath) of the mounted filesystem. 
 * In order to get to the underlying filesystem, need to have the mountpoint.
 * Combines into a full directory to a file
 *
 */
static void xmp_fullpath(char fpath[PATH_MAX], const char *path)
{
	    // Copys the string from fpath into XMP_DATA's filePath
	strcpy(fpath, XMP_DATA -> filePath);
	    // Concats fpath and path uptop a size of PATH_MAX
	strncat(fpath, path, PATH_MAX);	
}

static int xmp_getattr(const char *path, struct stat *stbuf)
{
	int res;
	
	/* 
	 * Citation: This is for a lot of the functions below as well.
	 * http://www.cs.nmsu.edu/~pfeiffer/fuse-tutorial/html/callbacks.html
	 * 
	 * When function called, passed a file path (default is root directory) and maintains file info. 
	 * Each function has to translate a new path
	 *
	 */
	    // Updates file path
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	res = lstat(fpath, stbuf);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_access(const char *path, int mask)
{
	int res;
	
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	res = access(fpath, mask);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_readlink(const char *path, char *buf, size_t size)
{
	int res;

	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);
	
	res = readlink(fpath, buf, size - 1);
	if (res == -1)
		return -errno;

	buf[res] = '\0';
	return 0;
}


static int xmp_readdir(const char *path, void *buf, fuse_fill_dir_t filler,
		       off_t offset, struct fuse_file_info *fi)
{
	DIR *dp;
	struct dirent *de;
	
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	(void) offset;
	(void) fi;

	dp = opendir(fpath);
	if (dp == NULL)
		return -errno;

	while ((de = readdir(dp)) != NULL) {
		struct stat st;
		memset(&st, 0, sizeof(st));
		st.st_ino = de->d_ino;
		st.st_mode = de->d_type << 12;
		if (filler(buf, de->d_name, &st, 0))
			break;
	}

	closedir(dp);
	return 0;
}

static int xmp_mknod(const char *path, mode_t mode, dev_t rdev)
{
	int res;
	
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	/* On Linux this could just be 'mknod(path, mode, rdev)' but this
	   is more portable */
	if (S_ISREG(mode)) {
		res = open(fpath, O_CREAT | O_EXCL | O_WRONLY, mode);
		if (res >= 0)
			res = close(res);
	} else if (S_ISFIFO(mode))
		res = mkfifo(fpath, mode);
	else
		res = mknod(fpath, mode, rdev);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_mkdir(const char *path, mode_t mode)
{
	int res;

	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);
	
	res = mkdir(fpath, mode);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_unlink(const char *path)
{
	int res;

	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);
	
	res = unlink(fpath);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_rmdir(const char *path)
{
	int res;

	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);
	
	res = rmdir(fpath);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_symlink(const char *from, const char *to)
{
	int res;

	res = symlink(from, to);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_rename(const char *from, const char *to)
{
	int res;

	res = rename(from, to);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_link(const char *from, const char *to)
{
	int res;

	res = link(from, to);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_chmod(const char *path, mode_t mode)
{
	int res;
	
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	res = chmod(fpath, mode);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_chown(const char *path, uid_t uid, gid_t gid)
{
	int res;
	
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	res = lchown(fpath, uid, gid);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_truncate(const char *path, off_t size)
{
	int res;
	
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	res = truncate(fpath, size);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_utimens(const char *path, const struct timespec ts[2])
{
	int res;
	struct timeval tv[2];
	
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	tv[0].tv_sec = ts[0].tv_sec;
	tv[0].tv_usec = ts[0].tv_nsec / 1000;
	tv[1].tv_sec = ts[1].tv_sec;
	tv[1].tv_usec = ts[1].tv_nsec / 1000;

	res = utimes(fpath, tv);
	if (res == -1)
		return -errno;

	return 0;
}	

static int xmp_open(const char *path, struct fuse_file_info *fi)
{
	int res;
	
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	res = open(fpath, fi->flags);
	if (res == -1)
		return -errno;

	close(res);
	return 0;
}

static int xmp_read(const char *path, char *buf, size_t size, off_t offset,
		    struct fuse_file_info *fi)
{
	    // Integer used to hold output value of a command
	int res;
	    //  File and Mirrored File
	FILE* fd; // Use to be: int fd;
	FILE* fdMirror;
	    // Buffer value and length to be written into via open_memstream. For mirroring
	char* mirrorValue;
	size_t mirrorValueLength;
	    // xattr buffer variable for metadata flags.
	char xattrValue[8];

	    // Updates file path
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	    // Don't use this parameter, so cast it to void.
	(void) fi;

	    // Opens the file at fpath with read permissions. Also checks for unsuccess.
	fd = fopen(fpath, "r"); // Use to be: open(path, O_RDONLY);
	if (fd == NULL)
		return -errno;

	    // Sets file buffer and length variables for mirror file directory. Also checks for unsuccess.
	fdMirror = open_memstream(&mirrorValue, &mirrorValueLength);
	if(fdMirror == NULL)
		return -errno;

	/*
	 * Citation: Linux Programmer's Manual - getxattr(2)
	 * http://man7.org/linux/man-pages/man2/fgetxattr.2.html
	 *
	 * Used this site to understand extended attribute functions and metadata flags
	 *
	 */
	    // Checks if file at fpath is marked as encrypted through metadata flag
	if(getxattr(fpath, "user.encrypted", xattrValue, 8) != -1)	
		    // Decrypt any encryption on the file and copies if unencrypted
		    // Passing 0, as seen in aes-crypt-util.c, is the Decryption case
		do_crypt(fd, fdMirror, 0, XMP_DATA -> passPhrase);
	else
		    // If not encrypted, read as is via pass-through case
		    // Passing -1, as seen in aes-crypt-util.c, is the copy case
		do_crypt(fd, fdMirror, -1, XMP_DATA -> passPhrase);
	
	    // Waits for output file to fully load before cleanup
	fflush(fdMirror);

	    // Searches for load location of mirror
	fseek(fdMirror, offset, SEEK_SET);

	    // Sets res for output of command for file reading for success checking. Also does fread. 
	    // Originally pread, but using fread now for file usage with a buffer.
	res = fread(buf, 1, size, fdMirror);
	if (res == -1)
		res = -errno;

	fclose(fd);
	fclose(fdMirror);	
	return res;
}

static int xmp_write(const char *path, const char *buf, size_t size,
		     off_t offset, struct fuse_file_info *fi)
{
	    // Integer used to hold output value of a command.
	int res;
	    //  File and Mirrored File.
	FILE* fd; // Use to be: int fd;
	FILE* fdMirror;
	    // Buffer value and length to be written into via open_memstream. For mirroring.
	char* mirrorValue;
	size_t mirrorValueLength;
	    // xattr buffer variable for metadata flags.
	char xattrValue[8];

	    // Updates file path
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	    // Don't use this parameter, so cast it to void.
	(void) fi;
	
	    // Opens the file at fpath with read permissions FIRST. Also checks for unsuccess.
	fd = fopen(fpath, "r"); // Use to be: open(path, O_WRONLY);
	if (fd == NULL)
		return -errno;
	
	    // Sets file buffer and length variables for mirror file directory. Also checks for unsuccess.
	fdMirror = open_memstream(&mirrorValue, &mirrorValueLength);
	if (fdMirror == NULL)
		return -errno;

	    // Checks if file at fpath is marked as encrypted through metadata flag. If so, decrypts.
	if (getxattr(fpath, "user.encrypted", xattrValue, 8) != -1)
		do_crypt(fd, fdMirror, 0, XMP_DATA -> passPhrase);
	
	    // Searches for load location of mirror.
	fseek(fdMirror, offset, SEEK_SET);
	
	    // Writes into mirror file, and checks for success.
	res = fwrite(buf, 1, size, fdMirror);
	if (res == -1)
		res = -errno;
	
	    // Waits for command completion before conducting cleanup of file.
	fflush(fdMirror);

	    // Closes the file, to reopen it with writing permissions.
	fclose(fd);
	fd = fopen(fpath, "w");

	    // Searches for load location of mirror, without an offset, this will be used for encryption.
	fseek(fdMirror, 0, SEEK_SET);

	    // Regardless of anything, Writing will always lead to encryption.
	    // As shown in aes-crypt-util.c, passing 1 is the encryption case.
	do_crypt(fdMirror, fd, 1, XMP_DATA -> passPhrase);

	/*
	 * Citation: Linux Programmer's Manual - setxattr(2)
	 * http://man7.org/linux/man-pages/man2/setxattr.2.html
	 *
	 * Used this site to understand extended attribute functions and metadata flags.
	 *
	 */
	    // Sets flag to be marked as encrypted.
	setxattr(fpath, "user.encrypted", "true", 4, 0);

	fclose(fd);
	fclose(fdMirror);	
	return res;
}

static int xmp_statfs(const char *path, struct statvfs *stbuf)
{
	int res;
	
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	res = statvfs(fpath, stbuf);
	if (res == -1)
		return -errno;

	return 0;
}

static int xmp_create(const char* path, mode_t mode, struct fuse_file_info* fi)
{
	    // We don't use these parameters, so cast them to void
	(void) fi;
	(void) mode;

	    // Updates file path
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);

	    // Local variables
	int res;
	FILE* fd;
	FILE* fdMirror;
	char* mirrorValue;
	size_t mirrorValueLength;

	    // Opens file
	fd = fopen(fpath, "w");
	if(fd == NULL)
		return -errno;
	
	    // Sets mirror variables and file for mirroring
	fdMirror = open_memstream(&mirrorValue, &mirrorValueLength);
	if(fdMirror == NULL)
		return -errno;
	
	    // Encrypt new file
	do_crypt(fdMirror, fd, 1, XMP_DATA -> passPhrase);
	
	// Use to be:
    	// res = creat(fpath, mode);
    	// if(res == -1)
	// return -errno;
	     // Set extended attribute flag as encrypted. Also checks for success.
	res = setxattr(fpath, "user.encrypted", "true", 4, 0);
	if(res)
		return -errno;

	fclose(fd); //Use to be: close(res);
	fclose(fdMirror);
	return 0;
}


static int xmp_release(const char *path, struct fuse_file_info *fi)
{
	/* Just a stub.	 This method is optional and can safely be left
	   unimplemented */

	(void) path;
	(void) fi;
	return 0;
}

static int xmp_fsync(const char *path, int isdatasync,
		     struct fuse_file_info *fi)
{
	/* Just a stub.	 This method is optional and can safely be left
	   unimplemented */

	(void) path;
	(void) isdatasync;
	(void) fi;
	return 0;
}

#ifdef HAVE_SETXATTR
static int xmp_setxattr(const char *path, const char *name, const char *value,
			size_t size, int flags)
{
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);
	
	int res = lsetxattr(fpath, name, value, size, flags);
	if (res == -1)
		return -errno;
	return 0;
}

static int xmp_getxattr(const char *path, const char *name, char *value,
			size_t size)
{
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);
	
	int res = lgetxattr(fpath, name, value, size);
	if (res == -1)
		return -errno;
	return res;
}

static int xmp_listxattr(const char *path, char *list, size_t size)
{
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);
	
	int res = llistxattr(fpath, list, size);
	if (res == -1)
		return -errno;
	return res;
}

static int xmp_removexattr(const char *path, const char *name)
{
	char fpath[PATH_MAX];
	xmp_fullpath(fpath, path);
	
	int res = lremovexattr(fpath, name);
	if (res == -1)
		return -errno;
	return 0;
}
#endif /* HAVE_SETXATTR */

static struct fuse_operations xmp_oper = {
	.getattr	= xmp_getattr,
	.access		= xmp_access,
	.readlink	= xmp_readlink,
	.readdir	= xmp_readdir,
	.mknod		= xmp_mknod,
	.mkdir		= xmp_mkdir,
	.symlink	= xmp_symlink,
	.unlink		= xmp_unlink,
	.rmdir		= xmp_rmdir,
	.rename		= xmp_rename,
	.link		= xmp_link,
	.chmod		= xmp_chmod,
	.chown		= xmp_chown,
	.truncate	= xmp_truncate,
	.utimens	= xmp_utimens,
	.open		= xmp_open,
	.read		= xmp_read,
	.write		= xmp_write,
	.statfs		= xmp_statfs,
	.create         = xmp_create,
	.release	= xmp_release,
	.fsync		= xmp_fsync,
#ifdef HAVE_SETXATTR
	.setxattr	= xmp_setxattr,
	.getxattr	= xmp_getxattr,
	.listxattr	= xmp_listxattr,
	.removexattr	= xmp_removexattr,
#endif
};

int main(int argc, char *argv[])
{
	/* 
	 * Citation: CS135 FUSE Documentation - Parsing the Command Line and Initializing FUSE
	 * http://www.cs.nmsu.edu/~pfeiffer/fuse-tutorial/html/init.html
	 *
	 * if ((argc < 3) || (argv[argc-2][0] == '-') || (argv[argc-1][0] == '-'))
	 * 	bb_usage();
 	 * 
	 * bb_data->rootdir = realpath(argv[argc-2], NULL);
	 * argv[argc-2] = argv[argc-1];
	 * argv[argc-1] = NULL;
	 * argc--;
	 *
	 */

	file_info *fileInfo;
	umask(0);

	    // Checks for argument to match specified amount
	if(argc < 4)
	{
		printf("ERROR: Too few arguments.\nUSAGE: <Encryption Key> <Mirror Directory> <Mount Directory>\n");
		return 1;
	}


	    // According to the CS135 FUSE Documentation - Private Data, we're mallocing fileInfo
	fileInfo = malloc(sizeof(file_info));
	if(fileInfo == NULL)
	{
		perror("ERROR: Memory allocation failed.\n");
		abort();
	}

	    // Internal data: Stores path and passpharse. Pull the root directory out of the argument list and saves it.
	fileInfo -> filePath = realpath(argv[argc - 2], NULL);
	fileInfo -> passPhrase = argv[argc - 3];

	    // Reorganize command arguments in order to pass the arguments into fuse_main
	argv[argc - 3] = argv[argc - 1];
	argv[argc - 2] = NULL;
	argv[argc - 1] = NULL;
	argc = argc - 2;

	return fuse_main(argc, argv, &xmp_oper, fileInfo);
} 		
