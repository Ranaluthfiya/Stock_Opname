<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UP;
use App\Models\ULP;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UPController;

class ULPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $UPs = UP::all();
        $ULPs = ULP::with('up')->paginate(10);
        return view('ulp', compact('UPs', 'ULPs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ulp');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $Ulp = new ULP;
            $Ulp -> id = $request->input('idULP');
            $Ulp -> ulp_code = $request->input('codeULP');
            $Ulp -> ulp_nama = $request->input('namaULP');
            $Ulp -> ulp_alamat = $request->input('alamatULP');
            $Ulp -> ulp_latitude = $request->input('latitudeULP');
            $Ulp -> ulp_longitude = $request->input('longitudeULP');
            $Ulp -> up_id = $request->input('slcup');
            $Ulp -> save();

            return redirect('/ulp')->with('success','Data Berhasil Ditambahkan');
            } catch (\Illuminate\Database\QueryException $e) {
                // Check for unique constraint violation
                if ($e->errorInfo[1] == 1062) {
                    echo '<script>alert("Data sudah ada dalam database.");</script>';
                    return redirect('ulp')->with('error','Data Gagal Ditambahkan');
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
    public function edit(ULP $ulp)
    {
        $Ulp = ULP::findOrFail($ulp->id);
        return view('ulp', compact('Ulp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $Ulp = ULP::findOrFail($request->input('id'));
            $Ulp->ulp_code = $request->input('codeULP');
            $Ulp->ulp_nama = $request->input('namaULP');
            $Ulp->ulp_alamat = $request->input('alamatULP');
            $Ulp->ulp_latitude = $request->input('latitudeULP');
            $Ulp->ulp_longitude = $request->input('longitudeULP');
            $Ulp->up_id = $request = $request->input('slcup');
            $Ulp->save();
    
            return redirect('/ulp')->with('success', 'Data Berhasil Diubah');
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for unique constraint violation
            if ($e->errorInfo[1] == 1062) {
                echo '<script>alert("Data sudah ada dalam database.");</script>';
                return redirect('ulp')->with('error', 'Data Gagal Diubah');
            } else {
                throw $e; // Rethrow the exception if it's not due to unique constraint
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ULP $ulp)
    {
        ULP::destroy($ulp->id);
        return redirect('/ulp')->with('success','Data Berhasil Dihapus');
    }
}
