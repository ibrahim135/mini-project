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
require ("session.php");
$user=$_SESSION['login_user'];
$sql="SELECT `email`, `fname`, `lname`, `password`, `isadmin`, `posts` FROM `db_lostandfound`.`user` WHERE `email`='$user'";
global $conn;
$retval=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($retval);
$email=$row['email'];
$fname=$row['fname'];
$lname=$row['lname'];

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pasword = md5($_POST['password']);
    $sql = "UPDATE `db_lostandfound`.`user` SET `fname`='$fname',`lname`='$lname',`password`='$pasword' WHERE `email`='$user'";
    mysqli_query($conn, $sql);
    header("location:logut.php");
}

?>

<div id="login-page" class="row rowx rowxrowx  card1">
    <div class="col s12 z-depth-5 card card1 grey darken-4 blue-text">
        <div class="login-form ">

            <div class="row rowx no-pad-bot card-content no-pad-top ">
                <div class="input-field col s12 no-pad-bot center ">
                    <!--  <img src="image/logo.png" alt="" class=" responsive-img valign profile-image-login">-->
                    <p class="center-align text-darken-4 white-text  " style="margin: 0px;">UPDATE USER DETAIL</p>
                </div>
            </div>
                <div class="card-content  grey darken-3" id="signup">
                    <div>
                        <form method="post" action="edituser.php">
                            <div class="row rowx margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix" >email</i>
                                    <?php
                                    echo "<input id=\"email\" type=\"email\" name=\"email\" value=\"$email\"  class=\"white-text\" disabled>";
                                    ?>

                                    <label for="email" class="center-align">Email</label>
                                </div>
                            </div>

                            <div class="row rowx margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">account_circle</i>
                                    <?php
                                    echo " <input id=\"username\" type=\"text\" name=\"fname\"  value='$fname' required >";
                                    ?>

                                    <label for="username" class="center-align">First Name</label>
                                </div>
                            </div>
                            <div class="row rowx margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">person</i>
                                    <?php
                                    echo " <input id=\"username\" type=\"text\" name=\"lname\"  value='$lname' required >";
                                    ?>
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
                                    <input type="submit" value="UPDATE">
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