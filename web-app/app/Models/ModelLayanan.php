<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLayanan extends Model
{
    public function allData()
    {
        // return $this->db->table('dm_layanan')
        //     ->get()->getResultArray();
        return $this->db->table('dm_layanan')->join('dm_datel_st', 'dm_datel_st.id_st_dm_datel = dm_layanan.st_ly', 'left')
            ->orderBy('st_ly', 'DESC')
            ->get()->getResultArray();
    }
    public function tambahlayanan($data)
    {
        return $this->db->table('dm_layanan')->insert($data);
    }
    public function updatelayanan($data)
    {
        return $this->db->table('dm_layanan')->where('id_layanan', $data['id_layanan'])->update($data);
    }
    public function checklayanan($data)
    {
        $arr = $this->db->table('dm_layanan')->where('nama_layanan', $data['nama_layanan'])
            ->get()
            ->getResultArray();
        return count($arr);
    }
    public function datalayanan($data)
    {
        $arr = $this->db->table('dm_layanan')->where('id_layanan', $data)
            ->join('dm_datel_st', 'dm_datel_st.id_st_dm_datel = dm_layanan.st_ly', 'left')
            ->get()
            ->getResultArray();
        return $arr;
    }
    public function validasiNamaLayanan($data)
    {
        $arr = $this->db->table('dm_layanan')->where('nama_layanan', $data['nama_layanan'])->select('id_layanan')
            ->get()
            ->getResultArray();
        return $arr;
    }
}
