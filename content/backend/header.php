<script>
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    var wscroll = $(this).scrollTop();
    if(wscroll > 100){
        $(".navbar").addClass("shrink-nav");
        $(".logo").addClass("shrink-logo");
        $(".tekst").addClass("hide1");
        $(".scroll-nav").removeClass("hide1");
        $(".normalnav").addClass("hide1");

    }
    else{
        $(".navbar").removeClass("shrink-nav");
        $(".logo").removeClass("shrink-logo");
        $(".tekst").removeClass("hide1");
        $(".scroll-nav").addClass("hide1");
        $(".normalnav").removeClass("hide1");

    }
}
</script>