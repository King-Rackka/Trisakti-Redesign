<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\AgendaModel;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $profil = [];
        try {
            $profil = $db->table('profil')->get()->getRowArray() ?? [];
        } catch (\Throwable $e) {}

        $berita = [];
        try {
            $newsModel = new NewsModel();
            $agendaModel = new AgendaModel();
            $fakultas = $db->table('fakultas')->get()->getResultArray() ?? [];

            $berita = $newsModel->orderBy('tanggal', 'DESC')->findAll(4);
            $agenda = $agendaModel->orderBy('tanggal', 'DESC')->findAll(4);
        } catch (\Throwable $e) {}

        return view('home', [
            'title'  => 'Beranda — Universitas Trisakti',
            'profil' => $profil,
            'berita' => $berita,
            'agenda' => $agenda,
            'fakultas' => $fakultas,
        ]);
    }
}