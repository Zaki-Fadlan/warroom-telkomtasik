<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDashboardTeknisi extends Model
{
    public function allData()
    {
        $dataWO = $this->db->table('db_teknisi')
            // ->join('dm_sto', 'dm_sto.id_sto = db_teknisi.sto_id_dbtek', 'left')
            ->join('dm_datel', 'dm_datel.id_datel = db_teknisi.sto_id_dbtek', 'left')
            ->orderBy('time_stamp', 'DESC')
            ->get()->getResultArray();
        return $dataWO;
    }
    public function validasi($data)
    {
        $dataWO = count($this->db->table('db_teknisi')->where('sto_id_dbtek ', $data)->get()->getResultArray());
        return $dataWO;
    }
    public function upd($data)
    {
        return $this->db->table('db_teknisi')->where('sto_id_dbtek', $data['sto_id_dbtek'])->update($data);
    }
    public function scbepagi($data, $waktu)
    {
        $datel = $this->db->table('dm_sto')->where('datel_sto', $data)
            ->get()->getResultArray();
        $sto_datel = [];
        foreach ($datel as $key) {
            $sto_datel[] = $key['id_sto'];
        }
        date_default_timezone_set("Asia/Jakarta");
        $batasHariini = strtotime(date('d-m-Y 08:00:00', $waktu));
        $dataWO = count($this->db->table('all_wo')
            ->where('wi_val<', $batasHariini)
            // ->where('wi_val>=', $batasHariini - 36000)
            ->where('st_val', 1)->where('st_fcc', 12)->whereIn('sto', $sto_datel)
            ->where('st_wo', 2)
            ->get()->getResultArray());
        return $dataWO;
    }
    public function scbesiang($data, $waktu)
    {
        date_default_timezone_set("Asia/Jakarta");
        $batasHariini = strtotime(date('d-m-Y 08:00:00', $waktu));
        $datel = $this->db->table('dm_sto')->where('datel_sto', $data)
            ->get()->getResultArray();
        $sto_datel = [];
        foreach ($datel as $key) {
            $sto_datel[] = $key['id_sto'];
        }
        $dataWO = count($this->db->table('all_wo')
            ->where('st_val', 1)->where('st_fcc', 12)->whereIn('sto', $sto_datel)
            ->where('wi_val>=', $batasHariini)->where('wi_val<', strtotime(date('d-m-Y 14:00:00', $waktu)))
            ->get()->getResultArray());
        return $dataWO;
    }
    public function scbesore($data, $waktu)
    {
        date_default_timezone_set("Asia/Jakarta");
        $batasHariini = strtotime(date('d-m-Y 14:00:00', $waktu));
        $datel = $this->db->table('dm_sto')->where('datel_sto', $data)
            ->get()->getResultArray();
        $sto_datel = [];
        foreach ($datel as $key) {
            $sto_datel[] = $key['id_sto'];
        }
        $dataWO = count($this->db->table('all_wo')
            ->where('st_val', 1)->where('st_fcc', 12)->whereIn('sto', $sto_datel)
            ->where('wi_val>=', $batasHariini)->where('wi_val<=', strtotime(date('d-m-Y 22:00:00', $waktu)))
            ->get()->getResultArray());
        return $dataWO;
    }
    public function kPelanggan($data, $waktu)
    {
        $datel = $this->db->table('dm_sto')->where('datel_sto', $data)
            ->get()->getResultArray();
        $sto_datel = [];
        foreach ($datel as $key) {
            $sto_datel[] = $key['id_sto'];
        }
        $dataWO = count($this->db->table('all_wo')
            ->where('st_wo', 4)
            ->whereIn('sto', $sto_datel)
            ->whereIn('tp_kendala', [1, 2, 4])
            ->where('wf_teknisi>=', $waktu)
            ->where('wf_teknisi<', $waktu + 86400)
            ->get()->getResultArray());
        return $dataWO;
    }
    public function kJaringan($data, $waktu)
    {
        $datel = $this->db->table('dm_sto')->where('datel_sto', $data)
            ->get()->getResultArray();
        $sto_datel = [];
        foreach ($datel as $key) {
            $sto_datel[] = $key['id_sto'];
        }
        $dataWO = count($this->db->table('all_wo')
            ->where('st_wo', 4)
            ->where('wf_teknisi>=', $waktu)
            ->where('wf_teknisi<', $waktu + 86400)
            ->whereIn('sto', $sto_datel)
            ->whereIn('tp_kendala', [3, 5, 6, 7])
            ->get()->getResultArray());
        return $dataWO;
    }
    public function pInput($data, $waktu)
    {
        $datel = $this->db->table('dm_sto')->where('datel_sto', $data)
            ->get()->getResultArray();
        $sto_datel = [];
        foreach ($datel as $key) {
            $sto_datel[] = $key['id_sto'];
        }
        $dataWO = count($this->db->table('all_wo')
            ->whereIn('sto', $sto_datel)
            ->where('st_wo', 9)
            ->where('wareq_sc>=', $waktu)
            ->where('wareq_sc<', $waktu + 86400)
            ->get()->getResultArray());
        return $dataWO;
    }
    public function sSC($data, $waktu)
    {
        $datel = $this->db->table('dm_sto')->where('datel_sto', $data)
            ->get()->getResultArray();
        $sto_datel = [];
        foreach ($datel as $key) {
            $sto_datel[] = $key['id_sto'];
        }
        $dataWO = count($this->db->table('all_wo')
            ->whereIn('sto', $sto_datel)
            ->where('st_wo', 10)
            ->where('wf_teknisi>=', $waktu)
            ->where('wf_teknisi<', $waktu + 86400)
            ->get()->getResultArray());
        return $dataWO;
    }
    public function sPS($data, $waktu)
    {
        $datel = $this->db->table('dm_sto')->where('datel_sto', $data)
            ->get()->getResultArray();
        $sto_datel = [];
        foreach ($datel as $key) {
            $sto_datel[] = $key['id_sto'];
        }
        $dataWO = count($this->db->table('all_wo')
            ->whereIn('sto', $sto_datel)
            ->where('st_wo', 5)
            ->where('wa_akt_wo>=', $waktu)
            ->where('wa_akt_wo<', $waktu + 86400)
            ->get()->getResultArray());
        return $dataWO;
    }

    public function updateAbsen($id, $data)
    {
        return $this->db->table('user_teknisi')->where('id_teknisi', $id)->update($data);
    }
    public function resetAbsen($data)
    {
        return $this->db->table('user_teknisi')->where('datel_tek', $data['datel_tek'])->update($data);
    }
    public function resetAllAbsen($data)
    {
        return $this->db->table('user_teknisi')->update($data);
    }
    public function gettingNameTeknisi($data)
    {
        return $this->db->table('user_teknisi')->where('id_teknisi', $data)
            ->get()
            ->getRow()->nama_tek;
    }
    public function rekapListteknisi($data)
    {
        $teknisi = $this->db->table('user_teknisi')
            ->where('datel_tek', $data)
            ->where('st_tek', 1)
            ->orderBy('nama_tek', 'asc')
            ->get()->getResultArray();
        return $teknisi;
    }
    public function insertDb($data)
    {
        date_default_timezone_set("Asia/Jakarta");
        $timezone = time() - (60 * 60 * 7);
        $batasHariini = strtotime(date('d-m-Y 00:00:00', $timezone));
        $konfirmasi = count($this->db->table('db_teknisi')
            ->where('sto_id_dbtek', $data['sto_id_dbtek'])
            ->where('time_stamp>=', $batasHariini)->where('time_stamp<', $batasHariini + 86400)
            ->orderBy('time_stamp', 'DESC')
            ->get()->getResultArray());
        if ($konfirmasi < 1) {
            $this->db->table('db_teknisi')->insert($data);
            return 200;
        } else {
            return "Maaf, Untuk Datel ini sudah direkap!!";
        }
    }

    public function getTim()
    {
        $dataTim = $this->db->table('dm_tim_teknisi')
            ->join('dm_datel', 'dm_datel.id_datel = dm_tim_teknisi.id_datel_tim', 'left')
            ->get()->getResultArray();
        return $dataTim;
    }

    public function cekDatel()
    {
        $data = $this->db->table('db_teknisi')
            ->join('dm_datel', 'dm_datel.id_datel = db_teknisi.sto_id_dbtek', 'left')
            ->get()->getResultArray();
        return $data;
    }
}
