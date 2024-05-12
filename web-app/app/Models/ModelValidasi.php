<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelValidasi extends Model
{
    public function allData()
    {
        return $this->db->table('dm_validasi')
            ->orderBy('id_validasi', 'DESC')
            ->get()->getResultArray();
    }
}
