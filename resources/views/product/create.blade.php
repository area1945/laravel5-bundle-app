@section('title') Produk  @endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="panel panel-default">

                <div class="panel-heading">
                    Produk
                </div>

                <div class="panel-body">
                    
                    <form id="form-submit" autocomplete="off" class="form-horizontal" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Foto / Gambar</label>
                            <div class="col-md-6">
                                <input type="file" name="file_image" class="form-control" />
                            </div>
                        </div>

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

                        <div class="form-group{{ $errors->has('brand_id') ? ' has-error' : '' }}">
                            <label for="brand_id" class="col-md-4 control-label">Brand <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select id="brand_id" name="brand_id" class="select2" style="width:100%;" required>
                                    <option selected disabled>Pilih Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $brand->id == old('brand_id') ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('brand_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                            <label for="brand_id" class="col-md-4 control-label">Kategori <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select id="categories" name="categories[]" class="select2" style="width:100%;"  multiple required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('categories'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categories') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Harga <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Harga" id="price" type="number" class="form-control" name="price" value="{{ old('price') }}" required>

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                            <label for="stock" class="col-md-4 control-label">Stok <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input placeholder="Masukan Stok" id="stock" type="number" class="form-control" name="stock" value="{{ old('stock') }}" required>

                                @if ($errors->has('stock'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Deskripsi <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <textarea placeholder="Masukan Deskripsi" class="form-control" name="description" id="description" rows="4" required>{{ old('description') }}</textarea>
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
                    <a class="btn btn-md btn-default" href="{{ route('product.index') }}">
                        Kembali Ke Daftar
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(".select2").select2({
                theme: "bootstrap"
            });
        });
    </script>
@endsection