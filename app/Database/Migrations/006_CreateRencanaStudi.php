<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRencanaStudi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rencana_studi' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'nim' => [
                'type' => 'CHAR',
                'constraint' => 10,
            ],
            'id_jadwal' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'nilai_angka' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'nilai_huruf' => [
                'type' => 'CHAR',
                'constraint' => 2,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_rencana_studi', true);
        $this->forge->addForeignKey('nim', 'mahasiswa', 'nim', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_jadwal', 'jadwal', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rencana_studi');
    }

    public function down()
    {
        $this->forge->dropTable('rencana_studi');
    }
}
