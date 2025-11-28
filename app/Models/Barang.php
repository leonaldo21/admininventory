<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'barang';

    // Primary key
    protected $primaryKey = 'id_barang';

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'nama_barang',
        'serial_number',   // ✅ ditambahkan
        'kategori',
        'quantity_total',
        'satuan',
        'remarks',
    ];

    // Relasi ke tabel barang_masuk
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_barang', 'id_barang');
    }

    // Relasi ke tabel barang_keluar
    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_barang', 'id_barang');
    }
}
