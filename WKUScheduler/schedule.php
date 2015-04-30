<!DOCTYPE html>
<html>
	<head>
		<title > WKU Class Scheduler </title>
		<link rel="stylesheet" type="text/css" href="CSS/scheduler.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="JS/jquery-2.1.3.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <style>
            .no-close .ui-dialog-titlebar-close
            {
                display: none;
            }
            
            .ui-dialog 
            {
                position:absolute;
            }
                     
        </style>
        <script>
        $(function() {
            $( "#removed" ).dialog({
            dialogClass: "no-close",
            draggable: false,
            resizable: false,
            position:{ my: 'left bottom', at: 'left bottom', of: window }});
        });
        
        $(function() {
            $( "#schedule" ).dialog({
            dialogClass: "no-close",
            draggable: false,
            resizable: false,
            position:{ my: 'right bottom', at: 'right bottom', of: window }});
        });
            
        </script>
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
    
		<div class="content" id = "content">
        
        <div id="removed" title="Removed Classes">
            <p>Conflicting Classes</p>
        </div>    
            
        <div id="schedule" title="Schedule">
            <p>Scheduled Classes</p>
        </div>
            
        <br>
        <center>
        <?php
            //connect to the MySQL database
            $con=mysqli_connect("localhost","Taylor","tama4793!","Scheduler2");
            // Check connection and state if connection failed
            if (mysqli_connect_errno())
                echo "Failed to connect to MySQL: " . mysqli_connect_error();              
            //store all questions in result variable
            $result = mysqli_query($con,"SELECT CRN from classes where Subject = '$test'");

            $subject = $_POST["subject"];
            $courseNum = $_POST["courseNum"];
            $subject = array_map('strval', $subject);
            $courseNum = array_map('strval', $courseNum);
            print_r($subject);
            print_r($courseNum);

            for($i = 0; $i < count($subject); $i++)
            {
                echo "Running Query. . .<br>";
                $subj = $subject[$i];
                $cNum = $courseNum[$i];
                //store all questions in result variable
                $result = mysqli_query($con,"SELECT CRN, Subject, CourseNum, Section, Location, Day FROM Classes 
                    WHERE Subject = '$subj' AND CourseNum = '$cNum'");        
                //while we still have questions in result
                while($row = mysqli_fetch_array($result)) 
                {
                    echo "{$row['CRN']} - {$row['Subject']} {$row['CourseNum']}-{$row['Section']}, {$row['Day']} at {$row['Location']}<br>";
                }
            }
        ?>
        </center>
		</div>
	</div>
</html>
