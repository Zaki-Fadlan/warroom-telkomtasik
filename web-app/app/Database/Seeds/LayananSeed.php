<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LayananSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'layanan' => 'WMS',
                'status'    => 1,
            ],
            [
                'layanan' => 'WMS Lite',
                'status'    => 1,
            ],
            [
                'layanan' => '1P POST ONLY',
                'status'    => 1,
            ],
            [
                'layanan' => '1P INET ONLY',
                'status'    => 1,
            ],
            [
                'layanan' => '1P Inet Jitu',
                'status'    => 1,
            ],
            [
                'layanan' => 'IH + Orbit',
                'status'    => 1,
            ],
            [
                'layanan' => 'BYOD 1P INTERNET ONLY',
                'status'    => 1,
            ],
            [
                'layanan' => 'BYOD 2P Internet + UseeTV',
                'status'    => 1,
            ],
            [
                'layanan' => '2P (Internet + Telpon)',
                'status'    => 1,
            ],
            [
                'layanan' => '2P (INTERNET + USEETV)',
                'status'    => 1,
            ],
            [
                'layanan' => '3PS',
                'status'    => 1,
            ],
            [
                'layanan' => 'PDA',
                'status'    => 1,
            ],
            [
                'layanan' => 'MO',
                'status'    => 1,
            ],
        ];

        $this->db->table('dm2_Layanan')->insertBatch($data);
    }
}
