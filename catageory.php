<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        Admin Area (flown things)
    </title>
    <link rel="stylesheet" href="css/postreport.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,900|Roboto+Condensed:400,300,700'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="dist/css/dropify.min.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/postreport.js"></script>
<body class="blue-grey darken-4">
<nav>
    <div class="nav-wrapper  blue-grey darken-3  ">
        <a href="#" class="brand-logo center " style="text-transform: uppercase;overflow: hidden;">Admin Area <span
                    class="hide-on-med-and-down"></span> </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li style="margin-right: 0px;"><a class="btn teal" href="admin.php">Admin Panel</a></li>
            <li style="margin-right: 0px;"><a class="btn teal" href="index.php">home</a></li>
            <li style="margin-left: 0px"><a class="btn teal" href="logut.php">logout</a></li>
            <!-- <li><a href="badges.html">Components</a></li>
           <li><a href="collapsible.html">JavaScript</a></li>-->
        </ul>
    </div>
</nav>
<br>
<?php
require("session.php");
require("config.php");
require("functions.php");
auth_admin();


if($_SERVER['REQUEST_METHOD']=="POST")
{
    global $conn;
    if(isset($_POST['catref'])){
        $catref=$_POST['catref'];
        if($catref!="0"){
           $sql="DELETE FROM `db_lostandfound`.`catagoery` WHERE `cid`=$catref";
            mysqli_query($conn,$sql);
            echo"<script>alert('category is deleted ')</script>";
        }

    }
    if(isset($_POST['cat'])){
        $cat=$_POST['cat'];
        $sql="INSERT INTO `db_lostandfound`.`catagoery`(`cname`) VALUES ('$cat'  )";
        mysqli_query($conn,$sql);
        echo"<script>alert('new category is added ')</script>";
    }
}
?>

<div class="container white-text  blue-grey   darken-3 form_main z-depth-5">
    <div class="row">
        <div class="col s6">
            <h5 style="text-transform:uppercase">Choose Catagory to delete</h5>
        </div>
        <form class="" action="catageory.php" method="post" enctype='multipart/form-data'>
            <div class="col s8">
                <div class="col s12">
                    <div class="input-field col s10 white-text">

                        <select name="catref" required>
                            <option value="" disabled selected class="" value="0">Select Category</option>
                            <?php
                            gen_cat_list();
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col s6 " style="margin-left: 20px; margin-bottom: 10px ;border-radius: 100px;">
                <button class="btn btn-large blue darken-2 z-depth-3 waves-effect waves-light" type="submit"
                        name="action">DELETE
                </button>

            </div>
        </form>
    </div>
    <br>

</div>

<div class="container white-text  blue-grey   darken-3 form_main z-depth-5">
    <div class="row">
        <div class="col s6">
            <h5 style="text-transform:uppercase">Enter Catagory to Add</h5>
        </div>
        <form class="" action="catageory.php" method="post" enctype='multipart/form-data'>
            <div class="col s8">
                <div class="col s6">
                    <div class="input-field col s10">
                        <input id="icon_prefix" type="text" required class="validate" name="cat" minlength="1"
                               maxlength="6">
                        <label for="icon_prefix " class="white-text">Catageory</label>
                    </div>

                </div>
            </div>
            <div class="col s6 " style="margin-left: 20px; margin-bottom: 10px ;border-radius: 100px;">
                <button class="btn btn-large blue darken-2 z-depth-3 waves-effect waves-light" type="submit"
                        name="action">ADD
                </button>

            </div>
        </form>
    </div>
</div>
<br>

</div>
</body>
</html>
