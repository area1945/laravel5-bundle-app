@section('title') Ubah Profil  @endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="panel panel-default">
                <div class="panel-heading">Ubah Profil</div>

                <div class="panel-body">
                    
                    <form autocomplete="off" class="form-horizontal" method="POST" action="{{ route('profile.update') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Lengkap <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Nama Lengkap" id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Alamat Email <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Alamat Email" id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Profil Saya
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
