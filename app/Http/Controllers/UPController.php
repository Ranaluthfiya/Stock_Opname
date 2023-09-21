<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UP;
use Illuminate\View\View;

class UPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $UPs = UP::paginate(10);
        return view('up', compact('UPs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('up');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $Up = new UP;
            $Up -> id = $request->input('idUP');
            $Up -> up_code = $request->input('codeUP');
            $Up -> up_nama = $request->input('namaUP');
            $Up -> up_alamat = $request->input('alamatUP');
            $Up -> latitude = $request->input('latitudeUP');
            $Up -> longitude = $request->input('longitudeUP');
            $Up -> save();

            return redirect('/up')->with('success','Data Berhasil Ditambahkan');
            } catch (\Illuminate\Database\QueryException $e) {
                // Check for unique constraint violation
                if ($e->errorInfo[1] == 1062) {
                    echo '<script>alert("Data sudah ada dalam database.");</script>';
                    return redirect('up')->with('error','Data Gagal Ditambahkan');
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
    public function edit(UP $up)
    {
        $Up = UP::findOrFail($up->id);
        return view('up', compact('Up'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $Up = UP::findOrFail($request->input('id'));
            $Up->up_code = $request->input('codeUP');
            $Up->up_nama = $request->input('namaUP');
            $Up->up_alamat = $request->input('alamatUP');
            $Up->latitude = $request->input('latitudeUP');
            $Up->longitude = $request->input('longitudeUP');
            $Up->save();
    
            return redirect('/up')->with('success', 'Data Berhasil Diubah');
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for unique constraint violation
            if ($e->errorInfo[1] == 1062) {
                echo '<script>alert("Data sudah ada dalam database.");</script>';
                return redirect('up')->with('error', 'Data Gagal Diubah');
            } else {
                throw $e; // Rethrow the exception if it's not due to unique constraint
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UP $up)
    {
        UP::destroy($up->id);
        return redirect('/up')->with('success','Data Berhasil Dihapus');
    }
}
