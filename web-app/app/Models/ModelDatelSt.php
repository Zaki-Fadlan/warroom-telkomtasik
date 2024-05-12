<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDatelSt extends Model
{

    public function allData()
    {
        return $this->db->table('dm_datel_st ')->get()->getResultArray();
    }
}
