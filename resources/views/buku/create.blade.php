@extends('layout.template')
@section('konten')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<!-- START FORM -->
<form action='{{url('buku')}}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href="{{url('buku')}}" class="btn btn-secondary"><< kembali</a>
        <div class="mb-3 row">
            <label for="id_buku" class="col-sm-2 col-form-label">ID Buku</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='id_buku' value="{{ Session::get('id_buku')}}" id="id_buku">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='judul' value="{{ Session::get('judul')}}" id="judul">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="pengarang" class="col-sm-2 col-form-label">Nama Pengarang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='pengarang' value="{{ Session::get('pengarang')}}" id="pengarang">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="biaya" class="col-sm-2 col-form-label">Biaya per Hari</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='biaya' value="{{ Session::get('biaya')}}" id="biaya">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="biaya" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
            </div>
        </div>
    </div>
</form>

<!-- AKHIR FORM -->
@endsection
