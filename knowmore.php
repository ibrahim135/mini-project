<?php
/**
 * Created by PhpStorm.
 * User: nishan
 * Date: 22-11-2017
 * Time: 05:49 PM
 */
require("config.php");
require("session.php");
require("functions.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $type = $_GET['type'];
    global $conn;
    if ($type == "lost") {
        $sql = "SELECT `discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate`,`draft` FROM `lthings` WHERE `id`=$id";
    } else {
        $sql = "SELECT `discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate` ,`draft` FROM `fthings` WHERE `id`=$id";
    }
    $row = mysqli_fetch_array(mysqli_query($conn, $sql));

    $user = get_user($row['uemail']);
    $email = $row['uemail'];
    $cat = get_catname($row['cat_ref']);
    $phone = get_phone($row['adressid']);
    $pdate = $row['postdate'];
    $add = get_full_add($row['adressid']);
    $pincode = $row['pincode'];
    $disc = $row['discription'];
    $imgurl = get_imgurl($row['imgid'], $type);
} else {
    //header('location:index.php');
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/main.css">

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/mainx.js"></script>
    <style>
        .postcard {
            margin-left: 20px;
            margin-right: 20px;
            border-radius: 20px;

        }


    </style>
</head>
<body class="   blue-grey  darken-4">
<ul id="dropdown1" class="dropdown-content  maindrop white">


    <li><a href="#posts" class=" white-text indigo darken-3">Posts</a></li>

    <li class="divider"></li>

    <li><a href="logut.php" class="blue darken-1 white-text indigo darken-4">Logout</a></li>
</ul>
<nav class="  blue-grey darken-3 z-depth-2" style="text-transform:">
    <div class="nav-wrapper  ">

        <a href="index.php" class="brand-logo " style="margin-left: 20px;text-transform: uppercase;">Lost And Found</a>
        <ul class="right hide-on-med-and-down">

            <!--<li><a href="about.php">About</a></li>-->
            <?php if (is_admin()) {
                echo " <li><a href=\"admin.php\" class=\" white-text btn \">ADMIN PANEL</a></li>";
            } ?>
            <li><a href="profile.php" class=" btn  white-text ">PROFILE</a></li>
            <li><a href="logut.php" class="btn  white-text ">LOGOUT</a></li>

        </ul>

    </div>
</nav>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col l6 s12">

            <?php
            echo "<img class=\"materialboxed\" width=\"300\" height=\"300px\"
                 src=\"$imgurl\">";
            ?>
        </div>

        <div class="col l6 s12 blue darken-3" style="border-radius: 30px;">
            <div class="container">
                <div class="row">
                    <br>
                    <?php
                    echo " <div class=\"col s12 white-text \" style=\"text-transform: capitalize;font-weight: 800;\">Post by $user</div>
                    <div class=\"col s12 white-text\" style=\"font-weight: 100;\">$email</div>
                    <div class=\"col s12 white-text\" style=\"font-weight: 430;margin-top: 10px;\">$cat</div>
                    <div class=\"col s12 white-text\" style=\"font-weight: 300;\">$phone</div>
                    <div class=\"col s12 white-text\" style=\"font-weight: 300;\">$pdate</div>
                    <div class=\"col s12 white-text\" style=\"font-weight: 300;\">$add - $pincode </div>
                    <div class=\"col s12 white-text \" style=\"text-transform: ;font-weight:500;margin-top: 5px;\">$disc</div>
                     <div class='col s12'><a class=\"waves-effect waves-light btn teal\" style=\"margin-top: 10px\" href=\"mailto:$email\" subject=\"a notification from flownthings \" target=\"_top\">Contact</a></div>
                     ";
                    if (is_admin()) {
                        echo "<div class='col s12'><a class=\"waves-effect waves-light btn red lighten-1\" style=\"margin-top: 10px\" href=\"deletepost.php?id=$id&&type=$type\" >delete</a></div>
                     ";
                       }

                    ?>

                </div>
            </div>
        </div>
    </div>

</div>

<br>
<br>


</body>

</html>