/* *************************
  File: multi-lookup.c
  Author: Peter Tran Huynh
  Date Created: 02-24-2016
  Last Modified: 03-01-2016
  Description:
	DNS Multi-Threaded Lookup
************************* */

#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <errno.h>
#include <pthread.h>
#include <unistd.h>

#include "util.h"
#include "multi-lookup.h"
#include "queue.h"

// Constants
#define MINARGS 3
#define USAGE "<inputFilePath> <outputFilePath>"
#define SBUFSIZE 1025
#define INPUTFS "%1024s"
#define MAX_INPUT_FILES 10
#define MAX_RESOLVER_THREADS 10
#define MIN_RESOLVER_THREADS 2
#define MAX_NAME_LENGTH 1025
#define MAX_IP_LENGTH INET6_ADDRSTRLEN
#define MAX_RAND_LIMIT 100

// Global Variables
int threadsTotal;
queue hostNamesBuffer;
pthread_mutex_t queueLock;
pthread_mutex_t outputLock;
pthread_mutex_t threadsTotalLock;

/*
 * Void function used for going into the critical section for threadsTotal
 * @Params: 
 * 	increment - integer checking to either increase or decrease threadsTotal
 * 
 */
void threadsTotalCrit(int increment)
{
	// Lock around threadsTotal, since it's globally shared and a critical section
	pthread_mutex_lock(&threadsTotalLock);
	if(increment == 1)
		threadsTotal++;
	else if(increment == 0)
		threadsTotal--;
	pthread_mutex_unlock(&threadsTotalLock);
	return;
}

/*
 * Function used for going into the critical section for popping hostNamesBuffer into some char
 * @Return:
 *	pop - char pointer of popped queue item.
 * 
 */
char* queueCrit()
{
	// Mutually Exclusive, with mutex around hostNames assignment
	pthread_mutex_lock(&queueLock);
	char* pop = queue_pop(&hostNamesBuffer);
	pthread_mutex_unlock(&queueLock);
	return pop;
}

/*
 * Void function used for each requester thread, runs thread
 * @Params: 
 * 	fileName - Void pointer for the file
 * 
 */
void* request(void* fileName)
{ 
	// Opens file into a variable fileName
	FILE* file = fopen((char*) fileName, "r");
	
	// Checks if the file unable to open. If so, we'll print an error message and exit the function.
	if(!file)
	{
		fprintf(stderr, "ERROR: Cannot open input file.\n");
		return NULL;
	}

	// Local Variables
	char* hostNames = malloc(SBUFSIZE*sizeof(char));
	char* namesQueued;
	int addedToQueue = 0;

	threadsTotalCrit(1);

	while(fscanf(file, INPUTFS, hostNames) > 0)
	{	
		// Duplicates hostNames into namesToQueue with a new pointer location to be put in queue
		namesQueued = strdup(hostNames);
		// Loops and waits until queue isn't full
		while(queue_is_full(&hostNamesBuffer))
		{
			usleep(rand() % MAX_RAND_LIMIT);
		}
	
		// Pushs hostNames to the queue
		pthread_mutex_lock(&queueLock);
		if(queue_push(&hostNamesBuffer, (void*) namesQueued) == QUEUE_FAILURE)
			fprintf(stderr, "ERROR: Pushing Queue Failed.\n");
		pthread_mutex_unlock(&queueLock);
		++addedToQueue;
	}
	
	threadsTotalCrit(0);

	// Prints total added into queue
	printf("    REQUESTER THREAD: %d Added to Queue.\n", addedToQueue);
	// Deallocates memory from hostNames
	free(hostNames);
	// Closes file
	fclose(file);
	return NULL;
}

/*
 * Void function used for each resolver thread, runs thread
 * @Params: 
 * 	fileName - Void pointer for the file
 * 
 */
void* resolve(void* fileName)
{
	// Opens file into a variable fileName
	FILE* file = fopen((char*) fileName, "a");

	// Checks if the file unable to open. If so, we'll print an error message and exit the function.
	if(!file)
	{
		fprintf(stderr, "ERROR: Cannot open output file.\n");
		return NULL;
	}

	// Local Variables
	char* hostNames;
		// Array of char strings with the IPv6 format
	char stringIP[MAX_IP_LENGTH];	
	int processedFromQueue = 0;

	hostNames = queueCrit();
	while(1)
	{
		if(hostNames != NULL)
		{
			// Checks for error while looking up the DNS IP Host, if so, print error and set stringIP to empty string
			if(dnslookup(hostNames, stringIP, sizeof(stringIP)) == UTIL_FAILURE)
			{
				printf("ERROR: DNSLookup Failure for %s\n", hostNames);
				strncpy(stringIP, "", sizeof(stringIP));
			}

			pthread_mutex_lock(&outputLock);
			// Prints hostNames and IP into file
			fprintf(file, "%s, %s\n", hostNames, stringIP);	
			pthread_mutex_unlock(&outputLock);
			// Deallocates memory
			free(hostNames);
			++processedFromQueue;
		}
		else if(threadsTotal == 0)
			break;
		hostNames = queueCrit();
	}
	
	// Prints total processed from queue
	printf("    RESOLVER THREAD: %d Processed from Queue.\n", processedFromQueue);
	// Closes file
	fclose(file);
	return NULL;
}

/*
 * Main function
 * 
 */
int main(int argc, char* argv[])
{
	// Total input files
        int filesTotal = argc - 2;

	// Check Arguments
	if(argc < MINARGS)
	{
		fprintf(stderr, "ERROR: Not Enough Arguments: %d of 2 minimum.\n", (argc - 1));
		fprintf(stderr, "USAGE:\n %s %s\n", argv[0], USAGE);
		return EXIT_FAILURE;
	}
	else if(filesTotal > MAX_INPUT_FILES)
	{
		fprintf(stderr, "ERROR: Too Many Arguments: %d of 11 maximum.\nOnly 10 input files allowed at once.\n", (argc - 1));
		fprintf(stderr, "USAGE:\n %s %s\n", argv[0], USAGE);
		return EXIT_FAILURE;
	}

	// Local Variables
	int i;
		// Request Threads array size of number of input files
	pthread_t requestThreads[filesTotal];
	// EXTRA CREDIT: CPU Cores must be at least 2 and at most 10
		// Total number of CPU Cores
	int resolverThreadsTotal = sysconf(_SC_NPROCESSORS_ONLN);
	if(resolverThreadsTotal < MIN_RESOLVER_THREADS)
		resolverThreadsTotal = MIN_RESOLVER_THREADS;
	else if(resolverThreadsTotal > MAX_RESOLVER_THREADS)
		resolverThreadsTotal = MAX_RESOLVER_THREADS;
		// Resolve Threads array size of number of cores
	pthread_t resolveThreads[resolverThreadsTotal];

	// Initializations
	threadsTotal = 0;
		// Initializes the queue with size of 50
        queue_init(&hostNamesBuffer, 50);
		// Lock initializations
	pthread_mutex_init(&queueLock, NULL);
	pthread_mutex_init(&outputLock, NULL);
	pthread_mutex_init(&threadsTotalLock, NULL);

	// Creates Request Threads
	for(i = 0; i < filesTotal; i++)
	{
		pthread_create(&requestThreads[i], NULL, request,(void *)argv[i+1]);
	}
	
	// Creates Resolve Threads
	for(i = 0; i < resolverThreadsTotal; i++)
	{
		pthread_create(&resolveThreads[i], NULL, resolve,(void *) argv[argc-1]);
	}
	
	// Waits for all thread requests to finish and joins them into an array
	for(i = 0; i < filesTotal; i++)
	{
		pthread_join(requestThreads[i], NULL);
	}

	// Waits for all thread resolves to finish and joins them into an array
	for(i = 0; i < resolverThreadsTotal; i ++)
	{
		pthread_join(resolveThreads[i], NULL);
	}

	// Release all locks
	pthread_mutex_destroy(&queueLock);
	pthread_mutex_destroy(&outputLock);
	pthread_mutex_destroy(&threadsTotalLock);

	// Cleans the queue
	queue_cleanup(&hostNamesBuffer);
	return 0;
}
