@extends('layouts.master')
    
@section('content')
<section class="content">
    
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              
            <div class="box-header">
              <h3 class="box-title">User List</h3>
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
             
            <!-- /.box-header -->
            
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                
                  <div class="row">
                      <div class="col-sm-6">
                        <form name="form-user" class="form-bulk-action" action="{{URL::asset('/users')}}" method="get" >
                        <div class="input-group">
                        @if(count($actions) > 0 )
                           {{ Form::select('action', $actions, 
                                    Request::input('action'), array(
                                        'class' => 'form-control bulk-action',
                                        'id' => 'bulk_action'
                                    )) }}
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default apply-btn">Apply</button>                
                            </span>
                        @endif
                        </div>
                            <input type="hidden" name="ids" id="ids" value="" />
                        </form>
                      </div>
                      <div class="col-sm-3">
                        <form name="form-user" class="form-filter" action="{{URL::asset('/users')}}" method="post" >
                        <div class="input-group">
                           {{ Form::select('status', ['all'=>'All Status','published'=>'Published','draft'=>'Drafted','trashed'=>'Trashed'], 
                                    $status , array(
                                        'class' => 'form-control input-md filter-status',
                                        'id' => 'bulk_action'
                                    )) }}
                            <span class="input-group-btn pd_l">
                                <button type="submit" class="btn btn-default filter-btn">Filter</button>                
                            </span>
                          </div>
                        </form>
                      </div>
                      <div class="col-sm-3">
                          
                          <div id="example1_filter" class="dataTables_filter pull-right">
                              <label>
                                  <form name="form-user" class="form-search-list" action="" method="get" >
                                  <div class="input-group">
                                    {{ Form::text('s', Request::input('s'), array(
                                        'class' => 'form-control',
                                        'id' => 'search_data',
                                        'placeholder' => 'Search'
                                    )) }}
                                 
                                  <span class="input-group-btn">
                                    <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                  </span>
                                  </div>
                                  </form>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                  <th width="5%" class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=""><input type="checkbox" class="check_all" /></th>
                  <th width="25%" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Name</th>
                  <th width="30%" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Email address: activate to sort column ascending">Email ID</th>
                  <th width="20%" class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Mobile number">Mobile</th>
                  <th width="14%" class=" " tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="User Role">Role</th>
                  <th width="6%" class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="ID">User ID</th></tr>
                </thead>
                <tbody>
                @forelse($users as $i=>$user)
                    <tr role="row" class="odd">
                        <td class="sorting_1"><input type="checkbox" value="{{$user->id}}"  class="check_id" /></td>
                      <td><a href="{{URL::asset("user/view/$user->id")}}" title="Edit user" >{{$user->name}}</a>
                      @if($user->status == 'draft')
                      &nbsp;&nbsp;({{ucfirst($user->status)}})
                      @endif
                      </td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->phone}}</td>
                      <td>{{$user->role}}</td>
                      <td align="right">{{$user->id}}</td>
                    </tr>
                @empty
                    <tr role="row" class="odd">
                        <td colspan="6">There are no record found.</td>
                    </tr> 
                @endforelse
                
                </tbody>
              </table></div></div>
                  <div class="row">
                  <div class="col-sm-5">
                      <form name="form-user" class="form-data-list" action="" method="get" >
                        <div class="dataTables_length" id="example1_length" style="margin-top: 20px;">
                              <label> 
                                  {{ Form::hidden('s', Request::input('s'), array(
                                        'class' => 'form-control'
                                    )) }}
                                  {{ Form::select('limit', ['5'=>5,'10'=>10,'25'=>25,'50'=>50,'100'=>100], 
                                    $filter['limit'], array(
                                        'class' => 'form-control input-sm page-limit',
                                        'id' => 'page_limit'
                                    )) }}
                                    &nbsp;Showing {{(($users->currentPage()-1)*$users->perPage())+1}} to {{(($users->currentPage()-1)*$users->perPage())}} of {{$users->total()}} entries 
                                    </label>
                        </div>
                      </form>
                  </div>
                  <div class="col-sm-7">
                      <div class="dataTables_paginate paging_simple_numbers pull-right" id="example1_paginate">
                         {{$users->render()}}
                       </div>
                          
                  </div>
                  
              </div></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

@endsection