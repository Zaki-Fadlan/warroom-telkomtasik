<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatelSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'datel' => 'Datel Banjar',
                'status'    => 1,
            ],
            [
                'datel' => 'Datel Ciamis',
                'status'    => 1,
            ],
            [
                'datel' => 'Datel Garut',
                'status'    => 1,
            ],
            [
                'datel' => 'Datel Singaparna',
                'status'    => 1,
            ],
            [
                'datel' => 'Inner Tasikmalaya',
                'status'    => 1,
            ],
        ];

        $this->db->table('dm2_datel')->insertBatch($data);
    }
}
