<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKendala extends Model
{
    public function allData()
    {
        return $this->db->table('dm_kendala')
            ->orderBy('id_kendala', 'ASC')->get()->getResultArray();
    }
}
