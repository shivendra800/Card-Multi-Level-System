(function($) {
	"use strict";

/* ----------------------------
    Preloader
    ------------------------------ */

$(window).on('load', function(){        
	$('#preloader').delay(300).fadeOut('slow',function(){
	$(this).remove();
	});
});

/* ----------------------------
    jQuery sticky area
    ------------------------------ */
	
$('.header-lover').sticky({
	topSpacing: 0,
});

/* ----------------------------
    Top Scroll
    ------------------------------ */

var offset = 220;
var duration = 500;
jQuery(window).on('scroll', function() {
	if (jQuery(this).scrollTop() > offset) {
		jQuery('.scroll-top').fadeIn(duration);
	} 
	else {
		jQuery('.scroll-top').fadeOut(duration);
	}
});
jQuery('.scroll-top').on('click', function() {
	event.preventDefault();
	jQuery('html, body').animate({scrollTop: 0}, duration);
	return false;
})

/* ----------------------------
	@module       Copyright
	@description  Evaluates the copyright year
    ------------------------------ */
	
var currentYear = (new Date).getFullYear();
	$(document).ready(function () {
		$(".current-year").text((new Date).getFullYear());
});

/* ----------------------------
    venobox
    ------------------------------ */

$('.venobox').venobox();

/* ----------------------------
    Smooth scroll js
    ------------------------------ */

$('a.smooth-menu').on("click", function (e) {
	e.preventDefault();
	var anchor = $(this);
	$('html, body').stop().animate({
		scrollTop: $(anchor.attr('href')).offset().top - 90
	}, 1000);
});

/* ----------------------------
    Testimonials
    ------------------------------ */

$('.testimonial-carousel').owlCarousel({
	loop: true,
	margin: 15,
	dots:false,
	items: 2,
	nav: false,
	autoplay:true,
	responsiveClass: true,
	responsive: {
	  0: {
		items: 1
	  },
	  767: {
		items: 1
	  },
	  768: {
		items: 1
	  },
	  992: {
		items: 2
	  }
	}
})

/* ----------------------------
    Doctors
    ------------------------------ */

	$('.doctors-carousel').owlCarousel({
		loop: true,
		margin: 15,
		dots:false,
		items: 4,
		nav: false,
		autoplay:true,
		responsiveClass: true,
		responsive: {
		  0: {
			items: 1
		  },
		  767: {
			items: 2
		  },
		  768: {
			items: 3
		  },
		  992: {
			items: 4
		  }
		}
	})

	/* ----------------------------
    Hospital
    ------------------------------ */

	$('.hospital-carousel').owlCarousel({
		loop: true,
		margin: 15,
		dots:false,
		items: 4,
		nav: false,
		autoplay:true,
		responsiveClass: true,
		responsive: {
		  0: {
			items: 1
		  },
		  767: {
			items: 2
		  },
		  768: {
			items: 2
		  },
		  992: {
			items: 3
		  }
		}
	})

		/* ----------------------------
    Blogs
    ------------------------------ */

	$('.bolg-carousel').owlCarousel({
		loop: true,
		margin: 15,
		dots:false,
		items: 4,
		nav: false,
		autoplay:true,
		responsiveClass: true,
		responsive: {
		  0: {
			items: 1
		  },
		  767: {
			items: 2
		  },
		  768: {
			items: 2
		  },
		  992: {
			items: 3
		  }
		}
	})

	/* ----------------------------
    Card
    ------------------------------ */

	$('.card-carousel').owlCarousel({
		loop: true,
		margin: 15,
		dots:false,
		items: 4,
		nav: false,
		autoplay:true,
		responsiveClass: true,
		responsive: {
		  0: {
			items: 2
		  },
		  767: {
			items: 3
		  },
		  768: {
			items: 5
		  },
		  992: {
			items: 8
		  }
		}
	})

/* ----------------------------
    counter up
    ------------------------------ */

$('.counter').counterUp({
	delay: 10,
	time: 1000
});

/* ----------------------------
    Details page bammer carousel
    ------------------------------ */

$('.details-page-bammer-carousel').owlCarousel({
	loop: true,
	margin: 4,
	dots:false,
	items: 3,
	nav: false,
	autoplay:true,
	center:true,
	responsiveClass: true,
	responsive: {
	  0: {
		items: 1
	  },
	  767: {
		items: 2
	  },
	  768: {
		items: 2
	  },
	  1000: {
		items: 3
	  }
	}
})

})(jQuery);