jQuery(function ( $ ) {

  var windowWidth = $(window).width();
  var newWindowWidth = $(window).width();
  var scrollTop = $(window).scrollTop();
  var newScrollTop = $(window).scrollTop();

  /*
  $('.tv_toggle').on('click', function(){
    $('.tv').css('height', 'auto');
	  if($('.tv_content').css('opacity') == 0){
            $('.tv_content').fadeIn();
            $('.tv_content').animate({opacity: 1},'fast', function () {
                $('.tv .list').css('height', $('#player').css("height"));
                player.api("play");
            });
            //$("#player").css("height", $(".tv .player").height()+"px");

        } else {
            player.api("stop");
            $('.tv_content').animate({opacity: 0});
            $('.tv_content').fadeOut();
        }
        $('.tv .list').scrollTop($('.tv .list').scrollTop() + $(current).position().top
            - $('.tv .list').height()/2 + $(current).height()/2);
    });
   */


 

  $(".show-search-field").on("click", function () {
    $(this).parent().toggleClass("active");
    setTimeout(function(){
      $(".show-search-field").prop("type", "submit");
    }, 500);
  });


  $(".show-header-menu").on("click", function () {
    $(this).toggleClass("active");
    $(this).parent(".header-menu-block").toggleClass("active");
  });

  $(".header-menu").on('mouseleave', function(){
    setTimeout(function(){
      $('.header-menu-block').removeClass('active');
      $('.btn-header-menu').removeClass('active');
    }, 700);
  });

  $(".actual-news-btn").on("click", function () {
    $(this).parent(".actual-news-btns").find(".actual-news-btn").removeClass("active");
    $(this).addClass("active");
  })

  $(document).ready(function () {
    $('.select').niceSelect();
	    });

  var swiperNews = new Swiper('.slider-news-container', {
    slidesPerView: 2,
    /* spaceBetween: 35, */
    navigation: {
      nextEl: '.slider-news-next',
      prevEl: '.slider-news-prev',
    },
  });


  var swiper4article = new Swiper('.swiper-4article', {
    slidesPerView: 1,
    allowTouchMove: false,
    simulateTouch: false,
    noSwiping: true,
    allowSwipeToNext: false,
    allowSwipeToPrev: false,
    pagination: {
      el: '.swiper-pagination',
    },
    breakpoints: {
      720: {
        allowTouchMove: true,
        simulateTouch: true,
        noSwiping: false,
        allowSwipeToNext: true,
        allowSwipeToPrev: true
      },
    },
  });

  var swiperVideo = new Swiper('.swiper-video', {
    slidesPerView: 1,
    allowTouchMove: false,
    simulateTouch: false,
    noSwiping: true,
    allowSwipeToNext: false,
    allowSwipeToPrev: false,
    pagination: {
      el: '.swiper-pagination',
    },
    breakpoints: {
      720: {
        allowTouchMove: true,
        simulateTouch: true,
        noSwiping: false,
        allowSwipeToNext: true,
        allowSwipeToPrev: true
      },
    },
  });

  $(".btn-menu-list").on("click", function () {
    $(this).toggleClass("active");
  });

  


  $(window).on("resize", function () {
    newWindowWidth = $(this).width();

    if (windowWidth < 720 && newWindowWidth  >= 720) {
      if ($(".swiper-4article").length > 0) {
        swiper4article.slideTo(0, false, false);
      }
      if ($(".swiper-video").length > 0) {
        swiperVideo.slideTo(0, false, false);
      }
    }
    

    windowWidth = $(this).width();

  });

  $(window).scroll(function () {
    newScrollTop = $(this).scrollTop()

    if (windowWidth < 992) {
      if (newScrollTop < scrollTop) {
        $("header").addClass("fixed anim-in")
      } else {
        $("header.fixed").removeClass("fixed anim-in")
      }
    }

    scrollTop = $(this).scrollTop()
  });

});