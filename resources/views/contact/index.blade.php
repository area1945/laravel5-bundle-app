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
                        <table id="table-data" class="table table-striped table-bordered" style="width:100%; margin-top: 2%; margin-bottom: 0.5%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Website</th>
                                    <th style="text-align:center">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="clearfix">
                        <div class="pull-left">
                            <a class="btn btn-md btn-default" href="{{ route('contact.create') }}">
                                Tambah Data
                            </a>
                        </div>
                        <div class="pull-right">
                            <a target="_blank" class="btn btn-md btn-default" href="{{ route('contact.download.pdf') }}">
                                Unduh Sebagai PDF
                            </a>
                            <a target="_blank" class="btn btn-md btn-default" href="{{ route('contact.download.excel') }}">
                                Unduh Sebagai Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var columns = [
                {
                    "data": "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                },
                {
                    data: 'email',
                },
                {
                    data: 'phone',
                },
                {
                    data: 'website',
                },
                {
                    data: 'id',
                    "orderable": false,
                    "className": "text-center",
                    render: function (data, type, row, meta) {
                       return dtActionButton("{{ route('contact.index') }}", row);
                    }
                },
            ];
            var option = {
                container: "#table-data",
                fetchUrl: "{{ route('datatable.contact') }}",
                moduleUrl: "{{ route('contact.index') }}",
                columns: columns
            }
            setDataTable(option);
        });
    </script>
@endsection