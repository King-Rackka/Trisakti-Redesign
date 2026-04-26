<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new NewsModel();
    }

    
    public function index()
    {
        $berita_terbaru = $this->beritaModel
            ->orderBy('tanggal', 'DESC')
            ->findAll(7); 

        
        $berita_populer = $this->beritaModel
            ->orderBy('tanggal', 'ASC') 
            ->findAll(3);

        $perPage = 8;
        $semua_berita = $this->beritaModel
            ->orderBy('tanggal', 'DESC')
            ->paginate($perPage, 'berita');

        $data = [
            'title'          => 'Berita — Universitas Trisakti',
            'berita_terbaru' => $berita_terbaru,
            'berita_populer' => $berita_populer,
            'semua_berita'   => $semua_berita,
            'pager'          => $this->beritaModel->pager,
        ];

        return view('news', $data);
    }

    public function show(string $slug)
    {
        $berita = $this->beritaModel->where('slug', $slug)->first();

        if (!$berita) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Berita '$slug' tidak ditemukan.");
        }

        $terkait = $this->beritaModel
            ->where('id !=', $berita['id'])
            ->orderBy('tanggal', 'DESC')
            ->findAll(4);

        $data = [
            'title'   => esc($berita['judul']) . ' — Universitas Trisakti',
            'berita'  => $berita,
            'terkait' => $terkait,
        ];

        return view('detailNews', $data);
    }
}