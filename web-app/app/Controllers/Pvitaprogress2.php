<?php

namespace App\Controllers;

use App\Models\ModelSto;
use App\Models\ModelAllWo;
use App\Models\ModelDatel;
use App\Models\ModelLevel;
use App\Models\ModelUser;


class Pvitaprogress2 extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'WO PROGRESS HD',
            'isi' => 'pvita/woprogress/index2',
            'sto' => $this->ModelSto->allData(),
            'datel' => $this->ModelDatel->allData(),
        ];
        return view('layoutpvita/wrapper', $data);
    }


    public function __construct()
    {
        helper('form');
        $this->ModelLevel = new ModelLevel();
        $this->ModelSto = new ModelSto();
        $this->ModelDatel = new ModelDatel();
        $this->ModelAllWo = new ModelAllWo();
        $this->ModelUser = new ModelUser();
    }

    public function ajaxDataTableProgress2()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data =  $this->ModelAllWo->progressH();
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            $aksi = '<button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" onclick="validasi(' . $temp['id'] . ')" data-target="#modalView"> Request SC</button>';
            $aksi2 = '<button type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="aktifasi(' . $temp['id'] . ')" data-target="#modalView"> Aktivasi</button>';
            $no++;
            $row = [];
            $row[] = $no;
            if ($temp['st_wo'] == 10) {
                $row[] = $aksi2;
            }
            if ($temp['st_wo'] == 3) {
                $row[] = $aksi;
            }
            $row[] = $temp['order_id'];
            $row[] = $temp['nama_sto'];
            $row[] = date('d/m/Y H:i:s', $temp['stamp_ampser']);
            $row[] = $temp['track_id'];
            $row[] = $temp['nama_layanan'];
            $row[] = $temp['nama_kecepatan'];
            $row[] = $temp['ncp'];
            $row[] = $temp['kcp'] . "/" . $temp['kacp'];
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
            $row[] = date('d/m/Y H:i:s', $temp['wi_val']);
            $row[] = $temp['n_validasi'];
            $row[] = $temp['n_fcc'];
            $row[] = $temp['sc_a'];
            $row[] = $temp['ket_val'];
            if ($temp['nama_val'] == "") {
                $row[] = "-";
            } else {
                $row[] = $this->ModelUser->gettingNameUser($temp['nama_val']);
            }
            $row[] = date('d/m/Y H:i:s', (int) $temp['wi_tek']);
            $row[] = $this->ModelSto->gettingSTOnamebyID($temp['sektor']);
            $row[] = $temp['nama_tek'];
            $row[] = $this->ModelUser->gettingNameUser($temp['na_isi_tek']);
            $row[] = $temp['ket_dispatch'];
            $row[] = $temp['alamat_inst'];
            $row[] = $temp['no_plgn'];
            $row[] = $temp['odp'];
            $row[] = str_replace('$$$', ',', $temp['tikor_plgn']);
            $row[] = $temp['port'];
            $row[] = $temp['qr'];
            $row[] = $temp['pnj_dc'];
            $row[] = $temp['snont'];
            $row[] = $temp['snstb'];
            $row[] = $temp['id_vallins'];
            $row[] = $temp['user_crew'];
            $row[] = $temp['app_sektor'];
            $row[] = $temp['ket_teknisi'];
            $row[] = date('d/m/Y H:i:s', (int) $temp['wf_teknisi']);
            if ($temp['st_wo'] == 3) {
                $row[] = $temp['nareq_sc'];
                $row[] = "";
            } else {
                $row[] = $this->ModelUser->gettingNameUser($temp['nareq_sc']);
                $row[] = date('d/m/Y H:i:s', $temp['wareq_sc']);
            }
            $row[] = $temp['no_sc'];
            $row[] = $temp['no_inet'];
            if ($temp['st_wo'] == 3) {
                $row[] = $temp['ni_sc'];
                $row[] = "";
            } else {
                $row[] = $this->ModelUser->gettingNameUser($temp['ni_sc']);
                $row[] = date('d/m/Y H:i:s', $temp['wi_sc']);
            }
            $row[] =  $temp['n_st_wo'];
            $dataDatel[] = $row;
        }
        $result['data'] = $dataDatel;
        echo json_encode($result);
        exit();
    }

    public function ajaxDataTableProgressFilter()
    {
        date_default_timezone_set("Asia/Jakarta");
        $filterData = [
            'sTime'          => strtotime(str_replace('/', '-', $this->request->getPost('start_time'))),
            'eTime'         => strtotime(str_replace('/', '-', $this->request->getPost('end_time'))) + 86400,
            'stoPlace'         => explode(',', $this->request->getPost('sto')),
        ];
        $data =  $this->ModelAllWo->progressFilterH($filterData);
        $finalData = [];
        $no = 0;
        foreach ($data as $temp) {
            $aksi = '<button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" onclick="validasi(' . $temp['id'] . ')" data-target="#modalView"> Request SC</button>';
            $aksi2 = '<button type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="aktifasi(' . $temp['id'] . ')" data-target="#modalView"> Aktivasi</button>';
            $no++;
            $row = [];
            $row[] = $no;
            if ($temp['st_wo'] == 10) {
                $row[] = $aksi2;
            }
            if ($temp['st_wo'] == 3) {
                $row[] = $aksi;
            }
            $row[] = $temp['order_id'];
            $row[] = $temp['nama_sto'];
            $row[] = date('d/m/Y H:i:s', $temp['stamp_ampser']);
            $row[] = $temp['track_id'];
            $row[] = $temp['nama_layanan'];
            $row[] = $temp['nama_kecepatan'];
            $row[] = $temp['ncp'];
            $row[] = $temp['kcp'] . "/" . $temp['kacp'];
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
            $row[] = date('d/m/Y H:i:s', $temp['wi_val']);
            $row[] = $temp['n_validasi'];
            $row[] = $temp['n_fcc'];
            $row[] = $temp['sc_a'];
            $row[] = $temp['ket_val'];
            $row[] = $this->ModelUser->gettingNameUser($temp['nama_val']);
            $row[] = date('d/m/Y H:i:s', (int) $temp['wi_tek']);
            $row[] = $this->ModelSto->gettingSTOnamebyID($temp['sektor']);
            $row[] = $temp['nama_tek'];
            $row[] = $this->ModelUser->gettingNameUser($temp['na_isi_tek']);
            $row[] = $temp['ket_dispatch'];
            $row[] = $temp['alamat_inst'];
            $row[] = $temp['no_plgn'];
            $row[] = $temp['odp'];
            $row[] = str_replace('$$$', ',', $temp['tikor_plgn']);
            $row[] = $temp['port'];
            $row[] = $temp['qr'];
            $row[] = $temp['pnj_dc'];
            $row[] = $temp['snont'];
            $row[] = $temp['snstb'];
            $row[] = $temp['id_vallins'];
            $row[] = $temp['user_crew'];
            $row[] = $temp['app_sektor'];
            $row[] = $temp['ket_teknisi'];
            $row[] = date('d/m/Y H:i:s', (int) $temp['wf_teknisi']);
            if ($temp['st_wo'] == 3) {
                $row[] = $temp['nareq_sc'];
                $row[] = "";
            } else {
                $row[] = $this->ModelUser->gettingNameUser($temp['nareq_sc']);
                $row[] = date('d/m/Y H:i:s', $temp['wareq_sc']);
            }
            $row[] = $temp['no_sc'];
            $row[] = $temp['no_inet'];
            if ($temp['st_wo'] == 3) {
                $row[] = $temp['ni_sc'];
                $row[] = "";
            } else {
                $row[] = $this->ModelUser->gettingNameUser($temp['ni_sc']);
                $row[] = date('d/m/Y H:i:s', $temp['wi_sc']);
            }
            $row[] =  $temp['n_st_wo'];
            $finalData[] = $row;
        }
        $result['data'] = $finalData;
        echo json_encode($result['data']);
        exit();
    }
    public function viewReqModal()
    {
        $aa = $this->request->getPost('id_wo');
        $datab = [
            "data" => $this->ModelAllWo->getDataValidasi($aa),
        ];
        return view('pvita/woprogress/modalreqsc', $datab);
    }
    public function viewReqModalps()
    {
        $aa = $this->request->getPost('id_wo');
        $datab = [
            "data" => $this->ModelAllWo->getDataValidasi($aa),
        ];
        return view('pvita/woprogress/modalaktifasi', $datab);
    }
    public function updateReqSC()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = strtotime(date("d-m-Y H:i:s")) - 25200;
        $data = [
            'id'            => $this->request->getPost('id'),
            'st_wo'       => 9,
            'nareq_sc'       => session()->get('id_user'),
            'wareq_sc'       => $now,
        ];
        $this->ModelAllWo->updateRollback($data);
        return json_encode("200");
    }
    public function updatePS()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = strtotime(date("d-m-Y H:i:s")) - 25200;
        $data = [
            'id'            => $this->request->getPost('id'),
            'st_wo'       => 5,
            'nm_akt_wo'       => session()->get('id_user'),
            'wa_akt_wo'       => $now,
        ];
        $this->ModelAllWo->updateRollback($data);
        return json_encode("200");
    }
}
