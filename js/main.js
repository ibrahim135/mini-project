$(document).ready(function () {

    //Materialize.toast('Wrong username or password', 4000);
    $('.materialboxed').materialbox();

    //animation to drop
    $('a[href^="#"]').bind('click.smoothscroll',function (e) {
        e.preventDefault();
        var target = this.hash,
            $target = $(target);

        $('html, body').stop().animate( {
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            window.location.hash = target;
        } );
    } );


});
