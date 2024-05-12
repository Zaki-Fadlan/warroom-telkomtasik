<?php

namespace App\Controllers;

use App\Models\ModelSto;
use App\Models\ModelAllWo;
use App\Models\ModelDatel;
use App\Models\ModelLevel;
use App\Models\ModelUser;


class Pvitakendala extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'WO KENDALA',
            'isi' => 'pvita/wokendala/index',
            'sto' => $this->ModelSto->allData(),
            'datel' => $this->ModelDatel->allData(),
        ];
        return view('layoutpvita/wrapper', $data);
    }
    public function __construct()
    {
        helper('form');
        $this->ModelLevel = new ModelLevel();
        $this->ModelDatel = new ModelDatel();
        $this->ModelSto = new ModelSto();
        $this->ModelAllWo = new ModelAllWo();
        $this->ModelUser = new ModelUser();
    }

    public function ajaxDataTableKendala()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data =  $this->ModelAllWo->kendala();
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            if ($temp['tp_kendala'] != 4) {
                $no++;
                $aksi = '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" onclick="dispatch(' . $temp['id'] . ')" data-target="#modalView"> Rollback</button>';
                $row = [];
                $row[] = $no;
                $row[] = $aksi;
                $row[] = $temp['order_id'];
                $row[] = $temp['nama_sto'];
                $row[] = date('d/m/Y H:i:s', $temp['stamp_ampser'] - 25133);
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
                $row[] = date('d/m/Y H:i:s', (int)$temp['wi_val'] - 25133);
                $row[] = $temp['n_validasi'];
                $row[] = $temp['n_fcc'];
                $row[] = $temp['sc_a'];
                $row[] = $temp['ket_val'];
                $row[] = $temp['nama_user'];
                $row[] = date('d/m/Y H:i:s', (int)$temp['wi_tek'] - 25133);
                $row[] = $this->ModelSto->gettingSTOnamebyID($temp['sektor']); //
                $row[] = $temp['nama_tek'];
                // $row[] = $this->ModelUser->gettingNameUser($temp['na_isi_tek']); //
                $row[] = "MASIH BUG";
                $row[] = $temp['ket_dispatch'];
                $row[] = $temp['odp'];
                $row[] = $temp['ket_teknisi'];
                $row[] = $temp['n_tipe_kendala'];
                $row[] = date('d/m/Y H:i:s', (int)$temp['wf_teknisi'] - 25133);
                $row[] = $temp['n_st_wo'];
                $dataDatel[] = $row;
            }
        }
        $result['data'] = $dataDatel;
        echo json_encode($result);
        exit();
    }
    public function viewRollbackModal()
    {
        $aa = $this->request->getPost('id_wo');
        $datab = [
            "data" => $this->ModelAllWo->getDataValidasi($aa),
        ];
        return view('pvita/wokendala/modalrollback', $datab);
    }
    public function rollbackData()
    {
        $data = [
            'id'            => $this->request->getPost('id'),
            'st_wo'       => 2,
        ];
        $this->ModelAllWo->updateRollback($data);
        return json_encode("200");
    }
    public function ajaxDataTableKendalaFilter()
    {
        date_default_timezone_set("Asia/Jakarta");
        $filterData = [
            'sTime'          => strtotime(str_replace('/', '-', $this->request->getPost('start_time'))),
            'eTime'         => strtotime(str_replace('/', '-', $this->request->getPost('end_time'))) + 86400,
            'stoPlace'         => explode(',', $this->request->getPost('sto')),
        ];
        $data =  $this->ModelAllWo->kendalaFilter($filterData);
        $finalData = [];
        $no = 0;
        foreach ($data as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" onclick="dispatch(' . $temp['id'] . ')" data-target="#modalView"> Rollback</button>';
            $row = [];
            $row[] = $no;
            $row[] = $aksi;
            $row[] = $temp['order_id'];
            $row[] = $temp['nama_sto'];
            $row[] = date('d/m/Y H:i:s', $temp['stamp_ampser'] - 25133);
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
            $row[] = date('d/m/Y H:i:s', (int)$temp['wi_val'] - 25133);
            $row[] = $temp['n_validasi'];
            $row[] = $temp['n_fcc'];
            $row[] = $temp['sc_a'];
            $row[] = $temp['ket_val'];
            $row[] = $temp['nama_user'];
            $row[] = date('d/m/Y H:i:s', (int)$temp['wi_tek'] - 25133);
            $row[] = $this->ModelSto->gettingSTOnamebyID($temp['sektor']); //
            $row[] = $temp['nama_tek'];
            // $row[] = $this->ModelUser->gettingNameUser($temp['na_isi_tek']); //
            $row[] = "MASIH BUG";
            $row[] = $temp['ket_dispatch'];
            $row[] = $temp['odp'];
            $row[] = $temp['ket_teknisi'];
            $row[] = $temp['n_tipe_kendala'];
            $row[] = date('d/m/Y H:i:s', (int)$temp['wf_teknisi'] - 25133);
            $row[] = $temp['n_st_wo'];
            $finalData[] = $row;
        }
        $result['data'] = $finalData;
        echo json_encode($result['data']);
        exit();
    }
}
