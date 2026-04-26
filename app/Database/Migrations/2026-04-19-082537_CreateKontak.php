<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKontak extends Migration
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
            'jenis' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'nilai' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
 
        $this->forge->addKey('id', true);
        $this->forge->createTable('kontak');
 
        $data = [
            ['jenis' => 'alamat',    'nilai' => 'Jl. Kyai Tapa No. 1 Grogol, Jakarta Barat, Indonesia', 'updated_at' => date('Y-m-d H:i:s')],
            ['jenis' => 'telepon',   'nilai' => '(62-21) 566 3232',    'updated_at' => date('Y-m-d H:i:s')],
            ['jenis' => 'whatsapp',  'nilai' => '+62 882 194 856 74',   'updated_at' => date('Y-m-d H:i:s')],
            ['jenis' => 'fax',       'nilai' => '(62-21) 564 4270',     'updated_at' => date('Y-m-d H:i:s')],
            ['jenis' => 'email',     'nilai' => 'humas@trisakti.ac.id', 'updated_at' => date('Y-m-d H:i:s')],
            ['jenis' => 'facebook',  'nilai' => 'https://www.facebook.com/hubunganmasyarakat.usakti/',       'updated_at' => date('Y-m-d H:i:s')],
            ['jenis' => 'instagram', 'nilai' => 'https://instagram.com/usakti_official',           'updated_at' => date('Y-m-d H:i:s')],
            ['jenis' => 'twitter',   'nilai' => 'https://x.com/usakti_official',                    'updated_at' => date('Y-m-d H:i:s')],
            ['jenis' => 'youtube',   'nilai' => 'https://youtube.com/UniversitasTrisakti',         'updated_at' => date('Y-m-d H:i:s')],
        ];
 
        $this->db->table('kontak')->insertBatch($data);
    }
 
    public function down()
    {
        $this->forge->dropTable('kontak');
    }
}
