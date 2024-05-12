<?php

namespace App\Controllers;

use App\Models\ModelSto;
use App\Models\ModelAllWo;
use App\Models\ModelDatel;
use App\Models\ModelLevel;
use App\Models\ModelFcc;
use App\Models\ModelValidasi;
use App\Models\ModelLayanan;
use App\Models\ModelKecepatan;
use App\Models\ModelStatus;


class Pvitareqm extends BaseController
{
    public function index()
    {
        if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
            $data = [
                'tittle' => 'REQUEST USER',
                'isi' => 'pvita/worequestm/index',
            ];
            return view('layoutpvita/wrapper', $data);
        } else {
            return view('pvita/wovalidasi/modalforbidden');
        }
    }


    public function __construct()
    {
        helper('form');
        $this->ModelLevel = new ModelLevel();
        $this->ModelSto = new ModelSto();
        $this->ModelDatel = new ModelDatel();
        $this->ModelAllWo = new ModelAllWo();
        $this->ModelFcc = new ModelFcc();
        $this->ModelValidasi = new ModelValidasi();
        $this->ModelKecepatan = new ModelKecepatan();
        $this->ModelLayanan = new ModelLayanan();
        $this->ModelStatus = new ModelStatus();
    }

    public function ajaxDataTableRequest()
    {
        $data =  $this->ModelAllWo->requestM();
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            $row = [];
            $aksi = '<button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" onclick="validasi(' . $temp['id_request'] . ')" data-target="#modalView"> Lihat Request</button>';
            $no++;
            $row[] = $no;
            $row[] = $aksi;
            if ($temp['tipe_edit'] == 0) {
                $row[] = 'Hapus WO';
            } else {
                $row[] = 'Edit WO';
            }
            $row[] = $temp['nama_user'];
            $row[] = $temp['nama_level'];
            $row[] = $temp['keteranganEdit'];
            $dataDatel[] = $row;
        }
        $result['data'] = $dataDatel;
        echo json_encode($result);
        exit();
    }

    public function viewEditVal()
    {
        $aa = $this->request->getPost('id_request');
        $datab = [
            "data" => $this->ModelAllWo->getDataConfirmation($aa),
            "dataold" => $this->ModelAllWo->getDataOldConfirmation($aa),
        ];
        return view('pvita/worequestm/modalconfirnation', $datab);
    }

    public function acc()
    {
        $data = [
            'id_request' => $this->request->getPost('id_request'),
        ];
        $dataR = $this->ModelAllWo->getForUpdate($data);
        $finalRData = [];
        foreach ($dataR as $r) {
            $finalRData['id'] = $r['id'];
            $finalRData['sto'] = $r['sto'];
            $finalRData['track_id'] = $r['track_id'];
            $finalRData['layanan'] = $r['layanan'];
            $finalRData['kecepatan'] = $r['kecepatan'];
            $finalRData['ncp'] = $r['ncp'];
            $finalRData['kcp'] = $r['kcp'];
            $finalRData['kacp'] = $r['kacp'];
            $finalRData['alamat'] = $r['alamat'];
            $finalRData['pat_alamat'] = $r['pat_alamat'];
            $finalRData['desa'] = $r['desa'];
            $finalRData['kecamatan'] = $r['kecamatan'];
            $finalRData['tikor_odp'] = str_replace('$$$', ',', $r['tikor_odp']);
            $finalRData['tikor_cp'] = str_replace('$$$', ',', $r['tikor_cp']);
            $finalRData['datel_odp'] = $r['datel_odp'];
            $finalRData['est_pj_dc'] = $r['est_pj_dc'];
            $finalRData['st_val'] = $r['st_val'];
            $finalRData['st_fcc'] = $r['st_fcc'];
            $finalRData['no_sc'] = $r['no_sc'];
            $finalRData['no_inet'] = $r['no_inet'];
            $finalRData['st_wo'] = $r['st_wo'];
        }
        if ($this->request->getPost('tipe_edit') == 1) {
            $this->ModelAllWo->updateAcc($finalRData);
            $dataB = [
                'id_request' => $this->request->getPost('id_request'),
                'status' => 1
            ];
            $this->ModelAllWo->updateAcctemp($dataB);
            return json_encode("200");
            // return json_encode("update wo");
        } else {
            $this->ModelAllWo->deleteacc($finalRData);
            $dataB = [
                'id_request' => $this->request->getPost('id_request'),
                'status' => 1
            ];
            $this->ModelAllWo->updateAcctemp($dataB);
            // return json_encode("delete wo");
            return json_encode("200");
        }
    }
    public function rej()
    {
        $data = [
            'id_request' => $this->request->getPost('id_request'),
        ];
        $dataR = $this->ModelAllWo->getForUpdateReject($data);
        $finalRData = [];
        foreach ($dataR as $r) {
            $finalRData['id'] = $r['id'];
            $finalRData['st_wo'] = $r['st_wo'];
        }
        if ($this->request->getPost('tipe_edit') == 1) {
            $this->ModelAllWo->updateAcc($finalRData);
            $dataB = [
                'id_request' => $this->request->getPost('id_request'),
                'status' => 1
            ];
            $this->ModelAllWo->updateAcctemp($dataB);

            return json_encode("200");
        } else {
            $this->ModelAllWo->updateAcc($finalRData);
            $dataB = [
                'id_request' => $this->request->getPost('id_request'),
                'status' => 1
            ];
            $this->ModelAllWo->updateAcctemp($dataB);
            return json_encode("200");
        }
    }
}
