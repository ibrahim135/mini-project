<?php
/**
 * Created by PhpStorm.
 * User: ibrahim
 * Date: 22-11-2021
 * Time: 12:44 PM
 */
require ("config.php");
require ("session.php");
require ("functions.php");
$id=$_GET['id'];
$type=$_GET['type'];
echo $id,$type;
mov_draf($id,$type);
mysqli_commit($conn);
header('location:profile.php');

?>
