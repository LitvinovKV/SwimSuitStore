$(document).ready(function() {
    
    $(".toggle-mnu").click(function() {
      $(this).toggleClass("on");
      $(".hidden-mnu").slideToggle();
      return false;
    });

    $(".toggle-text1").click(function() {
      $(this).toggleClass("on");
      $(".button-text1").slideToggle();
      return false;
    });

    $(".toggle-text2").click(function() {
      $(this).toggleClass("on");
      $(".button-text2").slideToggle();
      return false;
    });

    $(".toggle-text3").click(function() {
      $(this).toggleClass("on");
      $(".button-text3").slideToggle();
      return false;
    });

    $(".toggle-text4").click(function() {
      $(this).toggleClass("on");
      $(".button-text4").slideToggle();
      return false;
    });

    $(".toggle-text5").click(function() {
      $(this).toggleClass("on");
      $(".button-text5").slideToggle();
      return false;
    });

    $(".toggle-text6").click(function() {
      $(this).toggleClass("on");
      $(".button-text6").slideToggle();
      return false;
    });

    $(".toggle-text7").click(function() {
      $(this).toggleClass("on");
      $(".button-text7").slideToggle();
      return false;
    });

    $(".toggle-text8").click(function() {
      $(this).toggleClass("on");
      $(".button-text8").slideToggle();
      return false;
    });

    $(".toggle-text9").click(function() {
      $(this).toggleClass("on");
      $(".button-text9").slideToggle();
      return false;
    });


    $(".carousel-shop").owlCarousel({
        loop: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        responsive:{
        0:{
            items:2,
            mergeFit:true,
        },
        522:{
            items:3,
            mergeFit:true,
        },
        768:{
            items:3,
            mergeFit:true,
        },
        992:{
            items:3,
            mergeFit:true,
        },
        1200:{
            items:4,
            mergeFit:true,
        },
        1400:{
            items:4,
            mergeFit:true,
        }
    }
    });

	$(".carousel-pr").owlCarousel({
		loop: true,
		nav: true,
		navText: ["<i class='fa fa-chevron-circle-left'></i>","<i class='fa fa-chevron-circle-right'></i>"],
		responsive:{
        0:{
            items:1,
            mergeFit:true,
        },
        520:{
            items:1,
            mergeFit:true,
        },
        768:{
            items:1,
            mergeFit:true,
        },
        992:{
            items:1,
            mergeFit:true,
        },
        1200:{
            items:1,
            mergeFit:true,
        },
        1400:{
            items:1,
            mergeFit:true,
        }
    }
	});


	$(".carousel-images").owlCarousel({
		loop: true,
		nav: true,
		navText: ["<i class='fa fa-chevron-circle-left'></i>","<i class='fa fa-chevron-circle-right'></i>"],
		responsive:{
        0:{
            items:1,
            mergeFit:true,
        },
        520:{
            items:1,
            mergeFit:true,
        },
        768:{
            items:1,
            mergeFit:true,
        },
        992:{
            items:1,
            mergeFit:true,
        },
        1200:{
            items:1,
            mergeFit:true,
        },
        1400:{
            items:1,
            mergeFit:true,
        }
    }
	});	

	//Replace all SVG images with inline SVG
	$('img.img-svg').each(function(){
		var $img = $(this);
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		$.get(imgURL, function(data) {
				// Get the SVG tag, ignore the rest
				var $svg = $(data).find('svg');

				// Add replaced image's classes to the new SVG
				if(typeof imgClass !== 'undefined') {
					$svg = $svg.attr('class', imgClass+' replaced-svg');
				}

				// Remove any invalid XML tags as per http://validator.w3.org
				$svg = $svg.removeAttr('xmlns:a');

				// Check if the viewport is set, if the viewport is not set the SVG wont't scale.
				if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
					$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
				}

				// Replace image with new SVG
				$img.replaceWith($svg);

			}, 'xml');

	});

});

function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablink;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablink" and remove the class "active"
    tablink = document.getElementsByClassName("tablink");
    for (i = 0; i < tablink.length; i++) {
        tablink[i].className = tablink[i].className.replace(" active", "");
    }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
};
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();


var slideIndex = 1;
showSlides(slideIndex);

function currentSlide(n) {
  showSlides(slideIndex = n);
};

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("big");
  var dots = document.getElementsByClassName("demo");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
};