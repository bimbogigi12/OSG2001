jQuery( document ).ready(function($) {
			//recycle bin functions
			
			
			$(".sp-addon-activate").on("submit",function(){
		
		var form_data = $( this ).serializeArray();
		console.log(form_data);
			jQuery.post(ajaxurl,form_data, function(response) {
					var obj = $.parseJSON(response);
				
					if(obj.error != ''){
						
					$('.sp-rm-license-message-'+obj.post.slug).html('<p style="color:red">'+ obj.error+'</p>');	
					}else{
					
					
					var container = $('.sprm-addon-container-'+obj.post.slug);	
					
					console.log(obj.result.license);
					if(obj.result.license == 'valid'){
					$('.sp-rm-license-message-'+obj.post.slug).html('<p style="color:green">License Active! Expires: '+ obj.result.expires+'</p>');	
					$(".sprm-activate-button",container).val('Deactivate');
					$(".set_action",container).val('deactivate_license');
					}else{
					$('.sp-rm-license-message-'+obj.post.slug).html('<p style="color:red">License not activated.</p>');		
					$(".sprm-activate-button",container).val('Activate');
					$(".set_action",container).val('activate_license');
					}
					}
				});
		
		
		return false;
	});
			
			
			$('.cdm-recycled-item-view').on('click',function(){
			$('.recycle-bin-remove-content').html('<div style="text-align:center;padding:40px" class="sp-cdm-loading"><img src="'+ sp_vars.plugin_url+ '/images/loading.gif" ></div>');
				var item_id = $(this).attr('data-id');
				var item_type = $(this).attr('data-type');
			 console.log(this);
			 
			
						
						var inst = $('[data-remodal-id=recycle-bin-remove]').remodal();
		
						inst.open();
						
						
						
			jQuery.post(ajaxurl,{
				'action': 'cdm_admin_view_recycled_item',
				'type':item_type  ,
				'id': item_id
			}, function(response) {
					$('.recycle-bin-remove-content').html(response);
			});
						
			 return false;
			});
	
	
	
			$( document ).on( "click", ".cdm-recycle-function", function() {
				
					var item_id = $(this).attr('data-id');
					var item_type = $(this).attr('data-type');
					var item_method = $(this).attr('data-method');
					
					if(item_method == 'delete'){
						
						var item_message = 'Are you sure you want to delete this item for good? There is no going back!';
					}else{
						var item_message = 'Are you sure you want to restore this item?';
					}
					
					if (confirm(item_message)) {
					
					
			if(item_method == 'delete'){
			var action = 'cdm_admin_view_delete_object';	
			}else{
			var action = 'cdm_admin_view_restore_object';	
			}
				jQuery.post(ajaxurl,{
					'action': action,
					'type':item_type  ,
					'id': item_id
				}, function(response) {
						obj = $.parseJSON(response);
						alert(obj.message );
						location.reload();

						
						
				});
					
					
					} else {
						// Do nothing!
					}
	
				
			
				
				
				return false;
			});
			
			
			function cdm_empty_recycle_bin(){
				
				jQuery.post(ajaxurl,{
					'action': 'cdm_admin_view_empty_recycle_bin'
				}, function(response) {
						var obj = $.parseJSON(response);
						if(obj.rerun == 1){
							
							cdm_empty_recycle_bin();
							
							$(".cdm-recycle-bin-output").html('<div class="sp_cdm_success">'+ obj.total_items+ ' Items left to remove</div>');
						}else{
								
						alert(obj.message );
						location.reload();
						}

						
						
				});
							
				
				
			}
			$( document ).on( "click", ".cdm-empty-recycle-bin", function() {
				
					if (confirm('Are you sure you want to empty the recycle bin? All folders in recycle bin will be lost and not recoverable.')) {
						
						cdm_empty_recycle_bin();
						
					}else{
						
					}
				return false;
			});
			
			
			$( document ).on( "click", ".cdm-restore-recycle-bin", function() {
				
					if (confirm('Are you sure you want to restore the recycle bin? All files will be restored and added back to their respective places!')) {
						
							jQuery.post(ajaxurl,{
					'action': 'cdm_admin_view_restore_recycle_bin'
				}, function(response) {
						obj = $.parseJSON(response);
						alert(obj.message );
						location.reload();

						
						
				});
						
						
					}else{
						
					}
				return false;
			});
	
	});	
	//end recycle bin
	



(function(a){var b={vertical:false,menuItemSelector:"li",menuGroupSelector:"ul",rootClass:"potato-menu",menuItemClass:"potato-menu-item",menuGroupClass:"potato-menu-group",verticalClass:"potato-menu-vertical",holizontalClass:"potato-menu-holizontal",hasVerticalClass:"potato-menu-has-vertical",hasHolizontalClass:"potato-menu-has-holizontal",hoverClass:"potato-menu-hover",showDuration:350,hideDuration:100};function c(){var e=(typeof(arguments[0])!="string")?a.extend(b,arguments[0]):a.extend(b,{});var d=a(this).addClass(e.rootClass+" "+e.menuGroupClass).addClass((e.vertical)?e.verticalClass:e.holizontalClass);var g=d.find(e.menuItemSelector).addClass(e.menuItemClass);var f=d.find(e.menuGroupSelector).addClass(e.menuGroupClass);g.hover(function(h){a(this).addClass(e.hoverClass)},function(h){a(this).removeClass(e.hoverClass)});f.parent().each(function(h){var k=a(this);var i=(k.parent().hasClass(e.holizontalClass))?"bottom":"right";k.addClass((i=="bottom")?e.hasVerticalClass:e.hasHolizontalClass);var j=k.find(e.menuGroupSelector+":first").addClass(e.verticalClass);k.hover(function(l){var m=(i=="bottom")?{left:"0",top:""}:{left:a(this).width()+"px",top:"0"};j.css({left:m.left,top:m.top}).fadeIn(e.showDuration)},function(l){j.fadeOut(e.hideDuration)})});d.find('a[href^="#"]').click(function(){f.fadeOut(e.hideDuration);return(a(this).attr("href")!="#")});return this}a.fn.extend({ptMenu:c})})(jQuery);

(function($){$.fn.tipTip=function(options){var defaults={activation:"hover",keepAlive:false,maxWidth:"200px",edgeOffset:3,defaultPosition:"bottom",delay:400,fadeIn:200,fadeOut:200,attribute:"title",content:false,enter:function(){},exit:function(){}};var opts=$.extend(defaults,options);if($("#tiptip_holder").length<=0){var tiptip_holder=$('<div id="tiptip_holder" style="max-width:'+opts.maxWidth+';"></div>');var tiptip_content=$('<div id="tiptip_content"></div>');var tiptip_arrow=$('<div id="tiptip_arrow"></div>');$("body").append(tiptip_holder.html(tiptip_content).prepend(tiptip_arrow.html('<div id="tiptip_arrow_inner"></div>')))}else{var tiptip_holder=$("#tiptip_holder");var tiptip_content=$("#tiptip_content");var tiptip_arrow=$("#tiptip_arrow")}return this.each(function(){var org_elem=$(this);if(opts.content){var org_title=opts.content}else{var org_title=org_elem.attr(opts.attribute)}if(org_title!=""){if(!opts.content){org_elem.removeAttr(opts.attribute)}var timeout=false;if(opts.activation=="hover"){org_elem.hover(function(){active_tiptip()},function(){if(!opts.keepAlive){deactive_tiptip()}});if(opts.keepAlive){tiptip_holder.hover(function(){},function(){deactive_tiptip()})}}else if(opts.activation=="focus"){org_elem.focus(function(){active_tiptip()}).blur(function(){deactive_tiptip()})}else if(opts.activation=="click"){org_elem.click(function(){active_tiptip();return false}).hover(function(){},function(){if(!opts.keepAlive){deactive_tiptip()}});if(opts.keepAlive){tiptip_holder.hover(function(){},function(){deactive_tiptip()})}}function active_tiptip(){opts.enter.call(this);tiptip_content.html(org_title);tiptip_holder.hide().removeAttr("class").css("margin","0");tiptip_arrow.removeAttr("style");var top=parseInt(org_elem.offset()['top']);var left=parseInt(org_elem.offset()['left']);var org_width=parseInt(org_elem.outerWidth());var org_height=parseInt(org_elem.outerHeight());var tip_w=tiptip_holder.outerWidth();var tip_h=tiptip_holder.outerHeight();var w_compare=Math.round((org_width-tip_w)/2);var h_compare=Math.round((org_height-tip_h)/2);var marg_left=Math.round(left+w_compare);var marg_top=Math.round(top+org_height+opts.edgeOffset);var t_class="";var arrow_top="";var arrow_left=Math.round(tip_w-12)/2;if(opts.defaultPosition=="bottom"){t_class="_bottom"}else if(opts.defaultPosition=="top"){t_class="_top"}else if(opts.defaultPosition=="left"){t_class="_left"}else if(opts.defaultPosition=="right"){t_class="_right"}var right_compare=(w_compare+left)<parseInt($(window).scrollLeft());var left_compare=(tip_w+left)>parseInt($(window).width());if((right_compare&&w_compare<0)||(t_class=="_right"&&!left_compare)||(t_class=="_left"&&left<(tip_w+opts.edgeOffset+5))){t_class="_right";arrow_top=Math.round(tip_h-13)/2;arrow_left=-12;marg_left=Math.round(left+org_width+opts.edgeOffset);marg_top=Math.round(top+h_compare)}else if((left_compare&&w_compare<0)||(t_class=="_left"&&!right_compare)){t_class="_left";arrow_top=Math.round(tip_h-13)/2;arrow_left=Math.round(tip_w);marg_left=Math.round(left-(tip_w+opts.edgeOffset+5));marg_top=Math.round(top+h_compare)}var top_compare=(top+org_height+opts.edgeOffset+tip_h+8)>parseInt($(window).height()+$(window).scrollTop());var bottom_compare=((top+org_height)-(opts.edgeOffset+tip_h+8))<0;if(top_compare||(t_class=="_bottom"&&top_compare)||(t_class=="_top"&&!bottom_compare)){if(t_class=="_top"||t_class=="_bottom"){t_class="_top"}else{t_class=t_class+"_top"}arrow_top=tip_h;marg_top=Math.round(top-(tip_h+5+opts.edgeOffset))}else if(bottom_compare|(t_class=="_top"&&bottom_compare)||(t_class=="_bottom"&&!top_compare)){if(t_class=="_top"||t_class=="_bottom"){t_class="_bottom"}else{t_class=t_class+"_bottom"}arrow_top=-12;marg_top=Math.round(top+org_height+opts.edgeOffset)}if(t_class=="_right_top"||t_class=="_left_top"){marg_top=marg_top+5}else if(t_class=="_right_bottom"||t_class=="_left_bottom"){marg_top=marg_top-5}if(t_class=="_left_top"||t_class=="_left_bottom"){marg_left=marg_left+5}tiptip_arrow.css({"margin-left":arrow_left+"px","margin-top":arrow_top+"px"});tiptip_holder.css({"margin-left":marg_left+"px","margin-top":marg_top+"px"}).attr("class","tip"+t_class);if(timeout){clearTimeout(timeout)}timeout=setTimeout(function(){tiptip_holder.stop(true,true).fadeIn(opts.fadeIn)},opts.delay)}function deactive_tiptip(){opts.exit.call(this);if(timeout){clearTimeout(timeout)}tiptip_holder.fadeOut(opts.fadeOut)}}})}})(jQuery);