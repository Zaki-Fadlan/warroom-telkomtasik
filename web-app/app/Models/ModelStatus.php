<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStatus extends Model
{
    public function allData()
    {
        return $this->db->table('dm_wo_st')
            ->orderBy('id_st_wo', 'ASC')->get()->getResultArray();
    }
}
