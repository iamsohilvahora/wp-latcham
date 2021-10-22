jQuery(document).ready(function() {

 
  jQuery("a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area

      jQuery('html, body').animate({
        scrollTop: jQuery(hash).offset().top
      }, 2000, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  jQuery('input[type=file]').customFile();
   jQuery(".resourceloadmore").on('click',function() {
        $html = 'append';
        resources_post_show($html);
    });
    jQuery('#resource_term').on('change',function(){
      jQuery('#offset').val(0);
      $html = 'html';
      resources_post_show($html);
    });

  svgjs();
 
  
	var iPad = navigator.userAgent.match(/iPad/i) != null;
    var iPhone = navigator.userAgent.match(/iPhone/i) != null;
    var osofvisitor = navigator.platform.toLowerCase();
	if (!("ontouchstart" in document.documentElement)) {
        document.documentElement.className += " no-touch";
    } else {
        document.documentElement.className += " touch";
    }	
	if ((osofvisitor.indexOf("mac") > -1) || (iPad) || (iPhone)) {  
        jQuery('html').addClass('mac');
    } else {
        jQuery('html').addClass('no-mac');
    }

   
    //--Main Menu
   jQuery(".touch .main-navigation ul li > a").on("click touchstart",function(event){
       if(!jQuery(this).parent().hasClass("open") && jQuery(this).parent().has("ul").length > 0)
       {
        event.preventDefault();
        event.stopPropagation();
        jQuery(this).parent().addClass("open").siblings().removeClass("open");
       }
    });
   
  
   jQuery('.pdfdwnload').click(function(){   
    jQuery('#exampleModal').modal('show')	
	});
	jQuery('.menu-toggle').click(function(){
		jQuery('body').toggleClass('menu-open'); jQuery(".touch .industry-post-items .item .box-link").on("click touchstart",function(event){
       if(!jQuery(this).parent().hasClass("active"))
       {
        event.preventDefault();
        event.stopPropagation();
        jQuery(this).parent().addClass("active").siblings().removeClass("active");
       }
    });
	});
   
    jQuery('.link-search-btn').click(function(e){
        jQuery('body').toggleClass('search-open');
         e.stopPropagation();
    });
    jQuery('#searchform').click(function(e){
         e.stopPropagation();
    });
    jQuery('body').click(function(){
        jQuery(this).removeClass('search-open');
    });



    /*Slider*/
    jQuery('.hero-slider').not('.slick-initialized').slick({ 
         infinite: true,
         slidesToShow: 1,
         slidesToScroll: 1,
         arrows: false,
         autoplay: (jQuery('.hero-slider .item').length > 1) ? true : false,
         autoplaySpeed: 6000,
         dots: (jQuery('.hero-slider .item').length > 1) ? true : false, 
         pauseOnHover:false,
         speed: 2000,
          
    });

      jQuery('.testimonials-carsoul').not('.slick-initialized').slick({ 
         infinite: true,
         slidesToShow: 1,
         slidesToScroll: 1,
         arrows: (jQuery('.testimonials-carsoul .item').length > 1) ? true : false,
         autoplay: (jQuery('.testimonials-carsoul .item').length > 1) ? true : false,
         autoplaySpeed: 5000,
         dots: false,
         pauseOnHover:false,

         responsive: [
                      
                      {
                        breakpoint: 768,
                        settings: {
                          adaptiveHeight: true,    
                           autoplay: false,
                          }
                      } 
                       
                  ]
        });

      jQuery(".testimonials-carsoul").not('.slick-initialized').slick()


     jQuery('.usps-slider').not('.slick-initialized').slick({ 
                   infinite: true,
                   slidesToShow:4,
                   slidesToScroll:1,
                   arrows: false,
                   autoplay: (jQuery('.usps-slider .item').length < 4) ? true : false,
                   autoplaySpeed: 5000,
                   dots: false, 
                   pauseOnHover:false,

                   responsive: [
                    
                      {
                        breakpoint: 1199,
                        settings: {
                          slidesToShow: 3,
                          slidesToScroll:1,
                          dots:false, 
                          autoplay: (jQuery('.usps-slider .item').length < 3) ? true : false,

                        }
                      },
                      {
                        breakpoint: 768,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                          dots:false, 
                          autoplay: (jQuery('.usps-slider .item').length < 2) ? true : false,
                        }
                      },
                      {
                        breakpoint:640,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                          dots:false, 
                          autoplay: (jQuery('.usps-slider .item').length < 1) ? true : false,
                        }
                      }
                  ]
              });  
    jQuery('.industry-post-items').each(function(){
        jQuery(this).find('.item').each(function(){
            jQuery(this).on('mouseenter',function(){
                jQuery('.industry-post-items .item').removeClass('active');
                if(!jQuery(this).hasClass('active')){
                    jQuery(this).addClass('active');
                }
            })

        })
    })


    jQuery('.box-carsoul').not('.slick-initialized').slick({ 
         infinite: true,
         slidesToShow: 2,
         slidesToScroll:1,
         autoplaySpeed: 5000,
         dots: false,
         pauseOnHover:false,
    });

     jQuery('.post-box-carsoul').not('.slick-initialized').slick({ 
         infinite: true,
         slidesToShow: 2,
         slidesToScroll:1,
         arrows: (jQuery('.post-box-carsoul .item').length > 2) ? true : false,
         autoplay: (jQuery('.post-box-carsoul .item').length > 2) ? true : false,
         autoplaySpeed: 5000,
         dots: false,
         pauseOnHover:false, 
         responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 1,
                slidesToScroll:1,
              }
            }
        ]
    });
     jQuery('.case-post-box-carsoul').not('.slick-initialized').slick({ 
         infinite: true,
         slidesToShow: 1,
         slidesToScroll:1,
         arrows: true,
         autoplay:true,
         autoplaySpeed: 5000,
         pauseOnHover:false,
         dots: false, 
         responsive: [
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                           
                        }
                      },
                      {
                        breakpoint: 540,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                           
                        }
                      }  
                  ]
    });


      jQuery('.logo-carsoul').not('.slick-initialized').slick({ 
                   infinite: true,
                   slidesToShow:5,
                   slidesToScroll:1,
                   arrows: false,
                   autoplay: (jQuery('.logo-carsoul .slick-slide > .item').length < 5) ? true : false,
                   autoplaySpeed:2000,
                   dots: false, 
                   pauseOnHover:false,
                   responsive: [
                   {
                        breakpoint: 1200,
                        settings: {
                          slidesToShow: 4,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-carsoul  .slick-slide > .item').length < 4) ? true : false,
                        }
                      },
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: 3,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-carsoul  .slick-slide > .item').length < 3) ? true : false,

                        }
                      },
                      {
                        breakpoint: 768,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-carsoul  .slick-slide > .item').length < 2) ? true : false,
                        }
                      },
                      {
                        breakpoint:570,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-carsoul  .slick-slide > .item').length < 1) ? true : false,
                        }
                      }
                  ]
              }); 

      jQuery('.logo-category-slider').not('.slick-initialized').slick({ 
                   infinite: true,
                   slidesToShow:4,
                   slidesToScroll:1,
                   arrows: false,
                   autoplay: (jQuery('.logo-category-slider .slick-slide > .item').length < 4) ? true : false,
                   autoplaySpeed: 5000,
                   dots: false,
                   pauseOnHover:false, 
                   responsive: [
                   {
                        breakpoint: 1200,
                        settings: {
                          slidesToShow: 4,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-category-slider  .slick-slide > .item').length < 4) ? true : false,
                        }
                      },
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: 3,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-category-slider  .slick-slide > .item').length < 3) ? true : false,

                        }
                      },
                      {
                        breakpoint: 768,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-category-slider  .slick-slide > .item').length < 2) ? true : false,
                        }
                      },
                      {
                        breakpoint:570,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-category-slider  .slick-slide > .item').length < 1) ? true : false,
                        }
                      }
                  ]
              }); 

       jQuery('.solution-row').not('.slick-initialized').slick({ 
                   infinite: true,
                   slidesToShow:4,
                   slidesToScroll:1,
                   arrows: (jQuery('.solution-row .slick-slide > .item').length < 5) ? true : false,
                   autoplay: (jQuery('.solution-row .slick-slide > .item').length < 5) ? true : false,
                   autoplaySpeed: 5000,
                   dots: false, 
                   pauseOnHover:false,
                   responsive: [
                      {
                        breakpoint: 1200,
                        settings: {
                          slidesToShow: 3,
                          slidesToScroll:1,
                          arrows: (jQuery('.solution-row .slick-slide > .item').length < 3) ? true : false,
                          autoplay: (jQuery('.solution-row  .slick-slide > .item').length < 3) ? true : false,

                        }
                      },
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                          arrows: (jQuery('.solution-row .slick-slide > .item').length < 2) ? true : false,
                          autoplay: (jQuery('.solution-row  .slick-slide > .item').length < 2) ? true : false,

                        }
                      },
                      {
                        breakpoint:600,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                          arrows: (jQuery('.solution-row .slick-slide > .item').length < 1) ? true : false,
                          autoplay: (jQuery('.solution-row  .slick-slide > .item').length < 1) ? true : false,
                        }
                      }
                  ]
              }); 

      if(jQuery(window).width() < 1199)
                  {
                      jQuery('.industry-post-items').not('.slick-initialized').slick({ 
                     infinite: true,
                     slidesToShow:5,
                     slidesToScroll:1,
                     arrows: (jQuery('.industry-post-items .slick-slide > .item').length < 4) ? true : false,
                     autoplay: (jQuery('.industry-post-items .slick-slide > .item').length < 4) ? true : false,
                     autoplaySpeed: 5000,
                     dots: false, 
                     centerMode: true,
                     centerPadding: '0px',
                     pauseOnHover:false,
                     responsive: [
                        {
                          breakpoint: 1200,
                          settings: {
                            slidesToShow: 5,
                            slidesToScroll:1,
                            arrows: (jQuery('.industry-post-items .slick-slide > .item').length < 5) ? true : false,
                            autoplay: (jQuery('.industry-post-items  .slick-slide > .item').length < 5) ? true : false,

                          }
                        },
                         
                        {
                          breakpoint: 992,
                          settings: {
                            slidesToShow: 3,
                            slidesToScroll:1,
                            arrows: (jQuery('.industry-post-items .slick-slide > .item').length < 3) ? true : false,
                            autoplay: (jQuery('.industry-post-items  .slick-slide > .item').length < 3) ? true : false,

                          }
                        },
                        {

                          breakpoint:600,
                          settings: {
                            slidesToShow: 1,
                            slidesToScroll:1,
                            arrows: (jQuery('.industry-post-items .slick-slide > .item').length < 1) ? true : false,
                            autoplay: (jQuery('.industry-post-items  .slick-slide > .item').length < 1) ? true : false,
                          }
                        }
                    ]
                });

                 jQuery(" .industry-post-items .item ").removeClass("active");
                     
                  }   
     jQuery('.team-member-carsoul').not('.slick-initialized').slick({ 
         infinite: true,
         slidesToShow: 2,
         slidesToScroll:2,
         arrows: (jQuery('.team-member-carsoul .item').length > 2) ? true : false,
         autoplay: (jQuery('.team-member-carsoul .item').length > 2) ? true : false,
         autoplaySpeed: 5000,
         dots: false, 
         pauseOnHover:false,
         responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2,
                slidesToScroll:2,
              }
            }
        ]
    });


    if(jQuery('body').find('.hero-section').length > 0){
        jQuery('body').addClass('has-hero-section');
    }


    if (jQuery('#youtube-wrap').length > 0) {
      jQuery('.play-icon').click(function () {
            jQuery(this).parent().addClass('active');
            jQuery(this).parent().find('video').each(function () {
                this.play();
            });
            if (jQuery('.youtube-video').length >= 1) {
                jQuery(this).parent('.iframe-video').find('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
            }
           if (jQuery('iframe[src*="vimeo.com"]').length >= 1) {
                var iframe =  jQuery(this).parent().find('iframe[src*="vimeo.com"]')[0];
                var player = new Vimeo.Player(iframe);
                player.play();
          }
     
      });
    }


    
    

   /*function call*/
    wHeight_header('.hero-banner .item');
    containerPl();
    equal_height();
   
   jQuery('#masthead').next().after(' <div class="section-scroll"></div>');




//Scroll function ------------------
jQuery(window).bind("scroll", function() {
 var st = jQuery(window).scrollTop();
  var offset_section = jQuery('.section-scroll').offset();
  if(st > offset_section.top){
       
      jQuery('.site-header').addClass('sticky-header');
  }else{
      jQuery('.site-header').removeClass('sticky-header');
       
  }
});


 
});




	 
//  Function ------------------
jQuery(window).load(function() {
	 svgjs();
	  jQuery('.player').each(function() { 
      //ELEMENT SELECTORS
      var player = jQuery(this).get(0);
      var video = player.querySelector('.video');
      var playBtn = player.querySelector('.play-btn');
      //PLAYER FUNCTIONS
      function togglePlay() {
          if (video.paused) {
              video.play();
              player.parentNode.parentNode.classList.add('active');
              player.parentNode.parentNode.classList.remove('paused-video');
          } else {
              player.parentNode.parentNode.classList.add('paused-video');
              video.pause();  

          }
          playBtn.classList.toggle('paused');
      }

      playBtn.addEventListener('click', togglePlay);
    })

});

jQuery(window).bind("load resize", function() {
 var hh = jQuery('.site-header').outerHeight();
 jQuery('div#page').css({'padding-top': hh});

 containerPl();
 wHeight_header('.hero-banner .item');
 equal_height();
}).resize();

        
function equal_height() {
 
  setTimeout(function () {
         equalheight('.blog-post .summary .title');
         equalheight('.blog-post .summary');
         
         equalheight('.logo-category-slider .slick-track .clients-logo-item .client-logo');
    }, 200);



}

/*===== Equal Height row =======*/  
equalheight = function (container) {
 
        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = new Array(),
            jQueryel,
            topPosition = 0;
        jQuery(container).each(function () {
            jQueryel = jQuery(this);
            jQuery(jQueryel).innerHeight('auto')
            topPostion = jQueryel.offset().top;
            if (currentRowStart != topPostion) {
                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                    rowDivs[currentDiv].innerHeight(currentTallest);
                }
                rowDivs.length = 0; // empty the array
                currentRowStart = topPostion;
                currentTallest = jQueryel.innerHeight();
                rowDivs.push(jQueryel);
            } else {
                rowDivs.push(jQueryel);
                currentTallest = (currentTallest < jQueryel.innerHeight()) ? (jQueryel.innerHeight()) : (currentTallest);
            }
            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].innerHeight(currentTallest);
            }
        });
    
}


function containerPl(){
    var ww = jQuery(window).width();
    var ccontainerW = jQuery('.container').width(),
    PL = (ww - ccontainerW) / 2;
    jQuery('.container-align-left').css({
      'padding-left': PL
    });
}
function wHeight(ele){
    jQuery(ele).css({'height': wh});
}
function wHeight_header(ele){
    let wh = jQuery(window).outerHeight(),
    hh = jQuery('.site-header').outerHeight(),
    uspsh = jQuery('.usps-section').outerHeight(),
    height = wh - hh;
    
    if(jQuery('body').find('.usps-section').length > 0 && jQuery(window).width() >= 768){
        jQuery(ele).css({'height': height - uspsh});
    }else{
        jQuery(ele).css({'height': height});
    }
}




function svgjs(){
    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, else we gonna set it if we can.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });
}



   




/******   jQuery-AJAX Load More Button  *******/
var pageNumber = 1;
function postListFilter(obj){
    var loadMoreButton = jQuery('.load-more');
    var loadMoreText = jQuery(obj).text();
    if(loadMoreText !=''){
        pageNumber++;
    }else{
        pageNumber = 1;
    }

    var post_admin_URL = post_list_admin_URL_NAME.admin_URL;

    var str = '&pageNumber=' + pageNumber + '&action=get_more_posts';
      jQuery.ajax({
        type: "POST",
        dataType: "html",
        url: post_admin_URL,
        data: str,
        beforeSend: function() {
          jQuery('#loader').addClass('loader');
        },
        success: function(data){
          jQuery('#loader').removeClass('loader');
          var obj = JSON.parse(data);
         
          if(loadMoreText !=''){  
            jQuery(".append-post").append(obj.content);

            if (obj.page == obj.max_pages){
              loadMoreButton.hide(); //if last page, HIDE the button
            } 
          }
          else{
             jQuery(".append-post").html(obj.content);
              if (obj.page == obj.max_pages){
                loadMoreButton.hide(); //if last page, HIDE the button
              } 
              else{
                loadMoreButton.show();
              } 
          }
        },
      });
      return false;　
}

jQuery(document).ready(function() {
  counter = 0;
  $this = [];
  jQuery(".ajaxContent").each(function() {
        $this[counter] = jQuery(this);
         jQuery.ajax({
            url: myAjax.ajaxurl,
            type : 'post',
            dataType: "json",
            data : {action : 'get_home_content',ajaxIndex:jQuery(this).attr('ajaxIndex'),sectionTemplate:jQuery(this).attr('sectionTemplate'),section:jQuery(this).attr('sectionName'),counter:counter,post_id:myAjax.post_id},
            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                jQuery('.loader').removeClass('hidden');
            },
            success: function(response){                   
              $this[response.counter].html(response.result);  
              containerPl();
              equal_height();
              jQuery('.industry-post-items').each(function(){
                  jQuery(this).find('.item').each(function(){
                      jQuery(this).on('mouseenter',function(){
                          jQuery('.industry-post-items .item').removeClass('active');
                          if(!jQuery(this).hasClass('active')){
                              jQuery(this).addClass('active');
                          }
                      })

                  })
              }); 
              jQuery("a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area

      jQuery('html, body').animate({
        scrollTop: jQuery(hash).offset().top
      }, 2000, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

              svgjs();
              // video ifram js

              jQuery('.player').each(function() { 
              //ELEMENT SELECTORS
              var player = jQuery(this).get(0);
              var video = player.querySelector('.video');
              var playBtn = player.querySelector('.play-btn');
              //PLAYER FUNCTIONS
              function togglePlay() {
                  if (video.paused) {
                      video.play();
                      player.parentNode.parentNode.classList.add('active');
                      player.parentNode.parentNode.classList.remove('paused-video');
                  } else {
                      player.parentNode.parentNode.classList.add('paused-video');
                      video.pause();  

                  }
                  playBtn.classList.toggle('paused');
              }

              playBtn.addEventListener('click', togglePlay);
            })

              if (jQuery('#youtube-wrap').length > 0) {
              jQuery('.play-icon').click(function () {
              jQuery(this).parent().addClass('active');
              jQuery(this).parent().find('video').each(function () {
                  this.play();
              });
                    if (jQuery('.youtube-video').length >= 1) {
                        jQuery(this).parent('.iframe-video').find('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
                    }
                   if (jQuery('iframe[src*="vimeo.com"]').length >= 1) {
                        var iframe =  jQuery(this).parent().find('iframe[src*="vimeo.com"]')[0];
                        var player = new Vimeo.Player(iframe);
                        player.play();
                  }
             
              });
            }
            jQuery('.team-member-carsoul').not('.slick-initialized').slick({ 
         infinite: true,
         slidesToShow: 2,
         slidesToScroll:2,
         arrows: (jQuery('.team-member-carsoul .item').length > 2) ? true : false,
         autoplay: (jQuery('.team-member-carsoul .item').length > 2) ? true : false,
         autoplaySpeed: 5000,
         dots: false, 
         responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2,
                slidesToScroll:2,
              }
            }
        ]
    });

              jQuery(".tab_content").hide();
              jQuery(".tab_content:first").show();

              /* if in drawer mode content page according tabing js */
              jQuery(".tab_drawer_heading").click(function() {
                
                jQuery(".tab_content").hide();
                var d_activeTab = jQuery(this).attr("rel"); 
                jQuery("#"+d_activeTab).fadeIn();
                
                jQuery(".tab_drawer_heading").removeClass("d_active");
                jQuery(this).addClass("d_active");
                
                jQuery("ul.tabs li").removeClass("active");
                jQuery("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
              });
               jQuery('.case-post-box-carsoul').not('.slick-initialized').slick({ 
                   infinite: true,
                   slidesToShow: 1,
                   slidesToScroll:1,
                   arrows: true,
                   autoplay:true,
                   autoplaySpeed: 2000,
                   pauseOnHover:false,
                   dots: false, 
                   responsive: [
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                           }
                        },
                      {
                        breakpoint: 540,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                           
                        }
                      
                      } 
                  ]
              }); 
              jQuery('.post-box-carsoul').not('.slick-initialized').slick({ 
                   infinite: true,
                   slidesToShow: 2,
                   slidesToScroll:1,
                   arrows: (jQuery('.post-box-carsoul .item').length > 2) ? true : false,
                   autoplay: (jQuery('.post-box-carsoul .item').length > 2) ? true : false,
                   autoplaySpeed: 5000,
                   dots: false, 
                   responsive: [
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                        }
                      },
                        {
                        breakpoint: 540,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                        }
                      }
                  ]
              }); 

             

              jQuery('.logo-category-slider').not('.slick-initialized').slick({ 
                   infinite: true,
                   slidesToShow:4,
                   slidesToScroll:1,
                   arrows: false,
                   autoplay: (jQuery('.logo-category-slider .slick-slide > .item').length < 4) ? true : false,
                   autoplaySpeed: 5000,
                   dots: false, 
                   responsive: [
                   {
                        breakpoint: 1200,
                        settings: {
                          slidesToShow: 4,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-category-slider  .slick-slide > .item').length < 4) ? true : false,
                        }
                      },
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: 3,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-category-slider  .slick-slide > .item').length < 3) ? true : false,

                        }
                      },
                      {
                        breakpoint: 768,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-category-slider  .slick-slide > .item').length < 2) ? true : false,
                        }
                      },
                      {
                        breakpoint:570,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-category-slider  .slick-slide > .item').length < 1) ? true : false,
                        }
                      }
                  ]
              }); 

               jQuery('.logo-carsoul').not('.slick-initialized').slick({ 
                   infinite: false,
                   slidesToShow:5,
                   slidesToScroll:1,
                   arrows: false,
                   autoplay: (jQuery('.logo-carsoul .slick-slide > .item').length < 5) ? true : false,
                   autoplaySpeed:2000,
                   dots: false, 
                   responsive: [
                   {
                        breakpoint: 1200,
                        settings: {
                          slidesToShow: 4,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-carsoul  .slick-slide > .item').length < 4) ? true : false,
                        }
                      },
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: 3,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-carsoul  .slick-slide > .item').length < 3) ? true : false,

                        }
                      },
                      {
                        breakpoint: 768,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-carsoul  .slick-slide > .item').length < 2) ? true : false,
                        }
                      },
                      {
                        breakpoint:570,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                          autoplay: (jQuery('.logo-carsoul  .slick-slide > .item').length < 1) ? true : false,
                        }
                      }
                  ]
              }); 


               jQuery('.solution-row').not('.slick-initialized').slick({ 
                   infinite: true,
                   slidesToShow:4,
                   slidesToScroll:1,
                   arrows: (jQuery('.solution-row .slick-slide > .item').length < 5) ? true : false,
                   autoplay: (jQuery('.solution-row .slick-slide > .item').length < 5) ? true : false,
                   autoplaySpeed: 5000,
                   dots: false, 
                   responsive: [
                      {
                        breakpoint: 1200,
                        settings: {
                          slidesToShow: 3,
                          slidesToScroll:1,
                          arrows: (jQuery('.solution-row .slick-slide > .item').length < 3) ? true : false,
                          autoplay: (jQuery('.solution-row  .slick-slide > .item').length < 3) ? true : false,

                        }
                      },
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                          arrows: (jQuery('.solution-row .slick-slide > .item').length < 2) ? true : false,
                          autoplay: (jQuery('.solution-row  .slick-slide > .item').length < 2) ? true : false,

                        }
                      },
                      {
                        breakpoint:600,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                          arrows: (jQuery('.solution-row .slick-slide > .item').length < 1) ? true : false,
                          autoplay: (jQuery('.solution-row  .slick-slide > .item').length < 1) ? true : false,
                        }
                      }
                  ]
              }); 

               jQuery('.usps-slider').not('.slick-initialized').slick({ 
                   infinite: true,
                   slidesToShow:4,
                   slidesToScroll:1,
                   arrows: false,
                   autoplay: (jQuery('.usps-slider .item').length < 4) ? true : false,
                   autoplaySpeed: 5000,
                   dots: false, 
                   responsive: [
                    
                      {
                        breakpoint: 1199,
                        settings: {
                          slidesToShow: 3,
                          slidesToScroll:1,
                          dots:false, 
                          autoplay: (jQuery('.usps-slider .item').length < 3) ? true : false,

                        }
                      },
                      {
                        breakpoint: 768,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll:1,
                          dots:false, 
                          autoplay: (jQuery('.usps-slider .item').length < 2) ? true : false,
                        }
                      },
                      {
                        breakpoint:640,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll:1,
                          dots:false, 
                          autoplay: (jQuery('.usps-slider .item').length < 1) ? true : false,
                        }
                      }
                  ]
              }); 
              jQuery(".testimonials-carsoul").not('.slick-initialized').slick({
                   infinite: true,
                   slidesToShow: 1,
                   slidesToScroll: 1,
                   arrows: (jQuery('.testimonials-carsoul .item').length > 1) ? true : false,
                   autoplay: (jQuery('.testimonials-carsoul .item').length > 1) ? true : false,
                   autoplaySpeed: 5000,
                   dots: false,

                   responsive: [
                      
                      {
                        breakpoint: 768,
                        settings: {
                          adaptiveHeight: true,    
                           autoplay:false
                          }
                      } 
                       
                  ]
                   
                  
              });
                if(jQuery(window).width() < 1199)
                  {
                      jQuery('.industry-post-items').not('.slick-initialized').slick({ 
                     infinite: true,
                     slidesToShow:5,
                     slidesToScroll:1,
                     arrows: (jQuery('.industry-post-items .slick-slide > .item').length < 4) ? true : false,
                     autoplay: (jQuery('.industry-post-items .slick-slide > .item').length < 4) ? true : false,
                     autoplaySpeed: 5000,
                     dots: false, 
                     centerMode: true,
                     centerPadding: '0px',
                     responsive: [
                        {
                          breakpoint: 1200,
                          settings: {
                            slidesToShow: 5,
                            slidesToScroll:1,
                            arrows: (jQuery('.industry-post-items .slick-slide > .item').length < 5) ? true : false,
                            autoplay: (jQuery('.industry-post-items  .slick-slide > .item').length < 5) ? true : false,

                          }
                        },
                         
                        {
                          breakpoint: 992,
                          settings: {
                            slidesToShow: 3,
                            slidesToScroll:1,
                            arrows: (jQuery('.industry-post-items .slick-slide > .item').length < 3) ? true : false,
                            autoplay: (jQuery('.industry-post-items  .slick-slide > .item').length < 3) ? true : false,

                          }
                        },
                        {

                          breakpoint:600,
                          settings: {
                            slidesToShow: 1,
                            slidesToScroll:1,
                            arrows: (jQuery('.industry-post-items .slick-slide > .item').length < 1) ? true : false,
                            autoplay: (jQuery('.industry-post-items  .slick-slide > .item').length < 1) ? true : false,
                          }
                        }
                    ]
                });

                 jQuery(" .industry-post-items .item ").removeClass("active");
                     
                  }  

                

               
            },
            complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                jQuery('.loader').addClass('loader')
            }
        });
         counter++;
  });
  /* Download PDF Ajax*/
  jQuery('#pdfsubmit').click(function(e){
    e.preventDefault();    
    var str = '&action=download_pdf_form';
    str += '&name='+jQuery("#name").val();
    str += '&email='+jQuery("#email").val();
    str += '&sk_nonce='+jQuery("#sk_nonce").val();
    str += '&postid='+jQuery("#postid").val();
  jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
          jQuery('#loader').addClass('loader');
        },
        success: function (data) {
          jQuery('#loader').removeClass('loader');
          var responseData = JSON.parse(JSON.stringify(data));
          if (responseData.code == 200){
          if(responseData.url != ''){
            jQuery("#exampleModal").modal('hide');
            window.open(responseData.url, '_blank');
            window.location=document.location.href;
          }
          }else{
             jQuery(".display-error").html("<ul>"+responseData.msg+"</ul>");
             jQuery(".display-error").css("display","block");
          }
        },error: function () {
            alert('ajax error');
        }
    });
  });
jQuery('#custompdfsubmit').click(function(e){
    e.preventDefault();    
    var str = '&action=custom_page_download_pdf_form';
    str += '&name='+jQuery("#name").val();
    str += '&email='+jQuery("#email").val();
    str += '&sk_nonce='+jQuery("#sk_nonce").val();
    str += '&postid='+jQuery("#postid").val();
  jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
          jQuery('#loader').addClass('loader');
        },
        success: function (data) {
          jQuery('#loader').removeClass('loader');
          var responseData = JSON.parse(JSON.stringify(data));
          if (responseData.code == 200){
          if(responseData.url != ''){
            jQuery("#exampleModal").modal('hide');
            window.open(responseData.url, '_blank');
            window.location=document.location.href;
          }
          }else{
             jQuery(".display-error").html("<ul>"+responseData.msg+"</ul>");
             jQuery(".display-error").css("display","block");
          }
        },error: function () {
            alert('ajax error');
        }
    });
  });
  /* Service post load more action*/
  jQuery(".serviceloadmore").on('click',function() {
        $html = 'append';
        service_more_posts($html);
    });
    jQuery('.solutions_term').on('change',function(){
        $html = 'html';
        jQuery('#offset').val(0);
        service_more_posts($html);
    });
    jQuery('.industry_term').on('change',function(){
        $html = 'html';
        jQuery('#offset').val(0);
        service_more_posts($html);
    });
    /* Awards post load more action*/
    jQuery(".awardsloadmore").on('click',function() {
        $html = 'append';
        $aplha = '';
        award_more_posts($html,$aplha);
    });
    jQuery(".alphaaward").on('click',function(e) {
        $html = 'html';
        jQuery(this).siblings().removeClass('active');
        jQuery(this).addClass('active');
        $aplha = jQuery(this).attr("data-src");
        jQuery('#offset').val(0);
        award_more_posts($html,$aplha);
    });

    /* News post load more action*/
    jQuery(".newsloadmore").on('click',function() {
        $html = 'append';
        news_more_posts($html);
    });
    jQuery('.news_term').on('change',function(){
        $html = 'html';
        jQuery('#offset').val(0);
        news_more_posts($html);
    });

    /* Event post load more action*/
    jQuery(".eventloadmore").on('click',function() {
        $html = 'append';
        event_more_posts($html);
    });
    jQuery('.event_term').on('change',function(){
        $html = 'html';
        jQuery('#offset').val(0);
        event_more_posts($html);
    });
    jQuery('.event_date').on('change',function(){
        $html = 'html';
        jQuery('#offset').val(0);
        event_more_posts($html);
    });
    /* Sector page load more*/
    jQuery(".sectorloadmore").on('click',function() {
        service_sector_posts();
    });
    /* Solutions page load more*/
    jQuery(".solutionsloadmore").on('click',function() {
        solutions_posts();
    });
    /* Case study post load more action*/
    jQuery(".casestudyloadmore").on('click',function() {
        $html = 'append';
        casestudy_more_posts($html);
    });
    jQuery('.casestudy_term').on('change',function(){
        $html = 'html';
        jQuery('#offset').val(0);
        casestudy_more_posts($html);
    });
     /* logo post load more action*/
    jQuery(".logoloadmore").on('click',function() {
        logo_more_posts();
    });
});

/*Service post load more ajax*/
 function service_more_posts($html){
    var str = 'action=get_service_more_posts';
    var offset = jQuery('#offset').val();
    if(offset != '' && offset != 0) {
        str += '&offset='+offset;
    }

    var solutions_term =  jQuery( ".solutions_term option:selected" ).val();

    if(jQuery( ".solutions_term_array" ).length > 0){
      var solutions_term =  jQuery( ".solutions_term_array" ).val();
    }
    
    var industry_term =  jQuery( ".industry_term option:selected" ).val();
    if(jQuery( ".industry_term_array" ).length > 0){
      var industry_term =  jQuery( ".industry_term_array" ).val();
    }
    if(solutions_term != '') {
        str += '&solutions_term='+solutions_term;
      }
      if(industry_term != '') {
        str += '&industry_term='+industry_term;
      }
   jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
          if($html == 'html'){
            jQuery('#html_loader').addClass('html_loader');
            jQuery('.serviceloadmore').hide();
          }else{
            jQuery('#loader').addClass('loader');
          }
        },
        success: function (data) {
          jQuery('#html_loader').removeClass('html_loader');
          jQuery('#loader').removeClass('loader');
            jQuery('.serviceloadmore').show();
            var responseData = JSON.parse(JSON.stringify(data));
            if(responseData.result == ''){
              jQuery('#appenddata').html('<h4 class="not-found-title"> No posts found.</h4>');
            }else{            
              if($html == 'html'){
                jQuery('#appenddata').html(responseData.result);
              }else{
                
                jQuery('#appenddata').append(responseData.result);
              } 
            }
            jQuery('#offset').val(responseData.offset);           
            var total_post = jQuery('#Show_articals').find('.item').length;
            if(responseData.total_post <= total_post) 
            {
                jQuery('.loadmore').hide();
            }else{
                jQuery('.loadmore').show();
            }


        },error: function () {
            alert('ajax error');
        }
    });
}

/*Award post load more ajax*/
 function award_more_posts($html,$aplha){
    
    var str = 'action=get_award_more_posts';
    var offset = jQuery('#offset').val();
    if(offset != '' && offset != 0) {
        str += '&offset='+offset;
    } 
    if($aplha != '') {
        str += '&aplha='+$aplha;
    } 
   jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
          jQuery('#loader').addClass('loader');
        },
        success: function (data) {
          jQuery('#loader').removeClass('loader');
            jQuery('.serviceloadmore').show();
            var responseData = JSON.parse(JSON.stringify(data));
            if(responseData.result == ''){
              jQuery('#appenddata').html('<h4 class="not-found-title"> No posts found.</h4>');
            }else{            
              if($html == 'html'){
                jQuery('#appenddata').html(responseData.result);
              }else{
                
                jQuery('#appenddata').append(responseData.result);
              } 
            }
            jQuery('#offset').val(responseData.offset);           
            var total_post = jQuery('#Show_articals').find('.item').length;
            if(responseData.total_post <= responseData.offset) 
            {
                jQuery('.loadmore').hide();
            }else{
                jQuery('.loadmore').show();
            }
            svgjs();

        },error: function () {
            alert('ajax error');
        }
    });
}
/*logo post load more ajax*/
 function logo_more_posts(){
    
    var str = 'action=get_logo_more_posts';
    var offset = jQuery('#offset').val();
    if(offset != '' && offset != 0) {
        str += '&offset='+offset;
    } 
    var logo_term =  jQuery( "#logo_term" ).val();
    if(logo_term != '') {
        str += '&logo_term='+logo_term;
      }
   jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
          jQuery('#loader').addClass('loader');
        },
        success: function (data) {
          jQuery('#loader').removeClass('loader');
            jQuery('.logoloadmore').show();
            var responseData = JSON.parse(JSON.stringify(data));
            if(responseData.result == ''){
              jQuery('#appenddata').html('<h4 class="not-found-title"> No posts found.</h4>');
            }else{            
              jQuery('#appenddata').append(responseData.result);
            }
            jQuery('#offset').val(responseData.offset);           
            var total_post = jQuery('#Show_articals').find('.item').length;
            if(responseData.total_post <= responseData.offset) 
            {
                jQuery('.loadmore').hide();
            }else{
                jQuery('.loadmore').show();
            }

            svgjs();
        },error: function () {
            alert('ajax error');
        }
    });
}
/*News post load more ajax*/
 function news_more_posts($html){
    
    var str = 'action=get_news_more_posts';
    var offset = jQuery('#offset').val();
    if(offset != '' && offset != 0) {
        str += '&offset='+offset;
    }
    
    var news_term =  jQuery( ".news_term option:selected" ).val();
    if(news_term != '') {
        str += '&news_term='+news_term;
      }
      str +='&cat_ids='+ jQuery(".allCats").val();   
       
   jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
          if($html == 'html'){
            jQuery('#html_loader').addClass('html_loader');
            jQuery('.newsloadmore').hide();
          }else{
            jQuery('#loader').addClass('loader');
          }
        },
        success: function (data) {
          jQuery('#html_loader').removeClass('html_loader');
          jQuery('#loader').removeClass('loader');
            jQuery('.newsloadmore').show();
            var responseData = JSON.parse(JSON.stringify(data));
              if($html == 'html'){
                if(responseData.result){
                  jQuery('#appenddata').html(responseData.result);
                }else{
                  jQuery('#appenddata').html('<h4 class="not-found-title"> No posts found.</h4>');
                }
              }else{
                
                jQuery('#appenddata').append(responseData.result);
              } 
            
            jQuery('#offset').val(responseData.offset);           
            var total_post = jQuery('#Show_articals').find('.item').length;
            if(responseData.total_post <= total_post) 
            {
                jQuery('.loadmore').hide();
            }else{
                jQuery('.loadmore').show();
            }


        },error: function () {
            alert('ajax error');
        }
    });
}
/*Events post load more ajax*/
 function event_more_posts($html){
    
    var str = 'action=get_event_more_posts';
    var offset = jQuery('#offset').val();
    if(offset != '' && offset != 0) {
        str += '&offset='+offset;
    }
    str+='&type='+$html;
    var event_term =  jQuery( ".event_term option:selected" ).val();
    if(event_term != '') {
        str += '&event_term='+event_term;
      }
    var event_date =  jQuery( ".event_date option:selected" ).val();   
     if(event_date != '') {
        str += '&event_date='+event_date;
      }  
   jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
          if($html == 'html'){
            jQuery('#html_loader').addClass('html_loader');
            jQuery('.newsloadmore').hide();
          }else{
            jQuery('#loader').addClass('loader');
          }
        },
        success: function (data) {
          jQuery('#html_loader').removeClass('html_loader');
          jQuery('#loader').removeClass('loader');
            jQuery('.newsloadmore').show();
            var responseData = JSON.parse(JSON.stringify(data));
            if(responseData.result == ''){
              jQuery('#appenddata').html('<h4 class="not-found-title"> No posts found.</h4>');
            }else{            
              if($html == 'html'){
                if(responseData.result){
                  jQuery('#appenddata').html(responseData.result);
                }else{
                  jQuery('#appenddata').html('No Events found');
                }
                
              }else{
                
                jQuery('#appenddata').append(responseData.result);
              } 
            }
            jQuery('#offset').val(responseData.offset);           
            var total_post = jQuery('#Show_articals').find('.item').length;
            if(responseData.total_post <= total_post) 
            {
                jQuery('.loadmore').hide();
            }else{
                jQuery('.loadmore').show();
            }

            equal_height();


        },error: function () {
            alert('ajax error');
        }
    });
}
/*Sector post load more ajax*/
 function service_sector_posts(){
    var str = 'action=get_sector_more_posts';
    var offset = jQuery('#offset').val();
    if(offset != '' && offset != 0) {
        str += '&offset='+offset;
    }
    jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
            jQuery('#loader').addClass('loader');
        },
        success: function (data) {
            jQuery('#loader').removeClass('loader');
            jQuery('.sectorloadmore').show();
            var responseData = JSON.parse(JSON.stringify(data));
            if(responseData.result == ''){
              jQuery('#appenddata').html('<h4 class="not-found-title"> No posts found.</h4>');
            }else{
                jQuery('#appenddata').append(responseData.result);
              
            }
            jQuery('#offset').val(responseData.offset);           
            var total_post = jQuery('#appenddata').find('.item').length;
            if(responseData.total_post <= total_post){
                jQuery('.loadmore').hide();
            }else{
                jQuery('.loadmore').show();
            }
            equal_height();
        },error: function () {
            alert('ajax error');
        }
    });
}
/*Solutions post load more ajax*/
 function solutions_posts(){
    var str = 'action=get_solutions_more_posts';
    var offset = jQuery('#offset').val();
    if(offset != '' && offset != 0) {
        str += '&offset='+offset;
    }
    jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
            jQuery('#loader').addClass('loader');
        },
        success: function (data) {
            jQuery('#loader').removeClass('loader');
            jQuery('.solutionsloadmore').show();
            var responseData = JSON.parse(JSON.stringify(data));
            if(responseData.result == ''){
              jQuery('#appenddata').html('<h4 class="not-found-title"> No posts found.</h4>');
            }else{
                jQuery('#appenddata').append(responseData.result);
              
            }
            jQuery('#offset').val(responseData.offset);           
            var total_post = jQuery('#appenddata').find('.item').length;
            if(responseData.total_post <= total_post){
                jQuery('.loadmore').hide();
            }else{
                jQuery('.loadmore').show();
            }
            equal_height();
        },error: function () {
            alert('ajax error');
        }
    });
}

 /*resources post load more ajax*/
 function resources_post_show($html){
    
    var str = 'action=get_resource_more_posts';
    var offset = jQuery('#offset').val();
    if(offset != '' && offset != 0) {
        str += '&offset='+offset;
    }
    
    var resource_term =  jQuery( "#resource_term option:selected" ).val();
    if(resource_term != '') {
        str += '&resource_term='+resource_term;
      }
      
       
   jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
         if($html == 'html'){
            jQuery('#html_loader').addClass('html_loader');
            jQuery('.resourceloadmore').hide();
          }else{
            jQuery('#loader').addClass('loader');
          }
        },
        success: function (data) {
          jQuery('#html_loader').removeClass('html_loader');
          jQuery('#loader').removeClass('loader');
          jQuery('.resourceloadmore').show();
            var responseData = JSON.parse(JSON.stringify(data));
             if(responseData.result == ''){
              jQuery('#appenddata').html('<h4 class="not-found-title"> No posts found.</h4>');
            }else{            
              if($html == 'html'){
                jQuery('#appenddata').html(responseData.result);
              }else{
                jQuery('#appenddata').append(responseData.result);
              } 
            }
            jQuery('#offset').val(responseData.offset);           
            var total_post = jQuery('#show_resources_post').find('.item').length;
            if(responseData.total_post <= total_post) 
            {
                jQuery('.load-more').hide();
            }else{
                jQuery('.load-more').show();
            }
            svgjs();

        },error: function () {
            alert('ajax error');
        }
    });
}
/*Case Study post load more ajax*/
 
 function casestudy_more_posts($html){
    
    var str = 'action=get_casestudy_more_posts';
    var offset = jQuery('#offset').val();
    if(offset != '' && offset != 0) {
        str += '&offset='+offset;
    }
    
    str+='&type='+$html;
    var casestudy_term =  jQuery( ".casestudy_term option:selected" ).val();
    if(casestudy_term != '') {
        str += '&casestudy_term='+casestudy_term;
      }
   jQuery.ajax({
        url: post_list_admin_URL_NAME.admin_URL,
        type: "POST",
        dataType: "JSON",
        data: str,
        beforeSend: function() {
          if($html == 'html'){
            jQuery('#html_loader').addClass('html_loader');
            jQuery('.casestudyloadmore').hide();
          }else{
            jQuery('#loader').addClass('loader');
          }
        },
        success: function (data) {
          jQuery('#html_loader').removeClass('html_loader');
          jQuery('#loader').removeClass('loader');
            jQuery('.casestudyloadmore').show();
            var responseData = JSON.parse(JSON.stringify(data));
            if(responseData.result == ''){
              jQuery('#appenddata').html('<h4 class="not-found-title"> No posts found.</h4>');
            }else{            
              if($html == 'html'){
                  if(responseData.result){
                    jQuery('#appenddata').html(responseData.result);
                  }else{
                    jQuery('#appenddata').html('No Events found');
                  }
                }else{
                
                jQuery('#appenddata').append(responseData.result);
              } 
             }   
             jQuery('#offset').val(responseData.offset);
            var total_post = jQuery('#appenddata').find('.item').length;
            if(responseData.total_post <= total_post) {
                jQuery('.load-more').hide();
            }else{
                jQuery('.load-more').show();
            }
            equal_height();
        },error: function () {
            alert('ajax error');
        }
    });
}


;(function($) {

      // Browser supports HTML5 multiple file?
      var multipleSupport = typeof jQuery('<input/>')[0].multiple !== 'undefined',
          isIE = /msie/i.test( navigator.userAgent );

      $.fn.customFile = function() {

        return this.each(function() {

          var $file = jQuery(this).addClass('custom-file-upload-hidden'), // the original file input
              $wrap = jQuery('<div class="file-upload-wrapper">'),
              $input = jQuery('<input type="text" class="file-upload-input" />'),
              // Button that will be used in non-IE browsers
              $button = jQuery('<button type="button" class="file-upload-button">Upload file</button>'),
              // Hack for IE
              $label = jQuery('<label class="file-upload-button" for="'+ $file[0].id +'">Upload file</label>');

          // Hide by shifting to the left so we
          // can still trigger events
          $file.css({
            position: 'absolute',
            left: '-9999px'
          });

          $wrap.insertAfter( $file )
            .append( $file, $input, ( isIE ? $label : $button ) );

          // Prevent focus
          $file.attr('tabIndex', -1);
          $button.attr('tabIndex', -1);

          $button.click(function () {
            $file.focus().click(); // Open dialog
          });

          $file.change(function() {

            var files = [], fileArr, filename;

            // If multiple is supported then extract
            // all filenames from the file array
            if ( multipleSupport ) {
              fileArr = $file[0].files;
              for ( var i = 0, len = fileArr.length; i < len; i++ ) {
                files.push( fileArr[i].name );
              }
              filename = files.join(', ');

            // If not supported then just take the value
            // and remove the path to just show the filename
            } else {
              filename = $file.val().split('\\').pop();
            }

            $input.val( filename ) // Set the value
              .attr('title', filename) // Show filename in title tootlip
              .focus(); // Regain focus

          });

          $input.on({
            blur: function() { $file.trigger('blur'); },
            keydown: function( e ) {
              if ( e.which === 13 ) { // Enter
                if ( !isIE ) { $file.trigger('click'); }
              } else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
                // On some browsers the value is read-only
                // with this trick we remove the old input and add
                // a clean clone with all the original events attached
                $file.replaceWith( $file = $file.clone( true ) );
                $file.trigger('change');
                $input.val('');
              } else if ( e.which === 9 ){ // TAB
                return;
              } else { // All other keys
                return false;
              }
            }
          });

        });

      };

      // Old browser fallback
      if ( !multipleSupport ) {
        jQuery( document ).on('change', 'input.customfile', function() {

          var $this = $(this),
              // Create a unique ID so we
              // can attach the label to the input
              uniqId = 'customfile_'+ (new Date()).getTime(),
              $wrap = $this.parent(),

              // Filter empty input
              $inputs = $wrap.siblings().find('.file-upload-input')
                .filter(function(){ return !this.value }),

              $file = jQuery('<input type="file" id="'+ uniqId +'" name="'+ $this.attr('name') +'"/>');

          // 1ms timeout so it runs after all other events
          // that modify the value have triggered
          setTimeout(function() {
            // Add a new input
            if ( $this.val() ) {
              // Check for empty fields to prevent
              // creating new inputs when changing files
              if ( !$inputs.length ) {
                $wrap.after( $file );
                $file.customFile();
              }
            // Remove and reorganize inputs
            } else {
              $inputs.parent().remove();
              // Move the input so it's always last on the list
              $wrap.appendTo( $wrap.parent() );
              $wrap.find('input').focus();
            }
          }, 1);

        });
      }

}(jQuery));


