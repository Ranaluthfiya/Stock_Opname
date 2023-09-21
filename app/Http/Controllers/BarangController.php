<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\View\View;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $barangs = Barang::paginate(5);

        return view('barang', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $Barang = new Barang;
            $Barang -> barang_code = $request->input('kodebarang');
            $Barang -> barang_nama = $request->input('namabarang');
            $Barang -> barang_merk = $request->input('merkbarang');
            $Barang -> barang_jenis = $request->input('jenisbarang');
            $Barang -> barang_tipe = $request->input('tipebarang');
            $Barang -> barang_satuan = $request->input('satuan');
            $Barang -> save();

            return redirect('/barang')->with('success','Data Berhasil Ditambahkan');
            } catch (\Illuminate\Database\QueryException $e) {
                // Check for unique constraint violation
                if ($e->errorInfo[1] == 1062) {
                    echo '<script>alert("Barang sudah ada dalam database.");</script>';
                    return redirect('barang')->with('error','Barang Gagal Ditambahkan');
                } else {
                    throw $e; // Rethrow the exception if it's not due to unique constraint
                }
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $Barang = Barang::findOrFail($barang->id);
        return view('barang', compact('Barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
        $Barang = Barang::findOrFail($request->input('id'));
        $Barang -> barang_code = $request->input('kodebarang');
        $Barang -> barang_nama = $request->input('namabarang');
        $Barang -> barang_merk = $request->input('merkbarang');
        $Barang -> barang_jenis = $request->input('jenisbarang');
        $Barang -> barang_tipe = $request->input('tipebarang');
        $Barang -> barang_satuan = $request->input('satuan');
        $Barang -> save();

        return redirect('/barang')->with('success','Data Berhasil Diubah');
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for unique constraint violation
            if ($e->errorInfo[1] == 1062) {
                echo '<script>alert("Barang sudah ada dalam database.");</script>';
                return redirect('barang')->with('error','Barang Gagal Diubah');
            } else {
                throw $e; // Rethrow the exception if it's not due to unique constraint
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        Barang::destroy($barang->id);
        return redirect('/barang')->with('success','Data Berhasil Dihapus');
    }
}
