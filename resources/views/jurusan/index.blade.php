@extends('layout.app')

@section('content')
<div class="container ml-2 mt-4">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Kompetensi Keahlian</h2>
            </div>
            <div class="pull-right mt-4 mb-4">
                <a href="{{ route('jurusan.create') }}" class="btn btn-success">Tambah Data</a>
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
            <th>ID Kompetensi Keahlian</th>
            <th>Nama Kompetensi Keahlian</th>
            <th>Kepanjangan Kompetensi Keahlian</th>
            <th>Aksi</th>
        </tr>
        @foreach ($jurusan as $i => $jurusann)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $jurusann->id_jurusan }}</td>
                <td>{{ $jurusann->jurusan }}</td>
                <td>{{ $jurusann->alias }}</td>
                <td>
                    <form action="{{ route('jurusan.destroy', $jurusann->id_jurusan) }}" method="POST">
                        <a href="{{ route('jurusan.edit',$jurusann->id_jurusan) }}" class="btn btn-primary">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Hapus</button>

                    </form>
                </td>
            </tr>
            @endforeach
    </table>

    {!! $jurusan->links() !!}
</div>
@endsection