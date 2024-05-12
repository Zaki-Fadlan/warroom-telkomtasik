<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datel extends Migration
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
            'datel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type' => 'BOOLEAN',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('dm2_datel');
    }

    public function down()
    {
        $this->forge->dropTable('dm2_datel');
    }
}
