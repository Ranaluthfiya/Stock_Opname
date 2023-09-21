@extends('layouts.main')
@section('DetailTransaksi','active')
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
    <h2 style="text-align: center;" class="text-dark fw-bold text-sm pb-4 mt-4">Data Detail Transaksi</h2>
    <div class="border border-primary-emphasis p-2 mb-2">
    <div class="mb-auto text-sm">  
        <table class="table table-bordered text-dark table-sm" style="text-align: center;" border="1">
        </div>
            <thead class="table-primary">
                <tr>
                    <th>Detail Transaksi Id</th>
                    <th>Trans Id</th>
                    <th>Barang</th>
                    <th>Barang Quantity</th>
                    <th>Barang Serial Number</th>
                </tr>
            </thead>
            <thead>
            @if ($transaksis->isEmpty())
                        <p>Tidak ada data yang ditemukan.</p>
            @else 
                    @foreach ($detailtransaksis as $detail_transaksi)
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail_transaksi->trans_id }}</td>
                    <td>{{ $detail_transaksi->barang->barang_nama}}</td>
                    <td>{{ $detail_transaksi->barang_quantity }}</td>
                    <td>{{ $detail_transaksi->barang_sn }}</td>
                </tr>
                @endforeach
            @endif
            </thead>
        </div>
        {{ $detailtransaksis->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection