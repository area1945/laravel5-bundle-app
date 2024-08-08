@section('title') Kontak Person  @endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="panel panel-default">

                <div class="panel-heading">
                    Kontak Person
                </div>

                <div class="panel-body">
                    
                    <form id="form-submit" autocomplete="off" class="form-horizontal" method="POST" action="{{ route('contact.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Nama" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Alamat <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Alamat Email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Telepon <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Telepon" id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="website" class="col-md-4 control-label">Website </label>
                            <div class="col-md-6">
                                <input placeholder="Masukan Website" id="website" type="text" class="form-control" name="website" value="{{ old('website') }}" >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Alamat <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <textarea placeholder="Masukan Alamat" class="form-control" name="address" id="address" rows="4">{{ old('address') }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Simpan Data
                                </button>
                                <button type="reset" class="btn btn-warning">
                                    Reset Form
                                </button>
                            </div>
                        </div>
                    </form>

                    

                </div>

                <div class="panel-footer">
                    <a class="btn btn-md btn-default" href="{{ route('contact.index') }}">
                        Kembali Ke Daftar
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
