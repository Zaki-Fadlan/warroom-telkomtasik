<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPvitaData extends Model
{

    public function dataDatel()
    {
        return $this->db->table('dm_datel')->orderBy('id_datel', 'DESC')
            ->get()->getResultArray();
    }

    public function dataSto()
    {
        return $this->db->table('dm_sto')->orderBy('id_sto', 'DESC')
            ->get()->getResultArray();
    }

    public function dataSf()
    {
        return $this->db->table('user_sf')->orderBy('id_sf', 'DESC')->join('dm_datel', 'dm_datel.id_datel=user_sf.datel_sf')
            ->get()->getResultArray();
    }

    public function dataUser()
    {
        return $this->db->table('user_web')->orderBy('id_user', 'DESC')->join('dm_level', 'dm_level.id_level=lv_user')
            ->get()->getResultArray();
    }

    public function dataTeknisi()
    {
        return $this->db->table('user_teknisi')->orderBy('nama_tek', 'ASC')->join('dm_datel', 'dm_datel.id_datel=user_teknisi.datel_tek')
            ->get()->getResultArray();
    }
}
