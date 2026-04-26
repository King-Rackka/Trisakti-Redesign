<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\NewsModel;
use App\Models\FakultasModel;
use App\Models\ProdiModel;

class Admin extends BaseController
{

    protected $newsModel;
    protected $fakModel;
    protected $prodiModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
        $this->fakModel    = new FakultasModel();
        $this->prodiModel  = new ProdiModel();
    }

    public function dashboard()
    {
        return view('admin/dashboard', [
            'title' => 'Dashboard Admin',
            'username' => session()->get('username'),
        ]);
    }
    
    public function berita()
    {
        $perPage = 8;

        return view('admin/berita/index', [
            'title' => 'Kelola Berita',
            'berita' => $this->newsModel->orderBy('tanggal', 'DESC')->paginate($perPage, 'berita'),
            'pager'   => $this->newsModel->pager,
            'perPage' => $perPage,
        
            ]);
    }

    public function beritaTambah()
    {
        return view('admin/berita/form', [
            'title' => 'Tambah Berita',
            'berita' => null,
        ]);
    }

    public function beritaSimpan()
    {
        if (!$this->validate([
            'judul' => 'required|min_length[5]',
            'tanggal' => 'required|valid_date',
            'deskripsi' => 'required',
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->newsModel->insert([
            'judul' => $this->request->getPost('judul'),
            'tanggal' => $this->request->getPost('tanggal'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar' => $this->uploadGambar(),
        ]);

        return redirect()->to('/admin/berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function beritaEdit(int $id)
    {
        $berita = $this->newsModel->find($id);
        if (!$berita) throw new \CodeIgniter\Exceptions\PageNotFoundException();

        return view('admin/berita/form', [
            'title' => 'Edit Berita',
            'berita' => $berita,
        ]);
    }

    public function beritaUpdate(int $id)
    {
        $berita = $this->newsModel->find($id);
        if (!$berita) throw new \CodeIgniter\Exceptions\PageNotFoundException();

        if (!$this->validate([
            'judul' => 'required|min_length[5]',
            'tanggal' => 'required|valid_date',
            'deskripsi' => 'required',
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $namaGambar = $berita['gambar'];
        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($berita['gambar'])) {
                $pathLama = ROOTPATH . 'public/assets/news/' . $berita['gambar'];
                if (file_exists($pathLama)) unlink($pathLama);
            }
            $namaGambar = $this->uploadGambar();
        }

        $this->newsModel->update($id, [
            'judul'     => $this->request->getPost('judul'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar'    => $namaGambar,
        ]);

        return redirect()->to('/admin/berita')->with('success', 'Berita berhasil diperbarui.');
    }

    public function beritaHapus(int $id)
    {
        $berita = $this->newsModel->find($id);
        if (!$berita) throw new \CodeIgniter\Exceptions\PageNotFoundException();

        if (!empty($berita['gambar'])) {
            $path = ROOTPATH . 'public/assets/news/' . $berita['gambar'];
            if (file_exists($path)) unlink($path);
        }

        $this->newsModel->delete($id);
        return redirect()->to('/admin/berita')->with('success', 'Berita berhasil dihapus.');
    }

    private function uploadGambar(): ?string
    {
        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $nama = $file->getRandomName();
            $file->move(ROOTPATH . 'public/assets/news/', $nama);
            return $nama;
        }
        return null;
    }

    public function profil()
{
    $profil = \Config\Database::connect()->table('profil')->get()->getRowArray();
    return view('admin/profil', [
        'title'  => 'Profil Kampus',
        'profil' => $profil,
    ]);
}
 
public function profilUpdate()
{
    $db    = \Config\Database::connect();
    $field = $this->request->getPost('field');
 
    $updateData = [];
 
    switch ($field) {
        case 'sejarah':
            $updateData = ['sejarah' => $this->request->getPost('sejarah')];
            break;
        case 'visimisi':
            $updateData = [
                'visi' => $this->request->getPost('visi'),
                'misi' => $this->request->getPost('misi'),
            ];
            break;
        case 'motto':
            $updateData = [
                'motto'            => $this->request->getPost('motto'),
                'motto_deskripsi'  => $this->request->getPost('motto_deskripsi'),
            ];
            break;
        case 'tentang':
            $updateData = ['tentang' => $this->request->getPost('tentang')];
            break;
    }
 
    if (!empty($updateData)) {
        $updateData['updated_at'] = date('Y-m-d H:i:s');
        $db->table('profil')->update($updateData, ['id' => 1]);
    }
 
    return redirect()->to('/admin/profil')->with('success', 'Profil berhasil diperbarui.');
}
 
 
public function kontak()
{
    $db    = \Config\Database::connect();
    $semua = $db->table('kontak')->get()->getResultArray();
 
    $kontak = [];
    foreach ($semua as $item) {
        $kontak[$item['jenis']] = $item['nilai'];
    }
 
    return view('admin/kontak', [
        'title'  => 'Kelola Kontak',
        'kontak' => $kontak,
    ]);
}
 
public function kontakUpdate()
{
    $db     = \Config\Database::connect();
    $fields = ['alamat', 'telepon', 'whatsapp', 'fax', 'email', 'facebook', 'instagram', 'twitter', 'youtube', 'tiktok'];
 
    foreach ($fields as $field) {
        $nilai = $this->request->getPost($field);
        if ($nilai !== null) {
            $existing = $db->table('kontak')->where('jenis', $field)->get()->getRowArray();
            if ($existing) {
                $db->table('kontak')->where('jenis', $field)->update([
                    'nilai'      => $nilai,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $db->table('kontak')->insert([
                    'jenis'      => $field,
                    'nilai'      => $nilai,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
 
    return redirect()->to('/admin/kontak')->with('success', 'Kontak berhasil diperbarui.');
}

public function struktur()
{
    return view('admin/struktur/index', [
        'title' => 'Struktur Organisasi',
        'struktur' => \Config\Database::connect()->table('struktur')->get()->getResultArray(),
    ]);
}
 
 
public function strukturEdit(int $id)
{
    $struktur = \Config\Database::connect()->table('struktur')->where('id', $id)->get()->getRowArray();
    if (!$struktur) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
    return view('admin/struktur/form', [
        'title'    => 'Edit Struktur',
        'struktur' => $struktur,
    ]);
}
 
public function strukturUpdate(int $id)
{
    if (!$this->validate([
        'jabatan' => 'required',
        'nama'    => 'required',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
 
    \Config\Database::connect()->table('struktur')->where('id', $id)->update([
        'jabatan' => $this->request->getPost('jabatan'),
        'nama'    => $this->request->getPost('nama'),
    ]);
 
    return redirect()->to('/admin/struktur')->with('success', 'Data berhasil diperbarui.');
}
public function alumni()
{
    $db      = \Config\Database::connect();
    $perPage = 10;
    $model   = new \App\Models\AlumniModel();

    return view('admin/alumni/index', [
        'title'   => 'Kelola Alumni',
        'alumni'  => $model->orderBy('angkatan', 'DESC')->paginate($perPage, 'alumni'),
        'pager'   => $model->pager,
        'perPage' => $perPage,
    ]);
}
 
public function alumniTambah()
{
    return view('admin/alumni/form', [
        'title'  => 'Tambah Alumni',
        'alumni' => null,
    ]);
}
 
public function alumniSimpan()
{
    if (!$this->validate([
        'nama'     => 'required',
        'jurusan'  => 'required',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
 
    $data = [
        'nama'      => $this->request->getPost('nama'),
        'jurusan'   => $this->request->getPost('jurusan'),
        'angkatan'  => $this->request->getPost('angkatan'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'foto_profil' => $this->uploadFile('foto_profil', 'alumni'),
        'background_images' => $this->uploadFile('background_images', 'alumni'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
 
    \Config\Database::connect()->table('alumni')->insert($data);
 
    return redirect()->to('/admin/alumni')->with('success', 'Alumni berhasil ditambahkan.');
}
 
public function alumniEdit(int $id)
{
    $alumni = \Config\Database::connect()->table('alumni')->where('id', $id)->get()->getRowArray();
    if (!$alumni) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
    return view('admin/alumni/form', [
        'title'  => 'Edit Alumni',
        'alumni' => $alumni,
    ]);
}
 
public function alumniUpdate(int $id)
{
    $db     = \Config\Database::connect();
    $alumni = $db->table('alumni')->where('id', $id)->get()->getRowArray();
    if (!$alumni) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
    if (!$this->validate([
        'nama'     => 'required',
        'jurusan'  => 'required',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
 
    $data = [
        'nama'      => $this->request->getPost('nama'),
        'jurusan'   => $this->request->getPost('jurusan'),
        'angkatan'  => $this->request->getPost('angkatan'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
 
    $newFoto = $this->uploadFile('foto_profil', 'alumni');
    if ($newFoto) {
        $this->deleteFile('alumni', $alumni['foto_profil']);
        $data['foto_profil'] = $newFoto;
    }
 
    $newBg = $this->uploadFile('background_images', 'alumni');
    if ($newBg) {
        $this->deleteFile('alumni', $alumni['background_images']);
        $data['background_images'] = $newBg;
    }
 
    $db->table('alumni')->where('id', $id)->update($data);
 
    return redirect()->to('/admin/alumni')->with('success', 'Alumni berhasil diperbarui.');
}
 
public function alumniHapus(int $id)
{
    $db     = \Config\Database::connect();
    $alumni = $db->table('alumni')->where('id', $id)->get()->getRowArray();
    if (!$alumni) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
    $this->deleteFile('alumni', $alumni['foto_profil']);
    $this->deleteFile('alumni', $alumni['background_images']);
 
    $db->table('alumni')->where('id', $id)->delete();
 
    return redirect()->to('/admin/alumni')->with('success', 'Alumni berhasil dihapus.');
}
 
private function uploadFile(string $field, string $folder): ?string
{
    $file = $this->request->getFile($field);
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $nama = $file->getRandomName();
        $file->move(ROOTPATH . 'public/assets/' . $folder, $nama);
        return $nama;
    }
    return null;
}

private function deleteFile(string $folder, ?string $filename): void
{
    if (!empty($filename)) {
        $path = ROOTPATH . 'public/assets/' . $folder . '/' . $filename;
        if (file_exists($path)) unlink($path);
    }
}

public function agenda()
{
    $model  = new \App\Models\AgendaModel();
    $perPage = 8;
 
    $agenda = $model->orderBy('tanggal', 'DESC')->paginate($perPage, 'agenda');
 
    return view('admin/agenda/index', [
        'title'       => 'Kelola Agenda',
        'agenda'      => $agenda,
        'pager'       => $model->pager,
        'currentPage' => $model->pager->getCurrentPage('agenda'),
        'perPage'     => $perPage,
    ]);
}
 
public function agendaTambah()
{
    return view('admin/agenda/form', [
        'title'  => 'Tambah Agenda',
        'agenda' => null,
    ]);
}
 
public function agendaSimpan()
{
    if (!$this->validate([
        'judul'     => 'required|min_length[5]',
        'tanggal'   => 'required|valid_date',
        'waktu'     => 'required',
        'deskripsi' => 'required',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
 
    $model = new \App\Models\AgendaModel();
    $model->insert([
        'judul'      => $this->request->getPost('judul'),
        'tanggal'    => $this->request->getPost('tanggal'),
        'waktu'      => $this->request->getPost('waktu'),
        'tempat'     => $this->request->getPost('tempat'),
        'deskripsi'  => $this->request->getPost('deskripsi'),
        'gambar'     => $this->uploadFile('gambar', 'agenda') ?? '',
        'created_at' => date('Y-m-d H:i:s'),
    ]);
 
    return redirect()->to('/admin/agenda')->with('success', 'Agenda berhasil ditambahkan.');
}
 
public function agendaEdit(int $id)
{
    $agenda = \Config\Database::connect()->table('agenda')->where('id', $id)->get()->getRowArray();
    if (!$agenda) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
    return view('admin/agenda/form', [
        'title'  => 'Edit Agenda',
        'agenda' => $agenda,
    ]);
}
 
public function agendaUpdate(int $id)
{
    $db     = \Config\Database::connect();
    $agenda = $db->table('agenda')->where('id', $id)->get()->getRowArray();
    if (!$agenda) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
    if (!$this->validate([
        'judul'     => 'required|min_length[5]',
        'tanggal'   => 'required|valid_date',
        'waktu'     => 'required',
        'deskripsi' => 'required',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
 
    $data = [
        'judul'     => $this->request->getPost('judul'),
        'tanggal'   => $this->request->getPost('tanggal'),
        'waktu'     => $this->request->getPost('waktu'),
        'tempat'    => $this->request->getPost('tempat'),
        'deskripsi' => $this->request->getPost('deskripsi'),
    ];
 
    $newGambar = $this->uploadFile('gambar', 'agenda');
    if ($newGambar) {
        $this->deleteFile('agenda', $agenda['gambar']);
        $data['gambar'] = $newGambar;
    }
 
    $model = new \App\Models\AgendaModel();
    $model->update($id, $data);
 
    return redirect()->to('/admin/agenda')->with('success', 'Agenda berhasil diperbarui.');
}
 
public function agendaHapus(int $id)
{
    $db     = \Config\Database::connect();
    $agenda = $db->table('agenda')->where('id', $id)->get()->getRowArray();
    if (!$agenda) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
    $this->deleteFile('agenda', $agenda['gambar']);
 
    $model = new \App\Models\AgendaModel();
    $model->delete($id);
 
    return redirect()->to('/admin/agenda')->with('success', 'Agenda berhasil dihapus.');
}

public function fakultas()
{
    $activeTab = $this->request->getGet('tab') === 'prodi' ? 'prodi' : 'fakultas';

    return view('admin/fakultas/index', [
        'title'     => 'Kelola Fakultas & Prodi',
        'activeTab' => $activeTab, 
        'fakultas'  => $this->fakModel->getAllWithProdiCount(),
        'prodi'     => $this->prodiModel
                          ->select('prodi.*, fakultas.nama as nama_fakultas, fakultas.warna')
                          ->join('fakultas', 'fakultas.id = prodi.id_fakultas')
                          ->findAll(),
        'fakList'   => $this->fakModel->findAll(),
    ]);
}

    public function fakultasTambah()
    {
        return view('admin/fakultas/formFakultas', [
            'title' => 'Tambah Fakultas',
            'fak'   => null,
        ]);
    }
 
    public function fakultasSimpan()
    {
        if (!$this->validate([
            'nama'    => 'required|min_length[3]',
            'warna'   => 'required',
            'bg_tipe' => 'required|in_list[youtube,image]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
 
        [$bgTipe, $bgValue] = $this->_processBg('fakultas');
        $fotoDe = $this->uploadFile('foto_dekan', 'dekan');
 
        $nama = $this->request->getPost('nama');
        $this->fakModel->insert([
            'nama'            => $nama,
            'slug'            => $this->fakModel->makeSlug($nama),
            'warna'           => $this->request->getPost('warna'),
            'bg_tipe'         => $bgTipe,
            'bg_value'        => $bgValue,
            'jmlh_mahasiswa'  => (int)($this->request->getPost('jmlh_mahasiswa') ?: 0),
            'jmlh_guru_besar' => (int)($this->request->getPost('jmlh_guru_besar') ?: 0),
            'jmlh_doktor'     => (int)($this->request->getPost('jmlh_doktor') ?: 0),
            'jmlh_pengajar'   => (int)($this->request->getPost('jmlh_pengajar') ?: 0),
            'sejarah_singkat' => $this->request->getPost('sejarah_singkat'),
            'nama_dekan'      => $this->request->getPost('nama_dekan'),
            'foto_dekan'      => $fotoDe,
            'sambutan_dekan'  => $this->request->getPost('sambutan_dekan'),
        ]);
 
        return redirect()->to('/admin/fakultas')->with('success', 'Fakultas berhasil ditambahkan.');
    }

    public function fakultasEdit(int $id)
    {
        $fak = $this->fakModel->find($id);
        if (!$fak) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
        return view('admin/fakultas/formFakultas', [
            'title' => 'Edit Fakultas',
            'fak'   => $fak,
        ]);
    }
 
    public function fakultasUpdate(int $id)
    {
        $fak = $this->fakModel->find($id);
        if (!$fak) return redirect()->back()->with('error', 'Data tidak ditemukan.');
 
        [$bgTipe, $bgValue] = $this->_processBg('fakultas', $fak);
 
        $fotoDe   = $fak['foto_dekan'];
        $newFoto  = $this->uploadFile('foto_dekan', 'dekan');
        if ($newFoto) {
            $this->deleteFile('dekan', $fak['foto_dekan']);
            $fotoDe = $newFoto;
        }
 
        $nama = $this->request->getPost('nama');
        $this->fakModel->update($id, [
            'nama'            => $nama,
            'slug'            => $this->fakModel->makeSlug($nama, $id),
            'warna'           => $this->request->getPost('warna'),
            'bg_tipe'         => $bgTipe,
            'bg_value'        => $bgValue,
            'jmlh_mahasiswa'  => (int)($this->request->getPost('jmlh_mahasiswa') ?: 0),
            'jmlh_guru_besar' => (int)($this->request->getPost('jmlh_guru_besar') ?: 0),
            'jmlh_doktor'     => (int)($this->request->getPost('jmlh_doktor') ?: 0),
            'jmlh_pengajar'   => (int)($this->request->getPost('jmlh_pengajar') ?: 0),
            'sejarah_singkat' => $this->request->getPost('sejarah_singkat'),
            'nama_dekan'      => $this->request->getPost('nama_dekan'),
            'foto_dekan'      => $fotoDe,
            'sambutan_dekan'  => $this->request->getPost('sambutan_dekan'),
        ]);
 
        return redirect()->to('/admin/fakultas')->with('success', 'Fakultas berhasil diperbarui.');
    }
 
    public function fakultasHapus(int $id)
    {
        $fak = $this->fakModel->find($id);
        if (!$fak) return redirect()->back()->with('error', 'Data tidak ditemukan.');
 
        if ($fak['bg_tipe'] === 'image') $this->deleteFile('fakultas', $fak['bg_value']);
        $this->deleteFile('dekan', $fak['foto_dekan']);
        $this->fakModel->delete($id);
 
        return redirect()->to('/admin/fakultas')->with('success', 'Fakultas berhasil dihapus.');
    }
 
 
    public function prodiTambah()
    {
        return view('admin/fakultas/formProdi', [
            'title'   => 'Tambah Program Studi',
            'prodi'   => null,
            'fakList' => $this->fakModel->findAll(),
        ]);
    }
 
    public function prodiSimpan()
    {
        if (!$this->validate([
            'nama'        => 'required|min_length[3]',
            'id_fakultas' => 'required|integer',
            'jenjang'     => 'required|in_list[D3,S1,S2,S3,Profesi,Spesialis]',
            'bg_tipe'     => 'required|in_list[youtube,image]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
 
        [$bgTipe, $bgValue] = $this->_processBg('prodi');
 
        $nama = $this->request->getPost('nama');
        $this->prodiModel->insert([
            'id_fakultas' => $this->request->getPost('id_fakultas'),
            'nama'        => $nama,
            'slug'        => $this->prodiModel->makeSlug($nama),
            'jenjang'     => $this->request->getPost('jenjang'),
            'bg_tipe'     => $bgTipe,
            'bg_value'    => $bgValue,
            'tentang'     => $this->request->getPost('tentang') ?: null,
            'sejarah'     => $this->request->getPost('sejarah') ?: null,
            'nama_kaprodi'     => $this->request->getPost('nama_kaprodi')     ?: null,
            'sambutan_kaprodi' => $this->request->getPost('sambutan_kaprodi') ?: null,
            'foto_kaprodi'     => $this->uploadFile('foto_kaprodi', 'kaprodi'),
        ]);
 
        return redirect()->to('/admin/fakultas?tab=prodi')->with('success', 'Prodi berhasil ditambahkan.');
    }
 
    public function prodiEdit(int $id)
    {
        $prodi = $this->prodiModel->find($id);
        if (!$prodi) throw new \CodeIgniter\Exceptions\PageNotFoundException();
 
        return view('admin/fakultas/formProdi', [
            'title'   => 'Edit Program Studi',
            'prodi'   => $prodi,
            'fakList' => $this->fakModel->findAll(),
        ]);
    }

    public function prodiUpdate(int $id)
    {
        $prodi = $this->prodiModel->find($id);
        if (!$prodi) return redirect()->back()->with('error', 'Data tidak ditemukan.');
        
        $fotoKap   = $prodi['foto_kaprodi'];
        $newFotoKap = $this->uploadFile('foto_kaprodi', 'kaprodi');
        if ($newFotoKap) {
            $this->deleteFile('kaprodi', $prodi['foto_kaprodi']);
            $fotoKap = $newFotoKap;
        }

        [$bgTipe, $bgValue] = $this->_processBg('prodi', $prodi);
 
        $nama = $this->request->getPost('nama');
        $this->prodiModel->update($id, [
            'id_fakultas' => $this->request->getPost('id_fakultas'),
            'nama'        => $nama,
            'slug'        => $this->prodiModel->makeSlug($nama, $id),
            'jenjang'     => $this->request->getPost('jenjang'),
            'bg_tipe'     => $bgTipe,
            'bg_value'    => $bgValue,
            'tentang'     => $this->request->getPost('tentang') ?: null,
            'sejarah'     => $this->request->getPost('sejarah') ?: null,
            'nama_kaprodi'     => $this->request->getPost('nama_kaprodi')     ?: null,
            'sambutan_kaprodi' => $this->request->getPost('sambutan_kaprodi') ?: null,
            'foto_kaprodi'     => $fotoKap,
        ]);
 
        return redirect()->to('/admin/fakultas?tab=prodi')->with('success', 'Prodi berhasil diperbarui.');
    }
 
    public function prodiHapus(int $id)
    {
        $prodi = $this->prodiModel->find($id);
        if (!$prodi) return redirect()->back()->with('error', 'Data tidak ditemukan.');
 
        if ($prodi['bg_tipe'] === 'image') $this->deleteFile('prodi', $prodi['bg_value']);
        $this->prodiModel->delete($id);
        $this->deleteFile('kaprodi', $prodi['foto_kaprodi']);
 
        return redirect()->to('/admin/fakultas?tab=prodi')->with('success', 'Prodi berhasil dihapus.');
    }
 
    
    private function _processBg(string $folder, ?array $existing = null): array
    {
        $bgTipe  = $this->request->getPost('bg_tipe');
        $bgValue = $existing['bg_value'] ?? null;
 
        if ($bgTipe === 'youtube') {
            $bgValue = trim($this->request->getPost('bg_youtube') ?? '');
        } else {
            $file = $this->request->getFile('bg_image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                if (!in_array($file->getMimeType(), ['image/jpeg','image/png','image/webp'])) {
                    return [$bgTipe, $bgValue];
                }
                if ($existing && $existing['bg_tipe'] === 'image' && $existing['bg_value']) {
                    $this->deleteFile($folder, $existing['bg_value']);
                }
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/assets/' . $folder . '/', $newName);
                $bgValue = $newName;
            }
        }
 
        return [$bgTipe, $bgValue];
    }
 
    private function uploadFileFakultasProdi(string $field, string $folder): ?string
    {
        $file = $this->request->getFile($field);
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $nama = $file->getRandomName();
            $file->move(ROOTPATH . 'public/assets/' . $folder, $nama);
            return $nama;
        }
        return null;
    }
 
    private function deleteFileFakultasProdi(string $folder, ?string $filename): void
    {
        if (!empty($filename)) {
            $path = ROOTPATH . 'public/assets/' . $folder . '/' . $filename;
            if (file_exists($path)) unlink($path);
        }
    }
    
}