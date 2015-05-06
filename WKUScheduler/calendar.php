<!--
This html file is responsible for the webpage which will allow the user of the web application to view their generated weekly calendar of classes.
-->
<?php
// Start the session to retrieve session data from schedule page
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title > WKU Class Scheduler </title>
         <!--
        The css file used for web design.
         -->
		<link rel="stylesheet" type="text/css" href="CSS/scheduler.css">
	</head>
    
    <!--
    A div class within the css file, scheduler.css, specifying margins, width, and background color.
    -->
	<div class="wrapper">
         
        <!--
        A div class within the css file, scheduler.css, specifying the webpage's 
        header's positioning, background color, and float.
        -->
		<div class="header">
            
        <!--
        The specified location for web application's logo image.
        -->    
        <a href = "index.html"><img style = "float: left" src = "Images/logo.png" alt = "WKU Class Scheduler"></img></a>
        
        <!--
        The tabs and their specified styles.
        -->
        <a href="selectClasses.php">
        <img style = "position: absolute; bottom: 0; right: 750px" src = "Images/selectClasses.png" alt = "Select Classes">
        </img></a>
        <a href="schedule.php">
        <img style = "position: absolute; bottom: 0; right: 600px" src = "Images/schedule.png" alt = "Schedule"></img></a>
        <a href="detailedSchedule.php">
        <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/detailedSchedule.png" alt = "Detailed Schedule">
        </img></a>
        <a href="calendar.php">
        <img style = "position: absolute; bottom: 0; right: 300px" src = "Images/calendarSelected.png" alt = "Calendar">
        </img></a>
        <a href="map.php">
        <img style = "position: absolute; bottom: 0; right: 150px" src = "Images/map.png" alt = "Map"></img></a>

		</div>

        <!--
        The div class within the css file, scheduler.css, specifying the webpage's content's background color, float, and width.
        -->
		<div class="content">
        <body>
            <br>
            
            <center>
            <!--- Create a table for our calendar -->
            <table border="1" width = "1000" style="background-color:white">
            <!--- CReate a row of headers --->
            <tr>
                <th> </th>
                <th>MONDAY</th>
                <th>TUESDAY</th>
                <th>WEDNESDAY</th>
                <th>THURSDAY</th>
                <th>FRIDAY</th>
                <th>SATURDAY</th>
                <th>SUNDAY</th>
            </tr>
            
            <?php
                
                //Get session data from schedule and save it in an array called crn
                $classes = $_SESSION['crn'];
                //Create time and days arrays for calendar placement later
                $times = array();
                $days = array();
                echo "<br>";

            //connect to the MySQL database
			$con=mysqli_connect("localhost","Taylor","tama4793!","Scheduler2");
			// Check connection and state if connection failed
			if (mysqli_connect_errno())
		  		echo "Failed to connect to MySQL: " . mysqli_connect_error();  
			
            //Select all information needed for the calendar 
            //The AND statement selects only those query results with CRNs equal to those found in crn array
            $result = mysqli_query($con,"SELECT Classes.CRN, Classes.Subject, Classes.CourseNum, Classes.Title, Dates.Time,                                               Dates.Days, Dates.Location
                                        FROM Classes, Dates
                                        WHERE Classes.CRN = Dates.CRN
                                        AND Classes.CRN IN (".implode(', ',$classes).")
                                        ORDER BY STR_TO_DATE( SUBSTRING( Dates.Time, 1, 8 ) ,  '%l:%i %p' ) ");
  
            //while we go through the query result, save the information to arrays for each property
            while($row = mysqli_fetch_array($result)) 
            {
                $times[] = $row['Time'];
                $days[] = $row['Days'];
                $subs[] = $row['Subject'];
                $cns[] = $row['CourseNum'];
                $titles[] = $row['Title'];
            }  

            //for as many time slots as we need (8 am - 7 pm)
            for($j = 0; $j < 12; $j++)
            {
                //calculate the time displayed in the table labels
                $displayTime = (8 + $j)%12;
                if($displayTime == 0)
                    $displayTime = 12;
                $am_or_pm = "";
                //place am by times 8 - 11, else place pm
                if($displayTime >= 8 && $displayTime <= 11)
                    $am_or_pm = "AM";
                else
                    $am_or_pm = "PM";
                //start the row and show the display time for that row
                echo "<tr>";
                echo "<td>$displayTime $am_or_pm</td>";
                
                //for every day in the week
                for($k = 0; $k < 7; $k++)
                {
                    $currentDay = "";
                    //set resultFound to false, as we haven't found a class for that specific time/day in the calendar
                    $resultFound = false;
                    //if the loop is on 0, the day is Monday
                    if($k == 0)
                        $currentDay = "M";
                    //if the loop is on 1, the day is Tuesday
                    elseif($k == 1)
                        $currentDay = "T";
                    //if the loop is on 2, the day is Wednesday
                    elseif($k == 2)
                        $currentDay = "W";
                    //if the loop is on 3, the day is Thursday
                    elseif($k == 3)
                        $currentDay = "R";
                    //if the loop is on 4, the day is Friday
                    elseif($k == 4)
                        $currentDay = "F";
                    //if the loop is on 5, the day is Saturday
                    elseif($k == 5)
                        $currentDay = "S";
                    
                    //for how many times (# of classes) we have been passed from schedule page
                    for($l = 0; $l < count($times); $l++)
                    {   
                        //if the time of that class begins with the displayTime we are on in the loop
                        //and if the day of that class is the same as the current day we are on in the loop
                        if(substr($times[$l], 0, 2) == $displayTime && strpos($days[$l], $currentDay) !== false)
                        {
                            //echo the information for that class
                            echo "<td>$subs[$l] $cns[$l] $titles[$l] $times[$l] $days[$l]</td>";
                            //set resultFound to true, as we have a class for that time and day
                            $resultFound = true;
                            break;
                        }                        
                    }
                    //if nothing is found, place a blank space for that time/day spot in the calendar
                    if($resultFound == false)
                        echo "<td></td>";
                }
                
                //end the table row after each day of each time has been created
                echo "</tr>";  
            }
 
            ?>
            <!--- Close our calendar table -->    
            </table>
            </center>
        </body>
		</div>
    
	</div>

	
</html>
