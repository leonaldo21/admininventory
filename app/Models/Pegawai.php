<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

    // Kalau id_pegawai auto-increment integer, biarkan default
    // Kalau bukan, tambahkan:
    // protected $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'nik_ktp',
        'no_kk',
        'no_bpjs',
        'no_jmo',
        'no_npwp',
        'badge_id',
        'role',
        'dokumen',
    ];

    // Akses URL file dokumen langsung di Blade
    public function getDokumenUrlAttribute()
    {
        return $this->dokumen ? Storage::url($this->dokumen) : null;
    }
}
