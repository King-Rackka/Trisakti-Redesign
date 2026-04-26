<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AkunAdmin extends Migration
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
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
 
        $this->forge->addKey('id', true);
        $this->forge->createTable('admin');
 
        $this->db->table('admin')->insert([
            'email'    => 'radityaAdmin@gmail.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
        ]);
    }
 
    public function down()
    {
        $this->forge->dropTable('admin');
    }
}
