<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStReq extends Model
{

    public function allData()
    {
        return $this->db->table('st_req')->get()->getResultArray();
    }
}
