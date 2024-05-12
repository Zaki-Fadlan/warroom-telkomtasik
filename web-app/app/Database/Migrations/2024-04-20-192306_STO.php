<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class STO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sto' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'datel_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'status' => [
                'type' => 'BOOLEAN',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('datel_id', 'dm2_datel', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dm2_sto');
    }

    public function down()
    {
        $this->forge->dropTable('dm2_sto');
    }
}
