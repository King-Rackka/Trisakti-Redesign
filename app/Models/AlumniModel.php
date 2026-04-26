<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $table      = 'alumni';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama',
        'foto_profil',
        'background_images',
        'jurusan',
        'angkatan',
        'deskripsi',
        'updated_at',
    ];

    protected $useTimestamps = false;
}