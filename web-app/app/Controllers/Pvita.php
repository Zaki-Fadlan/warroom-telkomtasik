<?php

namespace App\Controllers;

use App\Models\ModelDatel;
use App\Models\ModelLevel;
use App\Models\ModelRegSf;
use App\Models\ModelStReq;
use App\Models\ModelRegTek;
use App\Models\ModelRegUser;

class Pvita extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelLevel = new ModelLevel();
        $this->ModelDatel = new ModelDatel();
        $this->ModelStReq = new ModelStReq();
        $this->ModelRegUser = new ModelRegUser();
        $this->ModelRegTek = new ModelRegTek();
        $this->ModelRegSf = new ModelRegSf();
    }

    public function index()
    {
        $data = [
            'tittle' => 'Login',
            'level' => $this->ModelLevel->allData()

        ];
        return view('pvita/loginpvita', $data);
    }

    public function reguser()
    {
        $data = [
            'datel' => $this->ModelDatel->allData(),
            'level' => $this->ModelLevel->allData(),
            'st' => $this->ModelStReq->allData()
        ];
        return view('pvita/reguser', $data);
    }

    public function streg()
    {
        return view('pvita/statusRegister');
    }

    public function registeruser()
    {
        $data = [
            'nik'             => $this->request->getPost('nik'),
            'password'        => md5($this->request->getPost('password')),
            'nama_user'       => $this->request->getPost('nama_user'),
            'cp_user'         => $this->request->getPost('cp_user'),
            'lv_user'         => $this->request->getPost('lv_user'),
            'datel_user'      => $this->request->getPost('datel_user'),
            'tgl_reguser'     => date('d-m-Y'),
            'st_req'          => 2,
            'st_user'         => 1,
        ];
        if (json_encode($this->ModelRegUser->checknik($data)) == 0) {
            $this->ModelRegUser->addRegUser($data);
            return json_encode("200");
        } else {
            return json_encode("Gagal");
        }
    }

    public function ajaxDataTableUser()
    {
        $data['reguser'] =  $this->ModelRegUser->allData();
        $datauser = [];
        $no = 0;
        foreach ($data['reguser'] as $temp) {
            $no++;
            $acc = '<span class="badge bg-success"><b>Accepted</b></span>';
            $pending = '<span class="badge bg-warning"><b>Pending</b></span>';
            $nAktif = '<span class="badge bg-danger"><b>Rejected</b></span>';
            $row = [];
            $row[] = $no;
            if ($temp['st_req'] == 1) {
                $row[] = $acc;
            }
            if ($temp['st_req'] == 2) {
                $row[] = $pending;
            }
            if ($temp['st_req'] == 0) {
                $row[] = $nAktif;
            }
            $row[] = $temp['tgl_reguser'];
            $row[] = $temp['nama_user'];
            $row[] = $temp['nik'];
            $row[] = $temp['nama_datel'];
            $row[] = $temp['nama_level'];
            $row[] = $temp['responder_mnjr'];

            $datauser[] = $row;
        }
        $result['data'] = $datauser;
        echo json_encode($result);
        exit();
    }

    public function regsf()
    {
        $data = [
            'datel' => $this->ModelDatel->allData(),
            'st' => $this->ModelStReq->allData()
        ];
        return view('pvita/regsf', $data);
    }

    public function registersf()
    {
        $data = [
            'id_tele_sf'       => $this->request->getPost('id_tele_sf'),
            'user_tele_sf'     => $this->request->getPost('user_tele_sf'),
            'nama_sf'          => $this->request->getPost('nama_sf'),
            'agency'           => $this->request->getPost('agency'),
            'kcon'             => $this->request->getPost('kcon'),
            'datel_sf'         => $this->request->getPost('datel_sf'),
            'tgl_regsf'        => date('d-m-Y'),
            'st_req'           => 2,
            'st_sf'            => 1,
        ];
        if (json_encode($this->ModelRegSf->checkdata($data)) == 0) {
            $this->ModelRegSf->addRegSf($data);
            return json_encode("200");
        } else {
            return json_encode("Gagal");
        }
    }

    public function ajaxDataTableSf()
    {
        $data['regsf'] =  $this->ModelRegSf->allData();
        $datauser = [];
        $no = 0;
        foreach ($data['regsf'] as $temp) {
            $no++;
            $acc = '<span class="badge bg-success"><b>Accepted</b></span>';
            $pending = '<span class="badge bg-warning"><b>Pending</b></span>';
            $nAktif = '<span class="badge bg-danger"><b>Rejected</b></span>';
            $row = [];
            $row[] = $no;
            if ($temp['st_req'] == 1) {
                $row[] = $acc;
            }
            if ($temp['st_req'] == 2) {
                $row[] = $pending;
            }
            if ($temp['st_req'] == 0) {
                $row[] = $nAktif;
            }
            $row[] = $temp['tgl_regsf'];
            $row[] = $temp['nama_sf'];
            $row[] = $temp['kcon'];
            $row[] = $temp['agency'];
            $row[] = $temp['nama_datel'];
            $row[] = $temp['responder_mnjr'];

            $datauser[] = $row;
        }
        $result['data'] = $datauser;
        echo json_encode($result);
        exit();
    }

    public function regteknisi()
    {
        $data = [
            'datel' => $this->ModelDatel->allData(),
            'st' => $this->ModelStReq->allData()
        ];
        return view('pvita/regteknisi', $data);
    }

    public function registertek()
    {
        $data = [
            'nik_tek'             => $this->request->getPost('nik_tek'),
            'id_tele_tek'         => $this->request->getPost('id_tele_tek'),
            'user_tele_tek'       => $this->request->getPost('user_tele_tek'),
            'nama_tek'            => $this->request->getPost('nama_tek'),
            'con_tek'             => $this->request->getPost('con_tek'),
            'mitra'               => $this->request->getPost('mitra'),
            'labor'               => $this->request->getPost('labor'),
            'crew'                => $this->request->getPost('crew'),
            'datel_tek'           => $this->request->getPost('datel_tek'),
            'tgl_regtek'          => date('d-m-Y'),
            'st_req'              => 2,
            'st_tek'              => 1,
        ];
        // return $this->ModelTeknisi->tambahTeknisi($data);
        if (json_encode($this->ModelRegTek->checkdata($data)) == 0) {
            $this->ModelRegTek->addRegTeknisi($data);
            return json_encode("200");
        } else {
            return json_encode("Gagal");
        }
    }

    public function ajaxDataTableTek()
    {
        $data['regtek'] =  $this->ModelRegTek->allData();
        $datauser = [];
        $no = 0;
        foreach ($data['regtek'] as $temp) {
            $no++;
            $acc = '<span class="badge bg-success"><b>Accepted</b></span>';
            $pending = '<span class="badge bg-warning"><b>Pending</b></span>';
            $nAktif = '<span class="badge bg-danger"><b>Rejected</b></span>';
            $row = [];
            $row[] = $no;
            if ($temp['st_req'] == 1) {
                $row[] = $acc;
            }
            if ($temp['st_req'] == 2) {
                $row[] = $pending;
            }
            if ($temp['st_req'] == 0) {
                $row[] = $nAktif;
            }
            $row[] = $temp['tgl_regtek'];
            $row[] = $temp['nama_tek'];
            $row[] = $temp['nik_tek'];
            $row[] = $temp['nama_datel'];
            $row[] = $temp['user_tele_tek'];
            $row[] = $temp['mitra'];
            $row[] = $temp['labor'];
            $row[] = $temp['crew'];
            $row[] = $temp['responder_mnjr'];

            $datauser[] = $row;
        }
        $result['data'] = $datauser;
        echo json_encode($result);
        exit();
    }

    public function statReg()
    {
        $data = [
            'datel' => $this->ModelDatel->allData(),
            'st' => $this->ModelStReq->allData()
        ];
        return view('pvita/statusRegister', $data);
    }
}
