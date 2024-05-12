<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDatel extends Model
{

    public function allData()
    {
        return $this->db->table('dm_datel')->join('dm_datel_st', 'dm_datel_st.id_st_dm_datel = dm_datel.status_datel', 'left')
            ->orderBy('status_datel', 'DESC')
            ->get()->getResultArray();
    }

    public function tambahDatel($data)
    {
        return $this->db->table('dm_datel')->insert($data);
    }
    public function updateDatel($data)
    {
        return $this->db->table('dm_datel')->where('id_datel', $data['id_datel'])->update($data);
    }
    public function checkdatel($data)
    {
        $arr = $this->db->table('dm_datel')->where('nama_datel', $data['nama_datel'])
            ->get()
            ->getResultArray();
        return count($arr);
    }
    public function dataDatel($data)
    {
        $arr = $this->db->table('dm_datel')->where('id_datel', $data)
            ->join('dm_datel_st', 'dm_datel_st.id_st_dm_datel = dm_datel.status_datel', 'left')
            ->get()
            ->getResultArray();
        return $arr;
    }
    public function validasiDatelName($data)
    {
        $arr = $this->db->table('dm_datel')->where('nama_datel', $data['nama_datel'])->select('id_datel')
            ->get()
            ->getResultArray();
        return $arr;
    }
}
