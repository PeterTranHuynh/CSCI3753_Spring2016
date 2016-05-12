/*
 * File: pager-lru.c
 * Author:              Peter Huynh
 * 
 * Original Author:     Andy Sayler
 *                          http://www.andysayler.com
 * Adopted From:        Dr. Alva Couch
 *                          http://www.cs.tufts.edu/~couch/
 *
 * Project: CSCI 3753 Programming Assignment 4
 * Create Date: Unknown
 * Modify Date: 2016/03/30
 * Description:
 * 	This file contains an lru pageit
 *      implmentation.
 */

#include <stdio.h> 
#include <stdlib.h>

#include "simulator.h"

void pageit(Pentry q[MAXPROCESSES]) { 
    
    /* This file contains the stub for an LRU pager */
    /* You may need to add/remove/modify any part of this file */

    /* Static vars */
    static int initialized = 0;
    static int tick = 1; // artificial time
    static int timestamps[MAXPROCESSES][MAXPROCPAGES];

    /* Local vars */
    int proctmp;
    int pagetmp;
	    // Added local vars for loop iteration, and page tracking
	int i;
	int oldestPage;
	int oldPage;

    /* initialize static vars on first run */
    if(!initialized){
	for(proctmp=0; proctmp < MAXPROCESSES; proctmp++){
	    for(pagetmp=0; pagetmp < MAXPROCPAGES; pagetmp++){
		timestamps[proctmp][pagetmp] = 0; 
	    }
	}
	initialized = 1;
    }
    
    /* Implement LRU Paging */
    // COMMENTED OUT: fprintf(stderr, "pager-lru not yet implemented. Exiting...\n");
    // COMMENTED OUT: exit(EXIT_FAILURE);
	    // Loops Through all processes
	for(proctmp = 0; proctmp < MAXPROCESSES; proctmp++)
	{
		    // Checks if current process in q is active
		if(q[proctmp].active)
		{
			    // Assigned current page
			pagetmp = q[proctmp].pc / PAGESIZE;

			    // If page isn't swapped in , swap it in and setup for pageout
			if(!q[proctmp].pages[pagetmp] && !pagein(proctmp, pagetmp))
			{
				    // Sets oldest page number to be the current tick
				oldestPage = tick;
				    // Loops through all pages in the current process
				for(i = 0; i < MAXPROCPAGES; i++)
				{
					    // If page at i is swapped in AND page isn't oldest
					if(q[proctmp].pages[i] && timestamps[proctmp][i] < oldestPage) 
					{
						    // Reassign the oldest page
						oldestPage = timestamps[proctmp][i];
						    // Current page set to be remove
						oldPage = i;
					}
				}
				    // Page out the current page (oldPage) 
				pageout(proctmp, oldPage);
				break;
 			}

			    // Sets current process and page to current tick
			timestamps[proctmp][pagetmp] = tick;
		}
	}


    /* advance time for next pageit iteration */
    tick++;
} 
