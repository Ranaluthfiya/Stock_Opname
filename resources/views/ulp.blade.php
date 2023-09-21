@extends('layouts.main')
@section('ULP','active')
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
    <h2 style="text-align: center;" class="text-dark fw-bold text-sm pb-4 mt-4">Data Unit Layanan Pelanggan (ULP) </h2>

    <div class="mb-auto text-sm">  
        <table class="table table-bordered text-dark table-sm" style="text-align: center;" border="1">
        <div class="mb-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ulpModal">
        <i class="fa fa-plus" aria-hidden="true"></i>
            Tambah Data
        </button>

        </div>
            <thead class="table-primary">
                <tr>
                    <th>Kode ULP</th>
                    <th>Nama ULP</th>
                    <th>Alamat</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Nama UP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <thead>
                @foreach ($ULPs as $ulp)           
                <tr>
                    <td>{{ $ulp->ulp_code}}</td>
                    <td>{{ $ulp->ulp_nama }}</td>
                    <td>{{ $ulp->ulp_alamat }}</td>
                    <td>{{ $ulp->ulp_latitude}}</td>
                    <td>{{ $ulp->ulp_longitude}}</td>
                    <td>{{ $ulp->up_id}}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm btn_editULP" data-id="{{ $ulp->id }}" data-nama="{{ $ulp->ulp_nama }}" data-alamat="{{ $ulp->ulp_alamat }}" data-latitude="{{ $ulp->ulp_latitude }}" data-longitude="{{ $ulp->ulp_longitude }}" data-up="{{ $ulp->up_id }}">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </button>
                        
                        <form action="/ulp/{{ $ulp->id }}" class="d-inline" method="post">
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
        {{ $ULPs->links('pagination::bootstrap-5') }}
    </div>
</div>
        <!-- Modal Tambah ULP-->

        <div class="modal fade" id="ulpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="container modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Tambah Unit Layanan Pelanggan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="Post" action='/ulp'>
            @csrf
                <div class="mb-3">
                    <label for="codeULP" class="form-label text-dark fw-bold">Kode Unit Layanan Pelanggan</label>
                    <input type="text" class="form-control" id="codeULP" name="codeULP" placeholder="Input Kode ULP">
                </div>
                <div class="mb-3">
                    <label for="namaULP" class="form-label text-dark fw-bold">Nama Unit Layanan Pelanggan</label>
                    <input type="text" class="form-control" id="namaULP" name="namaULP" placeholder="Input Nama ULP">
                </div>
                <div class="mb-3">
                    <label for="alamatULP" class="form-label text-dark fw-bold">Alamat Unit Layanan Pelanggan</label>
                    <input type="text" class="form-control" id="alamatULP" name="alamatULP" placeholder="Input Alamat ULP">
                </div>
                <div class="mb-3">
                    <label for="latitudeULP" class="form-label text-dark fw-bold">Latitude</label>
                    <input type="number" class="form-control" id="latitudeULP" name="latitudeULP" placeholder="Input Latitude ULP" step="any">
                </div>
                <div class="mb-3">
                    <label for="longitudeULP" class="form-label text-dark fw-bold">Longitude</label>
                    <input type="number" class="form-control" id="longitudeULP" name="longitudeULP" placeholder="Input Longitude ULP" step="any">
                </div>
                <div class="up-section mb-3">
                    <label for="slcup" class="form-label text-dark fw-bold">Unit Pengatur</label>
                    <div class="mb-3">
                        <select class="form-select text-dark" id="slcup" name="slcup">
                        <option selected>Pilih Opsi</option>
                        @foreach($UPs as $up)
                            <option value="{{$up->id}}">{{$up->up_nama}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-white" nama="SaveButton">Simpan</button>
                </div>
                </div>
            </form>
        </div>
        </div>

        <!-- Modal Edit ULP-->
        <div class="modal fade" id="editULPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary fw-bold" id="exampleModalLabel">Form Edit Unit Layanan Pelanggan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/ulp/edit" method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label hidden for="codeULP" class="form-label text-dark fw-bold">Kode Unit Layanan Pelanggan</label>
                            <input hidden type="text" class="form-control @error('codeULP') is-invalid @enderror" id="txtcodeULP" name="codeULP" >
                            @error('codeULP')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaULP" class="form-label text-dark fw-bold">Nama Unit Layanan Pelanggan</label>
                            <input type="text" class="form-control @error('namaULP') is-invalid @enderror" id="txtnamaULP" name="namaULP">
                            @error('namaULP')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamatULP" class="form-label text-dark fw-bold">Alamat Unit Layanan Pelanggan</label>
                            <input type="text" class="form-control @error('alamatULP') is-invalid @enderror" id="txtalamatULP" name="alamatULP">
                            @error('alamatULP')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="latitudeULP" class="form-label text-dark fw-bold">Latitude</label>
                            <input type="number" class="form-control @error('latitudeULP') is-invalid @enderror" id="txtlatitude" name="latitudeULP">
                            @error('latitudeULP')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="longitudeULP" class="form-label text-dark fw-bold">Longitude</label>
                            <input type="number" class="form-control @error('longitudeULP') is-invalid @enderror" id="txtlongitude" name="longitudeULP" >
                            @error('longitudeULP')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="up-section mb-3">
                            <label for="slcup" class="form-label text-dark fw-bold">Unit Pengatur</label>
                            <div class="mb-3">
                                <select class="form-select text-dark" id="slcup" name="slcup">
                                @foreach($UPs as $up)
                                    <option value="{{$up->id}}">{{$up->up_nama}}</option>
                                @endforeach
                                </select>
                            </div>
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