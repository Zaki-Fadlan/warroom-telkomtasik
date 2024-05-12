<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTeknisi extends Model
{

    public function allData()
    {
        return $this->db->table('user_teknisi')
            ->orderBy('id_teknisi', 'DESC')
            ->join('dm_datel', 'dm_datel.id_datel=user_teknisi.datel_tek')
            ->get()->getResultArray();
    }

    public function tambahTeknisi($data)
    {
        return $this->db->table('user_teknisi')->insert($data);
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
    public function gettingNameTeknisi($data)
    {
        return $this->db->table('user_teknisi')->where('id_teknisi', $data)
            ->get()
            ->getRow()->nama_tek;
    }
    public function gettingIdTeleTeknisi($data)
    {
        return $this->db->table('user_teknisi')->where('id_teknisi', $data)
            ->get()
            ->getRow()->id_tele_tek;
    }

    public function updateTeknisi($data)
    {
        return $this->db->table('user_teknisi')->where('id_teknisi', $data['id_teknisi'])->update($data);
    }

    public function dataTeknisi($data)
    {
        $arr = $this->db->table('user_teknisi')->where('id_teknisi', $data)
            ->join('dm_datel', 'dm_datel.id_datel=datel_tek')
            ->join('user_web_st', 'user_web_st.id_st_user = user_teknisi.st_tek', 'left')
            ->orderBy('id_teknisi', 'DESC')
            ->get()
            ->getResultArray();
        return $arr;
    }

    public function validasiNIK($data)
    {
        $arr = $this->db->table('user_teknisi')
            ->where('nik_tek', $data['nik_tek'])->select('id_teknisi')
            ->get()
            ->getResultArray();
        return $arr;
    }
    public function validasitele($data)
    {
        $arr = $this->db->table('user_teknisi')
            ->where('id_tele_tek', $data['id_tele_tek'])->select('id_teknisi')
            ->get()
            ->getResultArray();
        return $arr;
    }
    public function jmlWo($data)
    {
        $arr = $this->db->table('all_wo')
            ->where('id_nama_teknisi', $data)->where('st_wo', 8)
            ->get()
            ->getResultArray();
        return count($arr);
    }
    public function checkIdbyIDtele($data)
    {
        $arr = $this->db->table('user_teknisi')
            ->where('id_tele_tek', $data)->select('id_teknisi')
            ->get()
            ->getRow()->id_teknisi;
        return $arr;
    }
}
