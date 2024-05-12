<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStoSt extends Model
{

    public function allData()
    {
        return $this->db->table('dm_sto_st')->get()->getResultArray();
    }
}
