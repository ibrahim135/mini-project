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
<body class="blue grey darken-2">
<?php
require ("config.php");
require ("session.php");
require ("functions.php");
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
<div class="container white-text  blue-grey   darken-3 form_main z-depth-5">
    <div class="row">
        <div class="col s6">
            <h5 style="text-transform:uppercase">Enter Deatils about <FOUND></FOUND> item </h5>
        </div>
        <form class="" action="foundpost.php" method="post" enctype='multipart/form-data'>
            <div class="col s8">
                <div class="col s6">
                    <div class="input-field col s10 white-text">
                        <i class="material-icons prefix " style="margin-top: 10px;" >format_list_bulleted
                        </i>
                        <select name="cata" required>
                            <option value="" disabled selected class="" value="0">Select Category</option>
                            <?php
                            gen_cat_list();
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col s6">
                    <div class="input-field col s10">
                        <i class="material-icons prefix">location_on</i>
                        <input id="icon_prefix" type="number" required class="validate" name="pincode" minlength="5" maxlength="6">
                        <label for="icon_prefix " class="white-text">Pincode</label>
                    </div>

                </div>
                <div class="col s6">
                    <div class="input-field col s10">
                        <i class="material-icons prefix">sort</i>
                        <textarea id="icon_prefix2" required class="materialize-textarea" name="discription" minlength="10" maxlength="80"></textarea>
                        <label for="icon_prefix2 " class="white-text">Description</label>
                    </div>
                </div>

                <div class="col s6">
                    <div class="input-field col s10">
                        <i class="material-icons prefix">mail_outline</i>
                        <input id="city" type="text" required class="validate" name="city" minlength="4">
                        <label for="city" class="white-text">City/State</label>
                    </div>

                </div>


                <div class="col s6">
                    <div class="input-field col s10">
                        <i class="material-icons prefix">location_searching</i>
                        <input id="locality" type="text" required class="validate" name="street" minlength="4">
                        <label for="locality" class="white-text">Sreet/Locality</label>
                    </div>

                </div>



                <div class="col s6">
                    <div class="input-field col s10">
                        <i class="material-icons prefix">phone</i>
                        <input id="phone" type="number" required class="validate" name="phone" maxlength="10" minlength="10">
                        <label for="phone" class="white-text">Phone</label>
                    </div>

                </div>



                <div class="col s6">
                    <div class="input-field col s10">
                        <i class="material-icons prefix">av_timer</i>
                        <input  class="materialize-textarea" required type="date" name="date"></input>

                    </div>
                </div>


            </div>

            <div class="col s4 imagesubmit">
                <div class="col 12">

                    <input type="file" name="limage" id="input-file-now-custom-1" class="dropify" data-height="250"
                           data-max-file-size="1M" / >
                </div>
            </div>
    </div>
    <br>
    <div class="col s6 " style="margin-left: 20px; margin-bottom: 10px ;border-radius: 100px;">
        <button class="btn btn-large blue darken-2 z-depth-3 waves-effect waves-light" type="submit"
                name="action">POST
            <i class="material-icons right">send</i>
        </button>

    </div>
</div>
</form>
</div>
</div>

</body>
</html>
