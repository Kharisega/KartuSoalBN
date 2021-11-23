@extends('layout.app')

@section('content')
<div class="container ml-2 mt-4">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tambah Data Guru</h2>
        </div>
        <div class="pull-right mt-4 mb-2">
            <a class="btn btn-primary" href="{{ route('guru.index') }}">Kembali</a>
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

<form action="{{ route('guru.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Guru :</strong>
                <input type="text" name="nama" class="form-control" id="nama_guru" placeholder="Nama Guru" onfocusout="setNama()">
                <input type="hidden" name="name" value="" id="name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>E-Mail :</strong>
                <input type="text" name="email" class="form-control" placeholder="E-Mail">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password :</strong>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group ml-4">
                <label for="mapel">Mata Pelajaran :</label> <br>
                @foreach ($mapel as $ul => $mapell)
                <input type="checkbox" class="form-check-input" name="mapel[]" value='{{$mapell->nama_mapel}}'>{{$mapell->nama_mapel}}<br>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group ml-4">
                <label for="kelas">Kelas yang Diampu :</label> <br>
                @foreach ($kelas as $i => $kelass)
                <input type="checkbox" class="form-check-input" name="kelas[]" value='{{$kelass->kelas}}'>{{$kelass->kelas}}<br>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>

</form>
</div>
<script>
    function setNama() {
        var name = document.getElementById("nama_guru").value;
        document.getElementById("name").value = name;
    }
</script>
@endsection