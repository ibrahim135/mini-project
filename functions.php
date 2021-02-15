<?php

//function to upload image and returns the reference id
function upload_image($iname, $type)
{
    if(empty($_FILES[$iname]['name'])){
        $name="noimg.png";
        if ($type == 'lost')
            $query = "INSERT INTO db_lostandfound.limages(url) VALUES('$name')";

        if ($type == 'found')
            $query = "INSERT INTO db_lostandfound.fimages(url) VALUES('$name')";

        global $conn;
        $x = mysqli_query($conn, $query);
        $ref= mysqli_insert_id($conn);
        mysqli_commit($conn);
        return $ref;
    }



    //get file name here
    $_FILES[$iname]["name"] = $_SESSION['login_user'] . rand(100, 999) . $_FILES[$iname]["name"];
    $name = $_FILES[$iname]['name'];



    //chose post type
    if ($type == "lost") {
        $target_dir = "upload/lostimages/";

    }

    if ($type == "found") {
        $target_dir = "upload/foundimages/";

    }

    $target_file = $target_dir . basename($_FILES[$iname]["name"]);


    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png");

    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {

        // Insert record

        if ($type == 'lost')
            $query = "INSERT INTO db_lostandfound.limages(url) VALUES('" . $name . "')";
        if ($type == 'found')
            $query = "INSERT INTO db_lostandfound.fimages(url) VALUES('" . $name . "')";

        global $conn;
        $x = mysqli_query($conn, $query);


        // Upload file

        move_uploaded_file($_FILES[$iname]['tmp_name'], $target_dir . $name);

        $ref= mysqli_insert_id($conn);
        mysqli_commit($conn);
        return $ref;
    } else
        return 'fail';
}

//function to insert adress and returns the reference id
function add_adress($Add)
{

    global $conn;
    $city = mysqli_real_escape_string($conn, $Add['city']);
    $loc = mysqli_real_escape_string($conn, $Add['street']);
    $pin = mysqli_real_escape_string($conn, $Add['pincode']);
    $phone = mysqli_real_escape_string($conn, $Add['phone']);


    $querry = "INSERT INTO `db_lostandfound`.`adress`( `mobile`, `pincode`, `city`, `state`) VALUES ('$phone','$pin','$city','$loc')";

    $x = mysqli_query($conn, $querry);
    $ref= mysqli_insert_id($conn);
    mysqli_commit($conn);
    return $ref;


}

//generates  categeory list
function gen_cat_list()
{
    $sql = "SELECT `cid`, `cname` FROM `db_lostandfound`.`catagoery`";
    global $conn;
    $retval = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        $x = $row['cid'];
        $y = $row['cname'];
        echo "  <option value=\"$x\"  class=\"\" >$y</option>";
    }

}

//function to add post()
function add_post($discp, $ref_add, $pincode, $ref_uid, $ref_imgid, $date, $catg, $type)
{
    if ($type == "lost") {
        $sql = "INSERT INTO `db_lostandfound`.`lthings`(`cat_ref`, `discription`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate`) VALUES ($catg,'$discp',$ref_add,$pincode,'$ref_uid',$ref_imgid,'$date')";
        // $sql="INSERT INTO `lthings`(`discription`,`loc_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate`,`cat_ref`) VALUES ('$discp',$ref_add,$pincode,'$ref_uid',$ref_imgid,'$date',$catg)";
    }
    if ($type == "found") {
        $sql = "INSERT INTO `db_lostandfound`.`fthings`(`cat_ref`, `discription`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate`) VALUES ($catg,'$discp',$ref_add,$pincode,'$ref_uid',$ref_imgid,'$date')";
    }

    global $conn;
    mysqli_query($conn, $sql);
    mysqli_commit($conn);

}

//function to get username by id
function get_user($id)
{
    global $conn;
    $sql = "SELECT  `fname`,`lname` FROM `db_lostandfound`.`user` WHERE `email`='$id' ";
    $retval = mysqli_query( $conn, $sql);
    while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)){
        return $row['fname'] . " " . $row['lname'];
    }
   
}

//get image url from id
function get_imgurl($id, $type)
{
    global $conn;

    if ($type == "lost")
        $sql = "SELECT  `url` FROM `db_lostandfound`.`limages` WHERE `id`=$id";
    else
        $sql = "SELECT  `url` FROM `db_lostandfound`.`fimages` WHERE `id`=$id";

    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval);
    if ($type == "lost") {
        return "upload/lostimages/" . $row['url'];
    }
    if ($type == "found") {
        return "upload/foundimages/" . $row['url'];
    }

}

//get catageory  name by id
function get_catname($id)
{
    global $conn;
    $sql = "SELECT `cname` FROM `db_lostandfound`.`catagoery` WHERE `cid`=$id";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
    return $row['cname'];
}

//function to retrive post
function get_post($id, $type)
{
    global $conn;
    if ($type == "lost") {
        $sql = "SELECT `discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate`,`draft` FROM `db_lostandfound`.`lthings` WHERE `id`=$id";
        $top = " <span class=\"losttitle  z-depth-1 \"><b>LOST</b></span>";
    } else {
        $sql = "SELECT `discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate` ,`draft` FROM `db_lostandfound`.`fthings` WHERE `id`=$id";
        $top = "<span class=\"foundtitle  z-depth-1 \"><b>FOUND</b></span>";
    }

    $row = mysqli_fetch_array(mysqli_query($conn, $sql));
    if ($row['draft'] == 1) {
        $zz="<td><a class=\"btn\" href=\"\" disabled=''>drafted</a></td>";
    }
    else{
        $zz="<td><a class=\"btn\" href=\"draft.php?id=$id&&type=$type\">MOVE TO DRAFT</a></td>";
    }
    $catx=$row['cat_ref'];
    $cat = get_catname($row['cat_ref']);

    $disc = $row['discription'];

    // $add=$row['adressid'];
    //$pincode=$row['pincode'];
    //$user = get_user($row['uemail']);
    //$imgurl = get_imgurl($row['imgid'], $type);

    $pdate = $row['postdate'];

echo "<tr>
        <td>$id</td>
        <td>$type</td>
        <td>$cat</td>
        <td>$pdate</td>
        <td><a class=\"btn\" href=\"knowmore.php?id=$id&&type=$type\">Know more</a></td>
        
        $zz
        <td><a class=\"btn\" href=\"search.php?cat=$catx&&type=$type&&pdate=$pdate\">search</a></td>
        </tr>";
}

//function to retrive user post
function get_user_post($id, $type)
{

    global $conn;
    if ($type == "lost") {
        $sql = "SELECT `discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate`,`draft` FROM `db_lostandfound`.`lthings` WHERE `id`=$id";
        $top = " <span class=\"losttitle  z-depth-1 \"><b>LOST</b></span>";
    } else {
        $sql = "SELECT `discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate`,`draft` FROM `db_lostandfound`.`fthings` WHERE `id`=$id";
        $top = "<span class=\"foundtitle  z-depth-1 \"><b>FOUND</b></span>";
    }

    $row = mysqli_fetch_array(mysqli_query($conn, $sql));
    if ($row['draft'] == 1) {
        $link = " <a class= \"knoww btn btn-large teal\"  style=\" margin-top:10px\" href=\"knowmore.php?id=$id&&type=$type\">
                        SAVED IN DRAFT
                    </a>";
    } else {
        $link = " <a class=\"knoww btn btn-large  red lighten-1\" style=\" margin-top:10px\" href=\"draft.php?id=$id&&type=$type\">
                        Move to Draft
                    </a>";
    }
    $cat = get_catname($row['cat_ref']);
    $disc = $row['discription'];
    // $add=$row['adressid'];
    //$pincode=$row['pincode'];
    $user = get_user($row['uemail']);
    $imgurl = get_imgurl($row['imgid'], $type);
    $pdate = $row['postdate'];


    echo " <div class=\"col s4  \">
            <div class=\"card blue 1 white-text z-depth-5 medium postcard\" >
                <div class=\"card-image\">
                    <img src=\"$imgurl\" style=\"width: 300px;height: 300px\" class=\"materialboxed\">
                     $top
                    <span class=\"pusertext  \">
                </div>
                <div class=\"card-content\">
                    <div class=\"   col s12  \" style=\"text-transform: uppercase;\"><i class=\"material-icons left\">clear_all</i><b>$cat</b></div>
                    <p class=\"text-darken-4 \" style=\"  margin: 5px; \"> $disc
                    </p>
                </div>
               $link
            </div>
        </div>";


}

//function to retrive search post
function get_search_post($id, $type)
{
       global $conn;
    if ($type == "lost") {
        $sql = "SELECT `id`,`discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate` ,`draft` FROM `db_lostandfound`.`lthings` WHERE `id`=$id";

    } else {
        $sql = "SELECT `id`,`discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate` ,`draft` FROM `db_lostandfound`.`fthings` WHERE `id`=$id";
    }

    $retval=mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval);
    if ($row['draft'] == 1) {
        return;
    }

    $id=$row['id'];
    $cat = get_catname($row['cat_ref']);
    $disc = $row['discription'];
    // $add=$row['adressid'];
    //$pincode=$row['pincode'];
    $user = get_user($row['uemail']);
    //$imgurl = get_imgurl($row['imgid'], $type);
    $pdate = $row['postdate'];

    echo "<tr>
        <td>$id</td>
        <td>$user</td>
        <td>$cat</td>
        <td>$disc</td>
        <td>$pdate</td>
        <td><a class=\"btn\" href='knowmore.php?id=$id&&type=$type'>know more</a> </td>
        </tr>";

}

//move a post to draft
function mov_draf($id, $type)
{

    global $conn;
    $date = date("Y-m-d");
    if ($type == "lost") {
        $sql = "UPDATE `db_lostandfound`.`lthings` SET  `draft`=1,`ddate`='$date' WHERE `id`=$id";
    } else {
        $sql = "UPDATE `db_lostandfound`.`fthings` SET  `draft`=1,`ddate`='$date' WHERE `id`=$id";
    }
    mysqli_query($conn, $sql);
    mysqli_commit($conn);
}

//function to get phone no
function get_phone($id)
{
    global $conn;
    $sql = "SELECT   `city`, `state`, `mobile` FROM `db_lostandfound`.`adress` WHERE `aid`=$id";
    $row = mysqli_fetch_array(mysqli_query($conn, $sql));
    return $row['mobile'];

}

//function to get full adress
function get_full_add($id)
{
    global $conn;
    $sql = "SELECT   `city`, `state`, `mobile` FROM `db_lostandfound`.`adress` WHERE `aid`=$id";
    $row = mysqli_fetch_array(mysqli_query($conn, $sql));
    return $row['city'] . "-" . $row['state'];

}

//function to authnticate admin
function auth_admin()
{
    global $conn;
    if (isset($_SESSION['login_user'])) {
        $x = $_SESSION['login_user'];
        $sql = "SELECT `isadmin` FROM `db_lostandfound`.`user` WHERE `email`='$x'";

        $row = mysqli_fetch_array(mysqli_query($conn, $sql));
        if ($row['isadmin'] != 1) {
            header("location:index.php");
        }
    } else {
        header('location:login.php');
    }
}

//function to get user list-admin-panel
function get_user_list()
{
    global $conn;
    $sql = "SELECT `email`,`isadmin`, `posts`,`isadmin` FROM `db_lostandfound`.`user` ";

    $retval = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        $email = $row['email'];
        $user = get_user($email);
        $post = $row['posts'];

        echo "<tr><td>$user</td>
                <td>$email</td>
                <td>$post</td>
                <td><a href='deleteuser.php?id=$email' class='btn'>delete</a></td>
                </tr>";

    }


}

//function to get post list-admin-panel
function get_post_list($type)
{
    global $conn;
    if ($type == "lost") {
        $sql = "SELECT `id`, `discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate` ,`draft` FROM `db_lostandfound`.`lthings` ";
        $top = " <span class=\"losttitle  z-depth-1 \"><b>LOST</b></span>";
    } else {
        $sql = "SELECT `id`,`discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate` ,`draft`  FROM `db_lostandfound`.`fthings`";
        $top = "<span class=\"foundtitle  z-depth-1 \"><b>FOUND</b></span>";
    }
    $retval = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {

         if ($row['draft'] == 1) {
             continue;
         }

        $cat = get_catname($row['cat_ref']);
        $id = $row['id'];
        // $add=$row['adressid'];
        //$pincode=$row['pincode'];
        $user = get_user($row['uemail']);
        //$imgurl = get_imgurl($row['imgid'], $type);
        $pdate = $row['postdate'];


        echo "<tr>
                <td>$id</td>
                <td>$user</td>
                <td>$cat</td>
                 <td>$pdate</td>
                <td><a href='knowmore.php?id=$id&&type=$type' class='btn'>details</a></td>
                </tr>";


    }
}

//function to get post which are drafted
function get_draft_post()
{
    global $conn;
    $sqla = "SELECT `id`, `discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate` ,`draft`,`ddate` FROM `db_lostandfound`.`lthings` ";
    $sqlb = "SELECT `id`,`discription`,`cat_ref`, `adressid`, `pincode`, `uemail`, `imgid`, `postdate` ,`draft`,`ddate` FROM `db_lostandfound`.`fthings`";

    $retval = mysqli_query($conn, $sqla);
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {

        if ($row['draft'] == 1) {
            $cat = get_catname($row['cat_ref']);
            $id = $row['id'];
            // $add=$row['adressid'];
            //$pincode=$row['pincode'];
            $user = get_user($row['uemail']);
            //$imgurl = get_imgurl($row['imgid'], $type);
            $pdate = $row['postdate'];
            $ddate = $row['ddate'];

            echo "<tr>
                <td>$id</td>
                <td>$user</td>
                <td>lost</td>
                <td>$cat</td>
                 <td>$pdate</td>
                 <td>$ddate</td>
                <td><a href='knowmore.php?id=$id&&type=lost' class='btn'>details</a></td>
                </tr>";
        }
    }

    $retval = mysqli_query($conn, $sqlb);
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {

        if ($row['draft'] == 1) {
            $cat = get_catname($row['cat_ref']);
            $id = $row['id'];
            // $add=$row['adressid'];
            //$pincode=$row['pincode'];
            $user = get_user($row['uemail']);
            //$imgurl = get_imgurl($row['imgid'], $type);
            $pdate = $row['postdate'];
            $ddate = $row['ddate'];

            echo "<tr>
                <td>$id</td>
                <td>$user</td>
                <td>found</td>
                <td>$cat</td>
                 <td>$pdate</td>
                 <td>$ddate</td>
                <td><a href='knowmore.php?id=$id&&type=found' class='btn'>details</a></td>
                </tr>";
        }
    }
}

//function retruns true if user is admin
function is_admin()
{
    global $conn;
    if (isset($_SESSION['login_user'])) {

        $x = $_SESSION['login_user'];
        $sql = "SELECT `isadmin` FROM `db_lostandfound`.`user` WHERE `email`='$x'";
        $row = mysqli_fetch_array(mysqli_query($conn, $sql));

        if ($row['isadmin'] == 1) {

            return true;
        } else {

            return false;
        }
    } else {

        return false;
    }
}

//function to get total count of table
function t_count($x){
    global $conn;
    $sql="SELECT COUNT(*) 'total' FROM `db_lostandfound`.`$x`";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval);
    return $row['total'];

}

//function to get total count of table
function tp_count($x){
    global $conn;
    $sql="SELECT COUNT(*) total FROM `db_lostandfound`.`$x` WHERE `draft`=0 ";

    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval);
    return $row['total'];

}

//function to get total count of draft post
function draft_post_count(){
    global $conn;
    $sql="SELECT COUNT(`id`) 'total' FROM `db_lostandfound`.`fthings` WHERE draft=1";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval);
    $total=$row['total'];

    $sql="SELECT COUNT(`id`) 'total' FROM `db_lostandfound`.`lthings` WHERE draft=1";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval);

    $total=$total+$row['total'];
    return $total;
}

?>


