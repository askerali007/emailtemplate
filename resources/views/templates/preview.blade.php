@extends('layouts.master')
    
@section('content')

<section class="content-header">
    <h1> Template preview </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="row">
                <div class=" col-md-8 col-xs-8 col-sm-0"> </div>
                <div class=" col-md-2 col-xs-2 col-sm-6">
                    <a target="_blank" href="#" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Open in new window</a></div> 
                <div class=" col-md-2 col-xs-2 col-sm-6">
                    <a href="javascript:history.back()" class="pull-right">&laquo;&nbsp;Back to list</a></div>
            </div>
        </div>
          <!-- /.box-header -->
          <div class="col-md-1 col-sm-12"></div>
          <div class="col-md-10 col-sm-12">
            <div class="box box-info box-solid">
              <div class="box-header with-border">
                <h3 class="box-title" data-toggle="tooltip" data-placement="top" data-original-title=""> 
		
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body text-center">
              <!-- Template Body Start here -->
                Template part
                <div class="clearfix"></div>
              </div>
              
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="col-md-1 col-sm-12"></div>
          <!-- /.box-body -->
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </section>

@endsection

