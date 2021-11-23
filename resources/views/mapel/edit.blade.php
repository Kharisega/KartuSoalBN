@extends('layout.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Data Mata Pelajaran</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('mapel.index') }}">Kembali</a>
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

<form action="{{ route('mapel.update', $mapel[0]->id_mapel) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Kompetensi Keahlian :</strong>
                <input type="text" name="nama_mapel" class="form-control" value="{{ $mapel[0]->nama_mapel}}" placeholder="Nama Mata Pelajaran">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kepanjangan Kompetensi Keahlian :</strong>
                <select name="jenis_mapel" class="form-select" id="jenis_mapel">
                    <option value="Normatif" {{ (($mapel[0]->jenis_mapel == 'Normatif') ? 'selected' : '') }}>Normatif</option>
                    <option value="Produktif" {{ (($mapel[0]->jenis_mapel == 'Produktif') ? 'selected' : '') }}>Produktif</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Edit</button>
        </div>
    </div>

</form>
</div>
@endsection