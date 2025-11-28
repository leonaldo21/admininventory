<?php

// File: app/Models/Admin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Admin extends Authenticatable
{
    use HasFactory;

    // Tabel yang digunakan di database adalah 'admins' (plural).
    // Mendefinisikannya secara eksplisit membantu mengatasi case-sensitivity.
    protected $table = 'admins'; 

    /**
     * Nama kolom username (username) sudah sesuai dengan database, 
     * jadi tidak perlu fungsi tambahan di sini.
     */

    protected $guarded = ['id'];
}