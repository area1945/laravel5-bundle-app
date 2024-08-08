@if (session('success'))
<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Proses Berhasil !</strong> {{ session('success') }}
</div>
@endif
@if (session('danger'))
<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Proses Gagal !</strong> {{ session('danger') }}
</div>
@endif