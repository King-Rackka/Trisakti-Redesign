<?php

namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateFakultasProdi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'auto_increment' => true],
            'nama'            => ['type' => 'VARCHAR', 'constraint' => 150],
            'slug'            => ['type' => 'VARCHAR', 'constraint' => 160, 'unique' => true],
            'warna'           => ['type' => 'VARCHAR', 'constraint' => 10, 'default' => '#1a3a6b'],
            'bg_tipe'         => ['type' => 'ENUM', 'constraint' => ['youtube','image'], 'default' => 'image'],
            'bg_value'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true], // url ytb / nama file
            'jmlh_mahasiswa'  => ['type' => 'INT', 'default' => 0],
            'jmlh_guru_besar' => ['type' => 'INT', 'default' => 0],
            'jmlh_doktor'     => ['type' => 'INT', 'default' => 0],
            'jmlh_pengajar'   => ['type' => 'INT', 'default' => 0],
            'sejarah_singkat' => ['type' => 'TEXT', 'null' => true],
            'nama_dekan'      => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'foto_dekan'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sambutan_dekan'  => ['type' => 'TEXT', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('fakultas');

        $this->forge->addField([
            'id'           => ['type' => 'INT', 'auto_increment' => true],
            'id_fakultas'  => ['type' => 'INT'],
            'nama'         => ['type' => 'VARCHAR', 'constraint' => 150],
            'slug'         => ['type' => 'VARCHAR', 'constraint' => 160, 'unique' => true],
            'jenjang'      => ['type' => 'ENUM', 'constraint' => ['D3','S1','S2','S3','Profesi'], 'default' => 'S1'],
            'bg_tipe'      => ['type' => 'ENUM', 'constraint' => ['youtube','image'], 'default' => 'image'],
            'bg_value'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'tentang'      => ['type' => 'TEXT', 'null' => true],
            'sejarah'      => ['type' => 'TEXT', 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_fakultas', 'fakultas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('prodi');
    }

    public function down()
    {
        $this->forge->dropTable('prodi', true);
        $this->forge->dropTable('fakultas', true);
    }
}