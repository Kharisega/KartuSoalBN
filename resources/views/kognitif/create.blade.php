@extends('layout.app')

@section('content')
<div class="container ml-2 mt-4">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tambah Data Aspek Kognitif</h2>
        </div>
        <div class="pull-right mt-4 mb-2">
            <a class="btn btn-primary" href="{{ route('kognitif.index') }}">Kembali</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Maaf</strong> Data yang anda inputkan bermasalah.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('kognitif.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Aspek Kognitif :</strong>
                <input type="text" name="aspek_kognitif" class="form-control" placeholder="cth. C3">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Keterangan Aspek Kognitif :</strong>
                <input type="text" name="ket_kognitif" class="form-control" placeholder="cth. Mengingat">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>

</form>
</div>
@endsection