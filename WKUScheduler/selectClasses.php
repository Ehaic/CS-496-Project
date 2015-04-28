<!DOCTYPE html>
<html>
    <script src="JS/jquery-2.1.3.min.js"></script>
        <script>$( document ).ready(function() {
                $('#addClass').click(function(){
    var text = $('#sub').val() + " " +  $('#cn').val() + "<input type = 'hidden' name = 'classes[]' value = '" + $('#sub').val() + " " + $('#cn').val() + "'/>" + '<button>x</button>';
    if(text.length){
        $('<li />', {html: text}).appendTo('ul.justList')
    }
});

$('ul').on('click','button' , function(el){
    $(this).parent().remove()
});
                                                });
            </script>
	<head>
		<title > WKU Class Scheduler </title>
		<link rel="stylesheet" type="text/css" href="CSS/scheduler.css">
	</head>
    <body>
	<div class="wrapper">
    
		<div class="header">
        <a href = "index.html"><img style = "float: left" src = "Images/logo.png" alt = "WKU Class Scheduler"></img></a>
        <a href="selectClasses.php">
        <img style = "position: absolute; bottom: 0; right: 750px" src = "Images/selectClassesSelected.png" alt = "Select Classes"></img></a>
        <a href="schedule.php">
        <img style = "position: absolute; bottom: 0; right: 600px" src = "Images/schedule.png" alt = "Schedule"></img></a>
        <a href="calendar.html">
        <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/calendar.png" alt = "Calendar"></img></a>
        <a href="map.html">
        <img style = "position: absolute; bottom: 0; right: 300px" src = "Images/map.png" alt = "Map"></img></a>

        <a style = "position: absolute; bottom: 0; right: 120px; color: white" href="">Login</a>
        <a style = "position: absolute; bottom: 0; right: 50px; color: white" href="">Register</a>

		</div>
    
		<div class="content" style="margin-left: 200px; margin-top: 40px; font-size:18px">
            <br>
           
            Select Class Subject:<br>
            <form action = "schedule.php" method = "post"> 
            
            <select id = "sub" name="sub">
            <?php
            //connect to the MySQL database
			$con=mysqli_connect("localhost","Taylor","tama4793!","scheduler");

			// Check connection and state if connection failed
			if (mysqli_connect_errno())
		  		echo "Failed to connect to MySQL: " . mysqli_connect_error();  
            
			//store all questions in result variable
			$result = mysqli_query($con,"SELECT DISTINCT Subject FROM classes ORDER BY Subject ASC");

			//while we still have questions in result
			while($row = mysqli_fetch_array($result)) 
			{
                echo '<option value="'.$row['Subject'].'">'.$row['Subject'].'</option>';
  			}
            $_POST['classes'];
            ?>
            </select>
                <ul class="justList"></ul>
            <br>
            
            Select Course Num:<br>
           <input type="test" id="cn" />
            <input type="submit"></button>
            </form>
            <br><br>Submit Classes<br>
            <button id="addClass">Add Class</button>
            
        
		</div>
    
	</div>
	</body>
</html>
