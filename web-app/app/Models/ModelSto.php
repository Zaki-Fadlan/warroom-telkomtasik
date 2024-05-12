<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSto extends Model
{

    public function allData()
    {
        return $this->db->table('dm_sto')
            ->join('dm_sto_st', 'dm_sto_st.id_st_dm_sto = dm_sto.status_sto', 'left')
            ->join('dm_datel', 'dm_datel.id_datel = dm_sto.datel_sto', 'left')
            ->orderBy('id_sto', 'DESC')->get()->getResultArray();
    }

    public function tambahSto($data)
    {
        return $this->db->table('dm_sto')->insert($data);
    }
    public function updateSTOData($data)
    {
        return $this->db->table('dm_sto')->where('id_sto', $data['id_sto'])->update($data);
    }
    public function checksto($data)
    {
        $sto = $this->db->table('dm_sto')->where('nama_sto', $data['nama_sto'])
            ->get()
            ->getResultArray();
        if (count($sto) == 0) {
            return 0;
        } else {
            return "ada data";
        }
    }
    public function dataSto($data)
    {
        $arr = $this->db->table('dm_sto')->where('id_sto', $data)->join('dm_sto_st', 'dm_sto_st.id_st_dm_sto = dm_sto.status_sto', 'left')
            ->get()
            ->getResultArray();
        return $arr;
    }
    public function validasiStoName($data)
    {
        $arr = $this->db->table('dm_sto')->where('nama_sto', $data['nama_sto'])->select('id_sto')
            ->get()
            ->getResultArray();
        return $arr;
    }
    public function filterSto($data)
    {
        $arr = $this->db->table('dm_sto')->where('datel_sto', $data['id_datel'])
            ->get()
            ->getResultArray();
        return $arr;
    }
    public function gettingSTOnamebyID($data)
    {
        return $this->db->table('dm_sto')->where('id_sto', $data)
            ->get()
            ->getRow()->nama_sto;
    }
}
