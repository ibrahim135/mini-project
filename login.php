<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection"/>
    <!--Let browsrowx er know website is optimized for mobile-->


    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel='stylesheet' media='screen and (min-width: 100px) and (max-width: 799px)' href='css/mlogin.css'/>
    <link rel='stylesheet' media='screen and (min-width: 800px) and (max-width: 1400px)' href='css/llgoin.css'/>
    <script type="text/javascript" src="js/jquerry.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>


</head>
<body class=" grey darken-2">
<?php

require("config.php");

session_start();
if (isset($_SESSION['login_user'])) {
    header("location:index.php");

}

if(isset($_GET['login'])) {
    $x=$_GET['login'];
    if ($x == 0)
        echo "<p id='log' hidden  >fail</p>";
}
if(isset($_GET['signup'])){
    $x=$_GET['signup'];
    if ($x == 0)
        echo "<p id='sign' hidden  >fail</p>";
    if($x==1)
        echo "<p id='sign' hidden  >sucess</p>";
}
?>

<div id="login-page" class="row rowx rowxrowx  card1">
    <div class="col s12 z-depth-5 card card1 grey darken-4 blue-text">
        <div class="login-form ">

            <div class="row rowx no-pad-bot card-content no-pad-top ">
                <div class="input-field col s12 no-pad-bot center ">
                  <!--  <img src="image/logo.png" alt="" class=" responsive-img valign profile-image-login">-->
                    <p class="center-align text-darken-4 white-text  " style="margin: 0px;">LOST AND FOUND THINGS MANAGEMENT</p>
                </div>
            </div>


            <div class="col s12 no-padding">

                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width no-padding">
                        <li class="tab"><a href="#login" class="active">Login</a></li>
                        <li class="tab"><a href="#signup">Sign Up</a></li>
                    </ul>
                </div>

                <div class="card-content  grey darken-3" id="login">
                    <div>
                        <form id="login" method="post" action="userlogin.php">
                            <div class="row rowx margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix  ">email</i>
                                    <input id="username" type="text" name="username" required>
                                    <label for="username" class="center-align">Email</label>
                                </div>
                            </div>
                            <div class="row rowx margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix ">https</i>
                                    <input id="password" type="password" name="password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <!-- <div class="row"rowx  hidden>
                                 <div class="input-field col s12 m12 l12  login-text">
                                     <input type="checkbox" id="remember-me" checked="checked"/>
                                     <label for="remember-me">Remember me</label>
                                 </div>
                             </div>-->
                            <div class="row"rowx >
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light blue  col s12"><input type="submit"
                                                                                                      value="login">
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="card-content  grey darken-3" id="signup">
                    <div>
                        <form method="post" action="usersignup.php">
                            <div class="row rowx margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" type="email" name="email"  required >
                                    <label for="email" class="center-align">Email</label>
                                </div>
                            </div>

                            <div class="row rowx margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="username" type="text" name="fname"  required >
                                    <label for="username" class="center-align">First Name</label>
                                </div>
                            </div>
                            <div class="row rowx margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">person</i>
                                    <input id="lastname" type="text" name="lname"  required >
                                    <label for="lastname" class="center-align">Last Name</label>
                                </div>
                            </div>

                            <div class="row rowx margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="password" type="password" name="password"  required >
                                    <label for="password">Password</label>
                                </div>
                            </div>
                           <!-- <div class="row rowx margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">add_location</i>
                                    <label for="password-again">Postal Code</label>
                                    <input id="pincode" type="text" required name="pincode">
                                </div>
                            </div>-->

                            <div class="row"rowx >
                                <button class="btn waves-effect waves-light blue  col s12">
                                    <input type="submit" value="Register Now">
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</body>
</html>