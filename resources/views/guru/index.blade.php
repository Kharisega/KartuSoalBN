@extends('layout.app')

@section('content')
<div class="container ml-2 mt-4">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Guru</h2>
            </div>
            <div class="pull-right mt-4 mb-4">
                <a href="{{ route('guru.create') }}" class="btn btn-success">Tambah Data</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>ID Guru</th>
            <th>Nama Guru</th>
            <th>Mata Pelajaran</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
        @foreach ($guru as $i => $guruu)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $guruu->id_guru }}</td>
                <td>{{ $guruu->nama }}</td>
                <td>{{ $guruu->nama_mapel }}</td>
                <td>{{ $guruu->kelas }}</td>
                <td>
                    <form action="{{ route('guru.destroy', $guruu->id_guru) }}" method="POST">
                        <a href="{{ route('guru.edit',$guruu->id_guru) }}" class="btn btn-primary">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Hapus</button>

                    </form>
                </td>
            </tr>
            @endforeach
    </table>
</div>
@endsection