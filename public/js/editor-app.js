 /*
* $ Email Template Builder
* By: Asker ali
* Version : 1.0
* Created on : 07/Feb/2017
*
*
*  http://www.askeralik.com
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
(function($) {
	$.fn.emailEditor = function(options) {
		  var URL = window.URL || window.webkitURL;
		  var $image = $('#cropImage');
		  var $type  = '';
		  var cropBoxData;
		  var canvasData;		  
		  var $dataHeight = $('#dataHeight');
		  var $dataWidth  = $('#dataWidth');
		  var $dataRotate = $('#dataRotate');
		  var $dataScaleX = $('#dataScaleX');
		  var $dataScaleY = $('#dataScaleY');
		  
		  var originalImageURL = $image.attr('src');
		  var uploadedImageURL;
		  var $inputImage = $('#inputImage');
		  var $options = {
				viewMode: 1,
				dragMode: 'move',
				preview: '.img-preview',
				autoCropArea: 0,
				restore: false,
				guides: false,
				highlight: false,
				cropBoxMovable: false,
				cropBoxResizable: true,
				minCropBoxHeight: 200,
				minCropBoxWidth: 250,
				crop: function (e) {
				  $dataHeight.val(Math.round(e.height));
				  $dataWidth.val(Math.round(e.width));
				  $dataRotate.val(e.rotate);
				  $dataScaleX.val(e.scaleX);
				  $dataScaleY.val(e.scaleY);
				  	
				}
			  };
		  
		  var $currentImage;	  
		  var opts = $.extend({}, $.fn.emailEditor.defaults, options);
		
		//Image upload
		$('body').on('click', '.editimage', function (e) {
			
			var height = $(this).closest('td').height() ;
			var width = $(this).closest('td').width();
			
			//alert(width+" x "+height);
			
			
			$image.cropper('destroy');
			$currentImage = $(this);
			$this = $(this);
			$('#modalImageCrop').modal('show');
			$('#modalImageCrop').on('shown.bs.modal', function () {
				if(height > 0 &&  width > 0 ){
					$options.minCropBoxHeight = height;
					$options.minCropBoxWidth = width;
				}
				
				$image.attr('src',$this.attr('src')).cropper($options);
				
			}).on('hidden.bs.modal', function () {
				//cropBoxData = $image.cropper('getCropBoxData');
				//canvasData = $image.cropper('getCanvasData');
				$image.cropper('destroy');
			});
        });
		
		// Methods
 		$('.btn-primary').click(function () {
			var $this = $(this);
			var data = $this.data();
			var $target;
			var result;
		
			if ($this.prop('disabled') || $this.hasClass('disabled')) {
			  return;
			}
		
			if ($image.data('cropper') && data.method) {
			  data = $.extend({}, data); // Clone a new one
		
			  if (typeof data.target !== 'undefined') {
				$target = $(data.target);
		
				if (typeof data.option === 'undefined') {
				  try {
					data.option = JSON.parse($target.val());
				  } catch (e) {
					console.log(e.message);
				  }
				}
			  }
		
			  if (data.method === 'rotate') {
				$image.cropper('clear');
			  }
		
			  result = $image.cropper(data.method, data.option, data.secondOption);
				
			  if (data.method === 'rotate') {
				$image.cropper('crop');
			  }
		
			  switch (data.method) {
				case 'scaleX':
				case 'scaleY':
				  $(this).data('option', -data.option);
				  break;
		
				case 'getCroppedCanvas':
				  if (result) {
					var res_image = result.toDataURL('image/jpeg');
					var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
					$.ajax({url:opts.baseUrl+"templates/cropimage",
                                            data: { res_image : res_image, 
                                                    width : $options.minCropBoxWidth, 
                                                    height: $options.minCropBoxHeight,
                                                    _token: CSRF_TOKEN
                                                },
                                            type:"POST",
                                            dataType:"json"
					}).fail(function(error){
                                            alert("Error: something wrong happened !!!")
                                            window.location.reload();
					}).done(function(data){
                                            if(data.status == 'success'){
                                                if ($currentImage) {
                                                  $currentImage.attr('src', data.image_url).removeClass('imageChanged').addClass('imageChanged');
                                                  //alert("Image has been cropped successfully");
                                                  $currentImage.parent().before('<div class="active-image-tools"><a href="javascript:" class="image-settings" ><i class="fa fa-cog" aria-hidden="true"></i></a></div>');
                                                  $('#modalImageCrop').modal('hide');
                                                }
                                            }
					});
					
				  }
		
				  break;
		
				case 'destroy':
				  if (uploadedImageURL) {
					URL.revokeObjectURL(uploadedImageURL);
					uploadedImageURL = '';
					$image.attr('src', originalImageURL);
				  }
		
				  break;
			  }
		
			  if ($.isPlainObject(result) && $target) {
				try {
				  $target.val(JSON.stringify(result));
				} catch (e) {
				  console.log(e.message);
				}
			  }
		
			}
		  });
		  
		// Image uploade for crop
		
		  if (URL) {
			$inputImage.change(function () {
			  var files = this.files;
			  var file;
		
			  if (!$image.data('cropper')) {
				return;
			  }
		
			  if (files && files.length) {
				file = files[0];
		
				if (/^image\/\w+$/.test(file.type)) {
					
				  if (uploadedImageURL) {
					URL.revokeObjectURL(uploadedImageURL);
				  }
	
				  uploadedImageURL = URL.createObjectURL(file); 
				  $image.cropper('destroy').attr('src', uploadedImageURL).cropper($options);
				  $inputImage.val('');
				} else {
				  window.alert('Please choose an image file.');
				}
			  }
			});
		  } else {
			$inputImage.prop('disabled', true).parent().addClass('disabled');
		  }
		
		
		//Layer selection
		$('.layer-selection').click(function(e) {
                        var layer = $(this).data('file');
                        
			var type  = $(this).data('type');
                       // alert(opts.baseUrl+"uploads/layers/"+layer);
			$.get( opts.baseUrl+"uploads/layers/"+layer, function( data ) {
				
			  if($( "#editor_area section" ).length == 0){
			  	$( "#editor_area" ).html( data );
				
			  }
			  else{
			  	$( "#editor_area" ).append( data );
			  }
			  
			  $( '<div class="active-layer-tools"><a href="javascript:" class="handle" ><i class="fa fa-arrows" aria-hidden="true"></i></a><a href="javascript:" class="remove-layer" ><i class="fa fa-trash" aria-hidden="true"></i></a><a href="javascript:" class="edit-layer" ><i class="fa fa-edit" aria-hidden="true"></i></a></div>' ).insertBefore( "#editor_area section:last > div" );
			  $( "#editor_area" ).sortable({ handle: '.handle' }).disableSelection();
			  
			  _changeImageURL();
			  
			  //Editor Initialization
                          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			  $('.editable').editable(opts.baseUrl+"templates/save", { 
					type      : 'wysiwyg',
					event     : 'dblclick',
                                        submitdata:{_token: CSRF_TOKEN},
					data      :  function (value, settings) {
                                                            return $.trim(value);
                                                    }, 
					onblur    : 'ignore',
					tooltip	  : 'Double click for edit the content.',
					submit    : 'OK',
					cancel    : 'Cancel'/*,
					wysiwyg   : { controls : { separator04         : { visible : true },
											   insertOrderedList   : { visible : true },
											   insertUnorderedList : { visible : true }
								}
					}*/
				});
			  $('.editableTitle').editable(opts.baseUrl+"templates/save", { 
					type      : 'wysiwyg',
					event     : 'dblclick',
					data      : function (value, settings) {
						 return $.trim(value);
					}, 
					onblur    : 'ignore',
					tooltip	  : 'Double click for edit the content.',
					submit    : 'OK',
					cancel    : 'Cancel',
					wysiwyg   : { controls : { separator06 : { separator : true },

                                                    h1mozilla : { visible : true && $.browser.mozilla, className : 'h1', command : 'heading', arguments : ['h1'], tags : ['h1'] },
                                                    h2mozilla : { visible : true && $.browser.mozilla, className : 'h2', command : 'heading', arguments : ['h2'], tags : ['h2'] },
                                                    h3mozilla : { visible : true && $.browser.mozilla, className : 'h3', command : 'heading', arguments : ['h3'], tags : ['h3'] },

                                                    h1 : { visible : true && !( $.browser.mozilla ), className : 'h1', command : 'formatBlock', arguments : ['h1'], tags : ['h1'] },
                                                    h2 : { visible : true && !( $.browser.mozilla ), className : 'h2', command : 'formatBlock', arguments : ['h2'], tags : ['h2'] },
                                                    h3 : { visible : true && !( $.browser.mozilla ), className : 'h3', command : 'formatBlock', arguments : ['h3'], tags : ['h3'] }
                                            }
					}
				});
				
			   
	
			});
        });
		
		
		//## Active layer indication
		$('body').on('mouseenter', '.editor-area section', function (e) {
			$('.editor-area section').removeClass('active-layer');
			$(this).addClass('active-layer');
			$(this).find('a.remove-layer, a.edit-layer, a.handle').css({ 'display': 'block'});
		})
		$('body').on('mouseleave', '.editor-area section', function (e) {
			$(this).removeClass('active-layer');
			$(this).find('a.remove-layer, a.edit-layer, a.handle').css({ 'display': 'none'});
			
		})
		
		// Active image indicator
		$('body').on('mouseenter', 'img.editimage.imageChanged', function (e) {
			$(this).removeClass('active-layer');
			$(this).addClass('active-image');
			var target = $(this).parent();
			
			$(this).parent().prev().find('a.image-settings').css({ 'display': 'block'});
			
			//$(this).parent().prev().find('a.image-settings').css({ 'display': 'block'});	
				
			
		})
		$('body').on('mouseleave', '.editor-area section', function (e) {
			//$(this).removeClass('active-layer');
			$(this).find('img.editimage.imageChanged').removeClass('active-image');
			$(this).find('a.image-settings').css({ 'display': 'none'});
			
			
		})
		
		// Remove Layer
		$('body').on('click', 'a.remove-layer', function (e) {
			
			if($('.editor-area section').length > 1){
			$(this).closest('section').css("background-color","#E5E5E5").fadeOut(500, function(){ 
				$(this).remove();
			});
			}
		});
		
		// Image settings 		
		$('body').on('click', 'a.image-settings', function (e) {
			var $this = $(this);
			$('.image-tool').removeClass('hide');
			$('#fade').show(); 
			$type = $this.data('type')?$this.data('type'):'image';
			_assignImagePadding($this.closest('div').next('a').find('img.editimage.imageChanged'));
			_assignImageBorder($this.closest('div').next('a').find('img.editimage.imageChanged'));
			_assignImageLinkurl($this.closest('div').next('a').find('img.editimage.imageChanged'));
			
			setTimeout(function(){
				$this.closest('div').next('a').find('img.editimage.imageChanged').addClass('active-image');	
			}, 500);
			
		});
		
		// Edit Layer property
		$('body').on('click', 'a.edit-layer', function (e) {
			
			var $this = $(this);
			$('.container-tool').removeClass('hide');
			$('#fade').show();
			$type = $this.data('type')?$this.data('type'):'editor';
			
			_assignSectionPadding($this.closest('section'));
			_assignBgColor($this.closest('section'));
			_assignBorder($this.closest('section'));
			
			setTimeout(function(){
				$this.closest('section').addClass('active-layer');	
			}, 500);
		});
		
		// section applay button
		$('.applay-changes').click(function (e) {
			var pd_lt = $('#pd_lt').val()?$('#pd_lt').val()+"px":"0px";
			var pd_rt = $('#pd_rt').val()?$('#pd_rt').val()+"px":"0px";
			var pd_tp = $('#pd_tp').val()?$('#pd_tp').val()+"px":"0px";
			var pd_bt = $('#pd_bt').val()?$('#pd_bt').val()+"px":"0px";
			
			var bg_color = $('#bg_color').val(); 
			var brdw1 	 = $('#brd1').val();
			var brdw2 	 = $('#brd2').val();
			var brdw3 	 = $('#brd3').val();
			var brdw4 	 = $('#brd4').val();
			var brd_c 	 = $('#border_color').val(); 
			
			var align = $('#content_align').val()?$('#content_align').val():'left';
			
			
			$('.editor-area section.active-layer > div.containerTemp').css(
                            {"padding":pd_tp+" "+pd_rt+ " " +pd_bt+ " "+pd_lt,
                             "background-color": bg_color,
                             "border-top-width":brdw1+"px",
                             "border-right-width":brdw2+"px",
                             "border-bottom-width":brdw3+"px",
                             "border-left-width":brdw4+"px",
                             "border-color":brd_c,
                             "text-align":align});
			
			
				
			$('.close-popup').trigger( "click" );											  
			//$('.editor-area section.active-layer > div > .textEdit').html($('#content_edit').val());
			
		});
		
		// Image applay button
		$('.applay-changes2').click(function (e) {
			var pd_lt = $('#pd_lt2').val()?$('#pd_lt2').val()+"px":"0px";
			var pd_rt = $('#pd_rt2').val()?$('#pd_rt2').val()+"px":"0px";
			var pd_tp = $('#pd_tp2').val()?$('#pd_tp2').val()+"px":"0px";
			var pd_bt = $('#pd_bt2').val()?$('#pd_bt2').val()+"px":"0px";
			
			
			var brdw1 	 = $('#brd21').val();
			var brdw2 	 = $('#brd22').val();
			var brdw3 	 = $('#brd23').val();
			var brdw4 	 = $('#brd24').val();
			var brd_c 	 = $('#border_color2').val(); 
			
			var link_to  = $('#link_to2').val();
			
			$('img.editimage.imageChanged.active-image').css(
                            {"padding":pd_tp+" "+pd_rt+ " " +pd_bt+ " "+pd_lt,
                             "border-top-width":brdw1+"px",
                             "border-right-width":brdw2+"px",
                             "border-bottom-width":brdw3+"px",
                             "border-left-width":brdw4+"px",
                             "border-color":brd_c});
			
			
			$("img.editimage.imageChanged.active-image").closest('a.link').attr('href',link_to);
			
			$('.close-popup2').trigger( "click" );											  
			
		});
		
		//Close popup area 
		$('.close-popup').click(function (e) {
			$('#fade').hide();
			$('.container-tool').addClass('hide');
		});
		$('.close-popup2').click(function (e) {
			$('#fade').hide();
			$('.image-tool').addClass('hide');
		});
		
		//Close img upload popup area 
		$('.close-img-upload').click(function (e) {
			//$('#fade').hide();
			$('#modalImageCrop').modal("hide");
		});
		
		//Preview template
		$('#preview_template').click(function(e) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    var content = $('#editor_area').html();
			$.ajax({
			  type: "POST",
			  url: opts.baseUrl+'templates/createhtml',
			  data: {'content':content,_token: CSRF_TOKEN},
//                          dataType: 'JSON',
			  success: function(data){
                                if(data != 'error'){
                                        window.open(
                                          opts.baseUrl+"templates/draft/"+data,
                                          '_blank' // <- This is what makes it open in a new window.
                                        );

                                }
                                else{
                                        alert("Preview not available!, Please try later.");	
                                }
                         }
			});
			
        });
        
                //Save Template
                $('#save_template').click(function(e) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    var content = $('#editor_area').html();
			$.ajax({
			  type: "POST",
			  url: opts.baseUrl+'templates/savetemplate',
			  data: {'content':content,_token: CSRF_TOKEN},
                          dataType: 'JSON',
			  success: function(data){
                              console.log(data);
                                if(data.status == 'success'){
                                        window.open(
                                          opts.baseUrl+"uploads/draft/"+data+"/index.html",
                                          '_blank' // <- This is what makes it open in a new window.
                                        );

                                }
                                else{
                                        alert("Preview not available!, Please try later.");	
                                }
                         }
			});
			
                });
	
       $(window).scroll(function() {
           if($(window).scrollTop() > 50){
               $('.tool').css('top','8px');
               $('.tool').css('max-height','565px');
           
           }
           else{
              $('.tool').css('top','135px'); 
            }
        });
		
		
		//#### Common functions ######
		$('body').on('click', 'a.link', function (e) {
		    e.stopPropagation();
			return false;
		})
		
		_assignSectionPadding = function($element){
			var pd_lt = $element.find( "div.containerTemp" ).css( "padding-left").replace(/[^-\d\.]/g, '');
			var pd_rt = $element.find( "div.containerTemp" ).css( "padding-right").replace(/[^-\d\.]/g, '');
			var pd_tp = $element.find( "div.containerTemp" ).css( "padding-top").replace(/[^-\d\.]/g, '');
			var pd_bt = $element.find( "div.containerTemp" ).css( "padding-bottom").replace(/[^-\d\.]/g, '');
			
			$('#pd_lt').val(pd_lt);
			$('#pd_rt').val(pd_rt);
			$('#pd_tp').val(pd_tp);
			$('#pd_bt').val(pd_bt);
		};
		_assignBgColor = function($element){
			var bg = $element.find( "div.containerTemp" ).css( "background-color");
			$('#cp1').colorpicker({
				color: bg,
				format: "hex"
			});
		};
		
		_assignBorder = function($element){
			var brd1 = $element.find( "div.containerTemp" ).css( "border-top-width");
			var brd2 = $element.find( "div.containerTemp" ).css( "border-right-width");
			var brd3 = $element.find( "div.containerTemp" ).css( "border-bottom-width");
			var brd4 = $element.find( "div.containerTemp" ).css( "border-left-width");
			
			var brdc = $element.find( "div.containerTemp" ).css( "border-bottom-color");
			
			$('#brd1').val(parseInt(brd1));
			$('#brd2').val(parseInt(brd2));
			$('#brd3').val(parseInt(brd3));
			$('#brd4').val(parseInt(brd4));
			
			$('#cp2').colorpicker('destroy');
			$('#cp2').colorpicker({
				color: brdc,
				format: "hex"
			});
		};
		
		
		
		_changeImageURL = function(){
			$('#editor_area section:last img').each(function(index, element) {
				var url = $(this).attr('src');
                $(this).attr('src',opts.baseUrl+url)
            });
		};
		
		_assignImagePadding = function($element){
			
			var pd_lt = $element.css( "padding-left").replace(/[^-\d\.]/g, '');
			var pd_rt = $element.css( "padding-right").replace(/[^-\d\.]/g, '');
			var pd_tp = $element.css( "padding-top").replace(/[^-\d\.]/g, '');
			var pd_bt = $element.css( "padding-bottom").replace(/[^-\d\.]/g, '');
			
			$('#pd_lt2').val(pd_lt);
			$('#pd_rt2').val(pd_rt);
			$('#pd_tp2').val(pd_tp);
			$('#pd_bt2').val(pd_bt);
		};
		
		
		
		_assignImageBorder = function($element){
			var brd1 = $element.css( "border-top-width").replace(/[^-\d\.]/g, '');
			var brd2 = $element.css( "border-right-width").replace(/[^-\d\.]/g, '');
			var brd3 = $element.css( "border-bottom-width").replace(/[^-\d\.]/g, '');
			var brd4 = $element.css( "border-left-width").replace(/[^-\d\.]/g, '');
			
			var brdc = $element.css( "border-bottom-color");
			
			$('#brd21').val(parseInt(brd1));
			$('#brd22').val(parseInt(brd2));
			$('#brd23').val(parseInt(brd3));
			$('#brd24').val(parseInt(brd4));
			
			$('#cp3').colorpicker('destroy');
			$('#cp3').colorpicker({
				color: brdc,
				format: "hex"
			});
		};
		
		_assignImageLinkurl = function($element){
			
			var href = $element.closest('a.link').attr('href');
			$('#link_to2').val(href);
		};
		$.fn.emailEditor.defaults = {
			baseDir:'',
			baseUrl: ''
		}
	}
})(jQuery);
 
 


