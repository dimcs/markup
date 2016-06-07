var isTouchDevice = ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;

var html = document.documentElement;
html.className = html.className.replace('no-js', '');
if(isTouchDevice) {
	html.className = html.className.replace('no-touch', '');
}

jQuery(function() {
	MobNav({
		menu: '.navigation',
		slideElement: '.container',
		opener: '.mobile-nav-opener',
		activeClass: 'nav-open',
		overlayClass: 'page-overlay',
		swipe: 'swiperight'
	});

	 jQuery(document).ready(function(){
		jQuery(".navigation a").on("click", function (event) {
			event.preventDefault();
			var id  = jQuery(this).attr('href'),
				top = jQuery(id).offset().top;
			jQuery('body,html').animate({scrollTop: top}, 500);
		});
	});
});

