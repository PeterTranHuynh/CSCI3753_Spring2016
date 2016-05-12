#include <stdio.h>
#include <linux/kernel.h>
#include <sys/syscall.h>
#include <unistd.h>

int main()
{
	int num1 = 60;
	int num2 = 9;
	int addr;
	int *result = &addr;
	syscall(469, num1, num2, result);
	printf("%d\n", *result);	
	return 0;
}

