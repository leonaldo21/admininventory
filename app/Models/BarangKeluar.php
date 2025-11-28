<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';

    protected $primaryKey = 'id_barang_keluar';

    protected $fillable = [
        'id_barang',
        'kode_barang',
        'nama_barang',
        'satuan',
        'jumlah',
        'tujuan',
        'penerima',
        'lokasi',
        'tanggal_keluar',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
