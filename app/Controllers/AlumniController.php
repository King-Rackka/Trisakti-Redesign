<?php

namespace App\Controllers;

class AlumniController extends BaseController
{
    protected $db;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $model  = new \App\Models\AlumniModel();
        $perPage = 6;

        $alumni = $model->orderBy('angkatan', 'DESC')->paginate($perPage, 'alumni');

        return view('alumni', [
            'title'  => 'Alumni — Universitas Trisakti',
            'alumni' => $alumni,
            'pager'  => $model->pager,
        ]);
    }

    public function detail(int $id)
    {
        $alumni = $this->db->table('alumni')->where('id', $id)->get()->getRowArray();

        if (!$alumni) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Alumni tidak ditemukan.");
        }

        $lainnya = $this->db->table('alumni')
            ->where('id !=', $id)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get()->getResultArray();

        return view('detailAlumni', [
            'title'   => esc($alumni['nama']) . ' — Alumni Universitas Trisakti',
            'alumni'  => $alumni,
            'lainnya' => $lainnya,
        ]);
    }
}