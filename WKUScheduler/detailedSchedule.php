<!--
This html file is responsible for the design of the webpage which will allow the user of the web application to view their generated detailed schedule.
-->
<?php
// Start the session
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
        <script src="JS/jquery-2.1.3.min.js"></script>
	</head>
    
    <!--
    A div class within the css file, scheduler.css, specifying margins, width, and background color.
    -->
	<div class="wrapper">
    
        <!--
        A div class within the css file, scheduler.css, specifying the webpage's header's positioning, background color, and float.
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
       <a href="selectClasses.php">
        <img style = "position: absolute; bottom: 0; right: 750px" src = "Images/selectClasses.png" alt = "Select Classes"></img></a>
        <a href="schedule.php">
        <img style = "position: absolute; bottom: 0; right: 600px" src = "Images/schedule.png" alt = "Schedule"></img></a>
        <a href="detailedSchedule.php">
        <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/detailedScheduleSelected.png" alt = "Detailed Schedule"></img></a>
        <a href="calendar.php">
        <img style = "position: absolute; bottom: 0; right: 300px" src = "Images/calendar.png" alt = "Calendar"></img></a>
        <a href="map.php">
        <img style = "position: absolute; bottom: 0; right: 150px" src = "Images/map.png" alt = "Map"></img></a>

		</div>
    
        <!--
        The div class within the css file, scheduler.css, specifying the webpage's content's background color, float, and width.
        -->
		<div class="content">
        <br>
        <center>
        <?php
		//If post is empty use session data, if its not set session data and set CRN
			if(!empty($_POST['crn']))
			{
            $crn = $_POST['crn'];
			$_SESSION['crn'] = $crn;
			} else
			{
				$crn = $_SESSION['crn'];
			}
			
            //connect to the MySQL database
			$con=mysqli_connect("localhost","Scheduler","BUUFTeyqAtMPFaROzBuwvMfcUPUnuvafvTOeZDg3XFJ1hGaGSrYdMrRGGpFLfRTF","Scheduler2");
			// Check connection and state if connection failed
			if (mysqli_connect_errno())
		  		echo "Failed to connect to MySQL: " . mysqli_connect_error();  
			
			 $result = mysqli_query($con,"SELECT Classes.CRN, Classes.Subject, Classes.CourseNum, Classes.Section, Classes.Credits, Classes.Title, Classes.Fee, Classes.Accounted, Classes.Remaining, Instructors.InstructorID, Instructors.FirstName, Instructors.LastName, Dates.Time, Dates.Days, Dates.Location, Dates.Date 
                                        FROM Classes, Instructors, Dates 
                                        WHERE Classes.InstructorID = Instructors.InstructorID 
                                        AND Dates.CRN = Classes.CRN 
                                        AND Classes.CRN in (".implode(', ',$crn).")");
			echo "<table border = 1 style = 'background-color: white'>";
            echo "<tr><th>CRN</th><th>Subject</th><th>Course Number</th><th>Title</th><th>Section</th><th>Credits</th>
            <th>Fee</th><th>Accounted</th><th>Remaining</th><th>Professor First Initial</th><th>Professor Last Name</th>
            <th>Time</th><th>Days</th><th>Location</th><th>Date</th>";
			while($row = mysqli_fetch_array($result)) 
			{
                echo "<tr><td>";
                echo $row['CRN'];
                echo "</td><td>";
                echo $row['Subject'];
                echo "</td><td>";
                echo $row['CourseNum'];
                echo "</td><td>";
                echo $row['Title'];
                echo "</td><td>";
                echo $row['Section'];
                echo "</td><td>";
                echo $row['Credits'];
                echo "</td><td>";
                echo $row['Fee'];
                echo "</td><td>";
                echo $row['Accounted'];
                echo "</td><td>";
                echo $row['Remaining'];
                echo "</td><td>";
                echo $row['FirstName'];
                echo "</td><td>";
                echo $row['LastName'];
                echo "</td><td>";
                echo $row['Time'];
                echo "</td><td>";
                echo $row['Days'];
                echo "</td><td>";
                echo $row['Location'];
                echo "</td><td>";
                echo $row['Date'];
                echo "</td></tr>";
  			}
            echo "</table>";
           
            ?>
            </center>
		</div>
    
	</div>

	</body>
</html>