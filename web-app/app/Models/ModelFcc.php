<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFcc extends Model
{
    public function allData()
    {
        return $this->db->table('dm_fcc')
            ->orderBy('id_fcc', 'DESC')
            ->get()->getResultArray();
    }
}
