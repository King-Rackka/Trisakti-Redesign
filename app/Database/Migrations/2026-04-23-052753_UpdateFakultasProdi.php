<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateFakultasProdi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('prodi', [
            'nama_kaprodi'     => ['type' => 'VARCHAR',  'constraint' => 150, 'null' => true, 'after' => 'sejarah'],
            'foto_kaprodi'     => ['type' => 'VARCHAR',  'constraint' => 255, 'null' => true, 'after' => 'nama_kaprodi'],
            'sambutan_kaprodi' => ['type' => 'TEXT',     'null' => true,                      'after' => 'foto_kaprodi'],
        ]);
    }
 
    public function down()
    {
        $this->forge->dropColumn('prodi', ['nama_kaprodi', 'foto_kaprodi', 'sambutan_kaprodi']);
    }
}
