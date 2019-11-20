const $ = require('jquery');

$(document).ready(function(){
    // Show or Hide The Sticky Footer Button
    $(window).scroll(function(){
        if ($(this).scrollTop() > 200 ) {

            $('.go-top').fadeIn(200);
        } else {
            $('.go-top').fadeOut(200);
        }
    });

    // Animate the scroll to top
    $('.go-top').click(function(e){

        e.preventDefault();

        $('html,body').animate({scrollTop: 0}, 300);

    });
});