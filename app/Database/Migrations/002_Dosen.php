<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDosen extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nidn' => [
                'type' => 'CHAR',
                'constraint' => 10,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addKey('nidn', true);
        $this->forge->createTable('dosen');
    }

    public function down()
    {
        $this->forge->dropTable('dosen');
    }
}
