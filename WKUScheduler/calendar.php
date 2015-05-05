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
        <a href="calendar.php">
        <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/calendarSelected.png" alt = "Calendar"></img></a>
        <a href="map.php">
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
                
                $classes = array("39463","00007", "00031", "00047", "38191");
                $times = array();
                $days = array();
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
                $times[] = $row['Time'];
                $days[] = $row['Days'];
                $subs[] = $row['Subject'];
                $cns[] = $row['CourseNum'];
                $titles[] = $row['Title'];
            }  

            for($j = 0; $j < 12; $j++)
            {
                $displayTime = (8 + $j)%12;
                if($displayTime == 0)
                    $displayTime = 12;
                $am_or_pm = "";
                if($displayTime >= 8 && $displayTime <= 11)
                    $am_or_pm = "AM";
                else
                    $am_or_pm = "PM";
                echo "<tr>";
                echo "<td>$displayTime $am_or_pm</td>";
                
                for($k = 0; $k < 7; $k++)
                {
                    $currentDay = "";
                    $resultFound = false;
                    if($k == 0)
                        $currentDay = "M";
                    elseif($k == 1)
                        $currentDay = "T";
                    elseif($k == 2)
                        $currentDay = "W";
                    elseif($k == 3)
                        $currentDay = "R";
                    elseif($k == 4)
                        $currentDay = "F";
                    elseif($k == 5)
                        $currentDay = "S";
                    
                    for($l = 0; $l < count($times); $l++)
                    {   
                        if(substr($times[$l], 0, 2) == $displayTime && strpos($days[$l], $currentDay) !== false)
                        {
                            echo "<td>$subs[$l] $cns[$l] $titles[$l] $times[$l] $days[$l]</td>";
                            $resultFound = true;
                            break;
                        }                        
                    }
                    if($resultFound == false)
                        echo "<td></td>";
                }
                
                echo "</tr>";  
            }
                /*
                if (0 === strpos($times[$j], '08'))
                {

                    if($days[$j] == "M")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>"; 
                                    echo "</tr>";
                                }
                    
                                if($days[$j] == "T")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days[$j] == "W")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days[$j] == "R")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days[$j] == "F")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days[$j] == "S")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days[$j] == "MW")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days[$j] == "MWF")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                    
                                if($days[$j] == "TR")
                                {
                                    echo "<tr>";
                                    echo "<td> 8 AM </td>";
                                    echo "<td></td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td>$subs[$j] $cns[$j] $titles[$j] $times[$j] $days[$j]</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                        }
                
                        else
                        {
                            $time = (8 + $j)%12;
                            if($time == 0)
                                $time = 12;
                            $am_or_pm = "";
                            if($time >= 8 && $time <= 11)
                                $am_or_pm = "AM";
                            else
                                $am_or_pm = "PM";
                            echo "<tr>";
                            echo "<td> $time $am_or_pm </td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>"; 
                        }*/
                
                        


            ?>
                
            </table>
            </center>
        </body>
		</div>
    
	</div>

	
</html>
