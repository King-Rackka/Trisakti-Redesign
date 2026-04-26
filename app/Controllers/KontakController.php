<?php

namespace App\Controllers;

class KontakController extends BaseController
{
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

    public function index()
    {
        $db    = \Config\Database::connect();
        $semua = $db->table('kontak')->get()->getResultArray();

        $kontak = [];
        foreach ($semua as $item) {
            $kontak[$item['jenis']] = $item['nilai'];
        }

        return view('tentang/kontak', [ 
            'title' => 'Hubungi Kami — Universitas Trisakti',
            'active' => 'kontak',
            'sidebar_menu' => $this->sidebarMenu(),
            'kontak' => $kontak,
        ]);
    }
}