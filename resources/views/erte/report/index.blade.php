@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Report 
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/report">Report</a></li>
            <li class="active">Index</li>
          </ol>
  </section>
 @endsection

@section('content') 
    <section class="content">
      <div class="box">
        <div class="box-body">
          <!-- <div class="box"> -->
              @include('messages')
          
              <form method="post" action="/report/show">
                        {{ csrf_field() }}
                  <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6">
                          <label>From</label>
                            <div class='input-group date' id='date2'>
                              <input type='text' class="form-control" name="startDate" value="{{  old('startDate') }}" />
                                <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                              @if($errors->has('startDate'))
                                <div class="text-danger">
                                  {{ $errors->first('startDate')}}
                                </div>
                              @endif

                        <div class="col-sm-6">
                          <label>To</label>
                            <div class='input-group date' id='date3'>
                              <input type='text' class="form-control" name="endDate" value="{{  old('endDate') }}" />
                                <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                              @if($errors->has('endDate'))
                                <div class="text-danger">
                                  {{ $errors->first('endDate')}}
                                </div>
                              @endif                              
                      </div>
                  </div>
                              
                      <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="Print">
                      </div>                     
                </form>            

        </div>
        <div class="box-footer">
        </div>        
      </div>    
   </section>
    
@endsection