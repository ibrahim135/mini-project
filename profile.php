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
<body class="   grey darken-2">
<?php
require("config.php");
require("functions.php");
session_start();
if (!(isset($_SESSION['login_user']))) {
    header("location:login.php");
}
$user = $_SESSION['login_user'];
$name = get_user($user);

$sql = "SELECT `posts` FROM `db_lostandfound`.`user` WHERE `email`='$user'";
$row = mysqli_fetch_array(mysqli_query($conn, $sql));
$post = $row['posts'];


?>

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
<style>
    .row {
        margin-bottom: 0px;
    }
    .xx{
        overflow-y:scroll;
        max-height:480px;

        display:block;
    }
</style>
<div class="container">
    <div class="row profilev   ">

        <div class="col s12 push-s1  z-depth-4 card-panel blue-grey darken-3 white-text" style="border-radius: 5px;">
            <div class="container">
                <div class="row">
                    <br>
                    <?php
                    $post = $row['posts'];
                    echo "<div class=\"col s2\">$name</div>
            <div class=\"col s5\">EMAIL  :$user</div>
            <div class='col s2'>Total post :$post</div>
            <div class=\"col s2 push-s1\" style='margin-right: 5px'><a href='edituser.php' class='btn'>edit </a></div>";
                    ?>
                </div>
            </div

        </div>

    </div>
</div>
<div class="xx">
<div class="white-text blue-grey darken-1  z-depth-1" style=" ">
    <table class="centered  responsive-table  ">
        <div class="center-align flow-text">POST's BY <?php echo  $name?></div>
        <thead>
        <tr style="text-transform: uppercase">
            <th>id</th>
            <th>type</th>
            <th>Catageory</th>
            <th>post date</th>
            <th>know more</th>

            <th>DRAFT</th>
            <th>Search</th>
        </tr>
        </thead>

        <tbody style="text-transform: capitalize;" >
        <?php
        $sql = "SELECT `id` FROM `db_lostandfound`.`lthings` WHERE `uemail`='$user'";
        $retval = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $id=$row['id'];
            get_post($id, 'lost');
        }
        $sql = "SELECT `id` FROM `db_lostandfound`.`fthings` WHERE `uemail`='$user'";
        $retval = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $id=$row['id'];
            get_post($id, 'found');
        }
        ?>
        </tbody>
    </table>


</div>
</div>

</body>

</html>