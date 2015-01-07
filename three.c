#include <stdio.h>
/* Three Card Game Paradox
 * by Conor Gilmer
 */

/* globals */
int n = 0; /* number of Runs */

/* return the card corresponding to the number */
char card(int x) 
{
	char cards[] = {'A','B','C'};
	return(cards[x-1]);
} 

/* Three card game iteration */ 
int run () {

	int winning, chosen, remov;
	n++;
	printf("Run %d \t", n);
	winning = rand()%3 + 1;
	chosen = rand()%3 + 1;
	
	do {
		remov = rand()%3 + 1;
/*	printf("Removing no %d, (%d, %d) \n", remov, winning, chosen);*/
	} while ((chosen == remov) || (winning == remov));

	printf("Winning no %c \t", card(winning));
	printf("Chosen no %c \t", card(chosen));
	printf("Removing no %c \t", card(remov));

	/* sticking so have you won*/
	if (chosen == winning) {
		printf("Sticking Wins\n");
		return 0;
	} else {
		printf("Twisting Wins\n");
		return 1;
	}
}

int main()
{
	int twist = 0;
	int stick = 0;
	int games = 112; /* number of runs */
	int m;
	float twistPC = 0.0;
	float stickPC = 0.0;

	printf("Three Card Game Paradox\n");
	/* play the game games times */
	for (m = 1; m < games+1; m++)
	{
		if (run() ==0) 
			stick++; 
		else 
			twist++;
	}

	/* get the percentages of wins for switching and twisting */
	twistPC = (((float)twist/games) * 100.0);
	stickPC = (((float)stick/games) * 100.0);

	/* output results */
	printf("Results:\n");
	printf("Sticking wins: %d times (%f %)\n", stick, stickPC);
	printf("Twisting wins: %d times (%f %)\n", twist, twistPC);
	/* verdict */
	if (stick > twist)
		printf("It is better to stick with your original choice.\n");
	else
		printf("It is better to twist.\n");
	printf("The End\n");

	return 0;
}
