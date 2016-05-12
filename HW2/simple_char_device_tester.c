#include <stdio.h>
#include <stdlib.h>
#include <fcntl.h>
#include <string.h>

#define READ	'r'
#define WRITE	'w'
#define EXIT	'e'

int main()
{
	char input;
	char buffer[1024];
	int fileDevice;
	
	printf("\n\nFOR DEVICE:\n  - Press 'r' to READ\n  - Press 'w' to WRITE\n  - Press 'e' to EXIT\n  All other keys will continue reading/writing.");

	while(input != EXIT)
	{  
		printf("\n\nEnter command: ");
		scanf(" %[^\n]", &input);
		printf("\n");		

		if(input == READ)
		{
			printf("DATA READ:\n");
			system("cat /dev/simple_char_device");
		}
		else if(input == WRITE)
		{
			fileDevice = open("/dev/simple_char_device", O_RDWR);
			printf("DATA WRITE:\nEnter what you want to write in: \n");
			scanf(" %[^\n]", buffer);
			write(fileDevice, buffer, strlen(buffer));
			close(fileDevice);
		}
		else if(input == EXIT)
			printf("EXITING...\n");
		else
			printf("\n\nINVALID INPUT FOR DEVICE:\n  - Press 'r' to READ\n  - Press 'w' to WRITE\n  - Press 'e' to EXIT\n  All other keys will continue reading/writing.");
	}

	return 0;
}
