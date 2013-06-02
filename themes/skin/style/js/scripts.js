/*-----------------------------------------------------------------------------------*/
/*	TOGGLE
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	//Hide the tooglebox when page load
	jQuery(".togglebox").hide();
	//slide up and down when click over heading 2
	jQuery("h4").click(function() {
		// slide toggle effect set to slow you can set it to fast too.
		jQuery(this).toggleClass("active").next(".togglebox").slideToggle("slow");
		return true;
	});
}); 

/*-----------------------------------------------------------------------------------*/
/*	TABS
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	jQuery('#services-container').easytabs({
		animationSpeed: 300,
		updateHash: false
	});
}); 

/*-----------------------------------------------------------------------------------*/
/*	FORM
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	jQuery('#comment-form input[title]').each(function() {
		if(jQuery(this).val() === '') {
			jQuery(this).val(jQuery(this).attr('title'));	
		}
		
		jQuery(this).focus(function() {
			if(jQuery(this).val() == jQuery(this).attr('title')) {
				jQuery(this).val('').addClass('focused');	
			}
		});
		jQuery(this).blur(function() {
			if(jQuery(this).val() === '') {
				jQuery(this).val(jQuery(this).attr('title')).removeClass('focused');	
			}
		});
	});
});


/*-----------------------------------------------------------------------------------*/
/*	TESTIMONIALS
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	jQuery('#testimonials-container').easytabs({
		animationSpeed: 500,
		updateHash: false,
		cycle: 5000
	});
}); 

/*-----------------------------------------------------------------------------------*/
/*	PORTFOLIO GRID
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	var jQuerycontainer = jQuery('#portfolio .items');
	jQuerycontainer.imagesLoaded(function() {
		jQuerycontainer.isotope({
			itemSelector: '.item',
			layoutMode: 'fitRows'
		});
	});
	jQuery('.filter li a').click(function() {
		jQuery('.filter li a').removeClass('active');
		jQuery(this).addClass('active');
		var selector = jQuery(this).attr('data-filter');
		jQuerycontainer.isotope({
			filter: selector
		});
		return false;
	});
}); 

/*-----------------------------------------------------------------------------------*/
/*	VIDEOCASE
/*-----------------------------------------------------------------------------------*/
if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function(searchElement /*, fromIndex */ ) {
		"use strict";
		if (this == null) {
			throw new TypeError();
		}
		var t = Object(this);
		var len = t.length >>> 0;
		if (len === 0) {
			return -1;
		}
		var n = 0;
		if (arguments.length > 0) {
			n = Number(arguments[1]);
			if (n != n) { // shortcut for verifying if it's NaN
				n = 0;
			} else if (n != 0 && n != Infinity && n != -Infinity) {
				n = (n > 0 || -1) * Math.floor(Math.abs(n));
			}
		}
		if (n >= len) {
			return -1;
		}
		var k = n >= 0 ? n : Math.max(len - Math.abs(n), 0);
		for (; k < len; k++) {
			if (k in t && t[k] === searchElement) {
				return k;
			}
		}
		return -1;
	}
}
jQuery(document).ready(function() {
	var jQuerycontainer = jQuery('#videocase .items');
	jQuerycontainer.imagesLoaded(function() {
		jQuerycontainer.isotope({
			itemSelector: '.item',
			layoutMode: 'fitRows'
		});
	});
	jQuery('.filter li a').click(function() {
		jQuery('.filter li a').removeClass('active');
		jQuery(this).addClass('active');
		var selector = jQuery(this).attr('data-filter');
		jQuerycontainer.isotope({
			filter: selector
		});
		return false;
	});
	var _videocontainer = jQuery('#videocontainer');
	var _addressArr = [];
	jQuery('.items li').each(function(index) {
		jQuery(this).attr('rel', index);
		_addressArr[index] = jQuery(this).data('address');
	});
	var _descArr = [];
	jQuery('.description li').each(function(index) {
		_descArr[index] = jQuery(this);
		jQuery(this).hide();
		jQuery(this).on('click', function(event) {
			alert('click description');
		});
	});
	var _currentNum = 0;
	var isInit = false;
	_videocontainer.fitVids();
	var _videoArr = [];
	jQuery('.video').each(function(index) {
		_videoArr[index] = jQuery(this)
		if (index != 0) jQuery(this).hide();
	});
	jQuery.address.init(function(event) {}).change(function(event) {
		var _address = jQuery.address.value().replace('/', '');
		if (_address) {
			if (_address != "" && _currentNum != _addressArr.indexOf(_address)) loadAsset(_addressArr.indexOf(_address));
		} else {
			jQuery.address.path(_addressArr[0]);
		}
	})
	jQuery('.items li').on('click', function(event) {
		loadAsset(jQuery(this).attr('rel'));
		return false;
	});

	function loadAsset(n) {
		jQuery('html, body').animate({
			scrollTop: _videocontainer.offset().top - 30
		}, 600);
		_index = n;
		var _pv = _videoArr[_currentNum];
		if (_pv) _pv.animate({
			opacity: 0
		}, 300, function() {
			var _ph = _pv.height();
			_pv.hide();
			_pv.remove();
			var _h = _videoArr[_index].show().css('opacity', 0).height();
			_videoArr[_index].css('height', _ph);
			_videoArr[_index].animate({
				opacity: 1,
				height: _h
			}, 600, function() {
				_videoArr[_index].css('height', 'auto');
				_videocontainer.append(_pv);
				// _videocontainer.fitVids();			
			})
		})
		jQuery.address.path(_addressArr[_index])
		_currentNum = _index;
		return false;
	}
}); 

/*-----------------------------------------------------------------------------------*/
/*	FANCYBOX
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	jQuery('.fancybox-media').fancybox({
		arrows: false,
		padding: 10,
		closeBtn: false,
		openEffect: 'fade',
		closeEffect: 'fade',
		prevEffect: 'fade',
		nextEffect: 'fade',
		helpers: {
			media: {},
			buttons: {},
			thumbs: {
				width: 50,
				height: 50
			},
			title: {
				type: 'outside'
			},
			overlay: {
				opacity: 0.9
			}
		},
		beforeLoad: function() {
			var el, id = jQuery(this.element).data('title-id');
			if (id) {
				el = jQuery('#' + id);
				if (el.length) {
					this.title = el.html();
				}
			}
		}
	});
}); 

/*-----------------------------------------------------------------------------------*/
/*	IMAGE HOVER
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	jQuery('.items li a, .item a, .featured a').prepend('<span class="more"></span>');
});
jQuery(document).ready(function() {
	jQuery('.item, .items li, .featured').mouseenter(function(e) {
		jQuery(this).children('a').children('span').fadeIn(300);
	}).mouseleave(function(e) {
		jQuery(this).children('a').children('span').fadeOut(200);
	});
}); 

/*-----------------------------------------------------------------------------------*/
/*	BUTTON HOVER
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(jQuery) {
	jQuery(".social li a").css("opacity", "1.0");
	jQuery(".social li a").hover(function() {
		jQuery(this).stop().animate({
			opacity: 0.75
		}, "fast");
	}, function() {
		jQuery(this).stop().animate({
			opacity: 1.0
		}, "fast");
	});
}); 

/*-----------------------------------------------------------------------------------*/
/*	VIDEO
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	jQuery('.media, .featured').fitVids();
}); 

/*-----------------------------------------------------------------------------------*/
/*	SELECTNAV
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	selectnav('tiny', {
		label: '--- Navigation --- ',
		indent: '-'
	});
}); 

/*-----------------------------------------------------------------------------------*/
/*	MENU
/*-----------------------------------------------------------------------------------*/
ddsmoothmenu.init({
	mainmenuid: "menu",
	orientation: 'h',
	classname: 'menu',
	contentsource: "markup"
})

/*-----------------------------------------------------------------------------------*/
/*	HTML5 Media Resize
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(){
	jQuery(window).resize(function() {
			initMediaResize();
	});
	initMediaResize();
});	
	
function initMediaResize() {
	jQuery('.tb-resizemedia').each(function() {
		var media=jQuery(this);
		var iframe=media.find('iframe:first');
		var flv=media.find('.video-wrapper .video-container a');
		//alert(jQuery(this).width()+"  "+jQuery(this).data('width'));
		var prop= media.width() / media.data('width');
		if (iframe.length>0) iframe.height(media.data('height')*prop);
		if (flv.length>0) flv.height(media.data('height')*prop);
	});
}