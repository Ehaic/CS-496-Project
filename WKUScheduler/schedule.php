<?php
session_start();
?>
<!DOCTYPE html>
<html>
   <head>
   <title >WKU Class Scheduler</title>
   <link rel="stylesheet" type="text/css" href="CSS/scheduler.css">
   <!-- Import jquery's style sheet for our dialogue boxes-->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<!-- Import Jquery library -->
   <script src="JS/jquery-2.1.3.min.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <!-- Set the style of the dialogue boxes -->
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
        <!-- here we create the dialogue boxes on the page and bind them to the left bottom and right bottom of the window -->
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
		<!-- This function is used to parse the time from the database which is a string into a number so that it can be compared to other times to find class conflicts -->
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
   <!--not sure why but I had to declare this function in a seperate script tag I think it has something to do with return statements this function is pretty much the same as the parseTime function except i does it for the dates, it multiplies the month value by 12.-->
   <script type="text/javascript">
   function parseDate(a){
	   //break down the passed date into a month and day that can be represented as a single number
	date_arr = a.split('-');
	begin_date = date_arr[0];
	end_date = date_arr[1];
	//Split the month and day
	begin_date = begin_date.split('/');
	end_date = end_date.split('/');
	//Set the month and day variables
	begin_month = begin_date[0];
	begin_day = begin_date[1];
	end_month = end_date[0];
	end_day = end_date[1];
	//create the final numbers and addd them to an array
	begin_date = (12 * begin_month) + begin_day;
	end_date = (12 * end_month) + end_day;
	arr = [];
	arr.push(begin_date);
	arr.push(end_date);
	//return the array we created
	return arr;
   }
   </script>
   <!-- another method -->
   <script type="text/javascript">
   //This function generates a hidden form that is used to send the data to the next PHP page in the form of $_POST data
   function formGenerate(a)
   {
	   //For array length that is passed to this function
	   for(var i = 0; i < a.length; i++)
	   {
		 //Create a text string that is a hidden input to contain the CRN from the array
	  	 var text = "<input type = 'hidden' name = 'crn[]' value = '" + a[i] + "'/>"
		 //Append our text as a new object the the object that has the ID value of crnlist which is a <form>
		 $(text).appendTo('#crnlist');
	   }
   }
   </script>
   </head>
   
   <div class="wrapper">
     <div class="header"> 
     <a href = "index.html"><img style = "float: left" src = "Images/logo.png" alt = "WKU Class Scheduler"></img></a>
     <a href="selectClasses.php">
        <img style = "position: absolute; bottom: 0; right: 750px" src = "Images/selectClasses.png" alt = "Select Classes"></img></a>
        <a href="schedule.php">
        <img style = "position: absolute; bottom: 0; right: 600px" src = "Images/scheduleSelected.png" alt = "Schedule"></img></a>
        <a href="detailedSchedule.php">
        <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/detailedSchedule.png" alt = "Detailed Schedule"></img></a>
        <a href="calendar.php">
        <img style = "position: absolute; bottom: 0; right: 300px" src = "Images/calendar.png" alt = "Calendar"></img></a>
        <a href="map.php">
        <img style = "position: absolute; bottom: 0; right: 150px" src = "Images/map.png" alt = "Map"></img></a>
    </div>
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
         <!-- button to submit their generated schedule -->
    	<button id="SaveSchedule">Save Schedule</button>
        <!-- hidden form to send post data to detailed schedule page -->
        <form action="detailedSchedule.php" id="crnlist" method="post"></form>
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
            //Loop for the length of the $subject array.
            for($i = 0; $i < count($subject); $i++)
            {
                //Create a variable and establish its value as the value in the courseNum array at index i rounded down (ex: 496 rounds to 4)
                $highestNum = floor(intval($courseNum[$i])/100);
                //Establish the index of the maximum vlue as the current index i
                $maxIndex = $i;
                //Loop for the length of the $subject array minus the current value of index i
                for($j = $i; $j < count($subject); $j++)
                {
                	//If the value in the courseNum array at index j rounded down is greater than the previously established highest value, execute the following code.
                    if(floor(intval($courseNum[$j])/100) > $highestNum)
                    {
                    	//Update the highestNum and maxIndex variables with the new values.
                        $highestNum = floor(intval($courseNum[$j])/100);
                        $maxIndex = $j;
                    }
                }
                //Create variables to hold the current values of the subject and courseNum arrays at index i
                $tempSubject = $subject[$i];
                $tempCourse = $courseNum[$i];
                //Create variables to hold the current values of the subject and courseNum arrays at index indicated by the maxIndex variable
                $newSubject = $subject[$maxIndex];
                $newCourse = $courseNum[$maxIndex];
                //Change the current values of the subject and courseNum arrays at index i to the values held by the newSubject and newCourse variables respectfully.
                $subject[$i] = $newSubject;
                $courseNum[$i] = $newCourse;
               	//Change the current values of the subject and courseNum arrays at index i to the values held by the newSubject and newCourse variables respectfully.
                $subject[$maxIndex] = $tempSubject;
                $courseNum[$maxIndex] = $tempCourse;
            }
            //Create a new array to hold the amount of sections available for specified courses
            $count = array();
            //Loop for the length of the $subject array
            for($i = 0; $i < count($subject); $i++)
            {
            	//Create and establish variables to hold the values from the subejct and courseNum arrays respectfully.
                $subj = $subject[$i];
                $cNum = $courseNum[$i];
                //Create and run a query to list a count of the number of sections available where the course name and number equal the subj and cNum variables
                $result = mysqli_query($con,"SELECT COUNT(DISTINCT CRN) AS ClassCount FROM Classes WHERE Subject = '$subj' AND CourseNum = '$cNum'");
                //While there are results for the query that was just run, execute the following code.
                while($row = mysqli_fetch_array($result))
                {
                	//Push the current value into the $count array
                    array_push($count, $row['ClassCount']);
                }
            }
            //Loop for the length of the $subject array minus 1
            for($i = 1; $i < count($subject); $i++)
            {
            	//If the value in the courseNum array at index i rounded down is greater than the value in the courseNum array at 
            	//   index i-1 rounded down, execute the following code
                if(floor(intval($courseNum[$i])/100) == floor(intval($courseNum[$i-1])/100))
                {
                	//If the value in the count array at index i is less than the value in the count array at index i - 1, execute the following code.
                    if($count[$i] < $count[$i - 1])
                    {
                    	//Create variables to hold the current values of the count, subject, and courseNum arrays at index i - 1
                        $tempCount = $count[$i-1];
                        $tempSubject = $subject[$i-1];
                        $tempCourse = $courseNum[$i-1];
                        //Create variables to hold the current values of the count, subject, and courseNum arrays at index i
                        $newCount = $count[$i];
                        $newSubject = $subject[$i];
                        $newCourse = $courseNum[$i];
                      	//Change the current values of the subject, courseNum, and count arrays at index i - 1 to the values held by the newSubject,
                      	//   newCourse, and newCount variables respectfully.
                        $subject[$i-1] = $newSubject;
                        $courseNum[$i-1] = $newCourse;
                        $count[$i-1] = $newCount;
                        //Change the current values of the subject, courseNum, and count arrays at index i - 1 to the values held by the tempSubject,
                      	//   tempCourse, and tempCount variables respectfully.
                        $subject[$i] = $tempSubject;
                        $courseNum[$i] = $tempCourse;
                        $count[$i] = $tempCount;
                    }
                }
            }
            //Break for space and organization
            echo "<br>";
            //Loop for the length of the $subject array
            for($i = 0; $i < count($subject); $i++)
            {
                echo "<br>";
                //Create and establish variables to hold the values from the subejct and courseNum arrays respectfully.
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
                	//Create an array to hold the results of the recent query and push future results for that query into that array.
					$temp_Array = array($row['Subject'] , $row['CourseNum'],$row['Credits'], $row['Title'], $row['Fee'], $row['Remaining'], $row['FirstName'], $row['LastName'], $row['Time'], $row['Days'], $row['Location'], $row['Date'], $row['CRN']);
					array_push($Courses_Array, $temp_Array);
                }
            }
        ?>
        <!-- here is the javascript that generates the list of courses from the mysql query above. -->
         <script type="text/javascript">
		// pass PHP variable declared above to JavaScript variable
		var the_array = <?php echo json_encode($Courses_Array) ?>;
		var arrayLength = the_array.length;
		</script> 
         <script>
		 //Variable decleration
		 var subject_array = [];
		 var courseNum_array = [];
		 var crn = null;
		 //On document ready perform this function
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
			//this for loop generates headers, unordered lists, and list items for every item in the query.
    		for(var i = 0; i < arrayLength; i++)
			{
			cur_subject = the_array[i][0];
			cur_courseNum = the_array[i][1];
			//I generate an ID from the coursenum and subject to be used in the HTML tag's to uniquely identify items.
			id_attribute = cur_subject + cur_courseNum;
			time_array = parseTime(the_array[i][8]);
			date_array = parseDate(the_array[i][11]);
			//here is where we build each individual list item
			//This if statement is used to build headers for the classes, if the previous coursenum is different from the current coursenum and subject then we need to generate a header instead of a list item.
			if(cur_subject == prev_subject && cur_courseNum == prev_courseNum)
			{
				//This looks confusing but its really just an HTML list item containing all the information from the query with some extra HTML5 data for finding conflicts.
				//each finished item looks like:
				//<li class="classItem" data-subject="<subject>" data-crn="<crn>" data-courseNum="<courseNum> data-beginTime="<beginTime>" data-endTime="<endTime>" data-beginDate="<beginDate>" data-endDate="<endDate>" data-days="<days>">Then a string of the class information</li>
				//this is then appended to a header that has the unique ID that I generated earlier
				 text ='<li class = "classItem" data-subject = "' + cur_subject + '" data-crn = "' + the_array[i][12] + '" data-courseNum = "' + the_array[i][1] + '"data-beginTime = "' + time_array[0] + '" data-endTime = "' + time_array[1] + '" data-beginDate = "' + date_array[0] + '"data-endDate = "' + date_array[1] + '"data-days = "' + the_array[i][9] + '">' + the_array[i][0] + " " + the_array[i][1] + " " + the_array[i][2] + " " + the_array[i][3] + " " + the_array[i][4] + " " + the_array[i][5] + "<br>" + the_array[i][6] + " " + the_array[i][7] + " " + the_array[i][8] + " " + the_array[i][9] + " " + the_array[i][10] + " " + the_array[i][11] + "<br><br>" + "</li>";
                $( text ).appendTo('#h' + id_attribute);
			}
			//Here is where we generate a header.
			else
			{
				//Push the Subject and coursenum into an independent set of arrays if they are new, this is for the button listeners down on the buttom.
				subject_array.push(cur_subject);
				courseNum_array.push(cur_courseNum);
				//Here I generate an unordered list object the append to the courselist div I have on the page.
			unordered_list = '<ul style="list-style: none" id = "' + id_attribute + '"></ul>'
			//This line generates header text with an id of "h<id_attribute>"
			header_text = '<li id ="' + 'h' + id_attribute + '"> <h1>' + cur_subject + " " + cur_courseNum + " Classes" + "</h1></li>";//Generate the list items exactly the same as inside the if statement
            text = '<li class = "classItem" data-subject = "' + cur_subject + '" data-crn = "' + the_array[i][12] + '" data-courseNum = "' + the_array[i][1] + '"data-beginTime = "' + time_array[0] + '" data-endTime = "' + time_array[1] + '" data-beginDate = "' + date_array[0] + '"data-endDate = "' + date_array[1] + '"data-days = "' + the_array[i][9] + '">' + the_array[i][0] + " " + the_array[i][1] + " " + the_array[i][2] + " " + the_array[i][3] + " " + the_array[i][4] + " " + the_array[i][5] + "<br>" + the_array[i][6] + " " + the_array[i][7] + " " + the_array[i][8] + " " + the_array[i][9] + " " + the_array[i][10] + " " + the_array[i][11] + "<br><br>" + "</li>" ;
				//Append the unordered list to the courselist div
				$( unordered_list ).appendTo( ".CourseList" );
				//Append the header list item to the unordered list
				$( header_text ).appendTo('#' + id_attribute);
				//Append the class list item to the header
                $( text ).appendTo('#h' + id_attribute);
			}
			//set previous subject and coursenum
			prev_subject = cur_subject;
			prev_courseNum = cur_courseNum;
		}
		});
		//On document ready do this function
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
			//This hide's the header for the subject and coursenum that has been clicked on
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
			//This Is the logic for finding class conflicts, this is still inside the scope of double click on any list item inside the courselist div.
			//For each item that has the class ClassItem
			$('.classItem').each(function(index, element) {
				//this makes sure we're only dealing with objects inside the courselist div.
				if(($(this).parents().is('div.CourseList')))
				{
					//for the amount of days the class meets.length
					for(var j = 0; j < local_days.length; j++)
					{
						//If the current day we're looking at is found inside the days of this object we're looking at continue, if the days aren't the same there isnt a conflict so we move on to the next day.
						if($(this).attr('data-days').indexOf(local_days[j]) >= 0)
						{
							//Here we get all the times of this current object we're checking
							var check_startTime = $(this).attr('data-begintime');
							var check_endTime = $(this).attr('data-endtime');
							var check_startDate = $(this).attr('data-begindate');
							var check_endDate = $(this).attr('data-enddate');
							//then we check if the dates are in conflict, if they are check the times, if not there's no conflict
							if((check_startDate >= local_startDate && check_startDate <= local_endDate) || (check_endDate >= local_startDate && check_endDate <= local_endDate) || (check_startDate == local_startDate && check_endDate == local_endDate))
							{
							//finally the last conflict to check is if the times of the classes themselves conflict, if they do
								if((check_startTime >= local_startTime && check_startTime <= local_endTime) || (check_endTime >= local_startTime && check_endTime <= local_endTime) || (check_startTime == local_startTime && check_endTime == local_endTime))
								{
									//append this current object to out conflict list
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
			var local_crn = $(this).attr('data-crn');
			var local_courseNum = $(this).attr('data-courseNum');
			var ulname = '#h' + local_subject + local_courseNum;
			//Show the header again since there will now be a class item appended to it.
			$(ulname).show();
			//find list items that matches the course number of the object selected and make sure the subject matches. then append it to the appropriate header.
			$('li[data-courseNum = "' + local_courseNum + '"]').each(function(index, element) {
				if($(this).attr('data-subject') == local_subject)
				$(this).appendTo(ulname);
            });//close for each
			});//close double click schedule list
		
		//on double click per object in conflincting list this is the same as the method above.
		$('ul.RemovedList').on('dblclick','li', function(conflinctedClassRemove){
			var local_subject = $(this).attr('data-subject');
			var local_courseNum = $(this).attr('data-courseNum');
			var ulname = '#h' + local_subject + local_courseNum;
			$(ulname).show();
			$('li[data-courseNum = "' + local_courseNum + '"]').each(function(index, element) {
				if($(this).attr('data-subject') == local_subject)
				$(this).appendTo(ulname);
            });
		});
		//On clik of the save schedule button.
		$('#SaveSchedule').click(function(){
			//Generate a crn_list array
    			var crn_list = [];
				//based upon the crn's that are inside the schedule list dialog box
				$('ul.ScheduleList>li').each(function(index, element) {
					//makes sure the CRN isnt already in the list.
					if(crn_list.indexOf($(this).attr('data-crn')) == -1)
					{
						//push the CRN into the list
                		crn_list.push($(this).attr('data-crn'));
					}
            	});
				//Generate the form using the already written method
				formGenerate(crn_list);
				//Submit the form with ID #crnlist
				$('#crnlist').submit();
				//alert the user so they know what's going on
			alert("Schedule saved sending you to view your schedule.");
		});
    });
		</script>
		<!--Establish a script shell that will execute a section of javascript.-->
		<script type="text/javascript">
		//When the document is ready, execute the following code.
        $(document).ready(function(e) {
        	//Print an alert message to pop up onscreen. The message will give the user instructions on how to navigate the page and 
        	//   comfirm their list of courses for the other pages to draw from.
            alert("- Double-click on a class name to add it to your schedule (listed on the right). Different class times for the selected course will be added to the Removed Classes list (on the left)\n- To remove a course, double-click on it within the Schedule list or the Removed Courses list\n\nAfter you have built your schedule, hit the Save Schedule button.")
        });
        </script>
       </center>
     </div>
   </div>
</html>

