var floatPosition = parseInt($(".sideBanner").css('top'))

$(window).scroll(function() {
  
    var currentTop = $(window).scrollTop();
    var bannerTop = currentTop + floatPosition + "px";
    
    $(".sideBanner").stop().animate({
      "top" : bannerTop
    }, 500);

}).scroll();