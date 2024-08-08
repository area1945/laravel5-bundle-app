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
                    <div class="table-responsive">
                        <table class="table table-striped table-detail">
                            <tr>
                                <td width="100">Nama</td>
                                <td width="20">:</td>
                                <td>{{ $model->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $model->email }}</td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td>:</td>
                                <td>{{ $model->phone }}</td>
                            </tr>
                            <tr>
                                <td>Website</td>
                                <td>:</td>
                                <td>{{ $model->website }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $model->address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="clearfix">
                        <div class="pull-left">
                            <a class="btn btn-md btn-default" href="{{ route('contact.index') }}">
                                Kembali Ke Daftar
                            </a>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-md btn-primary" href="{{ route('contact.edit', ['id'=> $model->id]) }}">
                                Edit Data
                            </a>
                            <a id="btn-delete" data-id="{{ $model->id }}" data-module-url="{{ route('contact.index') }}" class="btn btn-md btn-danger" href="javascript:void(0);">
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

