@extends('layout.app')

@section('content')
<div class="container ml-2 mt-4">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Mata Pelajaran</h2>
            </div>
            <div class="pull-right mt-4 mb-4">
                <a href="{{ route('mapel.create') }}" class="btn btn-success">Tambah Data</a>
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
            <th>ID Mata Pelajaran</th>
            <th>Nama Mata Pelajaran</th>
            <th>Jenis Mata Pelajaran</th>
            <th>Aksi</th>
        </tr>
        @foreach ($mapel as $i => $mapell)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $mapell->id_mapel }}</td>
                <td>{{ $mapell->nama_mapel }}</td>
                <td>{{ $mapell->jenis_mapel }}</td>
                <td>
                    <form action="{{ route('mapel.destroy', $mapell->id_mapel) }}" method="POST">
                        <a href="{{ route('mapel.edit',$mapell->id_mapel) }}" class="btn btn-primary">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Hapus</button>

                    </form>
                </td>
            </tr>
            @endforeach
    </table>

    {!! $mapel->links() !!}
</div>
@endsection