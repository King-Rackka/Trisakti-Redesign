<?php

namespace App\Controllers;

class TentangController extends BaseController
{
    protected $profil;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->profil = \Config\Database::connect()
            ->table('profil')->get()->getRowArray();
    }

    private function sidebarMenu(): array
    {
        return [
            ['label' => 'Tentang Universitas', 'url' => 'tentang/tentang-universitas'],
            ['label' => 'Sejarah Singkat', 'url' => 'tentang/sejarah'],
            ['label' => 'Visi dan Misi', 'url' => 'tentang/visi-misi'],
            ['label' => 'Motto', 'url' => 'tentang/motto'],
            ['label' => 'Struktur Organisasi', 'url' => 'tentang/struktur-organisasi'],
            ['label' => 'Hubungi Kami', 'url' => 'tentang/kontak'],
        ];
    }

    public function sejarah()
    {
        return view('tentang/layout', [
            'title' => 'Sejarah Singkat — Universitas Trisakti',
            'active'  => 'tentang/sejarah',
            'page_title' => 'Sejarah Singkat',
            'sidebar_menu' => $this->sidebarMenu(),
            'konten'  => $this->profil['sejarah'] ?? '',
        ]);
    }

    public function visiMisi()
    {
        return view('tentang/visi_misi', [
            'title' => 'Visi dan Misi — Universitas Trisakti',
            'active' => 'tentang/visi-misi',
            'page_title' => 'Visi dan Misi',
            'sidebar_menu' => $this->sidebarMenu(),
            'visi'  => $this->profil['visi'] ?? '',
            'misi' => $this->profil['misi'] ?? '',
        ]);
    }

    public function motto()
    {
        return view('tentang/layout', [
            'title' => 'Motto — Universitas Trisakti',
            'active' => 'tentang/motto',
            'page_title' => 'Motto',
            'sidebar_menu' => $this->sidebarMenu(),
            'konten' => ($this->profil['motto_deskripsi'] ?? ''),
            'highlight' => $this->profil['motto'] ?? '',
        ]);
    }

    public function tentangUniversitas()
    {
        return view('tentang/layout', [
            'title' => 'Tentang Universitas — Universitas Trisakti',
            'active' => 'tentang/tentang-universitas',
            'page_title' => 'Tentang Universitas',
            'sidebar_menu' => $this->sidebarMenu(),
            'konten' => ($this->profil['tentang'] ?? ''),
        ]);
    }

    public function strukturOrganisasi()
    {
        $db = \Config\Database::connect();
        $struktur = [];
        if ($db->tableExists('struktur')) {
            $struktur = $db->table('struktur')
                ->get()->getResultArray();
        }

        return view('tentang/struktur', [
            'title' => 'Struktur Organisasi',
            'active' => 'tentang/struktur-organisasi',
            'page_title' => 'Struktur Organisasi',
            'sidebar_menu' => $this->sidebarMenu(),
            'struktur' => $struktur,
        ]);
    }
}