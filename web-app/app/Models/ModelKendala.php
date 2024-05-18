<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKendala extends Model
{
    public function allData()
    {
        return $this->db->table('dm_kendala')->join('dm_datel_st', 'dm_datel_st.id_st_dm_datel = dm_kendala.st_k', 'left')
            ->orderBy('id_kendala', 'DESC')
            ->get()->getResultArray();
    }
    public function tambahKendala($data)
    {
        return $this->db->table('dm_kendala')->insert($data);
    }
    public function updateKendala($data)
    {
        return $this->db->table('dm_kendala')->where('id_kendala', $data['id_kendala'])->update($data);
    }
    public function checkKendala($data)
    {
        $arr = $this->db->table('dm_kendala')->where('n_tipe_kendala', $data['n_tipe_kendala'])
            ->get()
            ->getResultArray();
        return count($arr);
    }
    public function dataKendala($data)
    {
        $arr = $this->db->table('dm_kendala')->where('id_kendala', $data)
            ->join('dm_datel_st', 'dm_datel_st.id_st_dm_datel = dm_kendala.st_k', 'left')
            ->get()
            ->getResultArray();
        return $arr;
    }
    public function validasiNamaKendala($data)
    {
        $arr = $this->db->table('dm_kendala')->where('n_tipe_kendala', $data['n_tipe_kendala'])->select('id_kendala')
            ->get()
            ->getResultArray();
        return $arr;
    }
}
