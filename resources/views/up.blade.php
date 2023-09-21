@extends('layouts.main')
@section('UP','active')
@section('container')

<script src="js/bootstrap.bundle.min.js"></script>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
        <i class="fa fa-check" aria-hidden="true"></i>
            {{ @session('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>     
            &nbsp{{ session()->get('error') }}
        </div>
    @endif
<div class="container">
    <h2 style="text-align: center;" class="text-dark fw-bold text-sm pb-4 mt-4">Data Unit Pengatur (UP) </h2>

    <div class="mb-auto text-sm">  
        <table class="table table-bordered text-dark table-sm" style="text-align: center;" border="1">
        <div class="mb-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#upModal">
        <i class="fa fa-plus" aria-hidden="true"></i>
            Tambah Data
        </button>

        </div>
            <thead class="table-primary">
                <tr>
                    <th>Kode UP</th>
                    <th>Nama UP</th>
                    <th>Alamat</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <thead>
                @foreach ($UPs as $up)           
                <tr>
                    <td>{{ $up->up_code }}</td>
                    <td>{{ $up->up_nama }}</td>
                    <td>{{ $up->up_alamat }}</td>
                    <td>{{ $up->latitude}}</td>
                    <td>{{ $up->longitude}}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm btn_editUP" data-id="{{ $up->id }}" data-nama="{{ $up->up_nama }}" data-alamat="{{ $up->up_alamat }}" data-latitude="{{ $up->latitude }}" data-longitude="{{ $up->longitude }}">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </button>
                        
                        <form action="/up/{{ $up->id }}" class="d-inline" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit"
                                onclick="return confirm('Yakin akan Mendelete Data?')"><i
                                    class="fa fa-trash"></i></button>
                        </form>
                        
                    </td>
                </tr>
                @endforeach
            </thead>
        </div>
        {{ $UPs->links('pagination::bootstrap-5') }}
    </div>
</div>
        <!-- Modal Tambah UP-->

        <div class="modal fade" id="upModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="container modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Tambah Unit Pengatur</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="Post" action='/up'>
            @csrf
            <div class="mb-3">
                    <label for="codeUP" class="form-label text-dark fw-bold">Kode Unit Pengatur</label>
                    <input type="text" class="form-control" id="codeUP" name="codeUP" placeholder="Input Kode UP">
                </div>
                <div class="mb-3">
                    <label for="namaUP" class="form-label text-dark fw-bold">Nama Unit Pengatur</label>
                    <input type="text" class="form-control" id="namaUP" name="namaUP" placeholder="Input Nama UP">
                </div>
                <div class="mb-3">
                    <label for="alamatUP" class="form-label text-dark fw-bold">Alamat Unit Pengatur</label>
                    <input type="text" class="form-control" id="alamatUP" name="alamatUP" placeholder="Input Alamat UP">
                </div>
                <div class="mb-3">
                    <label for="latitudeUP" class="form-label text-dark fw-bold">Latitude</label>
                    <input type="number" class="form-control" id="latitudeUP" name="latitudeUP" placeholder="Input Latitude UP" step="any">
                </div>
                <div class="mb-3">
                    <label for="longitudeUP" class="form-label text-dark fw-bold">Longitude</label>
                    <input type="number" class="form-control" id="longitudeUP" name="longitudeUP" placeholder="Input Longitude UP" step="any">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-white" nama="SaveButton">Simpan</button>
                </div>
                </div>
            </form>
        </div>
        </div>

        <!-- Modal Edit UP-->
        <div class="modal fade" id="editUPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary fw-bold" id="exampleModalLabel">Form Edit Unit Pengatur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/up/edit" method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="codeUP" class="form-label text-dark fw-bold">Kode Unit Pengatur</label>
                            <input type="text" class="form-control @error('codeUP') is-invalid @enderror" id="txtcodeUP" name="codeUP" >
                            @error('codeUP')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaUP" class="form-label text-dark fw-bold">Nama Unit Pengatur</label>
                            <input type="text" class="form-control @error('namaUP') is-invalid @enderror" id="txtnamaUP" name="namaUP">
                            @error('namaUP')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamatUP" class="form-label text-dark fw-bold">Alamat Unit Pengatur</label>
                            <input type="text" class="form-control @error('alamatUP') is-invalid @enderror" id="txtalamatUP" name="alamatUP">
                            @error('alamatUP')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="latitudeUP" class="form-label text-dark fw-bold">Latitude</label>
                            <input type="number" class="form-control @error('latitudeUP') is-invalid @enderror" id="txtlatitude" name="latitudeUP">
                            @error('latitudeUP')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="longitudeUP" class="form-label text-dark fw-bold">Longitude</label>
                            <input type="number" class="form-control @error('longitudeUP') is-invalid @enderror" id="txtlongitude" name="longitudeUP" >
                            @error('longitudeUP')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary text-white" nama="SaveButton">Ubah</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
         
@endsection