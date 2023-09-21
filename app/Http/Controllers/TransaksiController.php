<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\View\View;
use App\Models\UP;
use App\Models\ULP;
use App\Models\User;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() : View
    {

        $UPs = UP::all();
        $ULPs = ULP::all();
        $User = User::all();

        // Mengambil data transaksi dan menggabungkannya dengan data UPs dan ULPs
        $transaksis = Transaksi::paginate(10);
        return view('transaksi.index', compact('transaksis', 'UPs', 'ULPs','User'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function input() : View
    {
        $UPs = UP::all();
        $ULPs = ULP::all();

        return view('transaksi.input', compact('UPs', 'ULPs'));

    }
    public function caribarangmasuk(Request $request)
    {
        $carimasuk = $request->input('cari');
        $Barangs = [];
        
        if (!empty($carimasuk)) {
            $Barangs = Barang::where('barang_code', 'like', '%' . $carimasuk . '%')
                ->orWhere('barang_nama', 'like', '%' . $carimasuk . '%')->first();
    
            if ($Barangs) {
                $barang_code = $Barangs['barang_code'];
                $barang_nama = $Barangs['barang_nama'];
                $barang_merk = $Barangs['barang_merk'];
                $barang_jenis = $Barangs['barang_jenis'];
                $barang_tipe = $Barangs['barang_tipe'];
                $barang_satuan = $Barangs['barang_satuan'];
                $html = "<tr>
                            <td><input type='text' hidden class='form-control' value='$barang_code'  name='barang_code[]'>$barang_code</td>
                            <td>$barang_nama</td>
                            <td>$barang_merk</td>
                            <td>$barang_jenis</td>
                            <td>$barang_tipe</td>
                            <td>$barang_satuan</td>
                            <td><input type='number' class='form-control' name='barang_quantity[]'></td>
                            <td><input type='text' class='form-control' name='barang_sn[]'></td>
                            <td><button class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true' onclick='deleteRow(this)'></i></button></td>
                        </tr>";
                echo $html;
            }else {
                // Jika data tidak ditemukan, kirimkan pesan 'Tidak ada hasil yang ditemukan'
                echo json_encode('Tidak ada hasil yang ditemukan');
            }
        } else {
            // Jika pencarian kosong, kirimkan pesan 'Pencarian kosong'
            echo json_encode('Pencarian kosong');
        }
    }

    public function destroy(Transaksi $transaksi)
    {
    
            Transaksi::destroy($transaksi->id);
            return redirect('/transaksi')->with('success','Data berhasil dihapus');
    }

    public function simpanDataMasuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggaltransmasuk' => 'required|date',
            'slcupmasuk' => 'required|exists:up,id',
            'slculpmasuk' => 'required|exists:ulp,id',
            'barang_code.*' => 'required|exists:barang,barang_code',
            'barang_quantity.*' => 'required|integer|min:1',
            'barang_sn.*' => 'nullable|string|max:255'
        ], [
            'tanggaltransmasuk.required' => 'Tanggal transaksi harus diisi.',
            'tanggaltransmasuk.date' => 'Tanggal transaksi harus berupa tanggal yang valid.',
            'slcupmasuk.required' => 'Pilih UP terlebih dahulu.',
            'slcupmasuk.exists' => 'UP yang Anda pilih tidak valid.',
            'slculpmasuk.required' => 'Pilih ULP terlebih dahulu.',
            'slculpmasuk.exists' => 'ULP yang Anda pilih tidak valid.',
            'barang_code.*.required' => 'Kode barang wajib diisi.',
            'barang_code.*.exists' => 'Kode barang tidak valid.',
            'barang_quantity.*.required' => 'Quantity barang wajib diisi.',
            'barang_quantity.*.integer' => 'Quantity barang harus berupa angka.',
            'barang_quantity.*.min' => 'Quantity barang harus lebih dari atau sama dengan 1.',
            'barang_sn.*.required' => 'Serial number barang wajib diisi.',
            'barang_sn.*.max' => 'Serial number barang tidak boleh lebih dari :max karakter.'
        ]);

        if ($validator->fails()) {
            return redirect('/transaksi')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Buat transaksi baru
            $transaksi = new Transaksi;
            $transaksi->trans_tanggal = $request->input('tanggaltransmasuk');
            $transaksi->up_id = $request->input('slcupmasuk');
            $transaksi->ulp_id = $request->input('slculpmasuk');
            $transaksi->trans_jenis = 'Masuk';
            $transaksi->created_by = auth()->user()->id;
            $transaksi->created_at = now();
            $transaksi->save();

            // Mendapatkan ID transaksi yang baru saja disimpan
            $transaksiId = $transaksi->id;

            // Mendapatkan data barang yang dikirim dari form
            $barangCodes = $request->input('barang_code');
            $barangQuantities = $request->input('barang_quantity');
            $barangSns = $request->input('barang_sn');

            // Loop melalui data barang dan menyimpan detail transaksi
            for ($i = 0; $i < count($barangCodes); $i++) {
                // Cari barang berdasarkan barang_code
                $barang = Barang::where('barang_code', $barangCodes[$i])->first();

                if ($barang) {
                    $detailTransaksi = new DetailTransaksi;
                    $detailTransaksi->trans_id = $transaksiId;
                    $detailTransaksi->barang_id = $barang->id; // Menggunakan barang_id yang sesuai
                    $detailTransaksi->barang_quantity = $barangQuantities[$i];
                    $detailTransaksi->barang_sn = $barangSns[$i];
                    $detailTransaksi->save();
                } else {
                    // Barang dengan barang_code tertentu tidak ditemukan, Anda bisa menangani ini sesuai kebutuhan Anda
                    // Misalnya, Anda bisa melewatkan data ini atau memberikan pesan kesalahan.
                }
            }

            return redirect('/transaksi')->with('success', 'Transaksi berhasil disimpan');
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for unique constraint violation
            if ($e->errorInfo[1] == 1062) {
                return redirect('/transaksi')->with('error', 'Transaksi Gagal: Barang sudah ada dalam database');
            } else {
                throw $e; // Rethrow the exception if it's not due to unique constraint
            }
        }
    } 
    public function autocomplete(Request $request)
    {
        $cari = $request->input('cari');

        $results = Barang::where('barang_code', 'LIKE', "%$cari%")
                        ->orWhere('barang_nama', 'LIKE', "%$cari%")
                        ->get();

        return response()->json($results);
    }
    public function detail($transaksi_id){
        
        $transaksis = Transaksi::all();

        $detailtransaksis = DetailTransaksi::with('transaksi')->where('trans_id', $transaksi_id)->paginate(5);
        return view('detailtransaksi', compact('transaksis','detailtransaksis'));
    }
    public function keluar() : View
    {
        $UPs = UP::all();
        $ULPs = ULP::all();

        return view('transaksi.keluar',compact('UPs','ULPs'));
    }
    public function caribarangkeluar(Request $request)
    {
        $carikeluar = $request->input('cari');
        
        if (!empty($carikeluar)) {
            // Cari data barang yang sesuai dengan pencarian
            $Barangs = Barang::where('barang_code', 'like', '%' . $carikeluar . '%')
                ->orWhere('barang_nama', 'like', '%' . $carikeluar . '%')->first();

            if ($Barangs) {
                // Mengambil jumlah stok masuk
                $jumlahStokMasuk = DetailTransaksi::where('barang_id', $Barangs->id)
                    ->whereHas('transaksi', function ($query) {
                        $query->where('trans_jenis', 'masuk');
                    })
                    ->sum('barang_quantity');
                
                // Mengambil jumlah stok keluar
                $jumlahStokKeluar = DetailTransaksi::where('barang_id', $Barangs->id)
                    ->whereHas('transaksi', function ($query) {
                        $query->where('trans_jenis', 'keluar');
                    })
                    ->sum('barang_quantity');
                
                 // Menggunakan selisih stok masuk dan keluar
                $barang_code = $Barangs->barang_code;
                $barang_nama = $Barangs->barang_nama;
                $barang_merk = $Barangs->barang_merk;
                $barang_jenis = $Barangs->barang_jenis;
                $barang_tipe = $Barangs->barang_tipe;
                $barang_satuan = $Barangs->barang_satuan;
                $stock = $jumlahStokMasuk - $jumlahStokKeluar;
                $barang_sn = ''; // Anda harus mengisinya sesuai dengan data yang sesuai dengan barang
                
                if($stock >= 0){
                    if($stock==0){
                        $dis = "readonly";
                    }else{
                        $dis = "";
                    }
                    $html = "<tr>
                                <td><input type='text' hidden class='form-control' value='$barang_code' name='barang_code[]'>$barang_code</td>
                                <td>$barang_nama</td>
                                <td>$barang_merk</td>
                                <td>$barang_jenis</td>
                                <td>$barang_tipe</td>
                                <td>$barang_satuan</td>
                                <td>$stock</td>
                                <td><input type='number' $dis class='form-control' name='barang_quantity[]'></td>
                                <td><input type='text' $dis class='form-control' name='barang_sn[]'></td>
                                <td><button class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true' onclick='deleteRow(this)'></i></button></td>
                            </tr>";
                    echo $html;
                }else{

                }
            } else {
                // Jika data barang tidak ditemukan, kirimkan pesan 'Tidak ada hasil yang ditemukan'
                echo json_encode('Tidak ada hasil yang ditemukan');
            }
        }
    }
    public function simpanDataKeluar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggaltranskeluar' => 'required|date',
            'slcupkeluar' => 'required|exists:up,id',
            'slculpkeluar' => 'required|exists:ulp,id',
            'barang_code.*' => 'required|exists:barang,barang_code',
            'barang_quantity.*' => 'required|integer|min:1',
            'barang_sn.*' => 'nullable|string|max:255'
        ], [
            'tanggaltranskeluar.required' => 'Tanggal transaksi harus diisi.',
            'tanggaltranskeluar.date' => 'Tanggal transaksi harus berupa tanggal yang valid.',
            'slcupkeluar.required' => 'Pilih UP terlebih dahulu.',
            'slcupkeluar.exists' => 'UP yang Anda pilih tidak valid.',
            'slculpkeluar.required' => 'Pilih ULP terlebih dahulu.',
            'slculpkeluar.exists' => 'ULP yang Anda pilih tidak valid.',
            'barang_code.*.required' => 'Kode barang wajib diisi.',
            'barang_code.*.exists' => 'Kode barang tidak valid.',
            'barang_quantity.*.required' => 'Quantity barang wajib diisi.',
            'barang_quantity.*.integer' => 'Quantity barang harus berupa angka.',
            'barang_quantity.*.min' => 'Quantity barang harus lebih dari atau sama dengan 1.',
            'barang_sn.*.required' => 'Serial number barang wajib diisi.',
            'barang_sn.*.max' => 'Serial number barang tidak boleh lebih dari :max karakter.'
        ]);

        if ($validator->fails()) {
            foreach ($request->input('barang_quantity') as $quantity) {
                if (empty($quantity)) {
                    return redirect('trans/keluar')->with('error', 'Transaksi Gagal: Stok barang tidak cukup');
                }
            }
    
            return redirect('/transaksi')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Buat transaksi baru
            $transaksi = new Transaksi;
            $transaksi->trans_tanggal = $request->input('tanggaltranskeluar');
            $transaksi->trans_jenis = 'Keluar';
            $transaksi->up_id = $request->input('slcupkeluar');
            $transaksi->ulp_id = $request->input('slculpkeluar');
            $transaksi->created_by = auth()->user()->id;
            $transaksi->created_at = now();
            $transaksi->save();

            // Mendapatkan ID transaksi yang baru saja disimpan
            $transaksiId = $transaksi->id;

            // Mendapatkan data barang yang dikirim dari form
            $barangCodes = $request->input('barang_code');
            $barangQuantities = $request->input('barang_quantity');
            $barangSns = $request->input('barang_sn');

            // Loop melalui data barang dan menyimpan detail transaksi
            for ($i = 0; $i < count($barangCodes); $i++) {
                // Cari barang berdasarkan barang_code
                $barang = Barang::where('barang_code', $barangCodes[$i])->first();

                if ($barang) {
                    $detailTransaksi = new DetailTransaksi;
                    $detailTransaksi->trans_id = $transaksiId;
                    $detailTransaksi->barang_id = $barang->id; // Menggunakan barang_id yang sesuai
                    $detailTransaksi->barang_quantity = $barangQuantities[$i];
                    $detailTransaksi->barang_sn = $barangSns[$i];
                    $detailTransaksi->save();

                    // Mengurangi stok barang keluar dari semua transaksi masuk yang sesuai
                    $stokKeluar = $barangQuantities[$i];
                    $stokMasuk = DetailTransaksi::where('barang_id', $barang->id)->sum('barang_quantity');
                    $stokKeluarTotal = DetailTransaksi::where('barang_id', $barang->id)
                        ->whereHas('transaksi', function ($query) {
                            $query->where('trans_jenis', 'keluar');
                        })->sum('barang_quantity');

                    $sisaStok = $stokMasuk - $stokKeluarTotal;

                    if ($sisaStok < 0) {
                        // Handle jika stok keluar melebihi stok masuk
                        return redirect('/transaksi')->with('error', 'Transaksi Gagal: Stok barang tidak cukup');
                    }
                } else {
                    // Barang dengan barang_code tertentu tidak ditemukan, Anda bisa menangani ini sesuai kebutuhan Anda
                    // Misalnya, Anda bisa melewatkan data ini atau memberikan pesan kesalahan.
                }
            }

            return redirect('/transaksi')->with('success', 'Transaksi berhasil disimpan');
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for unique constraint violation
            if ($e->errorInfo[1] == 1062) {
                return redirect('/transaksi')->with('error', 'Transaksi Gagal: Data sudah ada dalam database');
            } else {
                throw $e; // Rethrow the exception if it's not due to unique constraint
            }
        }
    }

    
    

}