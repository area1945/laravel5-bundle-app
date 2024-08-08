@section('title') Kategori  @endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="panel panel-default">

                <div class="panel-heading">
                    Kategori
                </div>

                <div class="panel-body">
                    
                    <form id="form-submit" autocomplete="off" class="form-horizontal" method="POST" action="{{ route('category.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">Kode <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Kode" id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required>

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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


                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Deskripsi <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <textarea placeholder="Masukan Deskripsi" class="form-control" name="description" id="description" rows="4">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
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
                    <a class="btn btn-md btn-default" href="{{ route('category.index') }}">
                        Kembali Ke Daftar
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
