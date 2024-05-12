<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRegTek extends Model
{

    public function allData()
    {
        return $this->db->table('reg_teknisi')->join('dm_datel', 'dm_datel.id_datel=datel_tek')
            ->join('user_web_st', 'user_web_st.id_st_user = reg_teknisi.st_tek', 'left')
            ->orderBy('st_tek', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function addRegTeknisi($data)
    {
        return $this->db->table('reg_teknisi')->insert($data);
    }

    public function checkdata($data)
    {
        $tele = $this->db->table('user_teknisi')->where('id_tele_tek', $data['id_tele_tek'])
            ->get()
            ->getResultArray();
        $nik = $this->db->table('user_teknisi')->where('nik_tek', $data['nik_tek'])
            ->get()
            ->getResultArray();
        if (count($tele) == 0 and count($nik) == 0) {
            return 0;
        } else {
            return "ada data";
        }
    }
}
