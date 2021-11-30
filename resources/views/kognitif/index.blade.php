@extends('layout.app')

@section('content')
<div class="container ml-2 mt-4">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Aspek Kognitif</h2>
            </div>
            <div class="pull-right mt-4 mb-4">
                <a href="{{ route('kognitif.create') }}" class="btn btn-success">Tambah Data</a>
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
            <th>ID Aspek Kognitif</th>
            <th>Aspek Kognitif</th>
            <th>Keterangan Aspek Kognitif</th>
            <th>Aksi</th>
        </tr>
        @foreach ($kognitif as $i => $kognitiff)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $kognitiff->id_kognitif }}</td>
                <td>{{ $kognitiff->aspek_kognitif }}</td>
                <td>{{ $kognitiff->ket_kognitif }}</td>
                <td>
                    <form action="{{ route('kognitif.destroy', $kognitiff->id_kognitif) }}" method="POST">
                        <a href="{{ route('kognitif.edit',$kognitiff->id_kognitif) }}" class="btn btn-primary">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Hapus</button>

                    </form>
                </td>
            </tr>
            @endforeach
    </table>

    {!! $kognitif->links() !!}
</div>
@endsection