<!--
This html file is responsible for the design of the webpage which will allow the user of the web application to view their generated detailed schedule.
-->

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
        <a href="selectClasses.html">
        <img style = "position: absolute; bottom: 0; right: 850px" src = "Images/selectClasses.png" alt = "Select Classes"></img></a>
        <a href="schedule.html">
        <img style = "position: absolute; bottom: 0; right: 700px" src = "Images/schedule.png" alt = "Schedule"></img></a>
        <a href="detailedSchedule.html">
        <img style = "position: absolute; bottom: 0; right: 550px" src = "Images/detailedScheduleSelected.png" alt = "Detailed Schedule"></img></a>
        <a href="calendar.html">
        <img style = "position: absolute; bottom: 0; right: 400px" src = "Images/calendar.png" alt = "Calendar"></img></a>
        <a href="map.html">
        <img style = "position: absolute; bottom: 0; right: 250px" src = "Images/mapSelected.png" alt = "Map"></img></a>

        <!--
        The login and register buttons with their specified styles.
        -->
        <a style = "position: absolute; bottom: 0; right: 120px; color: white" href="">Login</a>
        <a style = "position: absolute; bottom: 0; right: 50px; color: white" href="">Register</a>

		</div>
    
        <!--
        The div class within the css file, scheduler.css, specifying the webpage's content's background color, float, and width.
        -->
		<div class="content">
        <br>
        <p style = "text-align: center"> </p>
		</div>
    
	</div>

	</body>
</html>