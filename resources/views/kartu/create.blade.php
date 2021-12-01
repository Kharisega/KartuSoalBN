@extends('layout.app')

@section('content')
<div class="container ml-2 mt-4">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tambah Kartu Soal</h2>
        </div>
        <div class="pull-right mt-4 mb-2">
            <a class="btn btn-primary" href="{{ route('kartu.index') }}">Kembali</a>
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

<form action="{{ route('kartu.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mata Pelajaran :</strong>
                <select class="form-select" name="mapel" id="mapel">
                    @foreach ($mapel as $mapell)
                        <option value="{{ $mapell }}">{{ $mapell }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kelas :</strong>
                <select class="form-select" name="kelas" id="kelas">
                    @foreach ($kelas as $kelass)
                        <option value="{{ $kelass->kelas }}">{{ $kelass->kelas }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kompetensi Keahlian :</strong>
                <select class="form-select" name="jurusan" id="jurusan">
                    @foreach ($jurusan as $jurusann)
                        <option value="{{ $jurusann->jurusan }}">{{ $jurusann->alias }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nomor Soal :</strong>
                <input type="number" class="form-control" name="no_soal" id="no_soal">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kompetensi Dasar Pengetahuan :</strong>
                <select class="form-select" name="id_kd_peng" id="id_kd_peng">
                    @foreach ($pengetahuan as $peng)
                        <option value="{{ $peng->id_kd }}">{{ $peng->kode_kd . ' ' . $peng->ket_kd }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kompetensi Dasar Keterampilan :</strong>
                <select class="form-select" name="id_kd_ket" id="id_kd_ket">
                    @foreach ($keterampilan as $ket)
                        <option value="{{ $ket->id_kd }}">{{ $ket->kode_kd . ' ' . $ket->ket_kd }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Materi :</strong>
                <input type="text" name="materi" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Indikator Soal :</strong>
                <input type="text" name="indikator_soal" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Aspek Kognitif :</strong> 
            <div class="form-group ml-4">
                @foreach ($kognitif as $i => $kognitiff)
                <input type="checkbox" class="form-check-input" name="kognitif[]" value='{{$kognitiff->id_kognitif}}'>{{$kognitiff->aspek_kognitif . ' ' . $kognitiff->ket_kognitif}}<br>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Jenis Soal :</strong>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_nilai" id="pilgan" onchange="handleChange()" value="PG">
                <label class="form-check-label" for="jenis_nilai">
                  Pilihan Ganda
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_nilai" id="essay" onchange="handleChange()" value="Essay">
                <label class="form-check-label" for="jenis_nilai">
                  Essay / Uraian
                </label>
              </div>
        </div>
        <strong style="margin-bottom: 15px; margin-top:15px;">Gambar (jika ada) :</strong>
        <input type="file" name="gambar" id="gambar" class="form-control-file mb-2">
        <div class="col-xs-12 col-sm-12 col-md-12" id="pil" style="display: none; margin-top: 25px;">
            <strong style="margin-bottom:15px;">Butir Soal</strong>
            <div class="form-group">
                <input type="text" name="soalpil" id="soalpil" aria-label="Soal" placeholder="Soal" class="form-control mb-3">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">A</span>
                    <input type="text" class="form-control" name="pilgan_a" placeholder="Pilihan Ganda A" aria-label="Pilihan Ganda A" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">B</span>
                    <input type="text" class="form-control" name="pilgan_b" placeholder="Pilihan Ganda B" aria-label="Pilihan Ganda B" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">C</span>
                    <input type="text" class="form-control" name="pilgan_c" placeholder="Pilihan Ganda C" aria-label="Pilihan Ganda C" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">D</span>
                    <input type="text" class="form-control" name="pilgan_d" placeholder="Pilihan Ganda D" aria-label="Pilihan Ganda D" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">E</span>
                    <input type="text" class="form-control" name="pilgan_e" placeholder="Pilihan Ganda E" aria-label="Pilihan Ganda E" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Kunci Jawaban</label>
                    <select name="kunci_soal" class="form-select" id="inputGroupSelect01">
                    <option value="-" selected>Pilih ....</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" id="ess" style="display: none; margin-top: 25px;">
            <strong style="margin-bottom: 15px;">Butir Soal</strong>
            <div class="form-group">
                <input type="text" name="soalessay" id="soalessay" aria-label="Soal" placeholder="Soal" class="form-control mb-3">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>

</form>
</div>
<script>
    var div1 = document.getElementById('pil'); 
    var div2 = document.getElementById('ess');
    var pilgan = document.getElementById('pilgan');
    var essay = document.getElementById('essay');

    function handleChange() {
        if ( pilgan.checked ) {
            div1.style.display = "block";
            div2.style.display = "none";
        } else if( essay.checked ) {
            div1.style.display = "none";
            div2.style.display = "block";
        }
    }
</script>
@endsection