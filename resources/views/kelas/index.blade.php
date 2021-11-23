@extends('layout.app')

@section('content')
<div class="container ml-2 mt-4">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Kelas</h2>
            </div>
            <div class="pull-right mt-4 mb-4">
                <a href="{{ route('kelas.create') }}" class="btn btn-success">Tambah Data</a>
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
            <th>ID Kelas</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
        @foreach ($kelas as $i => $kelass)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $kelass->id_kelas }}</td>
                <td>{{ $kelass->kelas }}</td>
                <td>
                    <form action="{{ route('kelas.destroy', $kelass->id_kelas) }}" method="POST">
                        <a href="{{ route('kelas.edit',$kelass->id_kelas) }}" class="btn btn-primary">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Hapus</button>

                    </form>
                </td>
            </tr>
            @endforeach
    </table>

    {!! $kelas->links() !!}
</div>
@endsection