<!--Call the PHP method named session_start() -->
<?php
session_start();
?>
<!--Establish an HTML shell for our webpage-->
<!DOCTYPE html>
<html>
    <!--Call the JQuery library-->
    <script src="JS/jquery-2.1.3.min.js"></script>
    <!--When the document is ready, add a function that takes the contents of the drop-down list and the text box and adds them to a list. Each item
        in the list can be removed with a button added here.-->
    <script>$( document ).ready(function() {
        $('#addClass').click(function(){
            var text = $('#sub').val() + " " +  $('#cn').val() + "<input type = 'hidden' name = 'subject[]' value = '" + $('#sub').val() + "'/>" + "<input type = 'hidden' name = 'courseNum[]' value = '" + $('#cn').val() + "'/>" + '<button>x</button>';

            if(text.length){
                $('<li />', {html: text}).appendTo('ul.justList')
            }
        });
        //If the button by each item is selected, remove the item matched with the button from the list
        $('ul').on('click','button' , function(el){
            $(this).parent().remove()
        });
    });</script>
    <!--Create a banner to display at the top of the webpage. -->
	<head>
		<title > WKU Class Scheduler </title>
		<link rel="stylesheet" type="text/css" href="CSS/scheduler.css">
	</head>
    <body>
    <!--A div class within the css file, selectClasses.php, specifying margins, width, etc.-->
	<div class="wrapper">
        <!--A div class for the header within the css file, selectClasses.php, specifying margins, width, etc.-->
		<div class="header">
        <!--Add tabs to the top of the page for each of the website's different pages-->
        <a href = "index.html"><img style = "float: left" src = "Images/logo.png" alt = "WKU Class Scheduler"></img></a>
        <a href="selectClasses.php">
        <img style = "position: absolute; bottom: 0; right: 750px" src = "Images/selectClassesSelected.png" alt = "Select Classes"></img></a>
        <a href="schedule.php">
        <img style = "position: absolute; bottom: 0; right: 600px" src = "Images/schedule.png" alt = "Schedule"></img></a>
        <a href="detailedSchedule.php">
        <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/detailedSchedule.png" alt = "Detailed Schedule"></img></a>
        <a href="calendar.php">
        <img style = "position: absolute; bottom: 0; right: 300px" src = "Images/calendar.png" alt = "Calendar"></img></a>
        <a href="map.php">
        <img style = "position: absolute; bottom: 0; right: 150px" src = "Images/map.png" alt = "Map"></img></a>
		</div>
        <!--UNIMPLEMENTED: Add links for the user to login or register an account-->
        <a style = "position: absolute; bottom: 0; right: 120px; color: white" href="">Login</a>
        <a style = "position: absolute; bottom: 0; right: 50px; color: white" href="">Register</a>
		</div>
        <!--Establish a script shell that will execute a section of javascript.-->
        <script type="text/javascript">
        //When the document is ready, execute the following code.
        $(document).ready(function(e) {
            //Print an alert message to pop up onscreen. The message will give the user instructions on how to enter in classes to be sent to the Schedule page
            alert("- Choose a subject from the drop-down menu\n- Type in a course number\n- Hit the Add Class button\n\nWhen you're ready to continue, hit the Submit Classes button.")
        });
        </script>
        <!--A div class within the css file specifying margins, width, etc.-->
		<div class="content" style="margin-left: 200px; margin-top: 40px; font-size:18px">
            <!--Print a message indicating that the user should select a class subject-->
            <br>
            <center>
            Select Class Subject:
            <br>
            <!--Establish post data to send through a hidden form to the schedule.php file-->
            <form action = "schedule.php" method = "post"> 
            <!--Create a drop-down menu-->
            <select id = "sub" name="sub">
            <?php
            //connect to the MySQL database
			$con=mysqli_connect("localhost","Scheduler","BUUFTeyqAtMPFaROzBuwvMfcUPUnuvafvTOeZDg3XFJ1hGaGSrYdMrRGGpFLfRTF","Scheduler2");
			// Check connection and state if connection failed
			if (mysqli_connect_errno())
		  		echo "Failed to connect to MySQL: " . mysqli_connect_error();  
			//Store all questions in the result variable
			$result = mysqli_query($con,"SELECT DISTINCT Subject FROM Classes ORDER BY Subject ASC");
			//while we still have questions in result
			while($row = mysqli_fetch_array($result)) 
			{
                //Fill the options of the drop-down menu with the results of the query.
                echo '<option value="'.$row['Subject'].'">'.$row['Subject'].'</option>';
  			}
            //Send the data from the list of added classes, established earlier, as post data to be called by another file.
            $_POST['subject'];
            $_POST['courseNum'];
            ?>
            </select>
            <!--Create a location to place for classes to be added to by the user.-->
            <ul style="list-style: none" class="justList"></ul>
            <br>
            <!--Print a message indicating the user should enter a course number.-->
            Select Course Num:<br>
            <!--Add a text box whose value will be sent by clicking on a button.-->
            <input type="test" id="cn" />
            <!--Create a button that will submit the values in the drop-down menu and the text box to the method that will add them to the list of classes-->
            <button id="addClass" type="button">Add Class</button>   
            <!--Print a message indicating the following button will submit the list of classes entered by the user to the schedule.php page-->
            <br><br>Submit Classes<br>
            <!--Create a button button that will submit the list of classes entered by the user to the schedule.php page-->
            <button type="submit">Submit Classes</button>
            </form>
            </center>
        <!--Close any open sections-->
		</div>
	</div>
	</body>
</html>
