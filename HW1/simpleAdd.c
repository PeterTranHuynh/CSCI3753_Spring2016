#include <linux/kernel.h>
#include <linux/linkage.h>

asmlinkage long sys_simpleadd(int number1, int number2, int *result)
{
	printk(KERN_ALERT "%d\n", number1);
	printk(KERN_ALERT "%d\n", number2);
	*result = number1 + number2;
	printk(KERN_ALERT "%d\n", *result);
	return 0;
}

