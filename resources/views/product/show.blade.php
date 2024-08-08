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
                    <div class="table-responsive">
                        <table class="table table-striped table-detail">
                            <tr>
                                <td width="120">Kode</td>
                                <td width="20">:</td>
                                <td>{{ $model->code }}</td>
                            </tr>
                            @if(!is_null($model->image))
                            <tr>
                                <td>Foto / Gambar</td>
                                <td>:</td>
                                <td>
                                    <img width="100" src="{{ url($model->image) }}" alt="produk" class="img-thumbnail" />
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $model->name }}</td>
                            </tr>
                            <tr>
                                <td>Brand</td>
                                <td>:</td>
                                <td>{{ !is_null($model->Brand) ? $model->Brand->name : "" }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td>
                                    @foreach($model->Categories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach 
                                </td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td>:</td>
                                <td>{{ $model->stock }}</td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>:</td>
                                <td>{{ number_format($model->price,2,',','.') }}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>{{ $model->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="clearfix">
                        <div class="pull-left">
                            <a class="btn btn-md btn-default" href="{{ route('product.index') }}">
                                Kembali Ke Daftar
                            </a>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-md btn-primary" href="{{ route('product.edit', ['id'=> $model->id]) }}">
                                Edit Data
                            </a>
                            <a id="btn-delete" data-id="{{ $model->id }}" data-module-url="{{ route('product.index') }}" class="btn btn-md btn-danger" href="javascript:void(0);">
                                Hapus Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

