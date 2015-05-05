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
        <a href="detailedSchedule.php">
        <img style = "position: absolute; bottom: 0; right: 550px" src = "Images/detailedSchedule.png" alt = "Detailed Schedule"></img></a>
        <a href="calendar.php">
        <img style = "position: absolute; bottom: 0; right: 400px" src = "Images/calendar.png" alt = "Calendar"></img></a>
        <a href="map.php">
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

    <div class="position">
        <div class="container">
            
            <?php
                
                $results = '';
                for($i = 0; $i < strlen(){
                    if($ [$i] == " "){
                        break;
                    }
                    $results = substr('', 0, $i);
                }

                echo "<img class='map' src='images/campusMap.jpg' alt='Campus Map!'>";

                foreach($results as $aResult){
                    if($aResult == CH){
                            echo "<img class='ch' src='Dots/ch.png'></img>";
                        }if($aResult == GCC){
                            echo "<img class='gcc' src='Dots/gcc.png'></img>";
                        }if($aResult == GH){
                            echo "<img class='gh' src='Dots/gh.png'></img>";
                        }if($aResult == SH){
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
                    }

            ?>
            
        </div>
    </div>

	</body>
</html>