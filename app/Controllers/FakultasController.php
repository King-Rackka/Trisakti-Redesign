<?php 

namespace App\Controllers;
use App\Models\FakultasModel;
use App\Models\ProdiModel;
 
class FakultasController extends BaseController
{
    protected FakultasModel $fakModel;
    protected ProdiModel    $prodiModel;
 
    public function __construct()
    {
        $this->fakModel   = new FakultasModel();
        $this->prodiModel = new ProdiModel();
    }
 
    public function index()
    {
        return view('fakultas/index', [
            'title'    => 'Fakultas',
            'fakultas' => $this->fakModel->getAllWithProdiCount(),
        ]);
    }
 
    public function detail(string $slug)
    {
        $fak = $this->fakModel->getWithProdi($slug);
        if (!$fak) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
        return view('fakultas/index', [
            'title'   => $fak['nama'],
            'fakultas' => $fak,
        ]);
    }
 
    public function detailProdi(string $fakSlug, string $prodiSlug)
    {
        $prodi = $this->prodiModel->getWithFakultas($prodiSlug);
        if (!$prodi) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
        return view('fakultas/detailProdi', [
            'title' => $prodi['nama'],
            'prodi' => $prodi,
        ]);
    }
}