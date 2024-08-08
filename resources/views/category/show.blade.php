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
                    <div class="table-responsive">
                        <table class="table table-striped table-detail">
                            <tr>
                                <td width="100">Kode</td>
                                <td width="20">:</td>
                                <td>{{ $model->code }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $model->name }}</td>
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
                            <a class="btn btn-md btn-default" href="{{ route('category.index') }}">
                                Kembali Ke Daftar
                            </a>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-md btn-primary" href="{{ route('category.edit', ['id'=> $model->id]) }}">
                                Edit Data
                            </a>
                            <a id="btn-delete" data-id="{{ $model->id }}" data-module-url="{{ route('category.index') }}" class="btn btn-md btn-danger" href="javascript:void(0);">
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

