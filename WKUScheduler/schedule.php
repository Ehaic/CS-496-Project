<?php
session_start();
?>
<!DOCTYPE html>
<html>
   <head>
   <title >WKU Class Scheduler</title>
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
		
		function parseTime(a) {
			//begin the process of parsing a time from time class's time string
			//first get the string of the class we're currently building a list item for.
			var time_string = a;
			//There are some classes that have TBA in time this if statement if for those classes
			if(time_string == "TBA")
			{
				return arr = [0,0];
			}
			//split at the - character to seperate beginning time from end
			var time_split = time_string.split('-');
			//set begin and end time.
			var begin_time = time_split[0];
			var end_time = time_split[1];
			//determine if a class is a pm class so we can add 12 hours if it's a pm.
			var begin_pm = 0;
			var end_pm = 0;
			if (begin_time.indexOf("pm") >= 0)
			{
				begin_pm = 12;
			}
			if (end_time.indexOf("pm") >= 0)
			{
				end_pm = 12;
			}
			//now we need to break down each time into minute and hour.
			//first get rid of AM and PM
			var begin_arr = begin_time.split(' ');
			var end_arr = end_time.split(' ');
			begin_time = begin_arr[0];
			end_time = end_arr[0];
			//then split into minutes and hour.
			begin_arr = begin_time.split(':');
			end_arr = end_time.split(':');
			//parse hour and minute to an int and then add 12 hours if it was a PM class.
			var begin_hour = parseInt(begin_arr[0]);
			var begin_minute = parseInt(begin_arr[1]);
			var end_hour = parseInt(end_arr[0]);
			var end_minute = parseInt(end_arr[1]);
			//if the time is 12 pm we dont want to add 12 to the hour.
			if(begin_hour != 12)
			{
			begin_hour = begin_hour + begin_pm;
			}
			if(end_hour !=12)
			{
			end_hour = end_hour + end_pm;
			}
			//after getting the hours and minutes set create a time value for finding time conflicts, this will be stored as attribute data to its specific list item.
			begin_time = (begin_hour * 100) + begin_minute;
			end_time = (end_hour * 100) + end_minute;
			var finishedProduct = [];
			finishedProduct.push(begin_time);
			finishedProduct.push(end_time);
			return finishedProduct;
		}
   </script>
   <!--not sure why but I had to declare this function in a seperate script tag.-->
   <script type="text/javascript">
   function parseDate(a){
	   //break down the passed date into a month and day that can be represented as a single number
	date_arr = a.split('-');
	begin_date = date_arr[0];
	end_date = date_arr[1];
	begin_date = begin_date.split('/');
	end_date = end_date.split('/');
	begin_month = begin_date[0];
	begin_day = begin_date[1];
	end_month = end_date[0];
	end_day = end_date[1];
	begin_date = (12 * begin_month) + begin_day;
	end_date = (12 * end_month) + end_day;
	arr = [];
	arr.push(begin_date);
	arr.push(end_date);
	return arr;
   }
   </script>
   <!-- another method -->
   <script type="text/javascript">
   function formGenerate(a)
   {
	   for(var i = 0; i < a.length; i++)
	   {
	  	 var text = "<input type = 'hidden' name = 'crn[]' value = '" + a[i] + "'/>"
		 console.log(text);
		 $(text).appendTo('#crnlist');
		 console.log(text);
	   }
   }
   </script>
   </head>
   
   <div class="wrapper">
     <div class="header"> 
     <a href = "index.html"><img style = "float: left" src = "Images/logo.png" alt = "WKU Class Scheduler"></img></a>
     <a href="selectClasses.php"> <img style = "position: absolute; bottom: 0; right: 750px" src = "Images/selectClasses.png" alt = "Select Classes"></img></a> 
     <a href="schedule.php"> <img style = "position: absolute; bottom: 0; right: 600px" src = "Images/scheduleSelected.png" alt = "Schedule"></img></a> 
     <a href="calendar.php"> <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/calendar.png" alt = "Calendar"></img></a> 
     <a href="map.php"> <img style = "position: absolute; bottom: 0; right: 300px" src = "Images/map.png" alt = "Map"></img></a> 
     <a style = "position: absolute; bottom: 0; right: 120px; color: white" href="">Login</a> 
     <a style = "position: absolute; bottom: 0; right: 50px; color: white" href="">Register</a> </div>
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
         <div class = "CourseList"></div>
         <br>
    	<button id="SaveSchedule">Save Schedule</button>
        <form action="map.php" id="crnlist" method="post"></form>
	</head>
   	   <?php
            //connect to the MySQL database
            $con=mysqli_connect("localhost","Scheduler","BUUFTeyqAtMPFaROzBuwvMfcUPUnuvafvTOeZDg3XFJ1hGaGSrYdMrRGGpFLfRTF","Scheduler2");
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
			//here we declare variables that we use to generate out list's of courses to display on the page.
			var cur_subject = null;
			var prev_subject = null;
			var cur_courseNum = null;
			var prev_courseNum = null;
			var text = null;
			var header_text = null;
			var unordered_list = null;
			var orderNum = null;
			//this for loop generates headers, unordered lists, and list items for every item in the query.
    		for(var i = 0; i < arrayLength; i++)
			{
			cur_subject = the_array[i][0];
			cur_courseNum = the_array[i][1];
			id_attribute = cur_subject + cur_courseNum;
			time_array = parseTime(the_array[i][8]);
			date_array = parseDate(the_array[i][11]);
			//here is where we build each individual list item
			if(cur_subject == prev_subject && cur_courseNum == prev_courseNum)
			{
				 text ='<li class = "classItem" data-subject = "' + cur_subject + '" data-order = "' + orderNum + '" data-crn = "' + the_array[i][12] + '" data-courseNum = "' + the_array[i][1] + '"data-beginTime = "' + time_array[0] + '" data-endTime = "' + time_array[1] + '" data-beginDate = "' + date_array[0] + '"data-endDate = "' + date_array[1] + '"data-days = "' + the_array[i][9] + '">' + the_array[i][0] + " " + the_array[i][1] + " " + the_array[i][2] + " " + the_array[i][3] + " " + the_array[i][4] + " " + the_array[i][5] + "<br>" + the_array[i][6] + " " + the_array[i][7] + " " + the_array[i][8] + " " + the_array[i][9] + " " + the_array[i][10] + " " + the_array[i][11] + "<br><br>" + "</li>";
                $( text ).appendTo('#h' + id_attribute);
				orderNum++;
			}
			else
			{
				orderNum = 0;
				subject_array.push(cur_subject);
				courseNum_array.push(cur_courseNum);
			unordered_list = '<ul style="list-style: none" id = "' + id_attribute + '"></ul>'
			header_text = '<li id ="' + 'h' + id_attribute + '" data-order = "' + orderNum + '"> <h1>' + cur_subject + " " + cur_courseNum + " Classes" + "</h1></li>";
			orderNum++;
            text = '<li class = "classItem" data-subject = "' + cur_subject + '" data-order = "' + orderNum + '" data-crn = "' + the_array[i][12] + '" data-courseNum = "' + the_array[i][1] + '"data-beginTime = "' + time_array[0] + '" data-endTime = "' + time_array[1] + '" data-beginDate = "' + date_array[0] + '"data-endDate = "' + date_array[1] + '"data-days = "' + the_array[i][9] + '">' + the_array[i][0] + " " + the_array[i][1] + " " + the_array[i][2] + " " + the_array[i][3] + " " + the_array[i][4] + " " + the_array[i][5] + "<br>" + the_array[i][6] + " " + the_array[i][7] + " " + the_array[i][8] + " " + the_array[i][9] + " " + the_array[i][10] + " " + the_array[i][11] + "<br><br>" + "</li>" ;
				$( unordered_list ).appendTo( ".CourseList" );
				$( header_text ).appendTo('#' + id_attribute);
                $( text ).appendTo('#h' + id_attribute);
			}
			prev_subject = cur_subject;
			prev_courseNum = cur_courseNum;
		}
		});
		
		$( document ).ready(function() {
			//this for loop is used to dynamically create the different listeners based upon how many different courses were chosen.
			for(var i = 0; i < subject_array.length; i++)
			{
				var ulname = subject_array[i] + courseNum_array[i];
				//Any button pressed in the center list do the following functions
        	$('#' + ulname).on('dblclick','li' , function(addScheduleList){
			var attr = $(this).attr('data-crn');
			// For some browsers, `attr` is undefined; for others,
			// `attr` is false.  Check for both.
			if (typeof attr !== typeof undefined && attr !== false) {
    		$(this).appendTo('ul.ScheduleList');
			var local_crn = $(this).attr('data-crn');
			var local_subject = $(this).attr('data-subject');
			var local_courseNum = $(this).attr('data-coursenum');
			var local_ulname = '#h' + local_subject + local_courseNum;
			var local_startTime = $(this).attr('data-begintime');
			var local_endTime = $(this).attr('data-endtime');
			var local_startDate = $(this).attr('data-begindate');
			var local_endDate = $(this).attr('data-enddate');
			var local_days = $(this).attr('data-days').split('');
			$(local_ulname).hide();
			//Add any courses with the same CRN to the scheduleList UL
			$('li[data-crn = "' + local_crn + '"]').each(function(index, element) {
				$(this).appendTo('ul.ScheduleList');
            });//close for each local_crn function
			//Add any course with a different crn and same courseNum to the conflict list.
			$('li[data-subject ="' + local_subject + '"]').each(function(index, element) {
				if($(this).attr('data-crn') != local_crn  && $(this).attr('data-courseNum') == local_courseNum)
				{
					$(this).appendTo('ul.RemovedList');
				}
           	});	//close for each local subject function
			}//close if statement loop
			$('.classItem').each(function(index, element) {
				if(($(this).parents().is('div.CourseList')))
				{
					for(var j = 0; j < local_days.length; j++)
					{
						if($(this).attr('data-days').indexOf(local_days[j]) >= 0)
						{
							var check_startTime = $(this).attr('data-begintime');
							var check_endTime = $(this).attr('data-endtime');
							var check_startDate = $(this).attr('data-begindate');
							var check_endDate = $(this).attr('data-enddate');
							if((check_startDate >= local_startDate && check_startDate <= local_endDate) || (check_endDate >= local_startDate && check_endDate <= local_endDate) || (check_startDate == local_startDate && check_endDate == local_endDate))
							{
							
								if((check_startTime >= local_startTime && check_startTime <= local_endTime) || (check_endTime >= local_startTime && check_endTime <= local_endTime) || (check_startTime == local_startTime && check_endTime == local_endTime))
								{
									$(this).appendTo('ul.RemovedList');
								}//close if time conflict.
							}//close if date conflict.
						}//Close if day conflict statement
					}//Close for loop
				}//Close if parent is
            });//Close each class item
       		});//close double click listeners
			}//close for loop
			
			//on double click per object in the schedule list
			$('ul.ScheduleList').on('dblclick','li', function(removeScheduleList){
			var local_subject = $(this).attr('data-subject');
			var order = $(this).attr('data-order');
			var local_crn = $(this).attr('data-crn');
			var local_courseNum = $(this).attr('data-courseNum');
			var ulname = '#h' + local_subject + local_courseNum;
			$(ulname).show();
			$('li[data-courseNum = "' + local_courseNum + '"]').each(function(index, element) {
				$(this).appendTo(ulname);
            });//close for each
			});//close double click schedule list
		
		//on double click per object in conflincting list
		$('ul.RemovedList').on('dblclick','li', function(conflinctedClassRemove){
			var local_subject = $(this).attr('data-subject');
			var local_courseNum = $(this).attr('data-courseNum');
			var ulname = '#h' + local_subject + local_courseNum;
			$(ulname).show();
			$('li[data-courseNum = "' + local_courseNum + '"]').each(function(index, element) {
				$(this).appendTo(ulname);
            });
		});
		
		$('#SaveSchedule').click(function(){
    			var crn_list = [];
				$('ul.ScheduleList>li').each(function(index, element) {
					if(crn_list.indexOf($(this).attr('data-crn')) == -1)
					{
                	crn_list.push($(this).attr('data-crn'));
					}
            	});
				console.log(crn_list);
				console.log("running form generate")
				formGenerate(crn_list);
				$('#crnlist').submit();
			alert("Schedule saved sending you to view your schedule.");
		});
    });
		</script>
       </center>
     </div>
   </div>
</html>
