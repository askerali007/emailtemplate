@extends('layouts.master')

@section('content')
<section class="content">
    <div id="" class="box">
        <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
              
            <div class="box-header">
              <h1 class="box-title">Layout:</h1>
              <a href="javascript:" class="btn btn-primary preview pull-right" role="button" id="preview_template"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Preview</a>
            </div>
              
              <div class="col-xs-12">
                  
                  @if(session()->has('error'))
                  <div class="alert alert-error">
                    {{ session()->get('error') }}
                  </div>
                  @endif
                  @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
              </div>
          </div>
        </div>
        <div class="editor">
                <div class="col-lg-2 col-xs-12 tool">
                    @forelse($layers as $index=>$layer) 
                        <div class="layers">
                            <img src="{{URL::asset('uploads/layers/'.$layer->file.'.png')}}" title="{{$layer->name}}" data-file="{{$layer->file}}.html" class="layer-selection" data-type="editor" />
                        </div>
                    @empty
                    <div class="layers">There are no layers.</div>
                    @endforelse
                </div>
                <div class="col-lg-10 col-xs-12 ">
                    <div class="container-tool hide">
                        <a href="javascript:" class="close-popup" ><i class="fa fa-times" aria-hidden="true"></i></a>
                        <div class="padding-area">
                                <ul id="content_tabs" class="nav nav-pills" data-tabs="tabs">
                                    <!--<li class="active"><a href="#content" data-toggle="tab">Content</a></li>-->
                                    <li class="active"><a href="#style" data-toggle="tab">Style</a></li>
                                    <li><a href="#padding" data-toggle="tab">Padding</a></li>
                                    
                                </ul>                           
                               <div id="my-tab-content1" class="tab-content pd_tp30">
                                    <div class="tab-pane active" id="style">
                                        <div class="tab-content pd_tp30 pd_bt_10">
                                            <strong>Background color:</strong>
                                            <div id="cp1" class="input-group colorpicker-component colorpicker-element">
                                                <input type="text" value="#ffffff" class="form-control" id="bg_color" />
                                                <span class="input-group-addon"><i></i></span>
                                            </div>
                                        </div>
                                       <div class="tab-content">
                                       		
                                       		<strong>Border color:</strong>
                                            <div id="cp2" class="input-group colorpicker-component colorpicker-element">
                                                <input type="text" value="#ffffff" class="form-control" id="border_color" />
                                                <span class="input-group-addon"><i></i></span>
                                            </div>
                                            <div class="tab-content pd_8">
                                            <strong>Top border width:</strong>&nbsp;<input type="number" name="brd1" id="brd1" class="form-controll small-text" min="0" max="99" />px
                                       </div>
                                            <div class="tab-content pd_8">
                                                    <strong>Right border width:</strong>&nbsp;<input type="number" name="brd2" id="brd2" class="form-controll small-text" min="0" max="99"  />px
                                               </div>
                                       		<div class="tab-content pd_8">
                                            <strong>Bottom border width:</strong>&nbsp;<input type="number" name="brd3" id="brd3" class="form-controll small-text" min="0" max="99"  />px
                                       </div>
                                       	<div class="tab-content pd_8">
                                            <strong>Left border width:</strong>&nbsp;<input type="number" name="brd4" id="brd4" class="form-controll small-text" min="0" max="99" />px
                                       </div>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane" id="padding">
                                        
                                        <div class="row">
                                            <div class="col-lg-4 col-xs-4">&nbsp;</div>
                                            <div class="col-lg-4 col-xs-4 center "><label>Top</label>
                                                <input type="number" id="pd_tp" min="0" max="99" class="form-controll small-text">px
                                            </div>
                                            <div class="col-lg-4 col-xs-4">&nbsp;</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-xs-4 center"><label>Left</label>
                                                <input type="number" id="pd_lt" min="0" max="99" class="form-controll small-text" >px
                                            </div>
                                            <div class="col-lg-4 col-xs-4">&nbsp;</div>
                                            <div class="col-lg-4 col-xs-4 center"><label>Right</label>
                                                <input type="number" id="pd_rt" min="0" max="99" class="form-controll small-text" >px
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-xs-4">&nbsp;</div>
                                            <div class="col-lg-4 col-xs-4 center "><label>Bottom</label>
                                                <input type="number" id="pd_bt" min="0" max="99" class="form-controll small-text">px
                                            </div>
                                            <div class="col-lg-4 col-xs-4">&nbsp;</div>
                                        </div>
                                            
                                    </div>                                
                                    
                                    <div class="row pd_tp30">
                                            <div class="col-lg-12 col-xs-12 center"> &nbsp;</div>
                                            <div class="col-lg-12 col-xs-12 center">
                                                <p><a href="javascript:" class="btn btn-primary applay-changes" role="button">Applay</a> </p>
                                            </div>
                                        </div>
                                </div>
        
                              
                               
                        </div>
                    </div>
                    <div class="image-tool hide">
                        <a href="javascript:" class="close-popup2" ><i class="fa fa-times" aria-hidden="true"></i></a>
                        <div class="padding-area">
                                <ul id="image_tabs" class="nav nav-pills" data-tabs="tabs">                                    
                                    <li class="active"><a href="#style2" data-toggle="tab">Style</a></li>
                                    <li><a href="#padding2" data-toggle="tab">Padding</a></li>
                                    <li><a href="#link2" data-toggle="tab">Link</a></li>
                                    
                                </ul>                           
                               <div id="my-tab-content2" class="tab-content pd_tp30">
                                    
                                    <div class="tab-pane active" id="style2">
                                       <div class="tab-content">
                                       		<strong>Border color:</strong>
                                            <div id="cp3" class="input-group colorpicker-component colorpicker-element">
                                                <input type="text" value="#ffffff" class="form-control" id="border_color2" />
                                                <span class="input-group-addon"><i></i></span>
                                            </div>
                                            <div class="tab-content pd_8">
                                            <strong>Top border width:</strong>&nbsp;<input type="number" name="brd1" id="brd21" class="form-controll small-text" min="0" max="99" />px
                                       </div>
                                            <div class="tab-content pd_8">
                                                    <strong>Right border width:</strong>&nbsp;<input type="number" name="brd2" id="brd22" class="form-controll small-text" min="0" max="99"  />px
                                               </div>
                                       		<div class="tab-content pd_8">
                                            <strong>Bottom border width:</strong>&nbsp;<input type="number" name="brd3" id="brd23" class="form-controll small-text" min="0" max="99"  />px
                                       </div>
                                       	<div class="tab-content pd_8">
                                            <strong>Left border width:</strong>&nbsp;<input type="number" name="brd4" id="brd24" class="form-controll small-text" min="0" max="99" />px
                                       </div>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane" id="padding2">
                                        
                                        <div class="row">
                                            <div class="col-lg-4 col-xs-4">&nbsp;</div>
                                            <div class="col-lg-4 col-xs-4 center "><label>Top</label>
                                                <input type="number" id="pd_tp2" min="0" max="99" class="form-controll small-text">px
                                            </div>
                                            <div class="col-lg-4 col-xs-4">&nbsp;</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-xs-4 center"><label>Left</label>
                                                <input type="number" id="pd_lt2" min="0" max="99" class="form-controll small-text" >px
                                            </div>
                                            <div class="col-lg-4 col-xs-4">&nbsp;</div>
                                            <div class="col-lg-4 col-xs-4 center"><label>Right</label>
                                                <input type="number" id="pd_rt2" min="0" max="99" class="form-controll small-text" >px
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-xs-4">&nbsp;</div>
                                            <div class="col-lg-4 col-xs-4 center "><label>Bottom</label>
                                                <input type="number" id="pd_bt2" min="0" max="99" class="form-controll small-text">px
                                            </div>
                                            <div class="col-lg-4 col-xs-4">&nbsp;</div>
                                        </div>
                                            
                                    </div> 
                                    
                                    <div class="tab-pane" id="link2">   
                                    	<div class="form-group">
                                          <label for="usr">Link to:</label>
                                          <input type="text" class="form-control" id="link_to2" name="link_to" placeholder="http://www.example.com">
                                        </div>   
                                    </div>                               
                                    
                                    <div class="row pd_tp30">
                                            <div class="col-lg-12 col-xs-12 center"> &nbsp;</div>
                                            <div class="col-lg-12 col-xs-12 center">
                                                <p><a href="javascript:" class="btn btn-primary applay-changes2" role="button">Applay</a> </p>
                                            </div>
                                        </div>
                                </div>
        
                              
                               
                        </div>
                    </div>
                    <div id="editor_area" class="editor-area">
                    	<span class="demo">Add content by clicking side widgets.</span>
                    </div>
                   
                </div>
                 <div class="clearfix"></div>
            </div>
        
        <div class="clearfix"></div>
        </div>
    </div>
    <div class="modal fade" id="modalImageCrop" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
          <div class="image-crop modal-dialog" role="document">
              <div class="modal-content">
                  <!--<div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>-->
                <div class="modal-body"> 
                	<a href="javascript:" class="close-img-upload" ><i class="fa fa-times" aria-hidden="true"></i></a>         
                    <div class="row">
                        <div class="col-lg-9 col-xs-12">
                            <img id="cropImage" src="{{URL::asset('img/text-default.png')}}" alt="Picture" class="upload-image">
                            
                            <div class="col-lg-6 col-xs-12">
                                   
                                  <!--<div class="input-group input-group-sm">
                                    <label class="input-group-addon" for="dataScaleX">ScaleX</label>
                                    <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                                  </div>
                                  <div class="input-group input-group-sm">
                                    <label class="input-group-addon" for="dataScaleY">ScaleY</label>
                                    <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
                                  </div>-->
                                  <div class="input-group input-group-sm pd_tp30">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;zoom&quot;, 0.1)">
                                          <span class="fa fa-search-plus"></span>
                                        </span>
                                      </button>
                                      <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;zoom&quot;, -0.1)">
                                          <span class="fa fa-search-minus"></span>
                                        </span>
                                      </button>
                                    </div>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, -10, 0)">
                                          <span class="fa fa-arrow-left"></span>
                                        </span>
                                      </button>
                                      <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 10, 0)">
                                          <span class="fa fa-arrow-right"></span>
                                        </span>
                                      </button>
                                 </div>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 0, -10)">
                                          <span class="fa fa-arrow-up"></span>
                                        </span>
                                      </button>
                                      <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 0, 10)">
                                          <span class="fa fa-arrow-down"></span>
                                        </span>
                                      </button>
                                    </div>  
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;scaleX&quot;, -1)">
                                          <span class="fa fa-arrows-h"></span>
                                        </span>
                                      </button>
                                      <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;scaleY&quot;, -1)">
                                          <span class="fa fa-arrows-v"></span>
                                        </span>
                                      </button>
                                    </div>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, -45)">
                                          <span class="fa fa-rotate-left"></span>
                                        </span>
                                      </button>
                                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, 45)">
                                          <span class="fa fa-rotate-right"></span>
                                        </span>
                                      </button>
                                    </div>
                                  </div>                      
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="btn-group pd_tp30 pull-right">
                                    <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                    <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Import image with Blob URLs">
                                      <span class="fa fa-upload">&nbsp;Choose image</span>
                                    </span>
                                  </label>
                                </div><div class="clearfix"></div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-12 docs-data">
                      <div class="preview-thumb">
                        <div class="img-preview preview-lg"></div>
                            <div class="col-lg-12 col-xs-12">
                               Width : <input type="text" class="dataVal" id="dataWidth" placeholder="height">px <br/>
                               Height : <input type="text" class="dataVal" id="dataHeight" placeholder="height">px <br/>
                               Rotate : <input type="text" class="dataVal" id="dataRotate" placeholder="height">deg <br/>
                               
                            </div>
                            <div class="input-group pd_tp30 pull-right"> 
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>                    
                                      <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getCroppedCanvas&quot;)">
                                             <span class="fa fa-crop"></span>&nbsp;Crop 
                                            </span>
                                       </button>
                                      
                                  </div>
                            <!--<div class="col-lg-12 col-xs-12 pd_tp30">
                                <div class="input-group input-group-sm">
                                    <label class="input-group-addon" for="dataHeight">Link To</label>
                                    <input type="text" class="form-control" id="image_link" placeholder="Enter url">
                                </div>
                                <div class="input-group" style="width: 100%">
                                  <label>  <input type="checkbox"> Open link in a new tab </label>
                                </div>
                               
                                
                            </div>-->                           
                          </div>
                      </div>
                      			 
                    </div>       	
                    </div>              
                </div>
              </div>
            </div>
    <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
              </div>
            </div>
          </div>
        </div>
</section>
<script>
$(document).ready(function(e) {
    $('#content_tabs').tab();
	$('#image_tabs').tab();
	//$( "#editor_area" ).sortable();
	jQuery().emailEditor({	
		baseDir:'/',
		baseUrl: '{{URL::asset('') }}'
	});
});

</script>
<div id="fade" class="black_overlay"></div>
@endsection