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

if($_POST['cata']=="0")
    header("location:found.php");
//user id
$ref_uid = $_SESSION['login_user'];

//image id
$ref_imgid = upload_image("limage", "lost");

//adress id
$ref_add = add_adress($_POST);

$catg = $_POST['cata'];
$discp = $_POST['discription'];
$date = $_POST['date'];
$pincode=$_POST['pincode'];
if($ref_imgid=="fail" ) {
    header("location:lost.php");

}
else {

    add_post($discp,$ref_add,$pincode,$ref_uid,$ref_imgid,$date,$catg,"lost");
    header("location:search.php?cat=$catg&&type=lost&&pdate=$date");
    mysqli_commit($conn);
}
//header('location:index.php');
?>


