$(document).ready(function () {

    var l=$("#log").text();
    if(l=="fail"){
        Materialize.toast('Wrong username or password', 4000);
    }
    var l=$("#sign").text();
    if(l=="fail"){
        Materialize.toast('Email already exists', 4000);
    }
    if(l=="sucess"){
        Materialize.toast('User is Registered Login now ', 4000);
    }


});