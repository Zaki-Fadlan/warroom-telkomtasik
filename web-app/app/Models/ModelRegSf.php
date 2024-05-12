<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRegSf extends Model
{

    public function allData()
    {
        return $this->db->table('reg_sf')->join('dm_datel', 'dm_datel.id_datel=datel_sf')
            ->join('user_web_st', 'user_web_st.id_st_user = reg_sf.st_sf', 'left')
            ->orderBy('st_sf', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function addRegSf($data)
    {
        return $this->db->table('reg_sf')->insert($data);
    }

    public function checkdata($data)
    {
        $tele = $this->db->table('user_sf')->where('id_tele_sf', $data['id_tele_sf'])
            ->get()
            ->getResultArray();
        $kcon = $this->db->table('user_sf')->where('kcon', $data['kcon'])
            ->get()
            ->getResultArray();
        if (count($tele) == 0 and count($kcon) == 0) {
            return 0;
        } else {
            return "ada data";
        }
    }
}
