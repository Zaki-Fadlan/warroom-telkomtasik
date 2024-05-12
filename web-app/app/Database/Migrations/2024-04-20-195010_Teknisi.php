<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Teknisi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => '36',
                'unique'     => true,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'unique'     => true,
            ],
            'id_telegram' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'contact' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'unique'     => true,
            ],
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'mitra' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'labor' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'crew' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'sto_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'teknisi_action' => [
                'type'       => 'INT',
                'constraint' => '2',
                'unsigned'   => true,
            ],
            'status' => [
                'type' => 'BOOLEAN',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sto_id', 'dm2_sto', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dm2_teknisi');
    }

    public function down()
    {
        $this->forge->dropTable('dm2_teknisi');
    }
}
