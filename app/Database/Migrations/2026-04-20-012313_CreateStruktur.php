<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStruktur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('struktur');

        $data = [
            ['nama' => 'Prof. Dr. Ir. Kadarsah Suryadi, DEA', 'jabatan' => 'Rektor'],
            ['nama' => 'Dr. Ir. Muhammad Burhannudinnur, M.Sc., IPU, ASEAN Eng.', 'jabatan' => 'Wakil Rektor I'],
            ['nama' => 'Prof. Dr. Khomsiyah, Ak., CA. FCMA., CGMA., CRIB.', 'jabatan' => 'Wakil Rektor II'],
            ['nama' => 'Ir. Yoska Oktaviano, MT', 'jabatan' => 'Plt. Wakil Rektor III'],
            ['nama' => 'Prof. Dr. drg. Tri Erri Astoeti, M.Kes., FISDPH., FISPD', 'jabatan' => 'Wakil Rektor IV'],
            ['nama' => 'Prof. Dr. Ir. Astri Rinanti, M.T., IPM., ASEAN Eng.', 'jabatan' => 'Direktur Lembaga Penelitian dan Pengabdian kepada Masyarakat (LP2M)'],
            ['nama' => 'Dr. Ir. Bambang Endro Yuwono, MS', 'jabatan' => 'Direktur Lembaga Manajemen Kampus '],
            ['nama' => 'Dr. Ir. Pantjanita Novi Hartami, S.T., M.T.,I.P.M,ASEAN.Eng', 'jabatan' => 'Direktur Badan Jaminan Mutu'],
            ['nama' => 'Ir. Agus Guntoro, MSi,PhD ', 'jabatan' => 'Direktur Kantor Urusan Internasional, Kerjasama, dan Kebudayaan'],
            ['nama' => 'Dr. Regina Jansen Arsjah, S.E., M.Si., Ak., CA.,CPA.', 'jabatan' => 'Direktur Badan Pengawas Internal '],
            ['nama' => 'Richy Wijaya W., SE., MM., C.R.A., C.R.P', 'jabatan' => 'Pjs. Direktur Badan Afiliasi'],
            ['nama' => 'Dr. Aji Wibowo, SH., MH.', 'jabatan' => 'Kepala Sekretariat Universitas'],
            ['nama' => 'Prof. Dr. Ir. Engeline Shintadewi Julian, MT', 'jabatan' => 'Kepala Biro Administrasi Akademik'],
            ['nama' => 'Gunawan, ST, MT', 'jabatan' => 'Kepala Biro Administrasi Umum'],
            ['nama' => 'Aqamal Haq, SE., Ak., MM', 'jabatan' => 'Kepala Biro Administrasi Keuangan'],
            ['nama' => 'Ir. Andry Prima, MT', 'jabatan' => 'Kepala Biro Administrasi Kemahasiswaan'],
            ['nama' => 'Prof. Dr. Elfrida Ratnawati Gultom, SH., M.Hum, M.Kn', 'jabatan' => 'Kepala Biro Sumber Daya Manusia'],
            ['nama' => 'Ir. H. Agung Sediono, MT, PhD', 'jabatan' => 'Kepala Biro Administrasi Perencanaan dan Sistem Informasi'],
            ['nama' => 'Djulijanto', 'jabatan' => 'Kepala UPT Otorita Kampus'],
            ['nama' => 'Dr. drg. Dewi Priandini, Sp.PM', 'jabatan' => 'Kepala UPT Hubungan Masyarakat'],
            ['nama' => 'Debbie Kemalasari, S.T., M.B.A., M.T., I.P.M.', 'jabatan' => 'Pjs. Kepala UPT Promosi dan Admisi'],
            ['nama' => 'Richy Wijaya W., SE., MM., C.R.A., C.R.P', 'jabatan' => 'Kepala UPT Pusat Karier'],
            ['nama' => 'Rizka Medina, S.Hum, MM', 'jabatan' => 'Pjs. Kepala UPT Perpustakaan'],
            ['nama' => 'Dr. Erny Tajib, SE., MM', 'jabatan' => 'Direktur Pusat Pembelajaran, Penerbitan dan Percetakan Digital Trisakti (P3DT)'],
        ];

        $this->db->table('struktur')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('struktur');
    }
}
