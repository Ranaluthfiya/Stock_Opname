<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
    public $incrementing = true;
    public $timestamps = false;
    protected $table = 'transaksi';
    protected $guarded = ['created_at', 'created_by'];
    protected $fillable = [
        'id',
        'tanggal_trans',
        'trans_jenis',
        'up_id',
        'ulp_id',
        'created_by',
        'created_at',
    ];
    public function up()
    {
        return $this->belongsTo(UP::class, 'up_id');
    }

    public function ulp()
    {
        return $this->belongsTo(ULP::class, 'ulp_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function detail()
    {
        return $this->belongsTo(User::class, 'detail_id');
    }
    
}
