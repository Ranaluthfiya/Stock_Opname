<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'barang';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'barang_code',
        'barang_nama',
        'barang_merk',
        'barang_jenis',
        'barang_tipe',
        'barang_satuan',
    ];
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'barang_id');
    }

    
}
