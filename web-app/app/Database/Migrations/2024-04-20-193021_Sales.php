<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sales extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => '36',
                'unique'     => true,
            ],
            'id_telegram' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'con_sf' => [
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
            'action_sf' => [
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
        $this->forge->createTable('dm2_sales');
    }

    public function down()
    {
        $this->forge->dropTable('dm2_sales');
    }
}
