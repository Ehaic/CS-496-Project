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
        <img style = "position: absolute; bottom: 0; right: 600px" src = "Images/scheduleSelected.png" alt = "Schedule"></img></a>
        <a href="calendar.html">
        <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/calendar.png" alt = "Calendar"></img></a>
        <a href="map.html">
        <img style = "position: absolute; bottom: 0; right: 300px" src = "Images/map.png" alt = "Map"></img></a>

        <a style = "position: absolute; bottom: 0; right: 120px; color: white" href="">Login</a>
        <a style = "position: absolute; bottom: 0; right: 50px; color: white" href="">Register</a>
		</div>
    
		<div class="content">
        <br>
        <?php
            //connect to the MySQL database
            $con=mysqli_connect("localhost","Taylor","tama4793!","scheduler");
            // Check connection and state if connection failed
            if (mysqli_connect_errno())
                echo "Failed to connect to MySQL: " . mysqli_connect_error();              
            //store all questions in result variable
            $result = mysqli_query($con,"SELECT CRN from classes where Subject = '$test'");

            $classes = $_POST["classes"];
            $classes = array_map('strval', $classes);
            print_r($classes);
            $test = "";

            for($i = 0; $i < strlen($classes[0]); $i++)
            {
                if(substr($classes[0], $i, 1) == ' ')
                {        
                    //store all questions in result variable
                    $result = mysqli_query($con,"SELECT CRN from classes where Subject = '$test'");        
                    //while we still have questions in result
                    while($row = mysqli_fetch_array($result)) 
                    {
                        echo $row['CRN'];
                        echo ", ";
                    }
                    break;
                }
                $test = substr($classes[0], 0, $i+1);
            }
            echo $test;
        ?>
		</div>
	</div>
	</body>
</html>
