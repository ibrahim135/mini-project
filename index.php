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
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body class="  grey darken-1">
<?php

require("config.php");
require("functions.php");
session_start();
if (!(isset($_SESSION['login_user']))) {
    header("location:login.php");
}
$user = $_SESSION['login_user'];

?>
<!-- User Profile -->

<nav class="  blue-grey darken-3 z-depth-2" style="text-transform:">
    <div class="nav-wrapper  ">

        <a href="#" class="brand-logo " style="margin-left: 20px;text-transform: uppercase;">Lost And Found</a>
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
<div class="container" style="margin-left: 380px;">
    <div class="row">
        <div class="col s6">
            <div class="">
                <div class=" ">
                    <div class="card-panel blue-grey darken-4 z-depth-5">
          <span class="white-text flow-text">ADD DETAIL ABOUT LOST ITEM
          </span>
                        <br>
                        <br>
                        <a href="lost.php" class="btn">ADD POST</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<div class="container " style="margin-left: 380px;">
    <div class="row">
        <div class="col s6">
            <div class="">
                <div class="">
                    <div class="card-panel blue-grey darken-4 z-depth-5">
          <span class="white-text flow-text">ADD DETAIL ABOUT FOUND ITEM
          </span>
                        <br>
                        <br>
                        <a href="found.php" class="btn">ADD POST</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</body>

</html>
<!--INSERT INTO `lost` (`sno`, `email`, `fname`, `lname`, `pwd`, `dt`) VALUES ('1', 'this@this.com', 'test', 'name', '12345', current_timestamp());-->