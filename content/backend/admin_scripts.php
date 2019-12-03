
<script>

    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
        var wscroll = $(this).scrollTop();
        if(wscroll > 100){
            $(".sidenav").css("top","4%");
            $(".navbar").addClass("shrink-nav");
            $(".logo").addClass("shrink-logo");
            $(".tekst").addClass("hide1");
            $(".scroll-nav").removeClass("hide1");
            $(".normalnav").addClass("hide1");
            $(".my-nav").removeClass("navbar-static-top");
            $(".my-nav").addClass("navbar-fixed-top");
            $(".sidenav").css("top","4%");


        }
        else{
            $(".sidenav").css("top","17%");

            $(".my-nav").addClass("navbar-static-top");
            $(".my-nav").removeClass("navbar-fixed-top");

            $(".navbar").removeClass("shrink-nav");
            $(".logo").removeClass("shrink-logo");
            $(".tekst").removeClass("hide1");
            $(".scroll-nav").addClass("hide1");
            $(".normalnav").removeClass("hide1");

        }
    }
</script>