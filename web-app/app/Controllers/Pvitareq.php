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


class Pvitareq extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'WO REQUEST',
            'isi' => 'pvita/worequest/index',
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
        $this->ModelFcc = new ModelFcc();
        $this->ModelValidasi = new ModelValidasi();
        $this->ModelKecepatan = new ModelKecepatan();
        $this->ModelLayanan = new ModelLayanan();
        $this->ModelStatus = new ModelStatus();
    }

    public function ajaxDataTableRequest()
    {
        $data =  $this->ModelAllWo->monitor();
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            if ($temp['st_wo'] != 11) {
                $aksi = '<button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" onclick="validasi(' . $temp['id'] . ')" data-target="#modalView"> Edit</button>';
                $aksi2 = '<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" onclick="del(' . $temp['id'] . ')" data-target="#modalView"> Hapus</button>';
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $aksi . $aksi2;
                $row[] = $temp['order_id'];
                $row[] = $temp['nama_sto'];
                $row[] = $temp['stamp_ampser'];
                $row[] = $temp['track_id'];
                $row[] = $temp['ncp'];
                $row[] = $temp['kcp'] . "/" . $temp['kacp'];
                $row[] = str_replace('$$$', ',', $temp['tikor_odp']);
                $row[] = str_replace('$$$', ',', $temp['tikor_cp']);
                $row[] = $temp['datel_odp'];
                $row[] = $temp['user_sf'];
                $row[] = $temp['agency'];
                $row[] = $temp['kcon'];
                $row[] = $temp['alamat'];
                $row[] = $temp['pat_alamat'];
                $row[] = $temp['desa'];
                $row[] = $temp['kecamatan'];
                $row[] = $temp['est_pj_dc'];
                $row[] = $temp['nama_layanan'];
                $row[] = $temp['nama_kecepatan'];
                $row[] = $temp['ket_sales'];
                $row[] = $temp['ket_val'];
                if ($temp['st_fcc'] == "") {
                    $row[] = '<button type="button" class="btn btn-danger">Belum Ada</button>';
                } else {
                    $row[] = '<button type="button" class="btn btn-warning">' . $temp['n_fcc'] . '</button>';
                }
                $dataDatel[] = $row;
            }
        }
        $result['data'] = $dataDatel;
        echo json_encode($result);
        exit();
    }

    public function ajaxDataTableRequestFilter()
    {
        date_default_timezone_set("Asia/Jakarta");
        $filterData = [
            'sTime'          => strtotime(str_replace('/', '-', $this->request->getPost('start_time'))),
            'eTime'         => strtotime(str_replace('/', '-', $this->request->getPost('end_time'))) + 86400,
            'stoPlace'         => explode(',', $this->request->getPost('sto')),
        ];
        $data =  $this->ModelAllWo->requestFilter($filterData);
        $finalData = [];
        $no = 0;
        foreach ($data as $temp) {
            $row = [];
            $aksi = '<button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" onclick="validasi(' . $temp['id'] . ')" data-target="#modalView"> Edit</button>';
            $aksi2 = '<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" onclick="del(' . $temp['id'] . ')" data-target="#modalView"> Hapus</button>';
            $no++;
            $row[] = $no;
            $row[] = $aksi . $aksi2;
            $row[] = $temp['order_id'];
            $row[] = $temp['nama_sto'];
            $row[] = $temp['stamp_ampser'];
            $row[] = $temp['track_id'];
            $row[] = $temp['ncp'];
            $row[] = $temp['kcp'] . "/" . $temp['kacp'];
            $row[] = str_replace('$$$', ',', $temp['tikor_odp']);
            $row[] = str_replace('$$$', ',', $temp['tikor_cp']);
            $row[] = $temp['datel_odp'];
            $row[] = $temp['user_sf'];
            $row[] = $temp['agency'];
            $row[] = $temp['kcon'];
            $row[] = $temp['alamat'];
            $row[] = $temp['pat_alamat'];
            $row[] = $temp['desa'];
            $row[] = $temp['kecamatan'];
            $row[] = $temp['est_pj_dc'];
            $row[] = $temp['nama_layanan'];
            $row[] = $temp['nama_kecepatan'];
            $row[] = $temp['ket_sales'];
            $row[] = $temp['ket_val'];
            if ($temp['st_fcc'] == "") {
                $row[] = '<button type="button" class="btn btn-danger">Belum Ada</button>';
            } else {
                $row[] = '<button type="button" class="btn btn-warning">' . $temp['n_fcc'] . '</button>';
            }
            $finalData[] = $row;
        }
        $result['data'] = $finalData;
        echo json_encode($result['data']);
        exit();
    }
    public function viewEditVal()
    {
        $aa = $this->request->getPost('id_wo');
        $datab = [
            "data" => $this->ModelAllWo->getDataValidasi($aa),
            "fcc" => $this->ModelFcc->allData(),
            "validasi" => $this->ModelValidasi->allData(),
            "sto" => $this->ModelSto->allData(),
            "layanan" => $this->ModelLayanan->allData(),
            "kecepatan" => $this->ModelKecepatan->allData(),
            "statuswo" => $this->ModelStatus->allData(),
            "alasan" => $this->ModelSto->allData(),
        ];
        return view('pvita/worequest/modaledit', $datab);
    }
    public function viewDelVal()
    {
        $aa = $this->request->getPost('id_wo');
        $datab = [
            "data" => $this->ModelAllWo->getDataValidasi($aa),
        ];
        return view('pvita/worequest/modaldelete', $datab);
    }
    public function RequestWOEdit()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = strtotime(date("d-m-Y H:i:s"));
        $data = [
            'id_request' => $now,
            'status' => 0,
            'tipe_edit ' => 1,
            'requester ' => session()->get('id_user'),
            'lv_requester ' => session()->get('id_level'),
            'id' => $this->request->getPost('id'),
            'track_id' => $this->request->getPost('track_id'),
            'sto' => $this->request->getPost('sto'),
            'ncp' => $this->request->getPost('ncp'),
            'layanan' => $this->request->getPost('layanan'),
            'kecepatan' => $this->request->getPost('kecepatan'),
            'kcp' => $this->request->getPost('kcp'),
            'kacp' => $this->request->getPost('kacp'),
            'alamat' => $this->request->getPost('alamat'),
            'pat_alamat' => $this->request->getPost('pat_alamat'),
            'desa' => $this->request->getPost('desa'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'tikor_odp' => $this->request->getPost('tikor_odp'),
            'tikor_cp' => $this->request->getPost('tikor_cp'),
            'datel_odp' => $this->request->getPost('datel_odp'),
            'est_pj_dc' => $this->request->getPost('est_pj_dc'),
            'st_val' => $this->request->getPost('st_val'),
            'st_fcc' => $this->request->getPost('st_fcc'),
            'no_sc' => $this->request->getPost('no_sc'),
            'no_inet' => $this->request->getPost('no_inet'),
            'st_wo' => $this->request->getPost('st_wo'),
            'keteranganEdit' => $this->request->getPost('keteranganEdit'),
        ];
        $this->ModelAllWo->addToTemp($data);
        $oldData = [
            'id_request' => $now,
            'id' => $this->ModelAllWo->getDataSC($data['id'])[0]['id'],
            'track_id' => $this->ModelAllWo->getDataSC($data['id'])[0]['track_id'],
            'sto' => $this->ModelAllWo->getDataSC($data['id'])[0]['sto'],
            'ncp' => $this->ModelAllWo->getDataSC($data['id'])[0]['ncp'],
            'layanan' => $this->ModelAllWo->getDataSC($data['id'])[0]['layanan'],
            'kecepatan' => $this->ModelAllWo->getDataSC($data['id'])[0]['kecepatan'],
            'kcp' => $this->ModelAllWo->getDataSC($data['id'])[0]['kcp'],
            'kacp' => $this->ModelAllWo->getDataSC($data['id'])[0]['kacp'],
            'alamat' => $this->ModelAllWo->getDataSC($data['id'])[0]['alamat'],
            'pat_alamat' => $this->ModelAllWo->getDataSC($data['id'])[0]['pat_alamat'],
            'desa' => $this->ModelAllWo->getDataSC($data['id'])[0]['desa'],
            'kecamatan' => $this->ModelAllWo->getDataSC($data['id'])[0]['kecamatan'],
            'tikor_odp' => $this->ModelAllWo->getDataSC($data['id'])[0]['tikor_odp'],
            'tikor_cp' => $this->ModelAllWo->getDataSC($data['id'])[0]['tikor_cp'],
            'datel_odp' => $this->ModelAllWo->getDataSC($data['id'])[0]['datel_odp'],
            'est_pj_dc' => $this->ModelAllWo->getDataSC($data['id'])[0]['est_pj_dc'],
            'st_val' => $this->ModelAllWo->getDataSC($data['id'])[0]['st_val'],
            'st_fcc' => $this->ModelAllWo->getDataSC($data['id'])[0]['st_fcc'],
            'no_sc' => $this->ModelAllWo->getDataSC($data['id'])[0]['no_sc'],
            'no_inet' => $this->ModelAllWo->getDataSC($data['id'])[0]['no_inet'],
            'st_wo' => $this->ModelAllWo->getDataSC($data['id'])[0]['st_wo'],
        ];
        $this->ModelAllWo->addToTemp_old($oldData);

        $dataA = [
            'id' => $data['id'],
            'st_wo' => 11
        ];
        $this->ModelAllWo->setToEditWo($dataA);

        return json_encode('200');
    }
    public function RequestWOdel()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = strtotime(date("d-m-Y H:i:s"));
        $data = [
            'id_request' => $now,
            'id' => $this->request->getPost('id'),
            'requester ' => session()->get('id_user'),
            'lv_requester ' => session()->get('id_level'),
            'status' => 0,
            'tipe_edit ' => 0,
            'keteranganEdit' => $this->request->getPost('keteranganEdit'),
        ];
        $this->ModelAllWo->addToTemp($data);
        $oldData = [
            'id_request' => $now,
            'id' => $this->ModelAllWo->getDataSC($data['id'])[0]['id'],
            'track_id' => $this->ModelAllWo->getDataSC($data['id'])[0]['track_id'],
            'sto' => $this->ModelAllWo->getDataSC($data['id'])[0]['sto'],
            'ncp' => $this->ModelAllWo->getDataSC($data['id'])[0]['ncp'],
            'layanan' => $this->ModelAllWo->getDataSC($data['id'])[0]['layanan'],
            'kecepatan' => $this->ModelAllWo->getDataSC($data['id'])[0]['kecepatan'],
            'kcp' => $this->ModelAllWo->getDataSC($data['id'])[0]['kcp'],
            'kacp' => $this->ModelAllWo->getDataSC($data['id'])[0]['kacp'],
            'alamat' => $this->ModelAllWo->getDataSC($data['id'])[0]['alamat'],
            'pat_alamat' => $this->ModelAllWo->getDataSC($data['id'])[0]['pat_alamat'],
            'desa' => $this->ModelAllWo->getDataSC($data['id'])[0]['desa'],
            'kecamatan' => $this->ModelAllWo->getDataSC($data['id'])[0]['kecamatan'],
            'tikor_odp' => $this->ModelAllWo->getDataSC($data['id'])[0]['tikor_odp'],
            'tikor_cp' => $this->ModelAllWo->getDataSC($data['id'])[0]['tikor_cp'],
            'datel_odp' => $this->ModelAllWo->getDataSC($data['id'])[0]['datel_odp'],
            'est_pj_dc' => $this->ModelAllWo->getDataSC($data['id'])[0]['est_pj_dc'],
            'st_val' => $this->ModelAllWo->getDataSC($data['id'])[0]['st_val'],
            'st_fcc' => $this->ModelAllWo->getDataSC($data['id'])[0]['st_fcc'],
            'no_sc' => $this->ModelAllWo->getDataSC($data['id'])[0]['no_sc'],
            'no_inet' => $this->ModelAllWo->getDataSC($data['id'])[0]['no_inet'],
            'st_wo' => $this->ModelAllWo->getDataSC($data['id'])[0]['st_wo'],
        ];
        $this->ModelAllWo->addToTemp_old($oldData);

        $dataA = [
            'id' => $data['id'],
            'st_wo' => 11
        ];
        $this->ModelAllWo->setToEditWo($dataA);

        return json_encode('200');
    }
}
