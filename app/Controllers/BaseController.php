<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseController extends Controller
{
    protected $helpers = ['url', 'form'];

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->injectFooterData();
    }

    private function injectFooterData(): void
{
    try {
        $db = \Config\Database::connect();

        $semua = $db->table('kontak')->get()->getResultArray();

        $kontakFooter  = array_values(array_filter($semua, fn($k) => in_array($k['jenis'], ['alamat','telepon','whatsapp','fax','email'])));
        $sosmedFooter  = array_values(array_filter($semua, fn($k) => in_array($k['jenis'], ['facebook','instagram','twitter','youtube','tiktok'])));

        $fakultasFooter = [];
        if ($db->tableExists('fakultas')) {
            $fakultasFooter = $db->table('fakultas')->select('nama, slug')->orderBy('nama', 'ASC')->get()->getResultArray();
        }

    } catch (\Throwable $e) {
        $kontakFooter   = [];
        $sosmedFooter   = [];
        $fakultasFooter = [];
    }

    \Config\Services::renderer()->setData([
    'kontakFooter'   => $kontakFooter,
    'sosmedFooter'   => $sosmedFooter,
    'fakultasFooter' => $fakultasFooter,
]);
}
}