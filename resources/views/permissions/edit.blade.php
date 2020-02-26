@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Edit Permissions
      </h1>
          <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/roles">Permissions</a></li>
            <li class="active">Edit</li>
          </ol>
  </section>
 @endsection

 @section('content')     
    <section class="content">
        <div class="box">
            <div class="box-body">
                    {{ Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'PUT']) }}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    
    <br>
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}                   
                

            </div>
        </div>
    </section>

    
@endsection