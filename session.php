<?php
/**
 * Created by PhpStorm.
 * User: nishan
 * Date: 03-10-2017
 * Time: 10:06 PM
 */
require("config.php");
session_start();

$user = $_SESSION['login_user'];

if (!isset($_SESSION['login_user'])) {
    header("location:login.php");

}

/**    $sql = "SELECT first_name FROM user_details WHERE username='$user'";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
    $login_session = $row['first_name'];
**/

?>