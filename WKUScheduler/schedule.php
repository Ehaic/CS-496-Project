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
            
            $( document ).ready(function() {
				var i = 0;
        $('#add').click(function(){
			i++
            var text = "hello " + i + "  <button>Remove</button>";
            if(text.length){
                $('<li />', {html: text}).appendTo('ul.CourseList')
            }
        });
        $('ul.CourseList').on('click','button' , function(addScheduleList){
            $(this).parent().appendTo('ul.ScheduleList')
        });
		$('ul.ScheduleList').on('click','button', function(removeScheduleList){
			$(this).parent().appendTo('ul.CourseList')
		});
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
            <ul style="list-style: none" class="RemovedList"></ul>
        </div>    
            
        <div id="schedule" title="Schedule">
            <p>Scheduled Classes</p>
            <ul style="list-style: none" class="ScheduleList"></ul>
        </div>
            
        <br>
        <center>
        <ul style="list-style: none" class = "CourseList"></ul>    
        <button id="add">Test</button>
            
        <?php
            //connect to the MySQL database
            $con=mysqli_connect("localhost","Taylor","tama4793!","Scheduler2");
            // Check connection and state if connection failed
            if (mysqli_connect_errno())
                echo "Failed to connect to MySQL: " . mysqli_connect_error();              

            //Retrieve subject data from database
            $subject = $_POST["subject"];
            //Retrieve courseNum data from database
            $courseNum = $_POST["courseNum"];
            //Converts to a string.
            $subject = array_map('strval', $subject);
            $courseNum = array_map('strval', $courseNum);
            //Print subject and courseNum data
            print_r($subject);
            print_r($courseNum);
            //Break for space and organization
            echo "<br>";

            for($i = 0; $i < count($subject); $i++)
            {
                //Allows to round down to numbers
                $highestNum = floor(intval($courseNum[$i])/100);
                $maxIndex = $i;

                for($j = $i; $j < count($subject); $j++)
                {
                    if(floor(intval($courseNum[$j])/100) > $highestNum)
                    {
                        $highestNum = floor(intval($courseNum[$j])/100);
                        $maxIndex = $j;
                    }
                }
                
                $tempSubject = $subject[$i];
                $tempCourse = $courseNum[$i];
                $newSubject = $subject[$maxIndex];
                $newCourse = $courseNum[$maxIndex];

                $subject[$i] = $newSubject;
                $courseNum[$i] = $newCourse;
                $subject[$maxIndex] = $tempSubject;
                $courseNum[$maxIndex] = $tempCourse;
            }

            $count = array();
            for($i = 0; $i < count($subject); $i++)
            {
                $subj = $subject[$i];
                $cNum = $courseNum[$i];
                $result = mysqli_query($con,"SELECT COUNT(DISTINCT CRN) AS ClassCount FROM Classes WHERE Subject = '$subj' AND CourseNum = '$cNum'");

                while($row = mysqli_fetch_array($result))
                {
                    array_push($count, $row['ClassCount']);
                }
            }

            for($i = 1; $i < count($subject); $i++)
            {
                if(floor(intval($courseNum[$i])/100) == floor(intval($courseNum[$i-1])/100))
                {
                    if($count[$i] < $count[$i - 1])
                    {
                        $tempCount = $count[$i-1];
                        $tempSubject = $subject[$i-1];
                        $tempCourse = $courseNum[$i-1];
                        $newCount = $count[$i];
                        $newSubject = $subject[$i];
                        $newCourse = $courseNum[$i];

                        $subject[$i-1] = $newSubject;
                        $courseNum[$i-1] = $newCourse;
                        $count[$i-1] = $newCount;
                        $subject[$i] = $tempSubject;
                        $courseNum[$i] = $tempCourse;
                        $count[$i] = $tempCount;
                    }
                }
            }
            //Print subject and courseNum data
            print_r($subject);
            print_r($courseNum);
            //Break for space and organization
            echo "<br>";

            for($i = 0; $i < count($subject); $i++)
            {
                echo "<br>";
                $subj = $subject[$i];
                $cNum = $courseNum[$i];
                //store all questions in result variable
                $result = mysqli_query($con,"SELECT Classes.CRN, Classes.Subject, Classes.CourseNum, Classes.Credits, Classes.Title, Classes.Fee, 
                    Classes.Remaining, Instructors.InstructorID, Instructors.FirstName, Instructors.LastName, Dates.Time, Dates.Days, Dates.Location, 
                    Dates.Date FROM Classes, Instructors, Dates WHERE Classes.InstructorID = Instructors.InstructorID AND Dates.CRN = Classes.CRN 
                    AND Subject = '$subj' AND CourseNum = '$cNum'");     
                //while we still have questions in result
                while($row = mysqli_fetch_array($result)) 
                {
                    echo "<font size='4'> | {$row['Subject']} | {$row['CourseNum']} | {$row['Credits']} | {$row['Title']} | {$row['Fee']} | {$row['Remaining']}
                     | {$row['FirstName']}. {$row['LastName']} | {$row['Time']} | {$row['Days']} | {$row['Location']} | {$row['Date']} | <br>";
                }
            }
        ?>
        </center>
		</div>
	</div>
</html>
