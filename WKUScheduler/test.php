<?php
// Start the session
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php
print_r($_SESSION['crn']);
$sid = session_id();
$sid = session_id();
if($sid) {
    echo "Session exists!";
} else {
    echo "SESSION DOESNT EXIST";
}
?>
<body>
</body>
</html>