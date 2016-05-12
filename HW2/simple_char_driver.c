

#include<linux/init.h>
#include<linux/module.h>

#include<linux/fs.h>
#include<asm/uaccess.h>
#define BUFFER_SIZE 1024

static char device_buffer[BUFFER_SIZE];

int openCounter = 0;
int closeCounter = 0;

ssize_t simple_char_driver_read (struct file *pfile, char __user *buffer, size_t length, loff_t *offset)
{
	/* *buffer is the userspace buffer to where you are writing the data you want to be read from the device file*/
	/*  length is the length of the userspace buffer*/
	/*  current position of the opened file*/
	/* copy_to_user function. source is device_buffer (the buffer defined at the start of the code) and destination is the userspace 		buffer *buffer */
	int readBytes = strlen(device_buffer);
	int toRead = BUFFER_SIZE - *offset;

	// If length is 0, there is nothing to read
	if (length == 0)
		return 0;

	// If length is too long, read the max amount
	if (length > BUFFER_SIZE - *offset)
		length = BUFFER_SIZE - *offset;

	// If bytes to be read is more than the length given, fix it
	if (toRead > length)
		toRead = length;

        // Get bytes written by subtracting unread bytes (copy_to_user) from length
	toRead = length - copy_to_user(buffer, device_buffer + *offset, length);
	printk(KERN_ALERT "READ: simple_char_driver is reading %d bytes\n", readBytes);

	// Set offset so increment to the end of the file
	*offset += toRead;

	return toRead;
}



ssize_t simple_char_driver_write (struct file *pfile, const char __user *buffer, size_t length, loff_t *offset)
{
	/* *buffer is the userspace buffer where you are writing the data you want to be written in the device file*/
	/*  length is the length of the userspace buffer*/
	/*  current position of the opened file*/
	/* copy_from_user function. destination is device_buffer (the buffer defined at the start of the code) and source is the userspace 		buffer *buffer */
        int writeBytes = strlen(device_buffer);
        int toWrite = BUFFER_SIZE - *offset;

	// If length is 0, there is nothing to write
        if (length == 0)
                return 0;

        // If length is too long, write the max amount
        if (length > BUFFER_SIZE - *offset)
                length = BUFFER_SIZE - *offset;

	// Get bytes written by subtracting unwritten bytes (copy_to_user) from length
	toWrite = length - copy_from_user(device_buffer + writeBytes, buffer, length);
	printk(KERN_ALERT "WRITE: simple_char_driver is writing %d bytes\n", toWrite);

	// Set offset to increment to the end of the file
  	*offset += toWrite;

	return toWrite;
}


int simple_char_driver_open (struct inode *pinode, struct file *pfile)
{
	/* print to the log file that the device is opened and also print the number of times this device has been opened until now*/
	printk(KERN_ALERT "OPEN: simple_char_driver has been opened %d times\n", openCounter+1);

	return 0;
}


int simple_char_driver_close (struct inode *pinode, struct file *pfile)
{
	/* print to the log file that the device is closed and also print the number of times this device has been closed until now*/
	printk(KERN_ALERT "CLOSE: simple_char_driver has been closed %d times\n", closeCounter+1);
	closeCounter++;

	return 0;
}

struct file_operations simple_char_driver_file_operations = {

	.owner   = THIS_MODULE,

	/* add the function pointers to point to the corresponding file operations. look at the file fs.h in the linux souce code*/
	//  From Line 2,758 of fs.h
	// .open	 = __fops ## _open,
	.open    = simple_char_driver_open,

	// .release = simple_attr_release,
	.release   = simple_char_driver_close,

	// .read	 = simple_attr_read,
	.read    = simple_char_driver_read,

	// .write	 = simple_attr_write,
	.write   = simple_char_driver_write

	// .llseek	 = generic_file_llseek,
	// No Need
};

static int simple_char_driver_init(void)
{
	/* print to the log file that the init function is called.*/
	printk(KERN_ALERT "INIT: simple_char_driver\n");

	/* register the device */
	register_chrdev(420, "simple_char_driver", &simple_char_driver_file_operations);

	return 0;
}

static int simple_char_driver_exit(void)
{
	/* print to the log file that the exit function is called.*/
	printk(KERN_ALERT "EXIT: simple_char_driver\n");

	/* unregister  the device using the register_chrdev() function. */
	unregister_chrdev(420, "simple_char_driver");

	return 0;
}

/* add module_init and module_exit to point to the corresponding init and exit function*/
module_init(simple_char_driver_init);
module_exit(simple_char_driver_exit);
