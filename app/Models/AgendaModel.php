<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class AgendaModel extends Model
{
    protected $table      = 'agenda';
    protected $primaryKey = 'id';
 
    protected $allowedFields = [
        'judul', 'slug', 'waktu', 'tanggal',
        'tempat', 'gambar', 'deskripsi', 'created_at',
    ];
 
    protected $useTimestamps = false;
 
    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];
 
    protected function generateSlug(array $data): array
    {
        if (!empty($data['data']['judul'])) {
            $slug     = url_title($data['data']['judul'], '-', true);
            $existing = $this->where('slug', $slug);
            if (!empty($data['id'])) {
                $existing = $existing->where('id !=', $data['id'][0]);
            }
            if ($existing->countAllResults() > 0) {
                $slug .= '-' . time();
            }
            $data['data']['slug'] = $slug;
        }
        return $data;
    }
}

?>