<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi; 
use App\Models\Transaksi; 

class DetailTransaksiController extends Controller
{
    // Metode untuk menampilkan semua detail transaksi
    public function index()
    {
        $detailTransaksi = DetailTransaksi::all();
        return view('detailtransaksi.index', ['detailTransaksi' => $detailTransaksi]);
    }

    // Metode untuk menampilkan detail transaksi berdasarkan ID transaksi
    public function show($transaksiId)
    {
        $detailTransaksi = DetailTransaksi::where('trans_id', $transaksiId)->get();
        return view('detailtransaksi.show', ['detailTransaksi' => $detailTransaksi]);
    }

    // Metode untuk menambahkan detail transaksi baru
    public function store(Request $request)
    {
        // Validasi data yang masuk sesuai kebutuhan Anda
        $validatedData = $request->validate([
            'trans_id' => 'required',
            'barang_id' => 'required',
            'barang_quantity' => 'required|integer',
            'barang_sn' => 'nullable|string|max:255',
        ]);

        // Simpan detail transaksi baru ke basis data
        DetailTransaksi::create($validatedData);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Detail Transaksi berhasil ditambahkan');
    }

    // Metode untuk mengedit detail transaksi
    public function edit($id)
    {
        $detailTransaksi = DetailTransaksi::findOrFail($id);
        // Tampilkan formulir edit atau lakukan perubahan lainnya
        return view('detailtransaksi.edit', ['detailTransaksi' => $detailTransaksi]);
    }

    // Metode untuk menyimpan perubahan pada detail transaksi yang diedit
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk sesuai kebutuhan Anda
        $validatedData = $request->validate([
            'trans_id' => 'required',
            'barang_id' => 'required',
            'barang_quantity' => 'required|integer',
            'barang_sn' => 'nullable|string|max:255',
        ]);

        // Update detail transaksi yang sesuai dengan ID
        DetailTransaksi::where('id', $id)->update($validatedData);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Detail Transaksi berhasil diperbarui');
    }

    // Metode untuk menghapus detail transaksi
    public function destroy($id)
    {
        // Temukan dan hapus detail transaksi berdasarkan ID
        DetailTransaksi::findOrFail($id)->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Detail Transaksi berhasil dihapus');
    }
}
