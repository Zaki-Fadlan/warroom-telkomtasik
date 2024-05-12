<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KecepatanSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kecepatan' => '20 Mbps',
                'status'    => 1,
            ],
            [
                'kecepatan' => '30 Mbps',
                'status'    => 1,
            ],
            [
                'kecepatan' => '40 Mbps',
                'status'    => 1,
            ],
            [
                'kecepatan' => '50 Mbps',
                'status'    => 1,
            ],
            [
                'kecepatan' => '100 Mbps',
                'status'    => 1,
            ],
            [
                'kecepatan' => '200 Mbps',
                'status'    => 1,
            ],
            [
                'kecepatan' => '300 Mbps',
                'status'    => 1,
            ],
        ];

        $this->db->table('dm2_kecepatan')->insertBatch($data);
    }
}
