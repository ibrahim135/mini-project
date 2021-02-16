<?php
/**
 * Created by PhpStorm.
 * Date: 03-10-2021
 *
 */
session_start();
require("config.php");
require ("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['username']);
    $password=md5(mysqli_real_escape_string($conn, $_POST['password']));

    $sql = "SELECT * FROM `db_lostandfound`.`user` WHERE `email` = $email and `password`=$password ";
    $retval=mysqli_query($conn,$sql);

    $row = mysqli_fetch_array($retval,MYSQLI_ASSOC);

    $count = mysqli_num_rows($retval);
    if($count == 1) {
        global  $email;
        $_SESSION['login_user'] = $email;
        mysqli_commit($conn);

        if(is_admin()){

            header("location:admin.php");
        }
        else
            header("location: index.php");
    }else {
        header("location:login.php?login=0");
    }
}else{
    header("location:login.php?login=x");
}
?>
