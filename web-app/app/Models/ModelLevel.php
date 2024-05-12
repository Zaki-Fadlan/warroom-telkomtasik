<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLevel extends Model
{
    public function allData()
    {
        return $this->db->table('dm_level')
            ->orderBy('id_level', 'DESC')->get()->getResultArray();
    }
}
