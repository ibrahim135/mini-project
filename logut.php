<?php
/**
 * Created by PhpStorm.
 * Date: 03-10-2021
 */

require ("config.php");
session_start();
mysqli_commit($con);
session_destroy();
header("location:login.php");
?>
