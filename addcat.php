<html xmlns="http://www.w3.org/1999/html">
<head>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/postreport.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,900|Roboto+Condensed:400,300,700'
          rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="dist/css/dropify.min.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>

    <script type="text/javascript" src="js/postreport.js"></script>
    <script src="dist/js/dropify.min.js"></script>
</head>
<body class="blue darken-2">
<ul id="dropdown1" class="dropdown-content maindrop white">

    <li><a href="profile.php"> Profile</a></li>

    <li class="divider"></li>

    <li><a href="logut.php">Logout</a></li>
</ul>
<nav class="blue darken-2">
    <div class="nav-wrapper  ">
        <a  href="index.php" class="brand-logo logo">
            </a>
    </div>
</nav>
<br>
<?php
require ("config.php");
if(isset($_POST['cata'])){
    $cat=$_POST['cata'];

    $sql="INSERT INTO `db_lostandfound`.`catagoery` (`cname`) VALUES ('$cat')";
    global $conn;
    mysqli_query($conn,$sql);
}
?>
<div class="container white-text  blue  darken-3 form_main">
    <div class="row">
        <div class="col s12">
            <h5 style="text-transform: capitalize">Enter The catageory</h5>
        </div>
        <form class="" action="" method="post" >
            <div class="col s12">
                <div class="input-field col s10">
                    <i class="material-icons prefix">location_on</i>
                    <input id="icon_prefix" type="text"  required  class="validate" name="cata">
                    <label for="icon_prefix " class="white-text">Catageory</label>
                </div>
            </div>
            <div class="col s12">
                <div class="input-field col s10">
                    <p>
                    <input id="icon_prefix" type="submit"  required  class="validate btn" >
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
/*CREATE DEFINER=`root`@`localhost` PROCEDURE `userCount`(OUT `counts` INT)
NO SQL
select count(*) into counts from user
*/?>
</body>