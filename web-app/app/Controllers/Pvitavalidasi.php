<?php

namespace App\Controllers;

use App\Models\ModelLevel;
use App\Models\ModelSto;
use App\Models\ModelDatel;
use App\Models\ModelStatus;
use App\Models\ModelAllWo;
use App\Models\ModelFcc;
use App\Models\ModelValidasi;


class Pvitavalidasi extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'WO VALIDASI',
            'isi' => 'pvita/wovalidasi/index',
            'sto' => $this->ModelSto->allData(),
            'datel' => $this->ModelDatel->allData(),
        ];
        return view('layoutpvita/wrapper', $data);
    }
    public function __construct()
    {
        helper('form');
        $this->ModelFcc = new ModelFcc();
        $this->ModelLevel = new ModelLevel();
        $this->ModelSto = new ModelSto();
        $this->ModelDatel = new ModelDatel();
        $this->ModelStatus = new ModelStatus();
        $this->ModelAllWo = new ModelAllWo();
        $this->ModelValidasi = new ModelValidasi();
    }
    public function viewValidationModal()
    {
        $aa = $this->request->getPost('id_wo');
        $datab = [
            "data" => $this->ModelAllWo->getDataValidasi($aa),
            "fcc" => $this->ModelFcc->allData(),
            "validasi" => $this->ModelValidasi->allData(),
        ];
        return view('pvita/wovalidasi/modalvalidasi', $datab);
    }
    public function viewForbidenModal()
    {
        return view('pvita/wovalidasi/modalforbidden');
    }
    public function ajaxDataTableValidasi()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data =  $this->ModelAllWo->validasi();
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="validasi(' . $temp['id'] . ')" data-target="#modalView"><i class="fa-solid fa-pen"></i> Validasi</button>';
            $row = [];
            $row[] = $no;
            $row[] = $aksi;
            if ($temp['n_validasi'] == "") {
                $row[] = "Belum Validasi";
                $row[] = "Belum Validasi";
                $row[] = "Belum Ada";
            } else {
                $row[] = $temp['n_validasi'];
                $row[] = $temp['n_fcc'];
                $row[] = $temp['ket_val'];
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
            if ($temp['n_validasi'] == "") {
                $row[] = "Belum Validasi";
            } else {
                $row[] = date('d/m/Y H:i:s', $temp['wi_val']);
            }
            $dataDatel[] = $row;
        }
        $result['data'] = $dataDatel;
        echo json_encode($result);
        exit();
    }
    public function ajaxDataTableValidasiFilter()
    {
        date_default_timezone_set("Asia/Jakarta");
        $filterData = [
            'sTime'          => strtotime(str_replace('/', '-', $this->request->getPost('start_time'))),
            'eTime'         => strtotime(str_replace('/', '-', $this->request->getPost('end_time'))) + 86400,
            'stoPlace'         => explode(',', $this->request->getPost('sto')),
        ];
        $data =  $this->ModelAllWo->validasiFilter($filterData);
        $finalData = [];
        $no = 0;
        foreach ($data as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="validasi(' . $temp['id'] . ')" data-target="#modalView"><i class="fa-solid fa-pen"></i> Validasi</button>';
            $row = [];
            $row[] = $no;
            $row[] = $aksi;
            if ($temp['n_validasi'] == "") {
                $row[] = "Belum Validasi";
                $row[] = "Belum Validasi";
                $row[] = "Belum Ada";
            } else {
                $row[] = $temp['n_validasi'];
                $row[] = $temp['n_fcc'];
                $row[] = $temp['ket_val'];
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
            if ($temp['n_validasi'] == "") {
                $row[] = "Belum Validasi";
            } else {
                $row[] = date('d/m/Y H:i:s', $temp['wi_val']);
            }
            $finalData[] = $row;
        }
        $result['data'] = $finalData;
        echo json_encode($result['data']);
        exit();
    }
    public function updateValidasi()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = strtotime(date("d-m-Y H:i:s")) - 25200;

        $data = [
            'id'            => $this->request->getPost('id'),
            'st_val'          => $this->request->getPost('st_validasi'),
            'st_fcc'       => $this->request->getPost('st_fcc'),
        ];
        if ($data['st_val'] == 1 and $data['st_fcc'] == 12) {
            $datab = [
                'id'            => $this->request->getPost('id'),
                'st_val'          => $this->request->getPost('st_validasi'),
                'st_fcc'       => $this->request->getPost('st_fcc'),
                'ket_val'       => $this->request->getPost('keterangan'),
                'sc_a'       => $this->request->getPost('sc_a'),
                'wi_val'       => $now,
                'nama_val'       => session()->get('id_user'),
                'st_wo'       => 2,
            ];
            $this->ModelAllWo->updateValidasi($datab);
            return json_encode("200");
        } else {
            $datac = [
                'id'            => $this->request->getPost('id'),
                'st_val'          => $this->request->getPost('st_validasi'),
                'st_fcc'       => $this->request->getPost('st_fcc'),
                'ket_val'       => $this->request->getPost('keterangan'),
                'sc_a'       => $this->request->getPost('sc_a'),
                'wi_val'       => $now,
                'nama_val'       => session()->get('id_user'),
                'st_wo'       => 6,
            ];
            $this->ModelAllWo->updateValidasi($datac);
            return json_encode("201");
        }
    }
}
