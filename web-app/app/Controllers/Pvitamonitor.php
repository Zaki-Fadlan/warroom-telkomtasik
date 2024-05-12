<?php

namespace App\Controllers;

use App\Models\ModelSto;
use App\Models\ModelAllWo;
use App\Models\ModelDatel;
use App\Models\ModelLevel;
use App\Models\ModelStatus;
use App\Models\ModelUser;
use App\Models\ModelTeknisi;


class Pvitamonitor extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'WO MONITOR',
            'isi' => 'pvita/womonitor/index',
            'sto' => $this->ModelSto->allData(),
            'datel' => $this->ModelDatel->allData(),
            'status' => $this->ModelStatus->allData(),
        ];
        return view('layoutpvita/wrapper', $data);
    }
    public function __construct()
    {
        helper('form');
        $this->ModelLevel = new ModelLevel();
        $this->ModelSto = new ModelSto();
        $this->ModelDatel = new ModelDatel();
        $this->ModelStatus = new ModelStatus();
        $this->ModelAllWo = new ModelAllWo();
        $this->ModelUser = new ModelUser();
        $this->ModelTeknisi = new ModelTeknisi();
    }

    public function ajaxDataTableMonitor()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data =  $this->ModelAllWo->monitor();
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $temp['order_id'];
            $row[] = $temp['nama_sto'];
            $row[] = date('d/m/Y H:i:s', (int)$temp['stamp_ampser']);
            $row[] = $temp['track_id'];
            $row[] = $temp['nama_layanan'];
            $row[] = $temp['nama_kecepatan'];
            $row[] = $temp['ncp'];
            $row[] = $temp['kcp'] . " / " . $temp['kacp'];
            $row[] = $temp['alamat'];
            $row[] = $temp['pat_alamat'];
            $row[] = $temp['desa'];
            $row[] = $temp['kecamatan'];
            $row[] = str_replace('$$$', ',', $temp['tikor_odp']);
            $row[] = str_replace('$$$', ',', $temp['tikor_cp']);
            $row[] = $temp['datel_odp'];
            $row[] = $temp['est_pj_dc'];
            $row[] = $temp['ket_sales'];
            $row[] = $temp['user_sf'];
            $row[] = $temp['nama_sf'];
            $row[] = $temp['kcon'];
            $row[] = $temp['agency'];
            if ($temp['wi_val'] != "") {
                $row[] =  date('d/m/Y H:i:s', $temp['wi_val']);
                $row[] =  $temp['n_validasi'];
                $row[] =  $temp['n_fcc'];
                $row[] =  $temp['sc_a'];
                $row[] =  $temp['ket_val'];
                $row[] = $this->ModelUser->gettingNameUser($temp['nama_val']);
            } else {
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
            }
            if ($temp['wi_tek'] != "") {
                $row[] =  date('d/m/Y H:i:s', $temp['wi_tek']);
                $row[] =  $this->ModelSto->gettingSTOnamebyID($temp['sektor']);
                $row[] =  $this->ModelTeknisi->gettingNameTeknisi((int)$temp['id_nama_teknisi']);
                $row[] =  $this->ModelUser->gettingNameUser($temp['na_isi_tek']);
                $row[] =  $temp['ket_dispatch'];
            } else {
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
            }
            if ($temp['wf_teknisi'] != "") {
                $row[] =  $temp['n_tipe_kendala'];
                $row[] =  $temp['odp'];
                $row[] =  $temp['alamat_inst'];
                $row[] =  $temp['no_plgn'];
                $row[] =  str_replace('$$$', ',', $temp['tikor_plgn']);
                $row[] =  $temp['port'];
                $row[] =  $temp['qr'];
                $row[] =  $temp['pnj_dc'];
                $row[] =  $temp['snont'];
                $row[] =  $temp['snstb'];
                $row[] =  $temp['id_vallins'];
                $row[] =  $temp['user_crew'];
                $row[] =  $temp['app_sektor'];
                $row[] =  $temp['ket_teknisi'];
                $row[] =  date('d/m/Y H:i:s', $temp['wf_teknisi']);
            } else {
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
            }
            if ($temp['wareq_sc'] != "") {
                // $row[] =  $this->ModelUser->gettingNameUser((int)$temp['nareq_sc']);
                $row[] =  "-";
                $row[] =  date('d/m/Y H:i:s', (int)$temp['wareq_sc']);
            } else {
                $row[] = "-";
                $row[] = "-";
            }
            if ($temp['wi_sc'] != "") {
                $row[] =  $temp['no_sc'];
                $row[] =  $temp['no_inet'];
                // $row[] =  $this->ModelUser->gettingNameUser($temp['ni_sc']);
                $row[] =  "-";
                $row[] =  date('d/m/Y H:i:s', $temp['wi_sc']);
            } else {
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
            }
            if ($temp['wa_akt_wo'] != "") {
                // $row[] =  $this->ModelUser->gettingNameUser($temp['nm_akt_wo']);
                $row[] =  "-";
                $row[] =  date('d/m/Y H:i:s', $temp['wa_akt_wo']);
            } else {
                $row[] = "-";
                $row[] = "-";
            }
            $row[] =  $temp['n_st_wo'];
            $dataDatel[] = $row;
        }
        $result['data'] = $dataDatel;
        echo json_encode($result);
        exit();
    }
    public function ajaxDataTableMonitorFilter()
    {
        date_default_timezone_set("Asia/Jakarta");
        $filterData = [
            'sTime'          => strtotime(str_replace('/', '-', $this->request->getPost('start_time'))),
            'eTime'         => strtotime(str_replace('/', '-', $this->request->getPost('end_time'))) + 86400,
            'stoPlace'         => explode(',', $this->request->getPost('sto')),
            'status'         => explode(',', $this->request->getPost('status')),
        ];
        $data =  $this->ModelAllWo->monitorFilter($filterData);
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $temp['order_id'];
            $row[] = $temp['nama_sto'];
            $row[] = date('d/m/Y H:i:s', (int)$temp['stamp_ampser']);
            $row[] = $temp['track_id'];
            $row[] = $temp['nama_layanan'];
            $row[] = $temp['nama_kecepatan'];
            $row[] = $temp['ncp'];
            $row[] = $temp['kcp'] . " / " . $temp['kacp'];
            $row[] = $temp['alamat'];
            $row[] = $temp['pat_alamat'];
            $row[] = $temp['desa'];
            $row[] = $temp['kecamatan'];
            $row[] = str_replace('$$$', ',', $temp['tikor_odp']);
            $row[] = str_replace('$$$', ',', $temp['tikor_cp']);
            $row[] = $temp['datel_odp'];
            $row[] = $temp['est_pj_dc'];
            $row[] = $temp['ket_sales'];
            $row[] = $temp['user_sf'];
            $row[] = $temp['nama_sf'];
            $row[] = $temp['kcon'];
            $row[] = $temp['agency'];
            if ($temp['wi_val'] != "") {
                $row[] =  date('d/m/Y H:i:s', $temp['wi_val']);
                $row[] =  $temp['n_validasi'];
                $row[] =  $temp['n_fcc'];
                $row[] =  $temp['sc_a'];
                $row[] =  $temp['ket_val'];
                $row[] = $this->ModelUser->gettingNameUser($temp['nama_val']);
            } else {
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
            }
            if ($temp['wi_tek'] != "") {
                $row[] =  date('d/m/Y H:i:s', $temp['wi_tek']);
                $row[] =  $this->ModelSto->gettingSTOnamebyID($temp['sektor']);
                $row[] =  $this->ModelTeknisi->gettingNameTeknisi((int)$temp['id_nama_teknisi']);
                $row[] =  $this->ModelUser->gettingNameUser($temp['na_isi_tek']);
                $row[] =  $temp['ket_dispatch'];
            } else {
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
            }
            if ($temp['wf_teknisi'] != "") {
                $row[] =  $temp['n_tipe_kendala'];
                $row[] =  $temp['odp'];
                $row[] =  $temp['alamat_inst'];
                $row[] =  $temp['no_plgn'];
                $row[] =  str_replace('$$$', ',', $temp['tikor_plgn']);
                $row[] =  $temp['port'];
                $row[] =  $temp['qr'];
                $row[] =  $temp['pnj_dc'];
                $row[] =  $temp['snont'];
                $row[] =  $temp['snstb'];
                $row[] =  $temp['id_vallins'];
                $row[] =  $temp['user_crew'];
                $row[] =  $temp['app_sektor'];
                $row[] =  $temp['ket_teknisi'];
                $row[] =  date('d/m/Y H:i:s', $temp['wf_teknisi']);
            } else {
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
            }
            if ($temp['wareq_sc'] != "") {
                // $row[] =  $this->ModelUser->gettingNameUser((int)$temp['nareq_sc']);
                $row[] =  "-";
                $row[] =  date('d/m/Y H:i:s', (int)$temp['wareq_sc']);
            } else {
                $row[] = "-";
                $row[] = "-";
            }
            if ($temp['wi_sc'] != "") {
                $row[] =  $temp['no_sc'];
                $row[] =  $temp['no_inet'];
                // $row[] =  $this->ModelUser->gettingNameUser($temp['ni_sc']);
                $row[] =  "-";
                $row[] =  date('d/m/Y H:i:s', $temp['wi_sc']);
            } else {
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
            }
            if ($temp['wa_akt_wo'] != "") {
                // $row[] =  $this->ModelUser->gettingNameUser($temp['nm_akt_wo']);
                $row[] =  "-";
                $row[] =  date('d/m/Y H:i:s', $temp['wa_akt_wo']);
            } else {
                $row[] = "-";
                $row[] = "-";
            }
            $row[] =  $temp['n_st_wo'];
            $dataDatel[] = $row;
        }
        $result['data'] = $dataDatel;
        echo json_encode($result['data']);
        exit();
    }
}
