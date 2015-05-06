<?php
// Start the session
session_start();
?>
<!--
This html file is responsible for the design of the webpage which will allow the user of the web application to view their generated class maps.
-->

<!DOCTYPE html>
<html>
	<head>
		<title > WKU Class Scheduler </title>
        <!--
        The css file used for web design.
         -->
        <link rel="stylesheet" type="text/css" href="CSS/scheduler.css">
        <!--
        Jquery used.
        -->
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
        <a href="selectClasses.php">
        <img style = "position: absolute; bottom: 0; right: 750px" src = "Images/selectClasses.png" alt = "Select Classes"></img></a>
        <a href="schedule.php">
        <img style = "position: absolute; bottom: 0; right: 600px" src = "Images/schedule.png" alt = "Schedule"></img></a>
        <a href="detailedSchedule.php">
        <img style = "position: absolute; bottom: 0; right: 450px" src = "Images/detailedSchedule.png" alt = "Detailed Schedule"></img></a>
        <a href="calendar.php">
        <img style = "position: absolute; bottom: 0; right: 300px" src = "Images/calendar.png" alt = "Calendar"></img></a>
        <a href="map.php">
        <img style = "position: absolute; bottom: 0; right: 150px" src = "Images/mapSelected.png" alt = "Map"></img></a>
		</div>
    
        <!--
        The div class within the css file, scheduler.css, specifying the webpage's content's background color, float, and width.
        -->
		<div class="content">
        <br>
        <p style = "text-align: center"> </p>
		</div>
    
	</div>

    <!--
    The div class within the css file, scheduler.css, padding the map correctly
    -->
    <div class="position">
        <!--
       The div class within the css file, scheduler.css, specifying the position as relative to make positioning more dynamic.
        -->
        <div class="container">
            
            <?php
				//connect to the MySQL database
				$con=mysqli_connect("localhost","Scheduler","BUUFTeyqAtMPFaROzBuwvMfcUPUnuvafvTOeZDg3XFJ1hGaGSrYdMrRGGpFLfRTF","Scheduler2");
				// Check connection and state if connection failed
				if (mysqli_connect_errno())
		  			echo "Failed to connect to MySQL: " . mysqli_connect_error();  
				//store all questions in result variable
				$crn = $_SESSION['crn'];
                /*
                The class within the css files, scheduler.css, specifying the campus map position as absolute, sets the 
                x y integers, and place it at z-index 1 to position image below any dots placed on the map.
                */
                echo "<img class='map' src='Images/campusMap.jpg' alt='Campus Map!'>";
				$resultArr = array();
				$courseNumArr = array();
				$subjectArr = array();
				//Get required location data for map, storing it in an array.
                for($i = 0; $i < count($crn); $i++)
				{
				$results = mysqli_query($con,"SELECT Dates.Location, Classes.Subject, Classes.CourseNum FROM Dates, Classes WHERE Classes.CRN = Dates.CRN AND Classes.CRN = '$crn[$i]'");
				$row = mysqli_fetch_array($results);
				$results = $row['Location'];
				//It splits the string into an array, adding a space character.
                $results = explode(" ", $results);
				array_push($resultArr,$results[0]);
				array_push($courseNumArr, $row['CourseNum']);
				array_push($subjectArr, $row['Subject']);
                //For each results in the array...
                foreach($results as $aResult){
                    //If if contains a certain location value, print its corresponding dot on the right spot of the map.
                    //Checks for each building.
                    if($aResult == CH){
                            echo "<img class='ch' src='Dots/ch.png'></img>";
                        }elseif($aResult == GCC){
                            echo "<img class='gcc' src='Dots/gcc.png'></img>";
                        }elseif($aResult == GH){
                            echo "<img class='gh' src='Dots/gh.png'></img>";
                        }elseif($aResult == SH){
                            echo "<img class='sh' src='Dots/sh.png'></img>";
                        }elseif($aResult == EST){
                            echo "<img class='est' src='Dots/est.png'></img>";
                        }elseif($aResult == PHAC){
                            echo "<img class='phac' src='Dots/phac.png'></img>";
                        }elseif($aResult == AFC){
                            echo "<img class='afc' src='Dots/afc.png'></img>";
                        }elseif($aResult == COHH){
                            echo "<img class='cohh' src='Dots/cohh.png'></img>";
                        }elseif($aResult == DA){
                            echo "<img class='da' src='Dots/da.png'></img>";
                        }elseif($aResult == GRH){
                            echo "<img class='grh' src='Dots/grh.png'></img>";
                        }elseif($aResult == TCCW){
                            echo "<img class='tccw' src='Dots/tccw.png'></img>";
                        }elseif($aResult == MMTH){
                            echo "<img class='mmth' src='Dots/mmth.png'></img>";
                        }elseif($aResult == MCHC){
                            echo "<img class='mchc' src='Dots/mchc.png'></img>";
                        }elseif($aResult == IE){
                            echo "<img class='ie' src='Dots/ie.png'></img>";
                        }elseif($aResult == EBS){
                            echo "<img class='ebs' src='Dots/ebs.png'></img>";
                        }elseif($aResult == SS){
                            echo "<img class='ss' src='Dots/ss.png'></img>";
                        }elseif($aResult == AC){
                            echo "<img class='ac' src='Dots/ac.png'></img>";
                        }elseif($aResult == GWH){
                            echo "<img class='gwh' src='Dots/gwh.png'></img>";
                        }elseif($aResult == FS){
                            echo "<img class='fs' src='Dots/fs.png'></img>";
                        }elseif($aResult == HCIC){
                            echo "<img class='hcic' src='Dots/hcic.png'></img>";
                        }elseif($aResult == CRD){
                            echo "<img class='crd' src='Dots/crd.png'></img>";
                        }elseif($aResult == MH){
                            echo "<img class='mh' src='Dots/mh.png'></img>";
                        }elseif($aResult == TPH){
                            echo "<img class='tph' src='Dots/tph.png'></img>";
                        }
					}//for each close
           		}//for close
            ?>
            
        </div>
    </div>
    
    <!--
    Apologies for the breaks. The key appears behind the campus otherwise.
    -->
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!--
    Key to indicate building location and dot colors which correlate to courses.
    -->
    <center><table border = "border">
        <tr>
            <th>Dot Color</th>
            <th>Building Location</th>
            <th>Course</th>
        </tr>

            <?php
                    /*
                    Building a table through a for loop.
                    If a certain location is found with an array using a query, print its dot image, print that location, 
                    and print the course number. Inbetween that are HTML brackets which indicate when it create extra rows
                    and columns.
                    */
					$i = 0;
                    foreach($resultArr as $aResult){
                        if($aResult == CH){
                            echo "<tr>";
                            echo "<th>";    
                            echo "<img src='Dots/ch.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == GCC){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/gcc.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == GH){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/gh.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == SH){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/sh.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == EST){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/est.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == PHAC){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/phac.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == AFC){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/afc.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == COHH){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/cohh.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == DA){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/da.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == GRH){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/grh.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == TCCW){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/tccw.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == MMTH){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/mmth.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == MCHC){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/mchc.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == IE){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/ie.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == EBS){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/ebs.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == SS){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/ss.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == AC){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/ac.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == GWH){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/gwh.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == FS){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/fs.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == HCIC){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/hcic.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == CRD){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/crd.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == MH){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/mh.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }elseif($aResult == TPH){
                            echo "<tr>";
                            echo "<th>";
                            echo "<img src='Dots/tph.png'></img>";
                            echo "</th>";
                            echo "<th>";
                            echo $aResult;
                            echo "</th>";
							echo "<th>";
							echo $subjectArr[$i]." ".$courseNumArr[$i];
							echo "</th>";
                            echo "</tr>";
                        }
						$i++;
                    }
                    
            ?>
        
        <!--
        Ending tags for the doc.
        -->
        </tr>
    </table></center>

	</body>
</html>