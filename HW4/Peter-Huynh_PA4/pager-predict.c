/*
 * File: pager-predict.c
 * Author:              Peter Huynh
 * 
 * Original Author:     Andy Sayler
 *                          http://www.andysayler.com
 * Adopted From:        Dr. Alva Couch
 *                          http://www.cs.tufts.edu/~couch/
 *
 * Project: CSCI 3753 Programming Assignment 4
 * Create Date: Unknown
 * Modify Date: 2016/04/13
 * Description:
 * 	This file contains a predictive pageit
 *      implmentation.
 */

#include <stdio.h> 
#include <stdlib.h>

#include "simulator.h"

/* 
 * Function for local LRU page searching, used for page swapping. Taken from pager-lru.c
 *
 * SOURCE: Taken from my pager-lru.c
 * THANK YOU TO Alex Beala for providing the initial inspiration for this local lru for the predict code: https://github.com/beala
 *
 * @params:
 *  timestamps - Array containing all process page timestamps
 *  q - Passed q array for pages
 *  proctmp - Integer for current process number
 *  tick - tick value, used to find oldestPage value
 *
 * @return:
 *  oldPage - Used to reassign new tick and set the next old page
 */
int lruPageSearch(int timestamps[MAXPROCESSES][MAXPROCPAGES], Pentry q[MAXPROCESSES], int proctmp, int tick)
{
	    // Local vars for loop iteration, and page tracking
	int i;
	int oldestPage = tick;
	int oldPage;

	    // Loops through all pages in the current process
	for(i = 0; i < MAXPROCPAGES; i++)
	{
		     // If swapped in AND page isn't oldest
		if(q[proctmp].pages[i] && timestamps[proctmp][i] < oldestPage)
		{
			    // Reassign the oldest page
			oldestPage = timestamps[proctmp][i];
			    // Current page set to be remove
			oldPage = i;
	        }
	}
	
	return oldPage;
}

/* 
 * Swaps two integers
 *
 * SOURCE: http://stackoverflow.com/questions/3835922/simple-swap-function-why-doesnt-this-one-swap
 *
 * @params:
 *  left - swap integer
 *  right - swap integer
 */
void swapInt(int *left, int *right)
{
	int tempLeft = *left;
	*left = *right;
	*right = tempLeft;
}

void pageit(Pentry q[MAXPROCESSES]) { 
    
    /* This file contains the stub for a predictive pager */
    /* You may need to add/remove/modify any part of this file */

    /* Static vars */
    static int initialized = 0;
    static int tick = 1; // artificial time
	    // Timestamp array for all pages/processes, process counter array, and array for last used process's process counters.
	static int timestamps[MAXPROCESSES][MAXPROCPAGES];
	static int processCounter[MAXPROCESSES];
	static int pcLast[MAXPROCESSES];
	    // 3D arrays: Each process has long array for pages, with each element pointing to another array for page's control flow paging pattern
	    // Each element within the Process contains a page number, a frequency, and a timestamp. Each will be used to determine when to pageout
	static int controlFlowPageNumber[MAXPROCESSES][MAXPROCPAGES][MAXPROCPAGES];
	static int controlFlowFrequency[MAXPROCESSES][MAXPROCPAGES][MAXPROCPAGES];
	static int *controlFlowTimestamp[MAXPROCESSES][MAXPROCPAGES][MAXPROCPAGES];

    /* Local vars */
	    // Prediction integers used for optimal paging algorithm, will be assigned future page properties for swapping in
	int *predictionsPageNumber;
	int *predictionsFrequency;
	int **predictionsTimestamp;
	    // Integers used as temp vars, to determine lru and current/last page location, and loop vars
	int proctmp, pagetmp;
	int lastPageNumUsed, currentPageNumber;
	int i, j, k;
	int filledPages;
    
    /* initialize static vars on first run */
    if(!initialized){
	/* Init complex static vars here */
	for(i = 0; i < MAXPROCESSES; i++)
	{
		for(j = 0; j < MAXPROCESSES; j++)
		{
			for(k = 0; k < MAXPROCESSES; k++)
			{
				    // Loops through every element in the 3D array
				controlFlowPageNumber[i][j][k] = -1;
				controlFlowFrequency[i][j][k] = -1;
				controlFlowTimestamp[i][j][k] = NULL;
			}
		}
	}
	for(proctmp = 0; proctmp < MAXPROCESSES; proctmp++)
	{
		for(pagetmp = 0; pagetmp < MAXPROCPAGES; pagetmp++)
		{
			timestamps[proctmp][pagetmp] = 0;
		}
		processCounter[proctmp] = 0;
        }
	initialized = 1;
    }
    
    /* Implement Predictive Paging */
    // COMMENTED OUT: fprintf(stderr, "pager-predict not yet implemented. Exiting...\n");
    // COMMENTED OUT: exit(EXIT_FAILURE);
	    // Update control flow for each active process
	for(proctmp = 0; proctmp < MAXPROCESSES; proctmp++)
	{
		    // Exit loop if q is currently inactive (NEEDS TO PAGE OUT!) the last page value is not set yet.
		if(q[proctmp].active && lastPageNumUsed != -1)
		{

			lastPageNumUsed = pcLast[proctmp] / PAGESIZE;
			    // Update pcLast to current program counter
			pcLast[proctmp] = q[proctmp].pc;
			currentPageNumber = pcLast[proctmp] / PAGESIZE;
			    // Updating to current page number
			pagetmp = (q[proctmp].pc - 1) / PAGESIZE;
			    // Updating timestamp to current tick
			timestamps[proctmp][pagetmp] = tick;

			    // Skip if last page is the current page
			if(lastPageNumUsed != currentPageNumber)
			{

				    // Page out the last page
				pageout(proctmp, lastPageNumUsed);

				    // Loops through the process's last page
				for(i = 0; i < MAXPROCPAGES; i++)
				{
					    // If the last page's number matches the current page's number, increase the frequency
					if(controlFlowPageNumber[proctmp][lastPageNumUsed][i] == currentPageNumber)
					{
						controlFlowFrequency[proctmp][lastPageNumUsed][i]++;
						break;
					}

					   // If the last page is empty, set its number to the current page, set frequency to 1 and set the timestamp
					if(controlFlowPageNumber[proctmp][lastPageNumUsed][i] == -1)
					{
						controlFlowPageNumber[proctmp][lastPageNumUsed][i] = currentPageNumber;
						controlFlowFrequency[proctmp][lastPageNumUsed][i] = 1;
						controlFlowTimestamp[proctmp][lastPageNumUsed][i] = &(timestamps[proctmp][i]);
						break;
					}
				}
			}
		}
	}

	    // Page swapping for any active processes
	for(proctmp = 0; proctmp < MAXPROCESSES; proctmp++)
	{
		    // Swap out pages and exit loop if q is currently inactive
		if (q[proctmp].active)
		{
			    // Set tmp var to next page number the process will require
			pagetmp = (q[proctmp].pc) / PAGESIZE;

			    // Checks if the page is already swapped in, if so, skip.
			if(q[proctmp].pages[pagetmp] != 1)
			{

				    // Pagein swap, upon success, set process counter to 0 since it's no waiting for a pageout anymore
				    // Checks if a pagein in progress via the process counter not being 0, if so, don't call another pageout
				if(pagein(proctmp, pagetmp))
				{
					if(processCounter[proctmp])
					{
						processCounter[proctmp] = 0;

						    // Local LRU search for page. Swap it out, and swap in a needed page. Occurs when the process needs page, but all frames are taken. 
						    // Checks if there is another page queued for swapping out, if not, exit
						if(lruPageSearch(timestamps, q, proctmp, tick))
							    // Set the process counter of current process to 1, meaning a pageout will be called
							processCounter[proctmp] = 1;
					}
				}
			}
		}
		else
		{
			    // Pages out as soon as process is idle
			for(pagetmp = 0; pagetmp < MAXPROCPAGES; pagetmp++)
			{
				pageout(proctmp, pagetmp);
			}
		}
	}

	    // Predictions for the next page for each active process
	for(proctmp = 0; proctmp < MAXPROCESSES; proctmp++)
	{
		if(q[proctmp].active)
		{
			    // Initialization and Setup of the guesses of the pages that the process will use next
			filledPages = 0;
			predictionsPageNumber = controlFlowPageNumber[proctmp][(q[proctmp].pc + 101) / PAGESIZE];
			predictionsFrequency = controlFlowFrequency[proctmp][(q[proctmp].pc + 101) / PAGESIZE];
			predictionsTimestamp = controlFlowTimestamp[proctmp][(q[proctmp].pc + 101) / PAGESIZE];

			    // Loops for any empty pages for a process, if not, increment to filledPages. This will stop SEG FAULTS
			for(i = 0; i < MAXPROCPAGES; i++)
			{
				if(predictionsPageNumber[filledPages] != -1 && filledPages < MAXPROCPAGES)
					filledPages++;
			}

			    // Goes through all the predictions until a timestamp previously is less than the current timestamp, if so, swap it.
			    // This will organize the predictions, allowing for optimal switching
			for(i = 0; i < MAXPROCPAGES; i++)
			{	
				for(j = 1; j < filledPages; j++)
				{
					if((*predictionsTimestamp[j - 1]) < (*predictionsTimestamp[j]))
					{
						if((predictionsFrequency[j - 1]) > (predictionsFrequency[j]))
						{
	 						swapInt(predictionsPageNumber + (j - 1), predictionsPageNumber + j);
							swapInt(predictionsFrequency + (j - 1), predictionsFrequency + j);
							swapInt(*predictionsTimestamp + (j - 1), *predictionsTimestamp + j);
						}
					}
				}
			}

			    // Pagein each prediction in order, since the predictions are now optimally sorted		
			for(i = 0; i < filledPages; i++)
			{
				pagein(proctmp, predictionsPageNumber[i]);
			}
		}
	}

    /* advance time for next pageit iteration */
    tick++;
} 
