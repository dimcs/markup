// simple nav
function MobNav(o) {
	var settings = extend({
			menu: '.mob-nav',
			slideElement: '.mob-nav',
			activeClass: 'mob-nav-opened',
			opener: '.mob-nav-opener',
			swipe: 'swipeleft',
			overlayClass: 'overlay',
			closeOnOutsideClick: true
		}, o),
		menu = document.querySelector(settings.menu),
		slideElement = document.querySelector(settings.slideElement),
		openers = Array.prototype.slice.call(document.querySelectorAll(settings.opener)),
		body = document.body,
		isOpened = false,
		busy = false,
		overlayElement;

	function init() {
		// prepare overlay
		typeof settings.overlayClass === 'string' && (overlayElement = createOverlay(settings.overlayClass));

		// init events
		openers.forEach(function (opener) {
			opener.addEventListener('click', openerHandler, false);
		});

		var hammer = new Hammer(menu, {});
		hammer.on(settings.swipe, close);
	}

	if(MobNav.transitionEndEvent) {
		var open = function () {
			if(isOpened || busy) return;

			slideElement.addEventListener(MobNav.transitionEndEvent, function f() {
				slideElement.removeEventListener(MobNav.transitionEndEvent, f);
				settings.closeOnOutsideClick && document.addEventListener('click', docHandler, false);
				isOpened = true;
				busy = false;
			}, false);

			overlayElement && body.appendChild(overlayElement);
			overlayElement.addEventListener('click', openerHandler, false);
			addClass(body, settings.activeClass);
			busy = true;
		},
		close = function () {
			if(!isOpened || busy) return;

			slideElement.addEventListener(MobNav.transitionEndEvent, function f() {
				overlayElement && body.removeChild(overlayElement);
				slideElement.removeEventListener(MobNav.transitionEndEvent, f);
				settings.closeOnOutsideClick && document.removeEventListener('click', docHandler);
				isOpened = false;
				busy = false;
			}, false);

			removeClass(body, settings.activeClass);
			busy = true;
		};
	}
	else {
		var open = function () {
			if(isOpened) return;

			overlayElement && body.appendChild(overlayElement);
			overlayElement.addEventListener('click', openerHandler, false);
			addClass(body, settings.activeClass);
			setTimeout(function () {
				settings.closeOnOutsideClick && document.addEventListener('click', docHandler, false);
			}, 25);
			isOpened = true;
		},
		close = function () {
			if(!isOpened) return;

			overlayElement && body.removeChild(overlayElement);
			removeClass(body, settings.activeClass);
			settings.closeOnOutsideClick && document.removeEventListener('click', docHandler);
			isOpened = false;
		};
	}

	function toggle() {
		isOpened ? close() : open();
	}

	function destroy() {
		openers.forEach(function (opener) {
			opener.removeEventListener('click', openerHandler);
		});

		overlayElement && body.removeChild(overlayElement);
		settings.closeOnOutsideClick && document.removeEventListener('click', docHandler);
		removeClass(body, settings.activeClass);
	}

	function createOverlay(cls) {
		var el = document.createElement('div');
		el.className = cls;
		return el;
	}

	function docHandler(e) {
		!menu.contains(e.target) && close();
	}

	function openerHandler(e) {
		e.preventDefault();
		toggle();
	}

	// utils

	function addClass(el, cls) {
		var c = el.className ? el.className.split(' ') : [];
		for(var i = c.length - 1; i >= 0; i--) if(c[i] === cls) return;
		c.push(cls);
		el.className = c.join(' ');
	}

	function removeClass(el, cls) {
		var c = el.className.split(' ');
		for(var i = 0; i < c.length; i++) if(c[i] === cls) c.splice(i--, 1);
		el.className = c.join(' ');
	}

	function extend(obj1, obj2) {
		for(var key in obj2) {
			obj1[key] = obj2[key];
		}
		return obj1;
	}

	init();

	// public

	return {
		open: open,
		close: close,
		toggle: toggle,
		destroy: destroy
	}
}

MobNav.transitionEndEvent = (function () {
	var t;
	var el = document.createElement('div');
	var transitions = {
		'transition': 'transitionend',
		'WebkitTransition': 'webkitTransitionEnd'
	}

	for(t in transitions) {
		if(el.style[t] !== undefined) {
			return transitions[t];
		}
	}

	return false;
})();