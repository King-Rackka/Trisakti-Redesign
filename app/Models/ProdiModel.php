<?php

namespace App\Models;
use CodeIgniter\Model;
 
class ProdiModel extends Model
{
    protected $table         = 'prodi';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id_fakultas','nama','slug','jenjang',
        'bg_tipe','bg_value','tentang','sejarah',
        'nama_kaprodi', 'foto_kaprodi', 'sambutan_kaprodi',
    ];
 
    public function getByFakultas(int $idFakultas)
    {
        return $this->where('id_fakultas', $idFakultas)->findAll();
    }
 
    public function getWithFakultas(string $slug)
    {
        return $this->db->table('prodi p')
            ->select('p.*, f.nama as nama_fakultas, f.slug as slug_fakultas, f.warna as warna_fakultas')
            ->join('fakultas f', 'f.id = p.id_fakultas')
            ->where('p.slug', $slug)
            ->get()->getRowArray();
    }
 
    public function makeSlug(string $nama, ?int $excludeId = null): string
    {
        $base = url_title(strtolower($nama), '-', true);
        $slug = $base;
        $i    = 1;
        while (true) {
            $q = $this->where('slug', $slug);
            if ($excludeId) $q->where('id !=', $excludeId);
            if (!$q->first()) break;
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}