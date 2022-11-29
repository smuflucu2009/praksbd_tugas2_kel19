@extends('layout.template')
@section('konten')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
        <form class="d-flex" action="{{url('buku')}}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}"
                placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit"><x-bi-search /></button>
        </form>
    </div>

    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <a href='{{ url('/create')}}' class="btn btn-primary">+</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-1">ID Buku</th>
                <th class="col-md-2">Judul</th>
                <th class="col-md-2">Nama Pengarang</th>
                <th class="col-md-2">Biaya Sewa per Hari</th>
                <th class="col-md-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $data->firstItem() ?>
            @foreach ($data as $item)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $item->id_buku }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->pengarang }}</td>
                <td>{{ $item->biaya }}</td>
                <td>
                    <a href='{{ url('buku/'.$item->id_buku.'/edit') }}' 
                        class="btn btn-warning btn-sm"><x-phosphor-pen />Edit</a>
                    <form onsubmit="return confirm('Yakin akan menghapus data ini?')" class="d-inline" action="{{ url('buku/'.$item->id_buku) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm"><x-heroicon-o-trash />Del</button>
                    </form>
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
            
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
</div>
<!-- AKHIR DATA -->
@endsection
