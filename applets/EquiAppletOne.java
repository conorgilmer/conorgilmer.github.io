import java.applet.*;         // Defines classes to create an applet 
import java.awt.*;	        // Defines basic classes for GUI programming.
import java.awt.event.*;   // Defines classes for working with events.
import javax.swing.*;      // Defines the Swing GUI classes.
import javax.swing.event.*; // .....combo box... a
import java.text.*;
import java.io.*;
import java.util.*;
import java.sql.*; 			// Time
import jahuwaldt.plot.PlotWindow;	// Plot Graph

/**  * Equipotentials applet  */
 
public class EquiAppletOne extends JApplet implements ActionListener {

//items on the page Buttons, Labels input fields etc.
   private JLabel leftLabel;
   private JTextField leftField;
   private JLabel rightLabel;
   private JTextField rightField;
   private JLabel YsepLabel;
   private JTextField YsepField;
   private JLabel XsepLabel;
   private JTextField XsepField;
// Buttons   
   private JButton runSimBtn;
   private JButton graphBtn;   
   private JButton initBtn;   
   private JTextArea resultsTextArea;   
   Font boldFont = new Font("SansSerif", Font.BOLD + Font.ITALIC, 11);   

// Variables  for the simulation	
    static int V1str = 0;
    static int V2str = 0;    
    static int xSep = 0;        
    static int ySep = 0;    
    static int XSpace = xSep;
    static int YSpace = ySep;
    static int V1 = V1str;
    static int V2 = V2str;
    static int XSize = 22 + (XSpace % 2);
    static int XA = (int) ((XSize-XSpace)/2);
    static int XB = XA + XSpace;

    static final int ROWS = 16;
    static final int COLS = 24;
    static int changes = 0;
    static  String displayMsg = "Finite Difference Method";
    static double grid[][] = new double[ROWS][COLS];

//Initialize the Array
static public void setGrid(int setVal, int rows, int cols) {
 for(int i = 0 ; i < rows; i++ )     {
	 for(int j = 0 ; j < cols; j++ ) 	    {
        	grid[i][j] = setVal;
	    }
    }
}

//Set the Boundaries
static public void setBounds(int YSpace, int XSpace, int XSize, int XA, int XB, int V1, int V2)
{
 int K = 0;
 double Poten;
// Set the values of the electrodes
 for(int ix = 0 ; ix <= XA; ix++ )
    {        	grid[0][ix] = V1;
        	grid[0][ix +XB] = V2;		
        	grid[YSpace][ix] = V1;
        	grid[YSpace][ix +XB] = V2;				
    }
// Set the values of the sides 
  for(int iy = 0 ; iy <= YSpace; iy++ )
    {        	grid[iy][0] = V1;
        	grid[iy][XSize] = V2;		
    }
// Set the values between the electrodes
   for(int ix = 0 ; ix <= XSpace; ix++ )
    {	    	K = ix +XA;
		Poten = (double)V1-((((double)V1-(double)V2) * (double)ix)/(double)XSpace);
        	grid[0][K] = Poten;
        	grid[YSpace][K] = Poten;
    }
}


// Relaxation Algorithm subroutine used for ReRun
public void runRelax(EPRun epRun)
{
	   int V1 = epRun.V1();
	   int V2 = epRun.V2();
	   int XSpace = epRun.XSpace();
	   int YSpace = epRun.YSpace();

 	   setGrid(0, ROWS, COLS); // Initialize Grid to Zero

	   int XSize = 22 + (XSpace % 2);
	   int XA = (int) ((XSize-XSpace)/2);
     	   int XB = XA + XSpace;
	   displayLine("Intializing.. Set Boundaries (ReRun)\n");	   	   
	   displayMsg += " ySep= " + ySep + " xSep= " +xSep + " V1= " + V1 + " V2= " +V2 +"\n";
           setBounds(YSpace, XSpace, XSize, XA, XB, V1, V2);
           System.out.println("Relaxation Algorithm...Starting(ReRun)...");

	   // Relaxation Algorithm now 
	   double Vdiff = Math.abs(V1-V2);
           double Delta = ((Vdiff))/10000.0;
           int IT = 0; // Iteration number 
	   int CH = 0;
	   double NewVal, absNewVal;
	   int ix, iy;

//           EPRun epreRun = new EPRun(V1, V2, XSpace, YSpace);
//	   addToResendMenu(epreRun);
           do
	   {
           CH = 0; // Number of changes 
           IT++;
	   //Note differences between Java & Modula-2/Pascal Arrays! CG 19/08/1999
           for (ix = 1;  ix <= YSpace-1; ix++)
	   {
                for (iy = 1; iy <= XSize-1; iy++)
		{
                     NewVal = (grid[ix-1][iy] + grid[ix+1][iy] + grid[ix][iy-1] + grid[ix][iy+1])/4;
		     absNewVal = Math.abs(NewVal);
                     if ((absNewVal-grid[ix][iy]) >= Delta) {
                         CH++;
                         grid[ix][iy] = NewVal;
		     }
	   	}
	   }
//   	   displayMsg += printGrid(YSpace, XSize);
           displayMsg +="Iteration = " + IT + " changes " + CH;
	   } while( CH != 0);

      	   displayMsg += "Iterations converged in " + IT +" cycles";
           displayMsg += "\n End of Relaxation";
	   displayMessage(displayMsg);
           displayMessage(printGrid(YSpace, XSize) );
   	   graphBtn.setEnabled(true);
}


//Print the Grid
static public String printGrid(int ROWS, int COLS)
{
String output = "Screen Display.\n";   // Accumulate text here (should be StringBuilder).
//... Print array in rectangular form using nested for loops.
        for (int row = 0; row <= ROWS; row++) {
            for (int col = 0; col <= COLS; col++) {
            output += " " + String.format("%02d", (int)Math.round(grid[row][col]));		
            }
            output += "\n"; // New Line
        }
        output += "\n End of Display";
	return output; 
} 
  private void displayMessage(String message)
   {
	  
	  Time time = new Time(System.currentTimeMillis());
	  resultsTextArea.setFont(boldFont);
	  resultsTextArea.append(time.toLocaleString() + ":\r\n\t");
	  resultsTextArea.append(message + "\n");
   }

      private void displayLine(String message)
	   {
	  
	  resultsTextArea.setFont(boldFont);
	  resultsTextArea.append(message + "\n");
	   }
	   

   //the components are created here and added to the applet
 
   
   public void init() {
 
        /* Since I will be using the content pane several times,
           declare a variable to represent it.  Note that the
           return type of getContentPane() is Container. */
 
        Container content = getContentPane();
 
        /* Assign a background color to the applet and its
           content panel.  This color will show through between
           components and around the edges of the applet. */
 
        setBackground(Color.yellow);
        content.setBackground(Color.blue);
 
  /** End menu set-up   */
  	  JPanel umConnectPanel = new JPanel();
	  umConnectPanel.setLayout(new GridLayout(5, 2));
	  umConnectPanel.setBorder(BorderFactory.createTitledBorder( BorderFactory.createEtchedBorder(), "Simulation using the Relaxation Algorithm"));

	  //Get Inputs from Screen
	  leftLabel = new JLabel();
	  leftLabel.setText("Left Potential (e.g. 0):");
	  umConnectPanel.add(leftLabel);
	  
	  leftField = new JTextField();
	  leftField.setText("");
	  umConnectPanel.add(leftField);

	  rightLabel = new JLabel();
	  rightLabel.setText("Right Potential (e.g. 99):");
	  umConnectPanel.add(rightLabel);
	  
	  rightField = new JTextField();
	  rightField.setText("");
	  umConnectPanel.add(rightField);

	  XsepLabel = new JLabel();
	  XsepLabel.setText("X - Separation (MAX=15):");
	  umConnectPanel.add(XsepLabel);

 	  XsepField = new JTextField();
	  XsepField.setText("");
	  umConnectPanel.add(XsepField);

	  YsepLabel = new JLabel();
	  YsepLabel.setText("Y - Separation (MAX=13):");
	  umConnectPanel.add(YsepLabel);	  
	  
	  YsepField = new JTextField();
	  YsepField.setText("");
	  umConnectPanel.add(YsepField);

	  // Set up buttons
	  initBtn = new JButton("Initalize");
	  initBtn.setEnabled(true);
	  initBtn.addActionListener(this);
	  umConnectPanel.add(initBtn);
	  
	  runSimBtn = new JButton("Run Relaxation Algorithm"); 
	  runSimBtn.setEnabled(false);
	  runSimBtn.addActionListener(this);
	  umConnectPanel.add(runSimBtn);

	  resultsTextArea = new JTextArea();
	  JScrollPane resultsPanel = new JScrollPane(resultsTextArea);
	  /* graph panel*/
          JPanel graphPanel = new JPanel();
	  graphPanel.setBorder(BorderFactory.createTitledBorder(
											  BorderFactory.createEtchedBorder(), "Graph Panel"));
          graphPanel.setLayout(new GridLayout(1, 2));
	  ButtonGroup directionGroup = new ButtonGroup();

 	  //Graph Button	  
	  graphBtn = new JButton("Plot Graph");
	  graphBtn.addActionListener(this);
	  graphBtn.setEnabled(false);
	  graphPanel.add(graphBtn);
      
          Container contentPane = getContentPane();
	  contentPane.add(resultsPanel, "Center");
	  contentPane.add(umConnectPanel, "North");
	  contentPane.add(graphPanel, "South");
 
} // end init()
 
 
public void actionPerformed(ActionEvent evt) {
	   
  Object source = evt.getSource();
  if (source == initBtn)
  {  
	   V1str = Integer.parseInt(leftField.getText());
   	   V2str = Integer.parseInt(rightField.getText());	   
	   xSep = Integer.parseInt(XsepField.getText());	   
	   ySep = Integer.parseInt(YsepField.getText());	   

	   XSpace = ySep; //they are getting mixed up
	   YSpace = xSep;
	   V1 = V1str;
	   V2 = V2str;
	   if (ySep > 13)
	   {
	   	   displayMessage("Y-Separation too high.");
	   }
	   else if (xSep > 15)
	   {
	   	   displayMessage("X-Separation too high.");
	   }	   
	   else
	   {
	   displayLine("Intializing.. Set Grid");	   	   	   
 	   setGrid(0, ROWS, COLS); // Initialize Grid to Zero
	   XSize = 22 + (XSpace % 2);
	   XA = (int) ((XSize-XSpace)/2);
     	   XB = XA + XSpace;
	   displayLine("Intializing.. Set Boundaries");	   	   
	   displayMessage(" : ySep= " + ySep + " xSep= " +xSep + " V1= " + V1 + " V2= " +V2 );
           setBounds(YSpace, XSpace, XSize, XA, XB, V1, V2);
//   	   displayMsg +=printGrid(YSpace, XSize);	  
	   displayMessage(printGrid(YSpace, XSize));
   	   runSimBtn.setEnabled(true);
	   }
  }
  else if (source == runSimBtn)
	  {

           System.out.println("Relaxation Algorithm...Starting...\n");
           displayMessage("Relaxation Algorithm...Starting...");

	   // Relaxation Algorithm now 
	   double Vdiff = Math.abs(V1-V2);
           double Delta = ((Vdiff))/10000.0;
           int IT = 0; // Iteration number 
	   int CH = 0;
	   double NewVal, absNewVal;
	   int ix, iy;

           //EPRun eprun = new EPRun(V1, V2, XSpace, YSpace);
	   //addToResendMenu(eprun);
           do
	   {
           CH = 0; // Number of changes 
           IT++;
	   //Note differences between Java & Modula-2/Pascal Arrays! CG 19/08/1999
           for (ix = 1;  ix <= YSpace-1; ix++)
	   {
                for (iy = 1; iy <= XSize-1; iy++)
		{
                     NewVal = (grid[ix-1][iy] + grid[ix+1][iy] + grid[ix][iy-1] + grid[ix][iy+1])/4;
		     absNewVal = Math.abs(NewVal);
                     if ((absNewVal-grid[ix][iy]) >= Delta) {
                         CH++;
                         grid[ix][iy] = NewVal;
		     }
	   	}
	   }
//   	   displayMsg += printGrid(YSpace, XSize);
           displayMessage ("\nIteration = " + IT + " changes " + CH);
	   } while( CH != 0);

      	   displayMessage("Iterations converged in " + IT +" cycles");
           displayMsg = "\n End of Relaxation";
	   displayMessage(displayMsg);
           displayMessage(printGrid(YSpace, XSize) );
   	   graphBtn.setEnabled(true);
	  }
/*
	  else if(source == aboutItem)
	  {
		  new AboutRelaxSim(this).show();
	  }
	else if(source == readmeItem)
	  {
		  new ReadMe(this).show();
	  }*/
 
         else if (source == graphBtn)
		 {
// not here yet       
		         displayMessage("Plot a graph of this grid");
			 jahuwaldt.plot.EquiPlotWindow.main(grid);
	}
/*         else if (source == graphGrid)
	{

 not here yet        jahuwaldt.plot.EquiPlotWindow.main(grid);

	}*/

	else if(source instanceof JMenuItem)
	  {
		  JMenuItem resendItem = (JMenuItem) source;
		  Integer itemPos = new Integer(resendItem.getActionCommand());
		  
		  try
		  {
			System.out.println("Attempting to remove object from vector at position: " + itemPos.toString());
		        //EPRun rundata = (EPRun) resendableReqs.elementAt(itemPos.intValue()); 
			System.out.println("Removal successfull");
			//runRelax(rundata);
			displayMessage("Request rerun successfully");
		 }
		  catch(Exception e)
		  {
			  e.printStackTrace();
			  displayMessage("Exception Re-Running Simulation: " + e.getMessage());
	         }
		}

	  else
	  {
		   displayMessage("Unrecognised event");
	  }
      repaint();

 
	} // end actionPerformed()
 
}  // end class EquiApplet

