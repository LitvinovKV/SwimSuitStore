$(document).ready(function() {
    $(".carousel-shop").owlCarousel({
        loop: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        responsive:{
        0:{
            items:2,
            mergeFit:true,
        },
        520:{
            items:2,
            mergeFit:true,
        },
        768:{
            items:2,
            mergeFit:true,
        },
        992:{
            items:4,
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