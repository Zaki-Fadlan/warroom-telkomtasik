<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUserSt extends Model
{

    public function allData()
    {
        return $this->db->table('user_web_st ')->get()->getResultArray();
    }
}
