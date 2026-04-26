<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTentang extends Migration
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
            'sejarah' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'visi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'misi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'motto' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'motto_deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tentang' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
 
        $this->forge->addKey('id', true);
        $this->forge->createTable('profil');
    }
 
    public function down()
    {
        $this->forge->dropTable('profil');
    }
}
