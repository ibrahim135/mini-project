<?php
/**
 * Created by PhpStorm.
 * User: nishan
 * Date: 18-11-2017
 * Time: 02:31 PM
 */
require("config.php");
require("session.php");
require("functions.php");

//user id
if($_POST['cata']=="0")
    header("location:found.php");

$ref_uid = $_SESSION['login_user'];

//image id
$ref_imgid = upload_image("limage", "found");

//adress id
$ref_add = add_adress($_POST);

$catg = $_POST['cata'];
$discp = $_POST['discription'];
$date = $_POST['date'];
$pincode=$_POST['pincode'];
if($ref_imgid=="fail" )
    header("location:found.php");
else {
    add_post($discp,$ref_add,$pincode,$ref_uid,$ref_imgid,$date,$catg,"found");
    mysqli_commit($conn);
    header("location:search.php?cat=$catg&&type=found&&pdate=$date");

}
//header('location:index.php');

?>


