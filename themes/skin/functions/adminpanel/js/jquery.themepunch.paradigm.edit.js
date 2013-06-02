/**
 * jQuery Paradigm Admin Panel Plugin
 * @version: 1.1 (09.12.2011)
 * @requires jQuery v1.2.2 or later 
 * @author Krisztian Horvath
 * All Rights Reserved, use only in themepunch Templates or when Plugin bought at Envato ! 
**/




(function($,undefined){	
	
	
	
	////////////////////////////
	// THE PLUGIN STARTS HERE //
	////////////////////////////
	
	$.fn.extend({
	
		
		// OUR PLUGIN HERE :)
		paradigmadminpanel: function(options) {
	
		
			
		////////////////////////////////
		// SET DEFAULT VALUES OF ITEM //
		////////////////////////////////
		var defaults = {	
			
		};
		
		options = $.extend({}, $.fn.paradigmadminpanel.defaults, options);
		

		return this.each(function() {
				
			var opt=options;
			var item=$(this);
			
			getDefaults(item,opt);
			createSlides(item,opt);
			setDrag();
			
		})
	}
})


		///////////////////////////////
		//	SAVE THE DEFAULT MARKUPS //
		///////////////////////////////
		function getDefaults(item,opt) {
		
			// Get the Default Caption
			item.data('defCaption',item.find("#default-admin-caption").html());
			item.find("#default-admin-caption").remove();
			
			// Get the Default Slide
			item.data('defSlide',item.find("#default-admin-slide").html());
			
			item.find("#default-admin-slide").remove();
			
			// Get Options
			var optdiv = item.find('#loaded-paradigm-item-options');
			
			opt.width = parseInt(optdiv.data("width"),0);
			opt.height = parseInt(optdiv.data("height"),0);
			opt.thumbWidth = parseInt(optdiv.data("thumbWidth"),0);
			opt.thumbHeight = parseInt(optdiv.data("thumbHeight"),0);
			opt.thumbAmount = parseInt(optdiv.data("thumbAmount"),0);
			opt.thumbSpaces = parseInt(optdiv.data("thumbSpaces"),0);
			opt.thumbPadding = parseInt(optdiv.data("thumbPadding"),0);
			opt.shadow = optdiv.data("shadow");
			opt.parallaxX = parseInt(optdiv.data("parallaxX"),0);
			opt.parallaxY = parseInt(optdiv.data("parallaxY"),0);
			opt.captionParallaxX = parseInt(optdiv.data("captionParallaxX"),0);
			opt.captionParallaxY = parseInt(optdiv.data("captionParallaxY"),0);
			opt.touchenabled=optdiv.data("touchenabled");
			opt.timer = parseInt(optdiv.data("timer"),0);	
			opt.fonturl=optdiv.data('fonturl');
			opt.fonttype=optdiv.data('fonttype');
								

			
			item.find('#loaded-paradigm-item-options').remove();
			
			item.find('#loaded-paradigm-item .video_paradigm_wrap').find('#close').remove();
			// COPY IFRAME TO THE RIGHT POSITION
			item.find('#loaded-paradigm-item .video_paradigm_wrap iframe').each(function(i) {
				var $this=$(this);							
				$this.parent().data('videosrc',$this.attr('src'));												
				$this.parent().find('iframe').remove();												
			});
			
			
			// Get Originell Template 						
			item.data('orgdata',item.find("#loaded-paradigm-item"));
			
			
			//item.data('orgdata',item.find("#loaded-paradigm-item").html());
			//item.find("#loaded-paradigm-item").remove();
		}
				
				
				
				
				

		//////////////////////		
		// SET THE LI ITEMS //
		/////////////////////
		
		function checkiPhone() {
						var iPhone=((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)));
						return iPhone;
					}

					function checkiPad() {
						var iPad=navigator.userAgent.match(/iPad/i);
						return iPad;
					}
											

		////////////////////
		// DRAG FUNCTIONS //
		///////////////////
		function setDrag() {
			var drag=$('body').find('#dragset .dragme');
			drag.draggable({
											zIndex: 1000,
											ghosting: false,
											axis:'x',
											containment: 'parent',
											revert: false,
											opacity: 1,
											drag:function() {		
											
												var item=$('body').data('paradigm-caption-field');
												var addon=$('body').data('paradigm-caption-field-add');
												var drag=$('body').find('#dragset .dragme');
												var proc=drag.position().left / (drag.parent().width()-12);
												var min = $('body').data('paradigm_minimum');
												var max = $('body').data('paradigm-caption-max');
												
												var act = Math.round((max-min) * proc) + min;
												setDemoCaptions(item);
												item.html(Math.round(act)+addon);												
														
											}
										});
		}
		
		
		
		
		////////////////////
		// 	DRAGSET PANEL //
		////////////////////
		function addDragSet(item) {
			//parseInt(item.offset().left,0)-55
			$('body').find('#dragset').css({'display':'block', 'position':'absolute', 'left':(parseInt(item.position().left,0)-40)+"px" , 'top':(parseInt(item.offset().top,0)-105)+"px"});
			
			$('body').append('<div class="paradigm-panel-overlay"></div>');
			var overlay=$('body').find('.paradigm-panel-overlay');
						
			var targetOpacity = overlay.css('opacity');
			
			// LIGHTBOX PROBLEM FOR iPAD && iPhone
			var ts=0;
			if (checkiPhone() || checkiPad()) ts=jQuery(window).scrollTop();
			
			overlay.css({	
							'width':$(window).width()+'px',
							'height':($(window).height()+150)+'px',
							'opacity':'0.4',
							'top':'0px',
							'left':'0px'
							});																	

			overlay.cssAnimate({'opacity':targetOpacity},{duration:500,queue:false});
			
			$(window).bind('resize scroll', function() {resizeOverlay(overlay,null,null);});			
			overlay.click(function() {
				$(window).unbind('resize scroll', function() {resizeOverlay(overlay,null,null);});
				$('body').find('#dragset').css({'display':'none'});
				$(this).remove();
				var addon=$('body').data('paradigm-caption-field-add');
				$('body').data('paradigm-caption-field').html($('body').data('paradigm-caption-field-value')+addon);
				setDemoCaptions($('body').data('paradigm-caption-field'));
			});
			
			
			var drag=$('body').find('#dragset .dragme');			
			var min = $('body').data('paradigm_minimum');
			
			var max = $('body').data('paradigm-caption-max');			
			var val = $('body').data('paradigm-caption-field-value');									
			
			
			var newpos = ((val / ((max-min)+min))*130)-12;		
			if (newpos<0) newpos = 0;
			drag.css({'left':newpos+"px"});
			
			var ok=$('body').find('#dragset .ok');
			ok.click(function() {
				$('body').find('#dragset').css({'display':'none'});
				$('body').find('.paradigm-panel-overlay').remove();
			});
			
		}
		
		
		
		
							
		
		////////////////////////////////
		// CLICK ON SOME NUMBER INPUT //
		////////////////////////////////
		function numInputClicked($this,minimum,max,addon) {			
				
				var $num=$this.find('.text-input');
				var val=parseInt($num.html(),0);
				
				$('body').data('paradigm-caption-field',$num);
				$('body').data('paradigm-caption-field-add',addon);				
				$('body').data('paradigm-caption-field-value',val);
				
				$('body').data('paradigm_minimum',parseInt(minimum,0));								
				$('body').data('paradigm-caption-max',parseInt(max,0));
				
				addDragSet($this);
		}
		
		////////////////////////////////////////////////////
		//Function to convert hex format to a rgb color   //
		///////////////////////////////////////////////////
		function rgb2hex(rgb){
			if (rgb=="transparent") rgb='rgb(255,255,255)';
			 rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
			 return "#" +
			  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
			  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
			  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2);
		}
		
		//////////////////////////
		//	THE COLOR SELECTORS	//
		//////////////////////////
		function colorSelector(item,col) {			
			
			item.ColorPicker({							
							color: rgb2hex(col),
							onShow: function (colpkr) {
								
								$(colpkr).fadeIn(500);
								return false;
							},
							onHide: function (colpkr) {
								$(colpkr).fadeOut(500);
								return false;
							},
							onChange: function (hsb, hex, rgb) {
								
								var item=$('body').data('.paradigm-caption-field')
								item.css({'backgroundColor':'#'+hex});
								setDemoCaptions(item.parent());
							}
					});
			
				
		}
		
		
		
		

		///////////////////////////////////////
		// GIVE LIVE FOR THE SLIDE CONTAINER //
		///////////////////////////////////////
		function giveLive(slide,opt,orig) {
			
			// FIND THE FIELDS
			var f=[];
			f.ops=slide.find('.options:first');			
			f.close=slide.find('.close:first');
			f.description = slide.find('.slidetitle');		
			f.remove=slide.find('.remove:first');				
			f.slidetitle=slide.find('.paradigm-slidetitle');
			f.upload=slide.find('.paradigm-imgupload');
			f.img=slide.find('.paradigm-slideimage');			
			f.slideimg = slide.find('.slideinside');
			f.infos=slide.find('.info');
			f.captions=slide.find('.paradigm-captions');
			f.removeitems=slide.find('.itemremove:first');
			f.trans = slide.find('.paradigm-transition');
				
			f.removeitems.click(function() {
				var slide=$(this).parent().parent();
				slide.find('img:first').attr('src',"");
				setTimeout(function() {checkHeight($currentdiv);},200);
			});
			
			if (orig!=null && orig!=undefined) {
				if (orig.data('transition') == "fade") {
					f.trans.find('.radio').removeClass("radio_selected");
					f.trans.find('.rfade').addClass("radio_selected");
				}
				
				if (orig.data('transition') == "slide") {
					f.trans.find('.radio').removeClass("radio_selected");
					f.trans.find('.rslide').addClass("radio_selected");
				}
			}
			f.trans.find('.radio').click(function() {
				var $this=$(this);
				$this.parent().find('.radio').removeClass("radio_selected");
				$this.addClass('radio_selected');
			});
			
			
			slide.data('f',f);
			// CLOSE / HIDE THE SLIDE SETTINGS
			f.close.click(function() {				
				var f=$(this).parent().parent().data('f');								
				f.ops.show();
				f.close.hide();
				f.description.hide("fast");
				f.upload.hide("fast");
				f.img.hide("fast");
				f.infos.hide("fast");
				f.captions.hide("fast");
				f.removeitems.hide("fast");
				f.slideimg.hide("fast");
				f.trans.hide('fast');

				setTimeout(function() {checkHeight($currentdiv);},200);
			});
			
			
			// SHOW THE SLIDE SETTINGS
			f.ops.click(function() {
				var f=$(this).parent().parent().data('f');												
				f.ops.hide();
				f.close.show();
				f.description.show("fast");
				f.upload.show("fast");
				f.img.show("fast");
				f.infos.show("fast");
				f.captions.show("fast");
				f.removeitems.show("fast");
				f.slideimg.show("fast");
				f.trans.show('fast');
				var slide = $(this).parent().parent();

				setTimeout(function() {checkHeight($currentdiv);},200);
				
				
			});
			
			
			// FIND THE ELEMENTS
			
			
			// SET THE MOUSE CURSOR FOR THE 
			f.close.css({'cursor':'pointer'});
			f.ops.css({'cursor':'pointer'});
			f.remove.css({'cursor':'pointer'});
			
			//if (slide.data('id')>0) {				
			/*	f.ops.show();
				f.close.hide();
				f.description.hide();
				f.upload.hide();
				f.img.hide();
				f.infos.hide();
				f.captions.hide();
				f.removeitems.hide();
				f.slideimg.hide();
				f.trans.hide();*/
			//} else {
				f.ops.hide();
			//}
			
			// REMOVE THE SLIDE 
			f.remove.click(function() {
				$(this).parent().parent().remove();
				setTimeout(function() {checkHeight($currentdiv);},200);
			});
			
			
			//CHANGING DESCRIPTION 
			f.description.change(function() {
				var $this=$(this);
				var slide=$this.parent().parent();
				slide.find('.head .title').html('Slide '+(slide.index())+' '+$this.val());				
			});
			
			
			
			// CHANGING IMAGE URL
			var surl=slide.find('.slideurl');
			surl.change(function() {
					
					var $this=$(this);
					var slide=$this.parent().parent().parent();	
					slide.find('.paradigm-slideimage img:first').remove();					
					slide.find('.paradigm-slideimage').prepend('<img src="'+$this.val()+'">');				
					
						
						slide.find('.paradigm-slideimage').waitForImages(function() {
							var $this=$(this);								
							var img = $this.find('img:first');
							var par=img.parent();
							img.appendTo($('body'));
							
							
							//FIRST LET CALCULTE THE ORIGINELL IMAGE POSITION AND SIZE
							img.data('w',parseInt(img.width(),0));
							img.data('h',parseInt(img.height(),0));							
							img.prependTo(par);
							var imgw = img.data('w');
							var imgh = img.data('h');				
							var imgl = 0;
							var imgt = 0;
							
							// NOW LET PUT IT IN NORMAL POSITION AND LET RESIZE IT TO THE ORIGINELL VERISION
							if (imgw<opt.width) {
								var oprop = opt.width/imgw;
								imgw = imgw*oprop;
								imgh = imgh*oprop;
							}
							
							if (imgh<opt.height) {
								var oprop = opt.height/imgh;
								imgw = imgw*oprop;
								imgh = imgh*oprop;
							}
							
							// NOW LET IT MOVE TO LEFT / UP TO THE RIGHT POSITION
							if (imgw>opt.width) imgl = (opt.width - imgw) /2;
							if (imgh>opt.height) imgt = (opt.height - imgh) /2;
							
							// NOW WE NEED THE PROPORTIONALS TO ORIGINELL								
							opt.propc = 528 / opt.width;
							if (opt.propc>1) opt.propc=1;
							
							
							imgw = imgw*opt.propc;
							imgh = imgh*opt.propc;
							imgl = imgl*opt.propc;
							imgt = imgt*opt.propc;
							
							
							img.data('ws',imgw);
							img.data('hs',imgh);					
							img.data('l',imgl);
							img.data('t',imgt);
							img.data('xoffset',imgl);
							img.data('yoffset',imgt);
							
							img.css({'position':'absolute','top':imgt+"px",'left':imgl+"px",'width':imgw+"px",'height':imgh+"px"});
							
						
							var newWidth = opt.width;
							if (newWidth>528) newWidth=528;
							if (newWidth<528) opt.propc=1;
							var newHeight = opt.height*opt.propc;
										
							
							$this.css({'overflow':'hidden','background-color':'#fff','width':newWidth+'px','height':newHeight+"px"});					
							$this.data('ws',newWidth);
							$this.data('hs',newHeight);
							
							
							// RESET THE CAPTIONS WITH NEW PROPORTIONS
							$('body').find('.paradigm-captions .caption').each(function() {					
								$this=$(this);
								var f=$this.data('f');
								f.demoheight = newHeight;
								resetCaptionsToScaled($(this),opt)
							});
							
							// RESET THE POSITION OF THE ZOOM ICON AS WELL FOR NEW PROPORTIONS
							
							var zoom = $this.parent().parent().parent().find('.zoom-icon');
							
							zoom.cssAnimate({'left':((newWidth/2)-25)+'px','top':((newHeight/2)+35)+'px'},{duration:100,queue:false});
							zoom.data('right',((newHeight/2)-25));
							zoom.data('out',((newHeight/2)+35));
							
							setTimeout(function() {checkHeight($currentdiv);},200);					
						});
						
				
			});
		}
		
		

		////////////////////////////////////////////
		// REUTRN THE SLIDE DEFINED VIA THIS ID  //
		//////////////////////////////////////////
		function findSlide(id) {						
				var slide="";						
					
				$('body').find('.slide').each(function(i) {			var $this=$(this);
					if (id == $this.data('id')) {	
						slide = $this;
					}
				});
				
				return slide;
			}

		
		
		
		
		
		
		
		
		
		////////////////////////////////
		// GIVE LIVE FOR THE CAPTIONS //
		///////////////////////////////
		function giveLiveCaptions(caption,source,opt) {
			
			// FIND THE FIELDS			
			var f=[];
			
			f.ops = caption.find('.options:first');			
			f.close = caption.find('.close:first');
			f.remove = caption.find('.remove');
			
			
			
			f.ops.css({'cursor':'pointer'});
			f.close.css({'cursor':'pointer'});
			f.remove.css({'cursor':'pointer'});
			
			f.ctext = caption.find('.paradigm-caption-text');
			f.clink = caption.find('.paradigm-caption-link');
			f.ctarget = caption.find('.paradigm-caption-link-target');
			
			f.cimage = caption.find('.paradigm-caption-image-source');
			f.cimagesmall = caption.find('.paradigm-caption-image-small');
			f.csize = caption.find('.paradigm-caption-font-size');
			f.ccolor = caption.find('.paradigm-caption-text-color');
			f.cbgcolor = caption.find('.paradigm-caption-bg-color');
			f.cshadowa = caption.find('.paradigm-caption-shadow-alpha');
			
			
			f.cbga = caption.find('.paradigm-caption-bg-alpha');
			f.chp = caption.find('.paradigm-caption-h-padding');
			f.cvp = caption.find('.paradigm-caption-v-padding');
			f.ctrans = caption.find('.paradigm-caption-transition');			
			
			f.videosrc = caption.find('.paradigm-video-source');
			f.videohtml = caption.find('.paradigm-video-txt');
			f.videohtml2 = caption.find('.paradigmvideotxt');
			
			f.x = parseInt(source.css('left'),0);
			f.y = parseInt(source.css('top'),0);		

			if (f.x>opt.width) f.x = opt.width - 150;
			if (f.x<0) f.x = 0;
			
			if (f.y>opt.height) f.y = opt.height-150;
			if (f.y<0) f.y = 0;
			
			f.id=caption.data('id');
			
			if (f.id==0) {
				f.remove.hide();
				f.ops.css({'margin-right':'0px'});
				f.close.css({'margin-right':'0px'});
			}
			
			
			if (f.id>0) {
					if ( $.browser.msie && $.browser.version < 9) {		
						f.boxshadow="";
					} else {
						f.boxshadow=source.css('boxShadow');
						f.boxshadow=f.boxshadow.replace('transparent','rgba(0,0,0,0)')
						if (f.boxshadow.length>4) {				
							f.boxshadow=f.boxshadow.split(",")[3].split(')')[0];
							f.cshadowa.find('.text-input').html(Math.round(f.boxshadow*100));
						}
					}
					
					// MAKE BACKGROUND COLOR NONE TRANSPARENT, AND SAVE TRANSPARENCY IN A NEW FIELD
					var bga=1;
					if (source.css('backgroundColor').split(",").length>3) {
						bga =source.css('backgroundColor').split(",")[3].split(")")[0];
						var newcolor= 	source.css('backgroundColor').replace("rgba","rgb");
						var r = newcolor.split(",")[0];
						var g = newcolor.split(",")[1];
						var b = newcolor.split(",")[2];				
						newcolor=r+","+g+","+b+")";				
						source.css({'backgroundColor':newcolor});
					} else {
						
					}
					
					
					if (bga==0 || source.css('backgroundColor') == "transparent") bga=0;
					f.cbga.find('.text-input').html(Math.round(bga*100));
			}
			
			
			//////////////////////
			//	CLICK FUNCTIONS //
			//////////////////////
			
			if (f.id>0) {
					// SET THE SIZE OF THE FONT
					f.csize.click(function() {	numInputClicked($(this),6,60,"px");});
					
					// SET THE SHADOW ALPHA
					f.cshadowa.click(function() {numInputClicked($(this),0,100," ");});
					
					// SET THE BG ALPHA
					f.cbga.click(function() {numInputClicked($(this),0,100," ");});
					
					// SET THE HORIZONTAL PADDING
					f.chp.click(function() {numInputClicked($(this),0,30,"px");});
					
					// SET THE VERTICAL PADDING
					f.cvp.click(function() {numInputClicked($(this),0,30,"px");});
				
				
					// SET THE BG COLR
					colorSelector(f.cbgcolor,source.css('backgroundColor'));
					f.cbgcolor.click(function() {
						$('body').data('.paradigm-caption-field',$(this).find('.picker'));
						});
					
					// SET THE BG COLR
					colorSelector(f.ccolor,source.css('color'));
					f.ccolor.click(function() {
						$('body').data('.paradigm-caption-field',$(this).find('.picker'));
						});
			}
		
		
			
			///////////////////////////
			// 1ST FILLING OF FIELDS //
			///////////////////////////
			f.description = caption.find('.captiontext');	
			
			if (f.id==0) {
				caption.find('.head .title').html("VIDEO LAYER (optional)");
				
				f.videosrc.find('.text-input').val(source.data('videosrc'));
				var vidhtml = source.html();								
				f.videohtml2.val(vidhtml);
			}
			
			
			if (f.id>0) {
						// SET IMAGE (SMALL) OR CAPTION TEXT
						if (source.find('img').length>0) {
							f.description.val("IMAGE");
							caption.data('oldvalue',"IMAGE");					
							caption.find('.head .title').html("Caption: IMAGE");		
							f.cimage.find('.text-input').val(source.find('img').attr('src'));
							f.cimagesmall.find('img').attr('src',source.find('img').attr('src'));				
							f.cimagesmall.waitForImages(function() {   				
								var cimg = f.cimagesmall.find('img');					
								var prop = 528/opt.width;					
								if (prop>1) prop=1;
								cimg.data('w',parseInt(cimg.width(),0));
								cimg.data('h',parseInt(cimg.height(),0));
								setTimeout(function() {checkHeight($currentdiv);},200);		
							});
							f.cimagesmall.find('img').parent().append('<div class="itemremove"></div>');
						} else {			
							// SET TITLE AND CAPTION TEXT			
							f.description.val(source.html());
							caption.data('oldvalue',source.html());					
							caption.find('.head .title').text("Caption: "+source.text());		
							f.cimagesmall.hide();
						}
						
						if (source.find('a').length>0) {
							f.clink.find('.text-input').val(source.find('a').attr('href'));
							f.ctarget.find('.text-input').val(source.find('a').attr('target'));
						}
						
						f.removeitems=caption.find('.paradigm-caption-image-small .itemremove');
						
						// SET TRANSITION
						if (source.hasClass("fadeleft")) f.ctrans.find('.rleft').addClass("radio_selected")
						  else
							if (source.hasClass("faderight")) f.ctrans.find('.rright').addClass("radio_selected")
							 else
								if (source.hasClass("fadeup")) f.ctrans.find('.rtop').addClass("radio_selected")
								 else
									if (source.hasClass("fadedown")) f.ctrans.find('.rbottom').addClass("radio_selected")
						
						f.ctrans.find('.radios >div').click(function() {
							$this=$(this);
							$this.parent().find('.radio_selected').removeClass('radio_selected');
							$this.addClass("radio_selected")
						});
						
						// SET DEFAULT COLORS OF BG AND TEXT
						f.cbgcolor.find('.picker').css({'backgroundColor':source.css('backgroundColor')});
						f.ccolor.find('.picker').css({'backgroundColor':source.css('color')});
						

						// SET PADDINGS
						f.cvp.find('.text-input').html(source.css('paddingTop'));
						f.chp.find('.text-input').html(source.css('paddingLeft'));
						
						
						// SET TEXT SIZE 
						f.csize.find('.text-input').html(source.css('font-size'));
			}
			
			
			
			// SAVE FIELDS INTO DATA
			caption.data('f',f);
			

			// HIDE THE SETTINGS OF THE CAPTION
			f.close.click(function() {
				var f = $(this).parent().parent().data('f');			
				f.close.hide();
				f.ops.show();								

				if (f.id==0) {
					f.videosrc.hide('fast');
					f.videohtml.hide('fast');
				} else {
					f.ctext.hide('fast');				
					f.csize.hide('fast');
					f.cimage.hide('fast');
					f.cimagesmall.hide('fast');
					f.ccolor.hide('fast');
					f.cbgcolor.hide('fast');
					f.cshadowa.hide('fast');
					f.cbga.hide('fast');
					f.chp.hide('fast');
					f.cvp.hide('fast');
					f.ctrans.hide('fast');		
					f.removeitems.hide('fast');	
					f.clink.hide('fast');
					f.ctarget.hide('fast');
				}
				
				setTimeout(function() {checkHeight($currentdiv);},200);
			});
			
			
			// SHOW THE SETTINGS OF THE CAPTION
			f.ops.click(function() {
				var f = $(this).parent().parent().data('f');		
				
				f.close.show();
				f.ops.hide();				
				if (f.id>0) {					
					f.cimage.show('fast');							
					f.removeitems.show();
					f.ctrans.show('fast');						
					if (f.cimage.find('.text-input').val().length==0) {				
							f.ctext.show('fast');
							f.csize.show('fast');
							f.ccolor.show('fast');
							f.cbgcolor.show('fast');
							f.cshadowa.show('fast');
							f.cbga.show('fast');
							f.chp.show('fast');
							f.cvp.show('fast');
							f.removeitems.hide();	
							f.cimagesmall.hide('fast');									
					} else {
						f.cimagesmall.show('fast');	
						f.clink.show('fast');
						f.ctarget.show('fast');						
						f.ctext.hide('fast');
					}
				} else {
					f.videosrc.show('fast');
					f.videohtml.show('fast');
					
				}
				setTimeout(function() {checkHeight($currentdiv);},200);
			});
			
			// INITIALE CLOSING THE CONFIGURATION PANELS HERE 
			f.videosrc.hide();
			f.videohtml.hide();
			f.close.hide();
			f.ops.show();				
			f.ctext.hide();				
			f.csize.hide();
			f.ccolor.hide();
			f.cbgcolor.hide();
			f.cshadowa.hide();
			f.cbga.hide();
			f.cimage.hide();
			f.cimagesmall.hide();
			if (f.id>0) f.removeitems.hide();				
			f.chp.hide();
			f.cvp.hide();
			f.ctrans.hide();			
			f.ops.show();
			f.close.hide();
			f.clink.hide('fast');
			f.ctarget.hide('fast');
				
				
			// ACTIONS FOR DIFFERENT EVENTS IN THE CONFIGURATION PANEL	
			if (f.id>0) {																
				//CHANGING DESCRIPTION 
				f.description.change(function() {
					var $this=$(this);
					var caption=$this.parent().parent();					
					caption.find('.head .title').html("Caption: "+$this.val());	
					var str=caption.find('.head .title').text();					
					caption.find('.head .title').text(str);
					var f=caption.data('f');
					// FIND THE RIGHT SLIDE
					var slideid = caption.data('slideid');
					var demo= findSlide(slideid).find('.paradigm-slideimage');
					demo.find('.paradigm-caption').each(function() {				
						if ( f.id == $(this).data('id')) {
							$(this).html($this.val());
						}
					});									
				});
				
				
				
			   // REMOVE THE SLIDE 
				f.remove.click(function() {
				
					var $this=$(this);
					var caption=$this.parent().parent();										
					var f=caption.data('f');
					

					// FIND THE RIGHT SLIDE
					var slideid = caption.data('slideid');
					
					var demo= findSlide(slideid).find('.paradigm-slideimage');
					demo.find('.paradigm-caption').each(function() {				
						if ( f.id == $(this).data('id')) {
							$(this).remove();
						}
					});
					caption.remove();
					setTimeout(function() {checkHeight($currentdiv);},200);
				});
				
				
				// REMOVE THE LAYER IMAGE
				f.removeitems.click(function() {
					var $this = $(this);
					var caption=$this.parent().parent();	
					var f=caption.data('f');
					f.cimage.find('.text-input').val("");
					f.cimage.find('.text-input').change();
					setTimeout(function() {checkHeight($currentdiv);},200);
				});
				
				// CHANGE LAYER IMAGE INPUT FIELD
				f.cimage.find('.text-input').change(function() {
					var $this = $(this);
					var caption=$this.parent().parent().parent();	
					var f=caption.data('f');
					
					removeDemoCaptions($this);
					
					if ($this.val().length==0)  {											
						f.csize.show('fast');
						f.ccolor.show('fast');
						f.cbgcolor.show('fast');
						f.cshadowa.show('fast');
						f.cbga.show('fast');
						f.chp.show('fast');
						f.cvp.show('fast');						
						f.ctext.find('.text-input').val("New Caption Here");
						f.ctext.find('.text-input').change();
						f.cimagesmall.find('img').attr('src',"");											
						f.cimagesmall.hide();
						f.ctext.show('fast');
						f.clink.hide('fast');
						f.ctarget.hide('fast');
					} else {
						f.description.val("IMAGE");
						caption.data('oldvalue',"IMAGE");					
						caption.find('.head .title').html("Caption: IMAGE");								
						f.cimagesmall.find('img').attr('src',$this.val());
						f.cimagesmall.waitForImages(function() {   				
							var cimg = f.cimagesmall.find('img');
												
							cimg.data('w',parseInt(cimg.width(),0));							
							cimg.data('h',parseInt(cimg.height(),0));
							if (cimg.data('w')>528)
								cimg.css({'width':'100%'});
							
							setTimeout(function() {checkHeight($currentdiv);},200);		
							
						})
						f.ctext.hide('fast');
						f.cimagesmall.show('fast');
						f.csize.hide('fast');
						f.ccolor.hide('fast');
						f.cbgcolor.hide('fast');
						f.cshadowa.hide('fast');
						f.cbga.hide('fast');
						f.chp.hide('fast');
						f.cvp.hide('fast');
						f.clink.show('fast');
						f.ctarget.show('fast');
					}
					createDemoCaptions(caption,opt);
				});
				
			}
				
				if (f.id>0) createDemoCaptions(caption,opt);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		////////////////////////////////////////////
		// CREATE DEMO CAPTIONS ON THE EDIT AREAD //
		////////////////////////////////////////////		
		function createDemoCaptions(caption,opt) {
			
			var slideid=caption.data('slideid');
			var capid=caption.data('id');
			var f=caption.data('f');
			
			var demo=findSlide(slideid).find('.paradigm-slideimage');				
			demo.css({'position':'relative'});
			
			f.demoheight = demo.height();
			f.xprop = 528 / opt.width;
			f.yprop = demo.height() / opt.height;
			
			f.xoffset = demo.find('img:first').data('xoffset');
			f.yoffset = demo.find('img:first').data('yoffset');
			
			
			f.pv=parseInt(f.cvp.find('.text-input').html(),0);
			f.ph=parseInt(f.chp.find('.text-input').html(),0);
			f.fs = parseInt(f.csize.find('.text-input').html(),0);
			
			var content=f.description.val();
			
			// IE HACKS FOR BOX SHADOWS ETC
			if ( $.browser.msie && $.browser.version < 9) {											
				f.shadows="";
			} else {
				f.boxshadow = parseInt(f.cshadowa.find('.text-input').html(),0)/100;								
				f.shadows='-moz-box-shadow: 10px 10px 15px rgba(0, 0, 0, '+f.boxshadow+');'+
										'-webkit-box-shadow: 10px 10px 15px rgba(0, 0, 0, '+f.boxshadow+');'+
										'box-shadow: 10px 10px 15px rgba(0, 0, 0, '+f.boxshadow+');'
										
										
			}
			
			if (f.cimagesmall.find('img').attr('src').length>0) {
				content="<img src="+f.cimagesmall.find('img').attr('src')+">";
				f.shadows="";
			} 
			
			
			
			if (f.xprop>1) f.xprop=1;
			if (f.yprop>1) f.yprop=1;
			
			f.textshadow_def='text-shadow : #000';
			f.textshadow="";
			
			
			// IE HACK FOR BACKGROUND COLORS
			if ( $.browser.msie && $.browser.version < 9) {		
				var newcolor = f.cbgcolor.find('.picker').css('backgroundColor');
				
			} else {
				var newcolor=String(f.cbgcolor.find('.picker').css('backgroundColor')).replace("rgb","rgba");
				newcolor=newcolor.replace(")",","+(parseInt(f.cbga.find('.text-input').html(),0)/100)+")");
				if ((parseInt(f.cbga.find('.text-input').html(),0)/100)==0) {
						f.shadows="";
						f.textshadow=f.textshadow_def+" "+(f.boxshadow*8)+"px "+(f.boxshadow*8)+"px "+(f.boxshadow*16)+"px;"
					}
			}			

			
			if (newcolor=="transparent" || (parseInt(f.cbga.find('.text-input').html(),0)/100) == 0) f.shadows="";
			var newcap = $('<div class="paradigm-caption" style="position:absolute;'+									
									'left:'+((f.x)*f.xprop)+'px;'+
									'top:'+((f.y)*f.yprop)+'px;'+									
									'color:'+f.ccolor.find('.picker').css('backgroundColor')+';'+
									'padding-top:'+f.pv*f.xprop+'px;'+
									'padding-bottom:'+f.pv*f.xprop+'px;'+
									'padding-left:'+f.ph*f.xprop+'px;'+
									'padding-right:'+f.ph*f.xprop+'px;'+
									'font-size:'+f.fs*f.xprop+'px;'+f.shadows+
									'font-family:'+opt.fonttype+';'+
									'background-color:'+newcolor+';'+f.textshadow+
									'"></div');
			demo.append(newcap);
			newcap.append(content);
			newcap.data('id',f.id);
			
			f.newcolor=newcolor;
			
			// IS THERE ANY IMAGES IN THE CAPTION ?? 
			if (newcap.find('img').length>0) {
				newcap.css({'color':'transparent',
							'background-color':'transparent',
							'padding':'0px',
							'margin':'0px'					
				});
				newcap.waitForImages(function() {   				
						var cimg = newcap.find('img');
						var prop = 528/opt.width;		
						if (prop>1) prop=1;
						cimg.data('w',parseInt(cimg.width(),0));
						cimg.data('h',parseInt(cimg.height(),0));
						
						cimg.css({'width':cimg.data('w')*prop+"px",
								  'height':cimg.data('h')*prop+"px"});				
					});
			}			
		}
		
		
		
		
		
		////////////////////////////////////////////
		// REMOVE A CAPTION FROM THE "DEMO" SLIDE //
		////////////////////////////////////////////
		function removeDemoCaptions(field) {
			var caption=field.parent().parent().parent();
			var slideid=caption.data('slideid');
			
			var capid=caption.data('id');
			var f=caption.data('f');
			var  demo= findSlide(slideid).find('.paradigm-slideimage');
			
			
			demo.find('.paradigm-caption').each(function() {				
				if ( f.id == $(this).data('id')) {
					$(this).remove();
				}
			});
		}
		
		
		
		////////////////////////////////////////////
		// SET DEMO CAPTIONS ON THE EDIT AREAD //
		////////////////////////////////////////////
		function setDemoCaptions(field) {
			
			var caption=field.parent().parent();
			var slideid=caption.data('slideid');
			
			var capid=caption.data('id');
			var f=caption.data('f');
			
			f.ctext = caption.find('.paradigm-caption-text');
			
			f.csize = caption.find('.paradigm-caption-font-size');
			f.ccolor = caption.find('.paradigm-caption-text-color');
			f.cbgcolor = caption.find('.paradigm-caption-bg-color');
			f.cshadowa = caption.find('.paradigm-caption-shadow-alpha');
			f.cbga = caption.find('.paradigm-caption-bg-alpha');
			f.chp = caption.find('.paradigm-caption-h-padding');
			f.cvp = caption.find('.paradigm-caption-v-padding');
			f.ctrans = caption.find('.paradigm-caption-transition');
			f.pv=parseInt(f.cvp.find('.text-input').html(),0);
			f.ph=parseInt(f.chp.find('.text-input').html(),0);
			f.fs = parseInt(f.csize.find('.text-input').html(),0);
			f.boxshadow = parseInt(f.cshadowa.find('.text-input').html(),0)/100;
			var newcolor=String(f.cbgcolor.find('.picker').css('backgroundColor')).replace("rgb","rgba");
			newcolor=newcolor.replace(")",","+(parseInt(f.cbga.find('.text-input').html(),0)/100)+")");
			
			
			
			if (f.xprop>1) f.xprop=1;								
			
			var  demo= findSlide(slideid).find('.paradigm-slideimage');
			
			
			demo.find('.paradigm-caption').each(function() {				
				if (f.id == $(this).data('id')) {
					$(this).css({									
									'color':f.ccolor.find('.picker').css('backgroundColor'),
									'padding-top':(f.pv*f.xprop)+'px',
									'padding-bottom':(f.pv*f.xprop)+'px',
									'padding-left':(f.ph*f.xprop)+'px',
									'padding-right':(f.ph*f.xprop)+'px',
									'font-size':(f.fs*f.xprop)+'px',						
									'background-color':newcolor									
					});
					
					
					if ((parseInt(f.cbga.find('.text-input').html(),0)/100)==0) {
						
						$(this).css({'text-shadow':'#000000 '+(f.boxshadow*8)+"px "+(f.boxshadow*8)+"px "+(f.boxshadow*16)+"px",
									 '-moz-box-shadow': '0px 0px 0px rgba(0, 0, 0, '+f.boxshadow+')',
									 '-webkit-box-shadow': '0px 0px 15px rgba(0, 0, 0, '+f.boxshadow+')',
									 'box-shadow': '0px 0px 0px rgba(0, 0, 0, '+f.boxshadow+')'});								
					} else {
						$(this).css({'-moz-box-shadow': '10px 10px 15px rgba(0, 0, 0, '+f.boxshadow+')',
									'-webkit-box-shadow': '10px 10px 15px rgba(0, 0, 0, '+f.boxshadow+')',
									'box-shadow': '10px 10px 15px rgba(0, 0, 0, '+f.boxshadow+')'});								
					}
					f.newcolor=newcolor;
					
					if ($(this).find('img').length>0) {
					   $(this).css({'color':'transparent',
									'background-color':'transparent',
									'padding':'0px',
									'margin':'0px'													
						});
					}
				}
			})
			//if ($('body').find('#dragset').css('display') =='none'	&& $('body').find('#
			//) writeExport();
		}
		
		
		
		
		
		//////////////////////////////////////////
		// SET THE CAPTION SIZE WIDTH / HEIGHT //
		//////////////////////////////////////////
		function resetCaptionsToNormal(caption,opt) {
			var f=caption.data('f');
			
			var editor=$('body').find('.mockup-paradigm-editor');
			editor.find('.paradigm-caption').each(function() {				
				var $this=$(this);
				if (f.id == $(this).data('id')) {
					$this.css({
									'left':f.x+'px',
									'top':f.y+'px',									
									'padding-top':f.pv+'px',
									'padding-bottom':f.pv+'px',
									'padding-left':f.ph+'px',
									'padding-right':f.ph+'px',
									'font-size':f.fs+'px',
									'cursor':'move'
					});
										
					$this.find('img').css({'position':'absolute','left':$this.find('img').data('l')+"px",'width':$this.find('img').data('w')+"px",
								 'height':$this.find('img').data('h')+"px"});
					
					
					$this.draggable({
											zIndex: 1000,
											ghosting: false,								
											
											revert: false,
											opacity: 0.8,
											drag:function() {																																																			
											}
										});
				}
			});						
		}
		
		//////////////////////////////////////
		// SET THE CAPTIONS AGAIN TO SCALED //
		/////////////////////////////////////
		function resetCaptionsToScaled(caption,opt) {
			
			
			var slideid=caption.data('slideid');
			var capid=caption.data('id');
			var f=caption.data('f');			
			
			
		
			
			f.xprop = 528 / opt.width;
			f.yprop = f.demoheight / opt.height;			
			
			if (f.x>opt.width) f.x = 10;
			if (f.y>opt.height) f.y = 10;
			
			
			
			var editor=$('body').find('.mockup-paradigm-editor');
			editor.find('.paradigm-caption').each(function(i) {			
				var $this=$(this);
				if (f.id == $this.data('id')) {
					
					f.x = parseInt($this.css('left'),0);
					f.y = parseInt($this.css('top'),0);
					if (f.xprop>1) f.xprop=1;										
					if (f.yprop>1) f.yprop=1;								
					$this.css({
									'left':(f.x*f.xprop)+'px',
									'top':(f.y*f.yprop)+'px',									
									'padding-top':(f.pv*f.yprop)+'px',
									'padding-bottom':(f.pv*f.yprop)+'px',
									'padding-left':(f.ph*f.xprop)+'px',
									'padding-right':(f.ph*f.xprop)+'px',
									'font-size':(f.fs*f.xprop)+'px',
									'cursor':'default'
					});
					
					$this.find('img').css({'left':$this.find('img').data('l')+"px",'width':$this.find('img').data('w')*f.xprop+"px",
								 'height':$this.find('img').data('h')*f.xprop+"px"});
					
					$this.draggable("destroy");
				}
			});

			var  demo= findSlide(slideid).find('.paradigm-slideimage');		

			demo.find('.paradigm-caption').each(function(i) {			
				var $this=$(this);
				if (f.id == $this.data('id')) {
					
					if ($('body').find('.mockup-paradigm-editor').length>0) {
						f.x = parseInt($this.css('left'),0);
						f.y = parseInt($this.css('top'),0);
					}
					if (f.xprop>1) f.xprop=1;										
					if (f.yprop>1) f.yprop=1;								
					$this.css({
									'left':(f.x*f.xprop)+'px',
									'top':(f.y*f.yprop)+'px',									
									'padding-top':(f.pv*f.yprop)+'px',
									'padding-bottom':(f.pv*f.yprop)+'px',
									'padding-left':(f.ph*f.xprop)+'px',
									'padding-right':(f.ph*f.xprop)+'px',
									'font-size':(f.fs*f.xprop)+'px',
									'cursor':'default'
					});
					
					$this.find('img').css({'left':$this.find('img').data('l')+"px",'width':$this.find('img').data('w')*f.xprop+"px",
								 'height':$this.find('img').data('h')*f.xprop+"px"});
					
					$this.draggable("destroy");
				}
			});
			
		}
		
		
		
		
		
		
		///////////////////////////////////////////
		//	EDIT THE SLIDE HERE VIA DRAG & DROP //
		/////////////////////////////////////////
		function editSlide(paradigmslideimage,opt) {
			
			
			
			paradigmslideimage.unbind('click');
			
			
			$('body').append('<div class="paradigm-panel-overlay-drag"></div>');
			var overlay=$('body').find('.paradigm-panel-overlay-drag');
						
			var targetOpacity = overlay.css('opacity');
			
			// LIGHTBOX PROBLEM FOR iPAD && iPhone
			var ts=0;
			if (checkiPhone() || checkiPad()) ts=jQuery(window).scrollTop();
			
			overlay.css({	
							'width':$(window).width()+'px',
							'height':($(window).height()+150)+'px',
							'opacity':'0.4',
							'top':'0px',
							'left':'0px'
							});																	

			overlay.cssAnimate({'opacity':targetOpacity},{duration:500,queue:false});
			
			
			
			
			
			
			
			// ADD THE MAIN IMAGE TO THE SCREEN
			///////////////////////////////////
			$('body').append('<div style="position:fixed;z-index:9999999;overflow:hidden;top:'+($(window).height()/2 - opt.height/2)+'px;left:'+($(window).width()/2 - opt.width/2)+'px;width:'+opt.width+'px;height:'+opt.height+'px;"class="mockup-paradigm-editor"></div>');
			
			$(window).bind('resize scroll', function() {resizeOverlay(overlay,editor,opt);});
			
			var editor=$('body').find('.mockup-paradigm-editor');
			
			
			// Remember to the old Parent
			/////////////////////////////
			var slide = paradigmslideimage.parent().parent();
			paradigmslideimage.addClass("moveme");			
			paradigmslideimage.data('oldpar',paradigmslideimage.parent());			
			paradigmslideimage.appendTo(editor);
			
			
			
			// SET THE IMAGE SIZE  
			////////////////////////
			var image=paradigmslideimage.find('img:first');
			image.css({'position':'absolute'});
			
			image.css({'width':image.data('w')+'px', 'height':image.data('h')+'px'});

			image.parent().css({'width':opt.width+"px",'height':opt.height+'px'});
			
			if (opt.width<image.width())
				image.css({'left':(0+(opt.width - image.width())/2)+'px'});
			
			if (opt.height<image.height())
				image.css({'top':(0+(opt.height - image.height())/2)+'px'});
			
			
			
			slide.find('.caption').each(function() {
				resetCaptionsToNormal($(this),opt);
				
			});
			
			
			
			// CLOSE THE LIGHTBOX AND SET EVERYTHING BACK AS IT WAS 
			//////////////////////////////////////////////////////////
			overlay.click(function() {
				$(window).unbind('resize scroll', function() {resizeOverlay(overlay,editor,opt);});
				$('body').find('.mockup-paradigm-editor .moveme').bind('click',function() {
					var $this=$(this);
					editSlide($this,opt);
				});
				
				$('body').find('.mockup-paradigm-editor .moveme').data('oldpar').parent().find('.caption').each(function() {
					resetCaptionsToScaled($(this),opt)
				});
				
				var img=$('body').find('.mockup-paradigm-editor .moveme img:first');
				
				img.css({'top':img.data('t')+"px",'left':img.data('l')+'px','position':'absolute', 'width':img.data('ws')+"px",'height':img.data('hs')+"px"});
				
				var imgp=img.parent();
				
				imgp.css({'width':imgp.data('ws')+"px",'height':imgp.data('hs')+"px"});
				
				$('body').find('.mockup-paradigm-editor .moveme').appendTo($('body').find('.mockup-paradigm-editor .moveme').data('oldpar'));
				
				$('body').find('.mockup-paradigm-editor').remove();
				$(this).remove();				
			});
			
		}
		
		
		
		
		
		
		///////////////////////////////////////////////////////////
		// RESIZE THE OVERLAY AND SOME OTHER ITEM ON DA STAGE :) //
		///////////////////////////////////////////////////////////
		function resizeOverlay(overlay,editor,opt) {
					overlay.css({'width':$(window).width()+'px',
								 'height':($(window).height()+150)+'px'});
					if (editor!=null) {
						editor.css({'left':($(window).width()/2 - opt.width/2)+'px',
									'top':($(window).height()/2 - opt.height/2)+'px'});
					}
					}
		
		
		
		
		
		
		
		
		/////////////////////////////////////////
		//	CREEATE SLIDES BASED ON GOT DATA  //
		///////////////////////////////////////
		function createSlides(item,opt) {
			var orgdata=$(item.data('orgdata'));
			opt.i=0;
			
			orgdata.find('ul:first >li').each(function(i) {				
				var $this = $(this);
				i=opt.i;				
				// ADD NEW SLIDE
				createNewSlide(item,opt,$this);				
				var slide=item.find('.slide:eq('+i+')');												
			});
			
			item.find('.addslide').css({'position':'relative'});
			
			// THE ADD SLIDE FUNCTION
			item.find('.addslide').click(function() {
				var emptyslide=$('<li data-transition="slide" data-description="Description for Admins"><img src="" data-thumb="" data-thumb_bw=""></li>');
				var i=opt.i;
				createNewSlide(item,opt,emptyslide);
				var slide=findSlide(i);
				giveLive(slide,opt);
				setTimeout(function() {
					
					checkHeight($currentdiv);
				},200);
				return false;
			});
			
						
			// MAKE THE SLIDERS HOLDER SORTABLE
				item.find('.content').sortable({
					 placeholder : 'placeholder_slides',
					 handle : '.head:first',
					 helper: 'clone',   
					 opacity:'0.65'
				})
			
			
			//CHANGING FONT FAMILY							
			$('body').find('.paradigm-caption').css({'font-family':opt.fonttype});																	
			$('head').append("<link href='"+opt.fonturl+"' rel='stylesheet' type='text/css'>" );
			
			// CHANGE FONT URL
			$('input[name="paradigmfonturl"]').change(function() {
				var $this=$(this);
				opt.fonturl=$this.val();
				$('head').append("<link href='"+$this.val()+"' rel='stylesheet' type='text/css'>" );
			});
			
			//CHANGING FONT FAMILY
			$('input[name="paradigmfonttypes"]').change(function() {				
				var $this=$(this);
				opt.fonttype=$this.val();
				
				$('body').find('.paradigm-caption').css({'font-family':opt.fonttype});
					
				
			});
			
			
			// CHANGE WIDHT AND HEIGHT
			$('input[name="paradigmwidth"]').change(function() {
				opt.height = parseInt($('input[name="paradigmheight"]').val(),0);
				opt.width = parseInt($('input[name="paradigmwidth"]').val(),0);
				$('body').find('.slideurl').change();
			
			});
			
			// CHANGE WIDHT AND HEIGHT
			$('input[name="paradigmheight"]').change(function() {				
				opt.height = parseInt($('input[name="paradigmheight"]').val(),0);
				opt.width = parseInt($('input[name="paradigmwidth"]').val(),0);
				$('body').find('.slideurl').change();
				
			});
			
			
			
			// CHANGE NORMAL AND PARALLAX SLIDER RADIOBUTTON
			$('body').find('#tp-p-glob-parallax-mode').live("click",function() {																	
					$('body').find('#tp-p-effects-acc').css({'display':'block'});
					$('body').find('#tp-p-thumbs-acc').css({'display':'block'});
			});
			
			$('body').find('#tp-p-glob-simple-mode').live("click",function() {																
					$('body').find('#tp-p-effects-acc').css({'display':'none'});
					$('body').find('#tp-p-thumbs-acc').css({'display':'none'});
			});
			
			if ($('input[name="paradigmglobalstyle"]')=="simple") {
				$('body').find('#tp-p-effects-acc').css({'display':'none'});
				$('body').find('#tp-p-thumbs-acc').css({'display':'none'});
			}
			
			
			item.append('<div style="clear:both"><div class="buttondark" id="export_paradigm">ExportMe</div></div>');
			$('body').find('#export_paradigm').click(function() {
				writeExport(opt);
			});
		}
		
		
		
		
		
		
		
		
		//////////////////////////////////////////////
		//	CREEATE "ONE" SLIDE BASED ON GOT DATA  //
		////////////////////////////////////////////
		function createNewSlide(item,opt,$this) {
			var orgdata=$(item.data('orgdata'));										
			
			var i=opt.i;
			opt.i=opt.i+1;
			
			item.find('.content').append($('<div class="slide" data-id="'+i+'" id="slide'+i+'">'+item.data('defSlide')+'</div>'));
			
			var slide=findSlide(i)
			
			
			slide.find('.title').html("Slide "+(i+1)+" "+$this.data('description'));
			
			// APPEND THE IMAGE 				
			slide.find('.paradigm-slideimage').wrap('<div class="slideinside" id="slideinside'+i+'" style="cursor:pointer;position:relative;"></div>');				
			slide.find('.paradigm-slideimage img:first').attr('src',$this.find('img:first').attr('src'));				
			
			slide.find('.paradigm-slideimage').waitForImages(function() {
			
				var $this=$(this);	
				var img = $this.find('img:first');
				
				//FIRST LET CALCULTE THE ORIGINELL IMAGE POSITION AND SIZE
				img.data('w',parseInt(img.width(),0));
				img.data('h',parseInt(img.height(),0));							
				
				var imgw = img.data('w');
				var imgh = img.data('h');				
				var imgl = 0;
				var imgt = 0;
				
				//alert(imgw);
				
				// NOW LET PUT IT IN NORMAL POSITION AND LET RESIZE IT TO THE ORIGINELL VERISION
				if (imgw<opt.width) {
					var oprop = opt.width/imgw;
					imgw = imgw*oprop;
					imgh = imgh*oprop;
				}
				
				if (imgh<opt.height) {
					var oprop = opt.height/imgh;
					imgw = imgw*oprop;
					imgh = imgh*oprop;
				}
				
				// NOW LET IT MOVE TO LEFT / UP TO THE RIGHT POSITION
				if (imgw>opt.width) imgl = (opt.width - imgw) /2;
				if (imgh>opt.height) imgt = (opt.height - imgh) /2;
				
				// NOW WE NEED THE PROPORTIONALS TO ORIGINELL								
				opt.propc = 528 / opt.width;
				if (opt.propc>1) opt.propc=1;
				
				
				imgw = imgw*opt.propc;
				imgh = imgh*opt.propc;
				imgl = imgl*opt.propc;
				imgt = imgt*opt.propc;
				
				
				img.data('ws',imgw);
				img.data('hs',imgh);					
				img.data('l',imgl);
				img.data('t',imgt);
				img.data('xoffset',imgl);
				img.data('yoffset',imgt);
				
				img.css({'position':'absolute','top':imgt+"px",'left':imgl+"px",'width':imgw+"px",'height':imgh+"px"});
				
				
				// LETS CALCULATE THE PROPORTIONS				
				// 1. MAKE THE IMAGE SCALED TO THE 528 WIDTHS 
								
				
				var newWidth = opt.width;
				if (newWidth>528) newWidth=528;
				if (newWidth<528) opt.propc=1;
				var newHeight = opt.height*opt.propc;
							
				
				$this.css({'overflow':'hidden','position':'relative','background-color':'#fff','width':newWidth+'px','height':newHeight+"px"});					
				$this.data('ws',newWidth);
				$this.data('hs',newHeight);
				
				slide.parent().parent().find('#slideinside'+i).append('<div class="itemremove"></div>');
			
			
				// ADD THE ZOOM ICON TO THE DEMO SLIDES 
				$this.append('<div class="zoom-icon" style="left:'+((newWidth/2)-25)+'px;top:'+((newHeight/2)+35)+'px"></div>');
				
				$this.find('.zoom-icon').css({'opacity':'0.0'});
				$this.find('.zoom-icon').data('right',((newHeight/2)-25));
				$this.find('.zoom-icon').data('out',((newHeight/2)+35));
				$this.find('.zoom-icon').cssAnimate({'opacity':'0.0'},{duration:10,queue:false});
				
				// HOVER / ON-OUT EFFECT 
				$this.hover(
					function() {
						var zoom=$($this).find('.zoom-icon');
						zoom.cssAnimate({'opacity':'1.0', 'top':zoom.data('right')+'px'},{duration:250,queue:false});
					},
					function() {
						var zoom=$($this).find('.zoom-icon');
						zoom.cssAnimate({'opacity':'0.0', 'top':zoom.data('out')+'px'},{duration:250,queue:false});
					});
				
			});
			
			
			// SET THE URL OF THE IMAGE 
			slide.find('.slideurl').val($this.find('img:first').attr('src'));				
									
			// APPEND A "EDITOR SENSOR"
			slide.find('.paradigm-slideimage').click(function() {
				var $this=$(this);									
				editSlide($this,opt);
			});
			
			// SET THE TITLE TO DESCRIPTION
			slide.find('.slidetitle').val($this.data('description'));
			
			// PUT THE ADD SLIDE BUTTON TO THE END OF THE CONTAINER
			item.find('.addslide').appendTo(item).appendTo(item.find('.content'));		
			
			// PUT THE GLOBAL SETTINGS TO THE END OF THE SLIDES AS WELL
			//item.find('.paradigm-global-settings').appendTo(item).appendTo(item.find('.content'));
			
			
			
			// ADD THE CREATIVE LAYERS ALIAS CAPTIONS TO THE SLIDE
			slide.find('.paradigm-slideimage').waitForImages(function() {
			
						// CREATE A VIDEO CAPTION
						
						var video=$this.find(".video_paradigm_wrap");
						var j=0;
						slide.find('.paradigm-captions').append($('<div class="caption">'+item.data('defCaption')+'</div>'));
						slide.find('.paradigm-captions').find('.caption:eq(0)').data('id',j);
						slide.find('.paradigm-captions').find('.caption:eq(0)').data('slideid',i);								
						giveLiveCaptions(slide.find('.paradigm-captions').find('.caption:eq(0)'), video,opt);
							
						
						
							
						// CREATE A CAPTION PER EACH CREATIVE DIV 								
						$this.find(".creative_layer div").each(
							function(o) {								
								var $this=$(this);						
								var j=o+1;
								slide.find('.paradigm-captions').append($('<div class="caption">'+item.data('defCaption')+'</div>'));
								slide.find('.paradigm-captions').find('.caption:eq('+j+')').data('id',j);
								slide.find('.paradigm-captions').find('.caption:eq('+j+')').data('slideid',i);
								
								giveLiveCaptions(slide.find('.paradigm-captions').find('.caption:eq('+j+')'), $this,opt);
																
							});
							
						// MAKE THE CAPTIONS ALSO DRAGGABLE
								slide.find('.paradigm-captions').sortable({
									 placeholder : 'placeholder_captions',
									 handle : '.head:first',
									 helper: 'clone',   
									 opacity:'0.65',
									 stop:function() {
										var $this=$(this);
										// AFTER RESORTING NEED TO CHANGE Z-INDEX AS WELL
										$(this).parent().find('.caption').each(function() {											
											var caption=$(this);
											var f=caption.data('f');
											var slideid = caption.data('slideid');
											f.index=caption.index();
											var demo= findSlide(slideid).find('.paradigm-slideimage');
											demo.find('.paradigm-caption').each(function() {				
													if ( f.id == $(this).data('id')) {
														$(this).css({'z-index':100+f.index});
													}
											});												
											});
									 }
								})
								
						
						// PUT  THE ADD CAPTION TO THE END OF THE CONTAINER
						slide.find('.paradigm-captions .add-caption-holder').each(function() {
							var $this=$(this);
							var par=$this.parent();
							$this.appendTo($('body')).appendTo(par);							
						});
						
						
						// ADD IMPORTANT INTER LINKS TO THE SLIDE ITSELF, SO IT IS AVAILABLE ALSO INSIDE THE FUNCTIONS...
						slide.find('.paradigm-captions .addcaption').data('slide',slide);
						slide.find('.paradigm-captions .addcaption').data('defCaption',item.data('defCaption'));
						slide.find('.paradigm-captions .addcaption').data('opt',opt);
						
						// CREATE A NEW CAPTION HERE ON ADD CAPTION CLICK EVENT
						slide.find('.paradigm-captions .addcaption').click(function() {
							var $this=$(this);
							var opt=$this.data('opt');							
							var emptylayer=$('<div class="caption_blue fadeup" style="font-family:'+opt.fonttype+';font-size:25px;color:#fff;background-color:#00b4ff;padding:5px;position:absolute;-moz-box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.75);-webkit-box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.75);box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.75);padding-left: 10px;padding-right: 10px;top:50px;left:50px;">Welcome to PARADIGM</div>');
							var slide=$this.data('slide');
							
							slide.find('.paradigm-captions').append($('<div class="caption">'+$this.data('defCaption')+'</div>'));
							
							var j=slide.find('.paradigm-captions .caption').length-1;
							
							
							slide.find('.paradigm-captions').find('.caption:eq('+j+')').data('id',j);
							slide.find('.paradigm-captions').find('.caption:eq('+j+')').data('slideid',slide.data('id'));								
							
							giveLiveCaptions(slide.find('.paradigm-captions').find('.caption:eq('+j+')'), emptylayer,opt);
							
							
							slide.find('.paradigm-captions .add-caption-holder').each(function() {
								var $this=$(this);
								var par=$this.parent();
								$this.appendTo($('body')).appendTo(par);							
							});
							
							setTimeout(function() {
								checkHeight($currentdiv);
							},200);
				
							return false;
						});
						
						giveLive(slide,opt,$this);
				});				
			
			// SET THE CURSOR TO MOVE
			item.find('.head').css({'cursor':'move'});			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		////////////////////////////
		//	WRITE THE EXPORT HERE //
		////////////////////////////
		function writeExport(opt) {
				var master= $('body').find('#loaded-paradigm-item');
				master.html("");
				
				//paradigm-theme-colo : light / dark
				var design="light";
				if ($('input[name="paradigmlayout"]').val() ==1) design="dark";
				master.append('<div id="paradigm-main-slider" class="'+design+'" style="width:'+$("input[name=paradigmwidth]").val()+';position:relative;"></div>');
				master.find('#paradigm-main-slider').append('<ul></ul>');
				var ul = master.find('ul');
				
				// GO THROUGH THE SLIDES AND CREATE THE LI AND DEEPER TAGS
				$('body').find('#paradigm-panel .content .slide').each(function(i) {
					
					var $this=$(this);
					var ul = $('body').find('#paradigm-main-slider ul');					
					var transit = $this.find('.paradigm-transition .radio_selected').html();
					var descript = $this.find('.slidetitle').val();
					var imgsrc = $this.find('.slideurl').val();
					
					ul.append('<li data-Transition="'+transit+'" data-description="'+descript+'"><img src="'+imgsrc+'" data-thumb_bw="'+imgsrc+'" data-thumb="'+imgsrc+'"></li>');
					var li=ul.find('li:eq('+i+')');
					
					
					// FIND THE VIDEO SETTINGS HERE
					$this.find('.caption').each(function() {
						var $this=$(this);
						var videosrc = $this.find('.paradigmvideosource').val();
						var videohtml = $this.find('.paradigmvideotxt').val();
						videohtml=videohtml+'<div id="close"></div>';
						if (videosrc.length>0) {
							li.append('<div class="video_pradigm"><div class="video_paradigm_wrap"></div></div>');
							var videowrap=li.find('.video_paradigm_wrap');
							videowrap.append('<iframe class="video_clip" src="'+videosrc+'" width="'+(opt.height*1.7777)+'" height="'+opt.height+'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>');							
							videowrap.append(videohtml);
						};						
					});

					li.append('<div class="creative_layer"></div>');
					$this.find('.caption').each(function() {
						var cl=li.find('.creative_layer');
						var caption=$(this);
						var f=caption.data('f');
						if (f.id!=0) {
							var trans=caption.find('.radio_selected').data('transition');
							
							
							if (f.cimagesmall.find('img').attr('src').length>0) {
								var content='<img src="'+f.cimagesmall.find('img').attr('src')+'">';
								
								if (f.clink.find('.text-input').val().length>0) {
									content = '<a style="cursor:pointer" href="'+f.clink.find(".text-input").val()+'" target="'+f.ctarget.find(".text-input").val()+'">'+content+'</a>';
									
								}
								
								f.shadows="";
								f.pv = 0;
								f.ph = 0;
								f.cbga=0;
								f.newcolor="transparent";
								f.boxshadow=0;
							} else {
								var content = f.ctext.find('.text-input').val()
							}
							
							//if (f.newcolor=="transparent" || (parseInt(f.cbga.find('.text-input').html(),0)/100) == 0) f.boxshadow=0;
							
							
							var newcap = $('<div class="'+trans+'" style="top:'+f.y+'px;left:'+f.x+'px;">'+content+'</div>');							
							
						
							
							newcap.css({
									'position':'absolute',
									'color':f.ccolor.find('.picker').css('backgroundColor'),
									'padding-top':f.pv+'px',
									'padding-bottom':f.pv+'px',
									'padding-left':f.ph+'px',
									'padding-right':f.ph+'px',
									'font-size':f.fs+'px',
									//'font-size':'100%',
									'line-height':'1',
									//'line-height':'1.4em',
									'background-color':f.newcolor});
							
							
							if (f.cimagesmall.find('img').attr('src').length==0) { 							
								
								if ((parseInt(f.cbga.find('.text-input').html(),0)/100)==0) {
												
												newcap.css({'text-shadow':'#000 '+(f.boxshadow*8)+"px "+(f.boxshadow*8)+"px "+(f.boxshadow*16)+"px",
															 '-moz-box-shadow': '0px 0px 0px rgba(0, 0, 0, '+f.boxshadow+')',
															 '-webkit-box-shadow': '0px 0px 15px rgba(0, 0, 0, '+f.boxshadow+')',
															 'box-shadow': '0px 0px 0px rgba(0, 0, 0, '+f.boxshadow+')'});								
									 } else {
												newcap.css({'-moz-box-shadow': '10px 10px 15px rgba(0, 0, 0, '+f.boxshadow+')',
															'-webkit-box-shadow': '10px 10px 15px rgba(0, 0, 0, '+f.boxshadow+')',
															'box-shadow': '10px 10px 15px rgba(0, 0, 0, '+f.boxshadow+')'});								
									}
							}
							cl.append(newcap);																					
						}
					});
					
				});
				
				
				
				
				// SHOW HTML HERE 
			/*	var newtext=master.html();
				newtext = newtext.toLowerCase();
				newtext = newtext.replace('<ul>','\n<ul>');
				master.find('li').each(function() {
					newtext = newtext.replace('<li','\n     < li');						
					newtext = newtext.replace('<img','\n          < img');						
					newtext = newtext.replace('<div class="video_pradigm"','\n                <div class = "video_pradigm"');	
					newtext = newtext.replace('<div class="video_paradigm_wrap">','\n                      <div class = "video_paradigm_wrap">');	
					newtext = newtext.replace('<iframe','\n                        < iframe');						
					newtext = newtext.replace('</iframe','\n                        < /iframe');						
					newtext = newtext.replace('</li>','\n     </ li>\n');	
					newtext = newtext.replace('<div class=','\n           </div class');	
					
				});
				newtext = newtext.replace('</ul>','\n</ul>');
				
				$('body').append('<textarea style="z-index:99999999;position:fixed;width:900px;height:600px;top:50px;left:50px;font-size:12px;">'+newtext+'</textarea>');
				
				*/
				$("#tp_home_paradigm_source").text(master.html());
				jQuery('#tp_editor_form').submit();
		}
				
})(jQuery);			

				
			

			   