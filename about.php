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
    <link rel="stylesheet" href="css/profilecard.css">
</head>
<body class="  blue-grey darken-4 ">
<?php
require("config.php");
require("session.php");
/**
 * echo '<h1 class="white-text">hello '.$_SESSION['login_user'].'</h1>';
 *
 */
?>

<!-- User Profile -->
<ul id="dropdown1" class="dropdown-content  maindrop white">

    <li><a href="profile.php" class=" white-text indigo darken-3"> Profile</a></li>

    <li class="divider"></li>

    <li><a href="logut.php" class="blue darken-1 white-text indigo darken-4">Logout</a></li>
</ul>


<nav class="  blue-grey darken-2 z-depth-2" style="text-transform:">
    <div class="nav-wrapper  ">
        <a href="index.php" class="brand-logo logo">
            <img src="image/logotext.png" class="responsive-img inline"></a>

        <ul class="right hide-on-med-and-down">
            <li><a href="search.php"><i class="material-icons left">search</i>Search Posts</a></li>

            <!-- Dropdown Trigger -->
            <li><a class="dropdown-button sim" href="#!" data-activates="dropdown1"><img src="image/user.JPG"
                                                                                         class="circle responsive-img loggeduser center-align "/></a>
            </li>
        </ul>

    </div>
</nav>

<div class="container  blue-grey-text">
    <div class="row center">
        <div class="col s12"><h1>
                About
            </h1></div>
        <div class="col s12">
            <h4>
                Learn about Flown Things and our Project Team.
            </h4>
        </div>


    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col s5 " style="margin: 20px;margin-left: 60px;">

            <div class="card hovercard">
                <div class="cardheader">
                </div>
                <div class="avatar">
                    <img alt="" src="image/user.jpg">
                </div>
                <div class="info white-text">
                    <div class="title">
                        <a class="flow-text white-text" ><b>Nishan B</b></a>
                    </div>
                    <div class="desc white-text">Backend Developer</div>
                    <div class="desc white-text">Developer at <b>Flown things</b></div>
                </div>
            </div>

        </div>
        <div class="col s5  " style="margin: 20px;margin-left:30px;">

            <div class="card hovercard">
                <div class="cardheader">

                </div>
                <div class="avatar">
                    <img alt="" src="image/nandan.jpeg" class="">
                </div>
                <div class="info">
                    <div class="title">
                        <a class="flow-text white-text" ><b>Nandan N S</b></a>
                    </div>
                    <div class="desc white-text">Backend Developer</div>
                    <div class="desc white-text">Developer at <b>FLown things</b></div>
                </div>
            </div>

        </div>


    </div>
</div>
</body>

</html>