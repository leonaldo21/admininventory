<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    
    protected $table = 'barang_masuk'; 

    // Primary key disesuaikan dengan migrasi
    protected $primaryKey = 'id_barang_masuk'; 

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_barang',
        'jumlah',
        'tanggal_masuk',
        'lokasi',
        'diterima_oleh',
    ];

    protected $dates = ['tanggal_masuk'];
    public $timestamps = true;

    /**
     * Relasi ke Barang
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    /**
     * Relasi ke Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'diterima_oleh', 'id_pegawai');
    }
}