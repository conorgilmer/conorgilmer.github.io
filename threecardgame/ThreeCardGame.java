/* The Three Card Game Paradox.  
 * the player has three cards to chose from, with one having a prize
 * after the player choses a card, if one card which is inccorect is removed
 * and you are given the option to stay with your card or select the other 
 * remaining card it is better to change you have more chances of winning 
 * yet your gut things its a 1 in 2 chances of winning 
 * when changing is really 2 out of 3 chances of winning and 
 * staying is 1 out of 3 chances of winning*/

import java.util.Random;
import java.util.Scanner;

public final class ThreeCardGame {
  
  public static char[] cards = new char[]{'a','b','c'}; // array of 3 characters (cards)

  public static final void main(String... aArgs){
    log("The Three Card Game.");
    Scanner scan = new Scanner(System.in);

    log("Do you want to play (press p) or simulate a number of games (press s).");
    String yorn = scan.next();
    if (yorn.equalsIgnoreCase("p")){
	log("Pick a card 'a', 'b', or 'c'");
        String card = scan.next();
	//get the numerical equivalent of the card chosen (should use position in array?)
        int cardI =  0;
        if (card.equalsIgnoreCase("a"))
           cardI =0;
        else if (card.equalsIgnoreCase("b"))
           cardI =1;
        else if (card.equalsIgnoreCase("c"))
           cardI =2;
	else {
	log("not a card here!");
	return;}
        singleRun(cardI);

    }

    else if (yorn.equalsIgnoreCase("s")){
	log("How many times do you want to run the test.");
	int runs = scan.nextInt(); 
	autoRun(runs);
    }
    else
	log("You chose not to play or simulate");

  } // end of main function

  public static void autoRun(int runNo)
    {
    String result = "Who Knows";
    int stickwins = 0; //counters of wins and losses
    int sticklost = 0;
    int switchwins = 0;
    int switchlost = 0;
    int percent = 0;
 
    log("Running " + runNo + " times:");
    //note a single Random object is reused here
    //it maybe more random to use a different randomiser for choice and winning card.
    Random randomGenerator = new Random();
    for (int idx = 1; idx <= runNo; ++idx){
      int prize = randomGenerator.nextInt(3);
      int choice = randomGenerator.nextInt(3);
      int onewrong = 0;
      while (onewrong == choice || onewrong == prize) { 
      onewrong = randomGenerator.nextInt(3);}
      if (prize == choice) {
         stickwins++;
         result = "win";}
      else{
        sticklost++;
	result = "lose";}

      log("Generated : Winning Card - " + cards[prize] + " Card Chosen - " + cards[choice] + " Removed Card - " + cards[onewrong] + " Result " +result);
    }
    //Results 
    log("\nResults:\nSticking wins you " + stickwins + " times." );
    log("Changing wins you " + sticklost +" times." );
    if (stickwins == sticklost){
	// have to try 2 run to get this condition
        log("Changing or Switching the same." );
	}
    else if (stickwins < sticklost){
	//percent = (stickwins * 100)/sticklost;
	percent = (sticklost * 100/runNo);
        log("Changing wins more times." + percent + "%");
	}
    else {
	// have to try 1 run to get this condition
        log("Sticking wins more times." );
	}
  } // end of simulated multiple runs

//single run
  public static void singleRun(int choice)
    {
    String result = "Who Knows";
    int stickwins = 0;
    int sticklost = 0;
    int switchwins = 0;
    int switchlost = 0;
    int percent = 0;

    log("Play Game:");
    //note a single Random object is reused here
    Random randomGenerator = new Random();
      int prize = randomGenerator.nextInt(3);
      int onewrong = 0;
      while (onewrong == choice || onewrong == prize) { 
      onewrong = randomGenerator.nextInt(3);}
      log("Removing One incorrect card ");
      log("Removed " + cards[onewrong] );
      int othercard = 0;
      for (int count = 0; count <= 2; count++) {
        if (count != choice && count != onewrong)
	othercard = count;
      }
      
      log("Cards left [" + cards[choice] + "] and " + cards[othercard]);
      log("Do you want to stick(s) or twist(t)");

      Scanner SorT = new Scanner(System.in);
      String twist = SorT.next();
      //change choice if twist or the other card are typed in else stick with original choice
      if ((twist.equalsIgnoreCase("t")) ||
	 (twist.equalsIgnoreCase(Character.toString(cards[othercard])))) {
         choice = othercard;
	 twist = "twisted choosing "; } 
      else
         twist = "stuck with ";
      if (prize == choice) {
         result = "win";
	}
      else{
	result = "lose";}

      log("Game: Winning Card \"" + cards[prize] + "\" Player " + twist + "["+ cards[choice] + "] - Result " +result);
  } // end of single run function
  
//displaying to screen function
  private static void log(String aMessage){
    System.out.println(aMessage);
  }

}

