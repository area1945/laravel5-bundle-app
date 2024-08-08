@section('title') Ubah Password  @endsection
@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="panel panel-default">
                <div class="panel-heading">Ubah Password</div>

                <div class="panel-body">

                   <form autocomplete="off" class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password Lama <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Kata Sandi Lama" id="old_password" type="password" class="form-control" name="old_password" required>

                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password Baru <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Kata Sandi Baru" id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input placeholder="Masukan Konfirmasi Kata Sandi Baru" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
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
