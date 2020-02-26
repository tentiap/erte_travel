@extends('layouts.master')

@section('breadcrumb')
  <section class="content-header">
      <h1>
          Roles
      </h1>
          <ol class="breadcrumb">
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../roles">Roles</a></li>
            <li class="active">Create</li>
          </ol>
  </section>
 @endsection

@section('content')
    <section class="content">
      <div class="box">
        <div class="box-body">
          <form method="post" action="/roles/store">
            
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

                        <h5><b>Assign Permissions</b></h5>

                        <div class='form-group'>
                            @foreach ($permissions as $permission)
                                {{ Form::checkbox('permissions[]',  $permission->id ) }}
                                {{ Form::label($permission->name, ($permission->name)) }}<br>

                            @endforeach
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                </form>
            </div>
        </div>
    </section>

    
@endsection