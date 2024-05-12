<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKecepatan extends Model
{
    public function allData()
    {
        return $this->db->table('dm_kecepatan')->join('dm_datel_st', 'dm_datel_st.id_st_dm_datel = dm_kecepatan.st_kc', 'left')
            ->orderBy('st_kc', 'DESC')
            ->get()->getResultArray();
    }
    public function tambahKecepatan($data)
    {
        return $this->db->table('dm_kecepatan')->insert($data);
    }
    public function updateKecepatan($data)
    {
        return $this->db->table('dm_kecepatan')->where('id_kecepatan', $data['id_kecepatan'])->update($data);
    }
    public function checkKecepatan($data)
    {
        $arr = $this->db->table('dm_kecepatan')->where('nama_kecepatan', $data['nama_kecepatan'])
            ->get()
            ->getResultArray();
        return count($arr);
    }
    public function dataKecepatan($data)
    {
        $arr = $this->db->table('dm_kecepatan')->where('id_kecepatan', $data)
            ->join('dm_datel_st', 'dm_datel_st.id_st_dm_datel = dm_kecepatan.st_kc', 'left')
            ->get()
            ->getResultArray();
        return $arr;
    }
    public function validasiNamaKecepatan($data)
    {
        $arr = $this->db->table('dm_kecepatan')->where('nama_kecepatan', $data['nama_kecepatan'])->select('id_kecepatan')
            ->get()
            ->getResultArray();
        return $arr;
    }
}
