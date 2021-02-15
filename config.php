<?php

$db_name='flownthings';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if (!$conn) {
    die('Could not connect: ' . mysqli_error());
    mysqli_close($conn);
    }

$retval = mysqli_select_db($conn,$db_name);

if ($retval) {
    echo "<p id='you' hidden >sucess</p>";
}

?>