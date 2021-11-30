@extends('layout.app')

@section('content')
<div class="container ml-2 mt-4">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Kartu Soal</h2>
            </div>
            <div class="pull-right mt-4 mb-4">
                <a href="{{ route('kartu.create') }}" class="btn btn-success">Tambah Kartu Soal</a>
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
        {{-- @foreach ($kartu as $i => $kartuu)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $kartuu->id_kartu }}</td>
                <td>{{ $kartuu->nama }}</td>
                <td>{{ $kartuu->nama_mapel }}</td>
                <td>{{ $kartuu->kelas }}</td>
                <td>
                    <form action="{{ route('kartu.destroy', $kartuu->id_kartu) }}" method="POST">
                        <a href="{{ route('kartu.edit',$kartuu->id_kartu) }}" class="btn btn-primary">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Hapus</button>

                    </form>
                </td>
            </tr>
            @endforeach --}}
    </table>
</div>
@endsection