/**
 * jQuery FIELDS Handler Plugin
 * @version: 1.1 (09.12.2011)
 * @requires jQuery v1.2.2 or later 
 * @author Krisztian Horvath
 * All Rights Reserved, use only in themepunch Templates or when Plugin bought at Envato ! 
**/




(function($,undefined){	
	
	
	//////////////////////////////////////
	// THE DROPDOWN PLUGIN STARTS HERE //
	////////////////////////////////////
	
	$.fn.extend({
	
		
		// OUR PLUGIN HERE :)
		dropdown: function(options) {
	
		
			
		////////////////////////////////
		// SET DEFAULT VALUES OF ITEM //
		////////////////////////////////
		var defaults = {	
			
		};
		
		options = $.extend({}, $.fn.dropdown.defaults, options);
		

		return this.each(function() {
		
			var opt=options;
			var dropdown=$(this);
			prepareLis(dropdown);	

			
		})
		
		
			
		
		//////////////////////		
		// SET THE LI ITEMS //
		/////////////////////
		function prepareLis(dd) {
			
			var ow = dd.find('.dropdownbutton').outerWidth();
			dd.find('ul').css({'width':ow+"px"});
			dd.css({'width':ow+'px'});
			if ($.browser.msie && $.browser.version < 9) { 										
				dd.find('ul:first').css({'margin':'0px'});
			}
			// FIRST WRAP SOME DIV AROUND THE LI ITEMS, AND MAKE THEM READY FOR SMALL TRANSITIONS
			dd.find('li').each(function(i) {
				var $this=$(this);
				
				$this.click(function() {
						var li = $(this);
						var ul = li.closest('ul');
						ul.find('>li').each(function() {
							$(this).removeClass('selected-dropdown');
						});
						li.addClass('selected-dropdown');
						ul.parent().find('.dropdownbutton').html(li.html());
						$('#'+dd.data('input').replace('[]','\\[\\]')).val(li.data('value'));
				});
				
				$this.wrapInner('<div class="listitem" style="position:relative;left:0px;"></div>');
				if ($.browser.msie && $.browser.version < 9) {											
					if (i==0) 	$this.css({'clear':'both','margin-top':'0px','padding-top':'0px'});					
															
					$this.css({'display':'none',
							   'opacity':'0.0',
							   'vertical-align':'bottom',							   							   
							   'top':'-20px'});		
					if ($.browser.msie && $.browser.version < 8) { 										
						$this.css({'width':$this.parent().parent().find('.buttonlight').width()});
						
					}
				} else {
				
					$this.css({'display':'none',
							   'opacity':'0.0',
							   'top':'-20px'});							   
				}
				
				var ind=$('#'+dd.data('input').replace('[]','\\[\\]')).val();
				
				dd.find('ul li').each(function() {
					if ($(this).data('value') == ind) $(this).click();
				});
			});
			
			
			
						
			// HOVER ON THE UL SHOULD SHOW THE LI ITEMS, IF LIS ARE VISIBLE ALREADY, OTHER WAY HIDE IT AFTER 100 MS
			dd.hover(
				function() {
					var $this=$(this);											
					// CREATE A SETTIMEOUT TO MAKE SURE IT NOT START DIRECTYL
					clearTimeout($this.data('timeout'));					
					
					$this.find('li').each(function(i) {
							var $this=$(this);
							$this.css({'display':'block'});
							clearTimeout($this.data('lianim'));
							if ($.browser.msie && $.browser.version < 9) {	
								setTimeout(function(){$this.cssAnimate({'top':'0px','opacity':'1.0'},{duration:10});},(i+1*2));						
							} else {
								setTimeout(function(){$this.cssAnimate({'top':'0px','opacity':'1.0'},{duration:300});},(i+1*80));						
							}
						});	
						checkHeight();												
				},
				function() {
					var $this=$(this);

					// CREATE A SETTIMEOUT TO MAKE SURE IT NOT START DIRECTYL
					clearTimeout($this.data('timeout'));
					$this.data('timeout',setTimeout( function() {
						$this.find('li').each(function(i) {
							var $this=$(this);					
							if ($.browser.msie && $.browser.version < 9) {	
								$this.cssAnimate({'top':'-20px','opacity':'0.0'},{duration:0});
								$this.data('lianim',setTimeout(function(){$this.css({'display':'none'})},10));
							} else {
								$this.cssAnimate({'top':'-20px','opacity':'0.0'},{duration:300});
								$this.data('lianim',setTimeout(function(){$this.css({'display':'none'})},400));							
							}
						});
					},300));
					checkHeight();
				}
			);			
		}	// END OF prepareLis FUNCTION 
		
		
	}
})









	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//												-	THE PLUGIN STARTS HERE	-
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
	
	////////////////////////////
	// THE MAIN PLUGIN //
	////////////////////////////
	
	$.fn.extend({
	
		
		// OUR PLUGIN HERE :)
		tpfields: function(options) {
	
		
			
		////////////////////////////////
		// SET DEFAULT VALUES OF ITEM //
		////////////////////////////////
		var defaults = {				
		};
		
		options = $.extend({}, $.fn.tpfields.defaults, options);
		

		return this.each(function() {
				
			var opt=options;
			var item=$(this);		
			
			addDragAndSlide();
			tp_setDrag();
			
			prepareAllInputs(item);
			//$('body').find('.unvisible').each(function() {$(this).removeClass('unvisible');});
			
			// CLONE ACCORDION ELEMENT IN CASE IT NECCESSARY
		/*	item.find('.addslide').click(function() {
				var $this=$(this);				
				var toclone=$('body').find('.slidetoclone');				
				toclone.parent().append(toclone.clone(true,true).removeClass('slidetoclone').addClass('newslideadded'));
				toclone.parent().find('.newslideadded').each(function() {
					var $this=$(this);
					$this.data('title',"fuck");
					alert($this.data('title'));
				});
				$this.appendTo($this.parent());
			}); */
		})
	}
})
										
		changeHeightSortable=function($sortable){
			jQuery("#adminleft").height($sortable.height()+200);
			jQuery("#adminright").find("#"+jQuery($currentdiv).attr("ref")).height($sortable.height()+180);
			
		}
		
		
		function prepareAllInputs(item) {
		
			console.log("Fields Plugin has been Called");
			// CREATE ACCORDION ELEMENTS
			item.find('.tp-accordion').each(function() {
					createAccordion($(this));
				});			
				
			// CREATE THE DROPDOWN LISTS
			item.find('.tp-dropdown').each(function () {
				var $this = $(this);				
				$this.dropdown({});	
			});
			
			
			// CREATE THE NUMMERIC INPUT FIELD TOOLS
			item.find('.tp-valuedrag').each(function() {
				$(this).click(function() {
					numInputClicked($(this));
				});
			});
			
			// SET UP THE COLORPICKER
			item.find('.tp-colorpicker .picker').click(function() {				
				$('body').data('tpfocusedfield',$(this));
			});
			
			item.find('.tp-colorpicker .picker').each(function() {
				colorSelector($(this));
			});
			
			
			// SET UP THE RADIO BUTTONS
			item.find('.tp-radio').each(function() {
				//alert(jQuery(this).closest("span").html());
				setRadios($(this));
			});
			
			
			// SET UP THE CHECK BOXES
			item.find('.tp-checkbox').each(function() {
				setCheckBox($(this))
			});
			
		}
		
		///////////////////////////////
		// BUILD OPEN / CLOSE SLIDES //
		///////////////////////////////
		function createAccordion(item) {
				
				if (item.data('accordionhasbeenset') == undefined) {
							item.data('accordionhasbeenset',1);
							
							console.log('Create Accordion');
							
							if (item.data('class') == "dark") 
								item.wrapInner('<div class="accordion slide-dark"></div>');
							else
								item.wrapInner('<div class="accordion slide-light"></div>');
								
							item.prepend('<div class="tp_collector_head"><div class="accordion-draghelper"><div class="title">'+item.data('title')+'</div></div></div>');				
							
							var entry = item.find('.tp_collector_head:first');
							
							// IF REMOVE BUTTON IS NECESSARY 
							if (item.data('remove')=="yes")
								entry.find('.accordion-draghelper:first').append('<div class="remove"></div>');
								
							entry.find('.accordion-draghelper:first').append('<div class="close"></div><div class="options"></div>');							
							
							var ops = entry.find('.options:first');			
							var close = entry.find('.close:first');				
							var remove = entry.find('.remove:first');	
							
							//close.data('item',item);
							//ops.data('item',item);
							
							// CLOSE / HIDE THE SLIDE SETTINGS
							close.click(function() {				
								var $this=$(this);
								var item = $this.parent().parent().parent();//var item = $this.data('item');
								var slide = item.find('.accordion:first');					
								/*slide.cssAnimate({'height':'0px','opacity':'0.0'},{duration:200,queue:false});
								slide.find('>*').hide('fast');*/
								slide.hide('fast');
								
								$this.hide();
								$this.parent().find('.options').show();	
								 setTimeout(function() {checkHeight()},300);
							});
							
							ops.click(function() {				
								var $this=$(this);
								var item = $this.parent().parent().parent();//$this.data('item');
								var slide = item.find('.accordion:first');	
								slide.show('fast');
			/*					slide.cssAnimate({'height':'auto','opacity':'1.0'},{duration:200,queue:false});
								
								slide.find('>*').each(function() {
									var $this=$(this);
									if (!$this.hasClass("unvisible")) $this.show('fast');
								});
								*/
								$this.hide('fast');
								$this.parent().find('.close').show();		
								setTimeout(function() {checkHeight()},300);
							});
							
							if (item.data('start') == "opened") {
								ops.hide();
								close.show();
							}
							
							if (item.data('start') == "closed") {
								ops.show();
								close.hide();
								close.click();
							}
				}
		}
										
        ///////////////////////////
		//	DRAG AND SLIDE PANEL //
		///////////////////////////
		function addDragAndSlide() {
			if ($('body').find('#tp_dragset').length==0)
				$('body').append('<div id="tp_dragset" style="display:none"><div class="tp_slidebar"><div class="tp_dragme"></div></div><div class="ok"></div></div>');
		}
		
		
		////////////////////
		// DRAG FUNCTIONS //
		///////////////////
		function tp_setDrag() {
			var drag=$('body').find('#tp_dragset .tp_dragme');
			drag.draggable({
											zIndex: 1000,
											ghosting: false,
											axis:'x',
											containment: 'parent',
											revert: false,
											opacity: 1,
											drag:function() {		
											
												var item=$('body').data('tpfocusedfield');
												var addon=$('body').data('tpfocusedfield-add');
												var drag=$('body').find('#tp_dragset .tp_dragme');
												
												var proc=drag.position().left / (drag.parent().width()-12);
												
												var min = $('body').data('tpdragminimum');
												var max = $('body').data('tpdragmaximum');												
												var act = Math.round((max-min) * proc) + min;															
												var step = $('body').data('tpdragstep');
												//console.log("Min:"+min+"  Max:"+max+"   DragPos:"+drag.position().left+'  Proc:'+proc+'  Step:'+step+" act:"+act);
												act = Math.round(act/step)*step;
												item.val(act+addon);												
												
											}
										});
		}
		
		
		
		
		////////////////////
		// 	tp_dragset PANEL //
		////////////////////
		function addtp_dragset(item) {
			
			
			
			$('body').find('#tp_dragset').css({'display':'block', 'position':'absolute', 'left':(parseInt(item.offset().left,0)-55)+"px" , 'top':(parseInt(item.offset().top,0)+65)+"px"});
			
			$('body').append('<div class="adminpanel-overlay"></div>');
			var overlay=$('body').find('.adminpanel-overlay');
						
			var targetOpacity = overlay.css('opacity');
			
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
				$('body').find('#tp_dragset').css({'display':'none'});
				$(this).remove();
				var addon=$('body').data('tpfocusedfield-add');
				$('body').data('tpfocusedfield').val($('body').data('tpfocusedfield-value')+addon);				
			});
			
			
			var drag=$('body').find('#tp_dragset .tp_dragme');			
			var min = $('body').data('tpdragminimum');			
			var max = $('body').data('tpdragmaximum');			
			var val = $('body').data('tpfocusedfield-value');									
									
			var newpos = ((val / ((max-min)+min))*130)-12;			
			
			//console.log("Min:"+min+"   Max:"+max+"   Val:"+val+"   NewPos:"+newpos);
			
			if (newpos<0) newpos = 0;
			drag.css({'left':newpos+"px"});
			
			var ok=$('body').find('#tp_dragset .ok');
			ok.click(function() {
				$('body').find('#tp_dragset').css({'display':'none'});
				var item=$('body').data('tpfocusedfield');				
				$('body').find('.adminpanel-overlay').remove();
				item.change();
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
					
					
		
		////////////////////////////////
		// CLICK ON SOME NUMBER INPUT //
		////////////////////////////////
		function numInputClicked(field) {			                	
				if (field.data('addon') == undefined || !field.data('addon').length>0) field.data('addon'," ");
				$('body').data('tpfocusedfield',field);
				$('body').data('tpfocusedfield-add',field.data('addon'));				
				$('body').data('tpdragstep',parseInt(field.data('step'),0));								
				$('body').data('tpfocusedfield-value',parseInt(field.val(),0));				
				$('body').data('tpdragminimum',parseInt(field.data('min'),0));								
				$('body').data('tpdragmaximum',parseInt(field.data('max'),0));				
				addtp_dragset(field);
		}
		
		
		
		
		//////////////////////////
		//	THE COLOR SELECTORS	//
		//////////////////////////
		function colorSelector(item) {			
			
			item.each(function(){
				$this = $(this);
				$this.css({'background-color':$('input[name='+$this.data('input').replace('[]','\\[\\]')+']').val()});
			});
			var col = $('input[name='+item.data('input').replace('[]','\\[\\]')+']').val();
			item.ColorPicker({							
							color: col,
							onShow: function (colpkr) {
								
								$(colpkr).fadeIn(500);
								return false;
							},
							onHide: function (colpkr) {
								$(colpkr).fadeOut(500);
								return false;
							},
							
							onChange: function (hsb, hex, rgb) {								
								var item=$('body').data('tpfocusedfield')								
								item.css({'backgroundColor':'#'+hex});													
								$('input[name='+item.data('input').replace('[]','\\[\\]')+']').val("#"+hex);
							}
					});							
		}						
		
		
		//////////////////////////////
		// SET UP THE RADIO BUTTONS //
		//////////////////////////////
		function setRadios(radios) {			
			//Dirk -> .replace('[]','\\[\\]')+']') wegen Array Feldern
			radios.find('.radio').click(function() {
				var $this=$(this);
				$this.siblings('.radio').removeClass('radio_selected');
				$this.addClass('radio_selected');
				//alert($this.parent().data('input').replace('[]','\\[\\]'));
				$('body').find('#'+$this.parent().data('input').replace('[]','\\[\\]')).val($this.data('value'));
			});
			
			
				var $radionbuttons = radios.closest("span");
				var ind = $radionbuttons.find('.radioinput').val();
				//alert(ind);
				$radionbuttons.find('.radio').each(function() {
					var $this=$(this);
					if ($this.data('value') == ind) {
						$this.click();
					}
				});

			
		}
		
		
		
		//////////////////////////////
		// SET UP THE RADIO BUTTONS //
		//////////////////////////////
		function setCheckBox(check) {			
		
			
			if (check.data('clickfunctionadded')!=1) {
					check.live("click",function() {
						var check=$(this);				
						if (check.hasClass('checkbox_on')) {
							check.removeClass('checkbox_on');
							if ($('#'+check.data('input').replace('[]','\\[\\]')).val() == true)						
									  $('#'+check.data('input').replace('[]','\\[\\]')).val("true")
								else
								  if ($('#'+check.data('input').replace('[]','\\[\\]')).val() == false)
									  $('#'+check.data('input').replace('[]','\\[\\]')).val("false")
									else
									  $('#'+check.data('input').replace('[]','\\[\\]')).val(check.data('off'))
									  
							check.html(check.data('off'));
							
							
						} else {
							check.addClass('checkbox_on');
							if ($('#'+check.data('input').replace('[]','\\[\\]')).val() == true)						
									  $('#'+check.data('input').replace('[]','\\[\\]')).val("true")
								else							  
								  if ($('#'+check.data('input').replace('[]','\\[\\]')).val() == false)
									  $('#'+check.data('input').replace('[]','\\[\\]')).val("false")
									else
									  $('#'+check.data('input').replace('[]','\\[\\]')).val(check.data('on'))
									  
							check.html(check.data('on'));
							
						}
						
					});
					check.data('clickfunctionadded',1);
			};
			
			var ind = $('#'+check.data('input').replace('[]','\\[\\]')).val();			
			
			if (ind==check.data('off')) {
				check.removeClass('checkbox_on');
				check.html(check.data('off'));
			} else {
				check.addClass('checkbox_on');
				check.html(check.data('on'));
			}
			
			
			
		}
		
		
		//////////////////////////////
		// SET UP THE RADIO BUTTONS //
		//////////////////////////////
		function setCheckBox_Dirk(check) {			
		
			
			
			check.click(function() {
				var check=$(this);
				
				if (check.hasClass('checkbox_on')) {
					check.removeClass('checkbox_on');
					if (check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val() == true)						
							  check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val("true")
						else
						  if (check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val() == false)
							  check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val("false")
						    else
							  check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val(check.data('off'))
							  
					check.html(check.data('off'));
					
					
				} else {
					check.addClass('checkbox_on');
					if (check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val() == true)						
							  check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val("true")
						else							  
						  if (check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val() == false)
							  check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val("false")
						    else
							  check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val(check.data('on'))
							  
					check.html(check.data('on'));
					
				}
				
			});
			
			var ind = check.closest("span").find('input[name='+check.data('input').replace('[]','\\[\\]')+']').val();			
			
			if (ind==check.data('off')) {
				check.removeClass('checkbox_on');
				check.html(check.data('off'));
			} else {
				check.addClass('checkbox_on');
				check.html(check.data('on'));
			}
			
			
			
		}


})(jQuery);			