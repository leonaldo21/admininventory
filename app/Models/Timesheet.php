<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $table = 'timesheet';
    protected $fillable = [
        'pegawai_id', 'tanggal', 'jam_masuk', 'jam_keluar', 'aktivitas'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
