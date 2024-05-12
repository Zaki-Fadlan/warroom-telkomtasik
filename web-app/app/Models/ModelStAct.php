<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStAct extends Model
{

    public function allData()
    {
        return $this->db->table('st_actnact')->get()->getResultArray();
    }
}
