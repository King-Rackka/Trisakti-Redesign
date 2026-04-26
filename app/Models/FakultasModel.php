<?php

namespace App\Models;
use CodeIgniter\Model;
 
class FakultasModel extends Model
{
    protected $table         = 'fakultas';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'nama','slug','warna','bg_tipe','bg_value',
        'jmlh_mahasiswa','jmlh_guru_besar','jmlh_doktor','jmlh_pengajar',
        'sejarah_singkat','nama_dekan','foto_dekan','sambutan_dekan',
    ];
 
    public function getAllWithProdiCount()
    {
        return $this->db->table('fakultas f')
            ->select('f.*, COUNT(p.id) as jmlh_prodi')
            ->join('prodi p', 'p.id_fakultas = f.id', 'left')
            ->groupBy('f.id')
            ->orderBy('f.nama', 'ASC')
            ->get()->getResultArray();
    }
 
    public function getWithProdi(string $slug)
    {
        $fak = $this->where('slug', $slug)->first();
        if (!$fak) return null;
 
        $prodi = (new ProdiModel())->where('id_fakultas', $fak['id'])->findAll();
        $fak['prodi'] = $prodi;
        return $fak;
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

?>