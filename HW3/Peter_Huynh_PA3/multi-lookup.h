
/* *************************
  File: multi-lookup.h
  Author: Peter Tran Huynh
  Date Created: 03-01-2016
  Last Modified: 03-01-2016
************************* */

#ifndef MULTI_H
#define MULTI_H

#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <errno.h>
#include <pthread.h>
#include <sys/sysinfo.h>

#include "queue.h"
#include "util.h"

// Mutex related functions involving critical sections
void threadsTotalCrit(int increment);
char* queueCrit();
// Thread functions
void* request(void* fileName);
void* resolve(void* fileName);
// Initialization Function
void init();

#endif
