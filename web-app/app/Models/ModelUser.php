<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{

    public function allData()
    {
        return $this->db->table('user_web')->join('dm_level', 'dm_level.id_level=lv_user')->join('dm_datel', 'dm_datel.id_datel=datel_user')
            ->join('user_web_st', 'user_web_st.id_st_user = user_web.st_user', 'left')
            ->orderBy('st_user', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function tambahUser($data)
    {
        return $this->db->table('user_web')->insert($data);
    }
    public function updateUser($data)
    {
        return $this->db->table('user_web')->where('id_user', $data['id_user'])->update($data);
    }

    public function checknik($data)
    {
        $arr = $this->db->table('user_web')->where('nik', $data['nik'], 'password', $data['password'])
            ->get()
            ->getResultArray();
        return count($arr);
    }

    public function dataUser($data)
    {
        $arr = $this->db->table('user_web')->where('id_user', $data)
            ->join('dm_level', 'dm_level.id_level=lv_user')
            ->join('dm_datel', 'dm_datel.id_datel=datel_user')
            ->join('user_web_st', 'user_web_st.id_st_user = user_web.st_user', 'left')
            ->orderBy('st_user', 'DESC')
            ->get()
            ->getResultArray();
        return $arr;
    }

    public function validasiNIK($data)
    {
        $arr = $this->db->table('user_web')->where('nik', $data['nik'])->select('id_user')
            ->get()
            ->getResultArray();
        return $arr;
    }
    public function gettingNameUser($data)
    {
        return $this->db->table('user_web')->where('id_user', $data)
            ->orderBy('st_user', 'DESC')
            ->get()
            ->getRow()->nama_user;
    }
}
