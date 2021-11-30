@extends('layout.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Data Aspek Kognitif</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('kognitif.index') }}">Kembali</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Edit Gagal</strong> Data yang anda inputkan bermasalah.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('kognitif.update', $kognitif[0]->id_kognitif) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Aspek Kognitif :</strong>
                <input type="text" name="aspek_kognitif" class="form-control" value="{{ $kognitif[0]->aspek_kognitif}}" placeholder="cth. C3">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Keterangan Aspek Kognitif :</strong>
                <input type="text" name="ket_kognitif" class="form-control" value="{{ $kognitif[0]->ket_kognitif}}" placeholder="cth. Membaca">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Edit</button>
        </div>
    </div>

</form>
</div>
@endsection