$(document).ready(function(){
    
    // Sidenav open/close
    $("#open-sidenav").click(function(){
        $(".sidenav").animate({left: 0}, 500);
    });
    $("#close-sidenav").click(function(){
        $(".sidenav").animate({left: "-40vw"}, 500);
    });
    $(window).resize(function(){
        if ($(window).width() > "768px"){
            $(".sidenav").css("left", "0vw");
        }
        if ($(window).width() <= "768px"){
            $(".sidenav").css("left", "-40vw");
        }
    });
    
    //Smooth scrolling adapted from https://css-tricks.com/snippets/jquery/smooth-scrolling/
    
    $('a[href *= "#"]').click(function(event){
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname
        ){
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                event.preventDefault();
                $('html, body').animate({
                  scrollTop: target.offset().top
                }, 700, function() {
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) {
                        return false;
                    }
                    else{                       
                        $target.attr('tabindex','-1');
                        $target.focus();
                    };
                });
            }
        }
    });
    
});