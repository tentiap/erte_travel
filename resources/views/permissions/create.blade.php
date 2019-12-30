@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Permissions
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../permissions">Permissions</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

@section('content')
    <section class="content">
      <div class="box">
        <div class="box-body">
          <form method="post" action="/permissions/store">
            
          {{ csrf_field() }}

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">  

                            @if($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name')}}
                                </div>
                            @endif                         
                        </div>

                        @if(!$roles->isEmpty()) 
                            <h4>Assign Permission to Roles</h4>

                            @foreach ($roles as $role) 
                                {{ Form::checkbox('roles[]',  $role->id ) }}
                                {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                            @endforeach
                        @endif

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                </form>
            </div>
        </div>
    </section>

    
@endsection