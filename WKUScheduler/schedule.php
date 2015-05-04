<!DOCTYPE html>
<html>
   <head>
   <title >WKU Class Scheduler</title>
   <link rel="stylesheet" type="text/css" href="CSS/scheduler.css">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   <script src="JS/jquery-2.1.3.min.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <style>
.no-close .ui-dialog-titlebar-close {
	display: none;
}
.ui-dialog {
	position: absolute;
}
</style>
   <script>
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
                position:fixed;
                top:400px;
                bottom:0px; 
                left:0px;
            }
                     
        </style>
        
        <script>
		
		
        $(function() {
            $( "#removed" ).dialog({
            dialogClass: "no-close",
            draggable: false,
            resizable: false,
            maxHeight: 400,
            position:{ my: 'left bottom', at: 'left bottom', of: window }});
        });
        
        $(function() {
            $( "#schedule" ).dialog({
            dialogClass: "no-close",
            draggable: false,
            resizable: false,
            maxHeight: 400,
            position:{ my: 'right bottom', at: 'right bottom', of: window }});
        });
   </script>
   </head>
   
   <div class="wrapper">
     <div class="header"> <a href = "index.html"><img style = "float: left" src = "Images/logo.png" alt = "WKU Class Scheduler"></img></a> <a href="selectClasses.php"> <img style = "position: absolute; bottom: 0; right: 750px" src = "Images/selectClasses.png" alt = "Select Classes"></img></a> <a href="schedule.php"> <img style = "position: absolute; bottom: 0; right: 600px" src = "Images/scheduleSelected.png" alt = "Schedule"></img></a> <a href="calendar.html"> <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/calendar.png" alt = "Calendar"></img></a> <a href="map.html"> <img style = "position: absolute; bottom: 0; right: 300px" src = "Images/map.png" alt = "Map"></img></a> <a style = "position: absolute; bottom: 0; right: 120px; color: white" href="">Login</a> <a style = "position: absolute; bottom: 0; right: 50px; color: white" href="">Register</a> </div>
     <div class="content" id = "content">
       <div id="removed" title="Removed Classes">
         <p>Conflicting Classes</p>
         <ul style="list-style: none" class="RemovedList">
         </ul>
       </div>
       <div id="schedule" title="Schedule">
         <p>Scheduled Classes</p>
         <ul style="list-style: none" class="ScheduleList">
         </ul>
       </div>
       <br>
       <center>
         <div class = "CourseList"> </div>
         <?php
    
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
            <ul style="list-style: none" class="RemovedList"></ul>
        </div>    
            
        <div id="schedule" title="Schedule">
            <ul style="list-style: none" class="ScheduleList"></ul>
        </div>
            
        <br>
        <center>
        <ul style="list-style: none" class = "CourseList"></ul>    
        <button id="add">Test</button>
            
        <?php
>>>>>>> origin/Andrews-Awesome-Branch
            //connect to the MySQL database
            $con=mysqli_connect("localhost","Taylor","tama4793!","Scheduler2");
            // Check connection and state if connection failed
            if (mysqli_connect_errno())
                echo "Failed to connect to MySQL: " . mysqli_connect_error();              
			$Courses_Array = array();
            //Retrieve subject data from database
            $subject = $_POST["subject"];
            //Retrieve courseNum data from database
            $courseNum = $_POST["courseNum"];
            //Converts to a string.
            $subject = array_map('strval', $subject);
            $courseNum = array_map('strval', $courseNum);
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
					$temp_Array = array($row['Subject'] , $row['CourseNum'],$row['Credits'], $row['Title'], $row['Fee'], $row['Remaining'], $row['FirstName'], $row['LastName'], $row['Time'], $row['Days'], $row['Location'], $row['Date'], $row['CRN']);
					array_push($Courses_Array, $temp_Array);
                }
            }
        ?>
         <script type="text/javascript">
		// pass PHP variable declared above to JavaScript variable
		var the_array = <?php echo json_encode($Courses_Array) ?>;
		var arrayLength = the_array.length;
		</script> 
         <script>
		 var subject_array = [];
		 var courseNum_array = [];
		 var crn = null;
        $( document ).ready(function() 
		{
			var cur_subject = null;
			var prev_subject = null;
			var cur_courseNum = null;
			var prev_courseNum = null;
			var text = null;
			var header_text = null;
			var unordered_list = null;
			var orderNum = null;
			var idNum = 0;
    		for(var i = 0; i < arrayLength; i++)
			{
			cur_subject = the_array[i][0];
			cur_courseNum = the_array[i][1];
			if(cur_subject == prev_subject)
			{
				 text ='<li data-subject = "' + cur_subject + '" data-order = "' + orderNum + '" data-crn = "' + the_array[i][12] + '" data-courseNum = "' + the_array[i][1] + '">' + the_array[i][0] + " " + the_array[i][1] + " " + the_array[i][2] + " " + the_array[i][3] + " " + the_array[i][4] + " " + the_array[i][5] + " " + the_array[i][6] + " " + the_array[i][7] + " " + the_array[i][8] + " " + the_array[i][9] + " " + the_array[i][10] + " " + the_array[i][11] + "  <button>Add To Schedule</button></li>";
                $( text ).appendTo('#' + cur_subject);
				orderNum++;
			}
			else
			{
				idNum++
				orderNum = 0;
				subject_array.push(cur_subject);
				courseNum_array.push(cur_courseNum);
			unordered_list = '<ul style="list-style: none" id = "' + cur_subject + '"></ul>'
			header_text = '<li id ="' + cur_subject + '" data-order = "' + orderNum + '"> <h1>' + cur_subject + " " + cur_courseNum + " Classes" + "</h1></li>";
			orderNum++;
            text = '<li data-subject = "' + cur_subject + '" data-order = "' + orderNum + '" data-crn = "' + the_array[i][12] + '" data-courseNum = "' + the_array[i][1] + '">' + the_array[i][0] + " " + the_array[i][1] + " " + the_array[i][2] + " " + the_array[i][3] + " " + the_array[i][4] + " " + the_array[i][5] + " " + the_array[i][6] + " " + the_array[i][7] + " " + the_array[i][8] + " " + the_array[i][9] + " " + the_array[i][10] + " " + the_array[i][11] + "  <button class = " + the_array[i][0] + ">Add To Schedule</button></li>" ;
				$( unordered_list ).appendTo( ".CourseList" );
				$( header_text ).appendTo('#' + cur_subject);
                $( text ).appendTo('#' + cur_subject);
			}
			prev_subject = cur_subject;
			prev_courseNum = cur_courseNum;
		}
		console.log(courseNum_array);
		console.log(subject_array);
		});
		
		$( document ).ready(function() {
			for(var i = 0; i < subject_array.length; i++)
			{
				var ulname = "#" + subject_array[i];
				//Any button pressed in the center list do the following functions
        $(ulname).on('click','button' , function(addScheduleList){
            $(this).parent().appendTo('ul.ScheduleList');
			var local_crn = $(this).parent().attr('data-crn');
			var local_subject = $(this).parent().attr('data-subject');
			var local_courseNum = $(this).parent().attr('data-courseNum');
			//Add any courses with the same CRN to the scheduleList UL
			$('li[data-crn = "' + local_crn + '"]').each(function(index, element) {
				$(this).appendTo('ul.ScheduleList');
            });
			//Add any course with a different crn and same courseNum to the conflict list.
			$('li[data-subject ="' + local_subject + '"]').each(function(index, element) {
				if($(this).attr('data-crn') != local_crn  && $(this).attr('data-courseNum') == local_courseNum)
				{
				$(this).appendTo('ul.RemovedList');
				}
            });
        });
			}
			//on button press in the schedule list
			$('ul.ScheduleList').on('click','button', function(removeScheduleList){
			var ulname = $(this).parent().attr('data-subject');
			var order = $(this).parent().attr('data-order');
			var local_crn = $(this).parent().attr('data-crn');
			var local_courseNum = $(this).parent().attr('data-courseNum');
			$('li[data-courseNum = "' + local_courseNum + '"]').each(function(index, element) {
				if($(this).attr('data-subject') == ulname){
				$(this).appendTo('#' + ulname);
				}
            });
		});
		//on button press in conflincting list
		$('ul.RemovedList').on('click','button', function(conflinctedClassRemove){
			var ulname = $(this).parent().attr('data-subject');
			var local_courseNum = $(this).parent().attr('data-courseNum');
			$('li[data-courseNum = "' + local_courseNum + '"]').each(function(index, element) {
                if($(this).attr('data-subject') == ulname){
				$(this).appendTo('#' + ulname);
				}
            });
		});
    });
		</script>
       </center>
     </div>
   </div>
</html>
