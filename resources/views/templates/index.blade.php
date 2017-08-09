@extends('layouts.master')

@section('content')

<section class="content">
    <div class="box ">
        <div class="box-body">
      <div class="row">
        <div class="col-xs-9">
              
            <div class="box-header">
              <h3 class="box-title">Template List</h3>
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
          <div class="col-sm-3">
            <form name="form-user" class="form-filter" action="{{URL::asset('/templates')}}" method="get" >
            <div class="input-group">
               {{ Form::select('user', $users, 
                        Request::input('user') , array(
                            'class' => 'form-control input-md filter-status',
                            'id' => 'user_filter',
                            'placeholder'=>'Please select'
                        )) }}
                <span class="input-group-btn pd_l">
                    <button type="submit" class="btn btn-default ">Filter</button>                
                </span>
              </div>
            </form>
          </div>
        </div>
    
        <div class="row">
        @forelse($templates as $key=>$template)
            <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="box box-info box-solid"> 
                        <div class="box-header with-border">
                           
                          <h3 class="box-title" data-toggle="tooltip" data-placement="top" data-original-title="{{$template->name}}">{{$template->name}}</h3>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body text-center  templ-box">
                           
                         <a data-toggle="tooltip" href="javascript:" data-placement="top" data-original-title="Click Here to Preview">
                      <div class="widget-body"> 
                          <img src="{{{ URL::asset('uploads/templates/'.$template->id.'/screenshot.png')}}}" style="max-height: 280px;" id="tempate_id" class="thumbnailimage"> </div>
                     	 </a>
                            <center>Author : {{$template->owner}}</center>
                        </div>
                        <div class="box-footer "> 
                            
                            <div class="col-md-4 center">
                          	<a href="{{URL::asset('/templates/draft')}}" class="templ-action rborder" data-toggle="tooltip" data-placement="top" data-original-title="Draft templates"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>(2)</a>
                            </div> 
                            <div class="col-md-4 center">
                          	<a href="{{URL::asset('/templates/finalized')}}" class="templ-action rborder" data-toggle="tooltip" data-placement="top" data-original-title="Finalized templates" ><i class="fa fa-file-text" aria-hidden="true"></i>(3)</a>
                            </div>
                            <div class="col-md-4 center">
                          	<a href="{{URL::asset('/templates/preview/'.$template->id)}}" class="templ-action" data-toggle="tooltip" data-placement="top" data-original-title="Preview" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </div>    
                          </div>
                        <!-- /.box-body -->
                      </div>
                </div>
        @empty
        <div class="col-xs-12 col-sm-12 col-md-12">There are no record found.</div>
        @endforelse
        
           
     </div>
    </div>
   </div>
</section>

@endsection