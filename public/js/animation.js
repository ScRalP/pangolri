$(document).ready(function(){
    $(window).scroll(function(){
        if($(this).scrollTop() > 200){
            $('.go-top').fadeIn(200);
        }
    });
});