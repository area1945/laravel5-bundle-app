@section('title') Brand  @endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="panel panel-default">

                <div class="panel-heading">
                    Brand
                </div>

                <div class="panel-body">
                    
                    <form id="form-submit" autocomplete="off" class="form-horizontal" method="POST" action="{{ route('brand.update', ['id'=> $model->id]) }}">
                        
                        {{ csrf_field() }}
                        {{  method_field('PATCH')  }}

                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">Kode <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Kode" id="code" type="text" class="form-control" name="code" value="{{ $model->code }}" required>

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
                                <input placeholder="Masukan Nama" id="name" type="text" class="form-control" name="name" value="{{ $model->name }}" required>

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
                                <textarea placeholder="Masukan Deskripsi" class="form-control" name="description" id="description" rows="4">{{ $model->description }}</textarea>
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
                                    Update Data
                                </button>
                                <button type="reset" class="btn btn-warning">
                                    Reset Form
                                </button>
                            </div>
                        </div>
                    </form>

                    

                </div>

                <div class="panel-footer">
                    <a class="btn btn-md btn-default" href="{{ route('brand.index') }}">
                        Kembali Ke Daftar
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
