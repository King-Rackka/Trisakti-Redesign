<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table      = 'berita';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'judul',
        'slug',
        'tanggal',
        'gambar',
        'deskripsi',
        'created_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];

    protected function generateSlug(array $data): array
    {
        if (!empty($data['data']['judul'])) {
            $slug = url_title($data['data']['judul'], '-', true);

            $existing = $this->where('slug', $slug);
            if (!empty($data['id'])) {
                $existing = $existing->where('id !=', $data['id'][0]);
            }
            $count = $existing->countAllResults();

            if ($count > 0) {
                $slug = $slug . '-' . time();
            }

            $data['data']['slug'] = $slug;
        }

        return $data;
    }
}