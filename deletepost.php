<?php
/**
 * Created by Php.
 * User: ibrahim
 * Date: 22-11-2021
 * Time: 08:33 PM
 */
require ('config.php');

global $conn;
$type=$_GET['type'];
$id=$_GET['id'];
if ($type == "lost") {
    $sql = "DELETE FROM `db_lostandfound`.`lthings` WHERE `id`=$id";
} else {
    $sql = "DELETE FROM `db_lostandfound`.`fthings` WHERE `id`=$id";
}
mysqli_query($conn, $sql);
mysqli_commit($conn);
header("location:admin.php");
?>
