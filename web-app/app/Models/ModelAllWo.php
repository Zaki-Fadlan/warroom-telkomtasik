<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAllWo extends Model
{
    // WO Validasi
    public function validasi()
    {
        return $this->db->table('all_wo')->groupStart()->where('st_wo', 1)->orWhere('st_wo', 6)->groupEnd()
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function validasiFilter($data)
    {
        return $this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])
            ->WhereIn('sto', $data['stoPlace'])->groupStart()->where('st_wo', 1)->orwhere('st_wo', 6)->groupEnd()
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function getDataValidasi($data)
    {
        return $this->db->table('all_wo')->where('id', $data)
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function updateValidasi($data)
    {
        return $this->db->table('all_wo')->where('id', $data['id'])->update($data);
    }

    //wo scbe
    public function scbe()
    {
        return $this->db->table('all_wo')->groupStart()->where('st_wo', 2)->orWhere('st_wo', 7)->groupEnd()
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->join('user_web', 'user_web.id_user = all_wo.nama_val', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function scbeFilter($data)
    {
        return $this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])
            ->WhereIn('sto', $data['stoPlace'])->where('st_wo', 2)
            ->join('user_web', 'user_web.id_user = all_wo.nama_val', 'left')
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function getDataScbe($data)
    {
        return $this->db->table('all_wo')->where('id', $data)
            ->join('user_web', 'user_web.id_user = all_wo.na_isi_tek', 'left')
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function updateScbe($data)
    {
        return $this->db->table('all_wo')->where('id', $data['id'])->update($data);
    }

    //wo progres
    public function progressI()
    {
        return $this->db->table('all_wo')->where('st_wo', 9)
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->join('user_web', 'user_web.id_user = all_wo.nama_val', 'left')
            ->join('user_teknisi', 'user_teknisi.id_teknisi = all_wo.id_nama_teknisi', 'inner')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }

    public function progressFilterI($data)
    {
        return $this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])
            ->WhereIn('sto', $data['stoPlace'])->where('st_wo', 9)
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->join('user_web', 'user_web.id_user = all_wo.nama_val', 'left')
            ->join('user_teknisi', 'user_teknisi.id_teknisi = all_wo.id_nama_teknisi', 'inner')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }

    public function updateSC($data)
    {
        return $this->db->table('all_wo')->where('id', $data['id'])->update($data);
    }
    public function getDataSC($data)
    {
        return $this->db->table('all_wo')->where('id', $data)
            //->join('dm_stsc','dm_stsc.id = all_wo.st_sc','left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }

    public function progressH()
    {
        return $this->db->table('all_wo')->groupStart()->where('st_wo', 3)->orWhere('st_wo', 10)->groupEnd()
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('user_teknisi', 'user_teknisi.id_teknisi = all_wo.id_nama_teknisi', 'inner')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->join('user_web', 'user_web.id_user = all_wo.nama_val', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }

    public function progressFilterH($data)
    {
        return $this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])
            ->WhereIn('sto', $data['stoPlace'])->groupStart()->where('st_wo', 3)->orWhere('st_wo', 10)->groupEnd()
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('user_teknisi', 'user_teknisi.id_teknisi = all_wo.id_nama_teknisi', 'inner')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->join('user_web', 'user_web.id_user = all_wo.nama_val', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    // wo Kendala
    public function kendala()
    {
        return $this->db->table('all_wo')->where('st_wo', 4)
            ->join('user_web', 'user_web.id_user = all_wo.nama_val', 'inner')
            ->join('user_teknisi', 'user_teknisi.id_teknisi = all_wo.id_nama_teknisi', 'inner')
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kendala', 'dm_kendala.id_kendala = all_wo.tp_kendala', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function kendalaFilter($data)
    {
        return $this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])
            ->WhereIn('sto', $data['stoPlace'])->where('st_wo', 4)
            ->join('user_web', 'user_web.id_user = all_wo.nama_val', 'inner')
            ->join('user_teknisi', 'user_teknisi.id_teknisi = all_wo.id_nama_teknisi', 'inner')
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kendala', 'dm_kendala.id_kendala = all_wo.tp_kendala', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }

    public function updateRollback($data)
    {
        return $this->db->table('all_wo')->where('id', $data['id'])->update($data);
    }
    // wo Teknisi
    public function teknisi()
    {
        return $this->db->table('all_wo')->where('st_wo', 8)
            ->join('user_web', 'user_web.id_user = all_wo.nama_val', 'inner')
            ->join('user_teknisi', 'user_teknisi.id_teknisi = all_wo.id_nama_teknisi', 'inner')
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function teknisiFilter($data)
    {
        return $this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])
            ->WhereIn('sto', $data['stoPlace'])->where('st_wo', 8)
            ->join('user_web', 'user_web.id_user = all_wo.nama_val', 'inner')
            ->join('user_teknisi', 'user_teknisi.id_teknisi = all_wo.id_nama_teknisi', 'inner')
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    // ganti Teknisi
    // Wo manja
    public function manja()
    {
        return $this->db->table('all_wo')->where('st_wo', 4)
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_kendala', 'dm_kendala.id_kendala = all_wo.tp_kendala', 'left')
            ->where('id_kendala', 4)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function manjafilter($data)
    {
        return $this->db->table('all_wo')->where('stamp_ampser>', $data['sTime'])->where('stamp_ampser<', $data['eTime'])
            ->WhereIn('sto', $data['stoPlace'])->where('st_wo', 4)
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->join('dm_kendala', 'dm_kendala.id_kendala = all_wo.tp_kendala', 'left')
            ->where('id_kendala', 4)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }

    //wo manja
    public function monitor()
    {
        return $this->db->table('all_wo')
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_kendala', 'dm_kendala.id_kendala = all_wo.tp_kendala', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function monitorFilter($data)
    {
        return $this->db->table('all_wo')->where('stamp_ampser>', $data['sTime'])->where('stamp_ampser<', $data['eTime'])
            ->WhereIn('sto', $data['stoPlace'])->WhereIn('st_wo', $data['status'])
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->join('dm_kendala', 'dm_kendala.id_kendala = all_wo.tp_kendala', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }

    public function requestFilter($data)
    {
        return $this->db->table('all_wo')->where('st_wo!=', 11)->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])
            ->WhereIn('sto', $data['stoPlace'])
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->join('dm_kendala', 'dm_kendala.id_kendala = all_wo.tp_kendala', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function setToEditWo($data)
    {
        return $this->db->table('all_wo')->where('id', $data['id'])->update($data);
    }
    public function addToTemp($data)
    {
        return $this->db->table('temp_edit')->insert($data);
    }
    public function addToTemp_old($data)
    {
        return $this->db->table('temp_edit_old')->insert($data);
    }
    // requestM
    public function requestM()
    {
        return $this->db->table('temp_edit')->where('status', 0)
            ->join('user_web', 'user_web.id_user = temp_edit.requester', 'left')
            ->join('dm_level', 'dm_level.id_level = temp_edit.lv_requester', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }
    public function getDataConfirmation($data)
    {
        $data = $this->db->table('temp_edit')->where('id_request', $data)
            ->join('dm_sto', 'dm_sto.id_sto = temp_edit.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = temp_edit.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = temp_edit.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = temp_edit.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = temp_edit.st_val', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = temp_edit.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
        return $data;
    }
    public function getDataOldConfirmation($data)
    {
        $data = $this->db->table('temp_edit_old')->where('id_request', $data)
            ->join('dm_sto', 'dm_sto.id_sto = temp_edit_old.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = temp_edit_old.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = temp_edit_old.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = temp_edit_old.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = temp_edit_old.st_val', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = temp_edit_old.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
        return $data;
    }
    public function getForUpdate($data)
    {
        $data = $this->db->table('temp_edit')->where('id_request', $data)
            ->join('dm_sto', 'dm_sto.id_sto = temp_edit.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = temp_edit.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = temp_edit.layanan', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = temp_edit.st_fcc', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = temp_edit.st_val', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = temp_edit.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
        return $data;
    }
    public function getForUpdateReject($data)
    {
        $data = $this->db->table('temp_edit_old')->where('id_request', $data)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
        return $data;
    }
    public function updateAcc($data)
    {
        return $this->db->table('all_wo')->where('id', $data['id'])->update($data);
    }
    public function deleteacc($data)
    {
        return $this->db->table('all_wo')->where('id', $data['id'])->delete();
    }
    public function updateAcctemp($data)
    {
        return $this->db->table('temp_edit')->where('id_request', $data['id_request'])->update($data);
    }
}
