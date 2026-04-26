<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAlumni extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'foto_profil' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'background-images' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'jurusan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'angkatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'deskripsi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('alumni');

    }

    public function down()
    {
        $this->forge->dropTable('alumni');
    }
}
