jQuery(function($) {

	var slideHeight = $(window).height();
	$('#home-slider .item').css('height',slideHeight);

	$(window).resize(function(){'use strict',
		$('#home-slider .item').css('height',slideHeight);
	});


    setTimeout(function(){
			$('.main-nav').addClass('navbar-fixed-top');
   }, 1200);

	new WOW().init();

});

