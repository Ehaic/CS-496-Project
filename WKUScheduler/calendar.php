<!DOCTYPE html>
<html>
	<head>
		<title > WKU Class Scheduler </title>
		<link rel="stylesheet" type="text/css" href="CSS/scheduler.css">
	</head>
    
	<div class="wrapper">
    
		<div class="header">
        <a href = "index.html"><img style = "float: left" src = "Images/logo.png" alt = "WKU Class Scheduler"></img></a>
        <a href="selectClasses.php">
        <img style = "position: absolute; bottom: 0; right: 750px" src = "Images/selectClasses.png" alt = "Select Classes"></img></a>
        <a href="schedule.php">
        <img style = "position: absolute; bottom: 0; right: 600px" src = "Images/schedule.png" alt = "Schedule"></img></a>
        <a href="calendar.html">
        <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/calendarSelected.png" alt = "Calendar"></img></a>
        <a href="map.html">
        <img style = "position: absolute; bottom: 0; right: 300px" src = "Images/map.png" alt = "Map"></img></a>

        <a style = "position: absolute; bottom: 0; right: 120px; color: white" href="">Login</a>
        <a style = "position: absolute; bottom: 0; right: 50px; color: white" href="">Register</a>

		</div>

		<div class="content">
        <body>
            <br>
            
            <center>
            <table border="1" width = "1000" style="background-color:white">
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
                
                $classes = array("00003","15318", "15606", "15615", "15678");
                echo "<br>";

                //connect to the MySQL database
			$con=mysqli_connect("localhost","Taylor","tama4793!","Scheduler2");
			// Check connection and state if connection failed
			if (mysqli_connect_errno())
		  		echo "Failed to connect to MySQL: " . mysqli_connect_error();  
			//store all questions in result variable

            $result = mysqli_query($con,"SELECT Classes.CRN, Classes.Subject, Classes.CourseNum, Classes.Title, Dates.Time,                                         Dates.Days, Dates.Location
                                        FROM Classes, Dates
                                        WHERE Classes.CRN = Dates.CRN
                                        AND Classes.CRN IN (".implode(', ',$classes).")
                                        ORDER BY STR_TO_DATE( SUBSTRING( Dates.Time, 1, 8 ) ,  '%l:%i %p' ) ");
  
                    while($row = mysqli_fetch_array($result)) 
			         {
                        $time = $row['Time'];
                        $days = $row['Days'];
                        $sub = $row['Subject'];
                        $cn = $row['CourseNum'];
                        $title = $row['Title'];
                        
                        if (0 === strpos($time, '08')) 
                        {
                                 if($days == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                        
                        if (0 === strpos($time, '09')) 
                        {
                                 if($days == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 9 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 9 AM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 9 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 9 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 9 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 9 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 9 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 9 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 9 AM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                        
                        if (0 === strpos($time, '10')) 
                        {
                                 if($days == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 10 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 10 AM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 10 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 10 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 10 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 10 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 10 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 10 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 10 AM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                        
                        if (0 === strpos($time, '11')) 
                        {
                                 if($days == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 11 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 11 AM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 11 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 11 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 11 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 11 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 11 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 11 AM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 11 AM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                        
                        if (0 === strpos($time, '12')) 
                        {
                                 if($days == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 12 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 12 PM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 12 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 12 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 12 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 12 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 12 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 12 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 12 PM</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                        
                        if (0 === strpos($time, '01')) 
                        {
                                 if($days == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 1 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 1 PM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 1 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 1 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 1 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 1 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 1 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 1 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 1 PM</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                        
                        if (0 === strpos($time, '02')) 
                        {
                                 if($days == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 2 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 2 PM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 2 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 2 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 2 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 2 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 2 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 2 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 2 PM</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                        
                        if (0 === strpos($time, '03')) 
                        {
                                 if($days == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 3 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 3 PM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 3 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 3 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 3 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 3 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 3 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 3 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 3 PM</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                        
                        if (0 === strpos($time, '04')) 
                        {
                                 if($days == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 4 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 4 PM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 4 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 4 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 4 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 4 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 4 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 4 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 4 PM</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                        
                        if (0 === strpos($time, '05')) 
                        {
                                 if($days == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 5 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 5 PM </td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 5 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 5 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 5 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 5 PM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 5 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 5 PM </td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 5 PM</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td>$sub $cn $title $time $days</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                    
            }
 


            ?>
                
            </table>
            </center>
        </body>
		</div>
    
	</div>

	
</html>
