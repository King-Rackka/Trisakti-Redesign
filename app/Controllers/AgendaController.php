<?php

namespace App\Controllers;

class AgendaController extends BaseController
{
    private function db() { return \Config\Database::connect(); }

    public function index()
    {
        $db      = $this->db();
        $perPage = 8;
        $page    = max(1, (int)($this->request->getGet('page_agenda') ?? 1));
        $offset  = ($page - 1) * $perPage;
        $total   = $db->table('agenda')->countAllResults();
        $pageCount = (int)ceil($total / $perPage);

        if ($page > $pageCount && $pageCount > 0) {
            $page   = $pageCount;
            $offset = ($page - 1) * $perPage;
        }

        $featured = $db->table('agenda')
            ->where('tanggal >=', date('Y-m-d'))
            ->orderBy('tanggal', 'ASC')
            ->limit(1)->get()->getRowArray();

        if (!$featured) {
            $featured = $db->table('agenda')
                ->orderBy('tanggal', 'DESC')
                ->limit(1)->get()->getRowArray();
        }

        $agenda = $db->table('agenda')
            ->orderBy('tanggal', 'DESC')
            ->limit($perPage, $offset)
            ->get()->getResultArray();

        return view('agenda', [
            'title'       => 'Agenda — Universitas Trisakti',
            'featured'    => $featured,
            'agenda'      => $agenda,
            'pageCount'   => $pageCount,
            'currentPage' => $page,
            'total'       => $total,
            'perPage'     => $perPage,
        ]);
    }

    public function detail(string $slug)
    {
        $db     = $this->db();
        $agenda = $db->table('agenda')->where('slug', $slug)->get()->getRowArray();

        if (!$agenda) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $terdekat = $db->table('agenda')
            ->where('id !=', $agenda['id'])
            ->where('tanggal >=', date('Y-m-d'))
            ->orderBy('tanggal', 'ASC')
            ->limit(4)->get()->getResultArray();

        if (count($terdekat) < 4) {
            $ids   = array_column($terdekat, 'id') ?: [0];
            $extra = $db->table('agenda')
                ->where('id !=', $agenda['id'])
                ->whereNotIn('id', $ids)
                ->orderBy('tanggal', 'DESC')
                ->limit(4 - count($terdekat))
                ->get()->getResultArray();
            $terdekat = array_merge($terdekat, $extra);
        }

        return view('detailAgenda', [
            'title'    => esc($agenda['judul']) . ' — Universitas Trisakti',
            'agenda'   => $agenda,
            'terdekat' => $terdekat,
        ]);
    }
}