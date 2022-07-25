@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="/pengurus/store">
                        @csrf

                        <!-- ID Users -->
                        <div class="form-group row">
                            <label for="id_users" class="col-md-4 col-form-label text-md-right">{{ __('ID Users') }}</label>

                            <div class="col-md-6">
                                <input id="id_users" type="text" class="form-control" value="{{ old('id_users') }}" autofocus>

                                @if($errors->has('id_users'))
                                    <div class="text-danger">
                                        {{ $errors->first('id_users')}}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Role jadikan hidden -->
                        <!-- <div class="form-group row"> -->
                            <!-- <label for="role" class="col-md-4 col-form-label text-md-right" >{{ __('Role') }}</label>
 -->
                            <div class="col-md-6">
                                <input id="role" type="hidden" class="form-control" value="1">

                                @if($errors->has('role'))
                                    <div class="text-danger">
                                        {{ $errors->first('role')}}
                                    </div>
                                @endif
                            </div>
                        <!-- </div> -->

                        <!-- Username -->
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" value="{{ old('username') }}">

                                @if($errors->has('username'))
                                    <div class="text-danger">
                                        {{ $errors->first('username')}}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Nama -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="form-group row">
                            <label for="kontak" class="col-md-4 col-form-label text-md-right">{{ __('Kontak') }}</label>

                            <div class="col-md-6">
                                <input id="kontak" type="text" class="form-control" value="{{ old('kontak') }}">

                                @if($errors->has('kontak'))
                                    <div class="text-danger">
                                        {{ $errors->first('kontak')}}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>
                            <br>

                            <div class="col-md-6">
                                <label class = "radio-inline">
                                    <input type="radio" name="jenis_kelamin" value="1"> Laki-laki
                                </label>
                                <label class = "radio-inline">
                                    <input type="radio" name="jenis_kelamin" value="2"> Perempuan
                                </label>

                                @if($errors->has('jenis_kelamin'))
                                    <div class="text-danger">
                                        {{ $errors->first('jenis_kelamin')}}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Wilayah -->
                        <div class="form-group row">
                            <label for="id_kota" class="col-md-4 col-form-label text-md-right">{{ __('Wilayah') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="id_kota">
                                    @foreach($kota as $k)
                                        <option name="id_kota" value="{{$k->id_kota}}">{{$k->nama_kota}}</option> 
                                    @endforeach
                                </select>    
                                
                                @if($errors->has('id_kota'))
                                    <div class="text-danger">
                                        {{ $errors->first('id_kota')}}
                                    </div>
                                @endif
                            </div>
                        </div>


                        <!-- Password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
