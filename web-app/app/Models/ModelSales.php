<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSales extends Model
{

    public function allData()
    {
        return $this->db->table('user_sf')
            ->orderBy('id_sf', 'DESC')
            ->join('dm_datel', 'dm_datel.id_datel=user_sf.datel_sf')
            ->get()
            ->getResultArray();
    }

    public function tambahSales($data)
    {
        return $this->db->table('user_sf')->insert($data);
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

    public function updateSales($data)
    {
        return $this->db->table('user_sf')->where('id_sf', $data['id_sf'])->update($data);
    }

    public function dataSales($data)
    {
        $arr = $this->db->table('user_sf')->where('id_sf', $data)
            ->join('dm_datel', 'dm_datel.id_datel=datel_sf')
            ->join('user_web_st', 'user_web_st.id_st_user = user_sf.st_sf', 'left')
            ->orderBy('id_sf', 'DESC')
            ->get()
            ->getResultArray();
        return $arr;
    }

    public function validasiId($data)
    {
        $arr = $this->db->table('user_sf')
            ->where('id_tele_sf', $data['id_tele_sf'])
            ->select('id_sf')
            ->get()
            ->getResultArray();
        return $arr;
    }

    public function validasiK($data)
    {
        $arr = $this->db->table('user_sf')
            ->where('kcon', $data['kcon'])
            ->select('id_sf')
            ->get()
            ->getResultArray();
        return $arr;
    }
}
