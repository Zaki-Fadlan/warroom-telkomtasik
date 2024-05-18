<?php

namespace App\Controllers;

use App\Models\ModelSto;
use App\Models\ModelLayanan;
use App\Models\ModelUser;
use App\Models\ModelDatel;
use App\Models\ModelLevel;
use App\Models\ModelTeknisi;
use App\Models\ModelSales;
use App\Models\ModelStAct;
use App\Models\ModelDatelSt;
use App\Models\ModelStoSt;
use App\Models\ModelUserSt;
use App\Models\ModelKecepatan;
use App\Models\ModelKendala;

// use PhpMyAdmin\Server\Status\Data;


class Pvitadatamaster extends BaseController
{

    public function index()
    {
        $data = [
            'tittle' => 'DATAMASTER',
            'isi' => 'pvita/datamaster/index',
        ];
        return view('layoutpvita/wrapper', $data);
    }
    public function __construct()
    {
        helper('form');
        $this->ModelLevel = new ModelLevel();
        $this->ModelDatel = new ModelDatel();
        $this->ModelLayanan = new ModelLayanan();
        $this->ModelKecepatan = new ModelKecepatan();
        $this->ModelSto = new ModelSto();
        $this->ModelUser = new ModelUser();
        $this->ModelTeknisi = new ModelTeknisi();
        $this->ModelSales = new ModelSales();
        $this->ModelStAct = new ModelStAct();
        $this->ModelDatelSt = new ModelDatelSt();
        $this->ModelStoSt = new ModelStoSt();
        $this->ModelUserSt = new ModelUserSt();
        $this->ModelKendala = new ModelKendala();
    }
    // Fungsi Kendala
    public function viewModalKendala()
    {
        return view('pvita/datamaster/modaltambah/formkendala');
    }
    public function viewModalEditKendala()
    {
        $aa = $this->request->getPost('id_kendala');
        $data =  $this->ModelKendala->dataKendala($aa);
        $aktif =  $this->ModelDatelSt->allData();
        $datab = [
            "data" => $data,
            "aktif" => $aktif,
        ];
        // return json_encode($data);
        return view('pvita/datamaster/modaledit/editkendala', $datab);
    }
    public function insertKendala()
    {
        $data = [
            'n_tipe_kendala' => strtoupper($this->request->getPost('n_tipe_kendala')),
            'st_k'           => 1,
        ];
        if ($this->ModelKendala->checkKendala($data) == 0) {
            $this->ModelKendala->tambahKendala($data);
            return json_encode("200");
        } else {
            return json_encode("gagal");
        }
    }
    public function updateKendalaData()
    {
        $data = [
            'id_kendala'         => $this->request->getPost('id_kendala'),
            'n_tipe_kendala'         => strtoupper($this->request->getPost('n_tipe_kendala')),
            'st_k'         => strtoupper($this->request->getPost('st_k')),
        ];
        $datab = $this->ModelKendala->validasiNamaKendala($data);
        $ss = "";
        foreach ($datab as $key) {
            $ss .= $key['id_kendala'];
        }
        if ((int)$ss == $data['id_kendala'] or $datab == []) {
            $this->ModelKendala->updateKendala($data);
            return json_encode("200");
        } else {
            return "Gagal";
        }
    }
    public function ajaxDataTableKendala()
    {
        $data['kendala'] =  $this->ModelKendala->allData();
        $dataKendala = [];
        $no = 0;
        foreach ($data['kendala'] as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="editKendala(' . $temp['id_kendala'] . ')" data-target="#modalView"><i class="fa-solid fa-pen"></i> Edit</button>';
            $row = [];
            $row[] = $no;
            $row[] = $temp['n_tipe_kendala'];
            $row[] = $temp['n_st_dm_datel'];
            $row[] = $aksi;
            $dataKendala[] = $row;
        }
        $result['data'] = $dataKendala;
        echo json_encode($result);
        exit();
    }
    // Fungsi Kecepatan
    public function viewModalKecepatan()
    {
        return view('pvita/datamaster/modaltambah/formkecepatan');
    }
    public function viewModalEditKecepatan()
    {
        $aa = $this->request->getPost('id_kecepatan');
        $data =  $this->ModelKecepatan->dataKecepatan($aa);
        $aktif =  $this->ModelDatelSt->allData();
        $datab = [
            "data" => $data,
            "aktif" => $aktif,
        ];
        // return json_encode($data);
        return view('pvita/datamaster/modaledit/editkecepatan', $datab);
    }

    public function insertKecepatan()
    {
        $data = [
            'nama_kecepatan'         => strtoupper($this->request->getPost('nama_kecepatan')),
            'st_kc'           => 1,
        ];
        if ($this->ModelKecepatan->checkKecepatan($data) == 0) {
            $this->ModelKecepatan->tambahKecepatan($data);
            return json_encode("200");
        } else {
            return json_encode("gagal");
        }
    }
    public function updateKecepatanData()
    {
        $data = [
            'id_kecepatan'         => $this->request->getPost('id_kecepatan'),
            'nama_kecepatan'         => strtoupper($this->request->getPost('nama_kecepatan')),
            'st_kc'         => strtoupper($this->request->getPost('st_kc')),
        ];
        $datab = $this->ModelKecepatan->validasiNamaKecepatan($data);
        $ss = "";
        foreach ($datab as $key) {
            $ss .= $key['id_kecepatan'];
        }
        if ((int)$ss == $data['id_kecepatan'] or $datab == []) {
            $this->ModelKecepatan->updateKecepatan($data);
            return json_encode("200");
        } else {
            return "Gagal";
        }
    }
    public function ajaxDataTableKecepatan()
    {
        $data['kecepatan'] =  $this->ModelKecepatan->allData();
        $dataKecepatan = [];
        $no = 0;
        foreach ($data['kecepatan'] as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="editKecepatan(' . $temp['id_kecepatan'] . ')" data-target="#modalView"><i class="fa-solid fa-pen"></i> Edit</button>';
            $row = [];
            $row[] = $no;
            $row[] = $temp['nama_kecepatan'];
            $row[] = $temp['n_st_dm_datel'];
            $row[] = $aksi;
            $dataKecepatan[] = $row;
        }
        $result['data'] = $dataKecepatan;
        echo json_encode($result);
        exit();
    }
    // Fungsi Layanan
    public function viewModalLayanan()
    {
        return view('pvita/datamaster/modaltambah/formlayanan');
    }
    public function viewModalEditLayanan()
    {
        $aa = $this->request->getPost('id_layanan');
        $data =  $this->ModelLayanan->datalayanan($aa);
        $aktif =  $this->ModelDatelSt->allData();
        $datab = [
            "data" => $data,
            "aktif" => $aktif,
        ];
        // return json_encode($data);
        return view('pvita/datamaster/modaledit/editlayanan', $datab);
    }
    public function insertLayanan()
    {
        $data = [
            'nama_layanan'         => strtoupper($this->request->getPost('nama_layanan')),
            'st_ly'           => 1,
        ];
        if ($this->ModelLayanan->checklayanan($data) == 0) {
            $this->ModelLayanan->tambahlayanan($data);
            return json_encode("200");
        } else {
            return json_encode("gagal");
        }
    }
    public function updateLayananData()
    {
        $data = [
            'id_layanan'         => $this->request->getPost('id_layanan'),
            'nama_layanan'         => strtoupper($this->request->getPost('nama_layanan')),
            'st_ly'         => strtoupper($this->request->getPost('st_ly')),
        ];
        $datab = $this->ModelLayanan->validasiNamaLayanan($data);
        $ss = "";
        foreach ($datab as $key) {
            $ss .= $key['id_layanan'];
        }
        if ((int)$ss == $data['id_layanan'] or $datab == []) {
            $this->ModelLayanan->updatelayanan($data);
            return json_encode("200");
        } else {
            return "Gagal";
        }
    }
    public function ajaxDataTableLayanan()
    {
        $data['layanan'] =  $this->ModelLayanan->allData();
        $dataLayanan = [];
        $no = 0;
        foreach ($data['layanan'] as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="editLayanan(' . $temp['id_layanan'] . ')" data-target="#modalView"><i class="fa-solid fa-pen"></i> Edit</button>';
            $row = [];
            $row[] = $no;
            $row[] = $temp['nama_layanan'];
            $row[] = $temp['n_st_dm_datel'];
            $row[] = $aksi;
            $dataLayanan[] = $row;
        }
        $result['data'] = $dataLayanan;
        echo json_encode($result);
        exit();
    }
    // Fungsi Datel
    public function viewModalDatel()
    {
        return view('pvita/datamaster/modaltambah/formdatel');
    }
    public function viewModalEditDatel()
    {
        $aa = $this->request->getPost('id_datel');
        $data =  $this->ModelDatel->dataDatel($aa);
        $aktif =  $this->ModelDatelSt->allData();
        $datab = [
            "data" => $data,
            "aktif" => $aktif,
        ];
        // return json_encode($data);
        return view('pvita/datamaster/modaledit/editdatel', $datab);
    }

    public function insertdatel()
    {
        $data = [
            'nama_datel'         => strtoupper($this->request->getPost('nama_datel')),
            'status_datel'           => 1,
        ];
        if ($this->ModelDatel->checkdatel($data) == 0) {
            $this->ModelDatel->tambahDatel($data);
            return json_encode("200");
        } else {
            return json_encode("gagal");
        }
    }
    public function updateDatelData()
    {
        $data = [
            'id_datel'         => $this->request->getPost('id_datel'),
            'nama_datel'         => strtoupper($this->request->getPost('nama_datel')),
            'status_datel'         => strtoupper($this->request->getPost('status_datel')),
        ];
        $datab = $this->ModelDatel->validasiDatelName($data);
        $ss = "";
        foreach ($datab as $key) {
            $ss .= $key['id_datel'];
        }
        if ((int)$ss == $data['id_datel'] or $datab == []) {
            $this->ModelDatel->updateDatel($data);
            return json_encode("200");
        } else {
            return "Gagal";
        }
    }

    public function ajaxDataTableDatel()
    {
        $data['datel'] =  $this->ModelDatel->allData();
        $dataDatel = [];
        $no = 0;
        foreach ($data['datel'] as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="editDatel(' . $temp['id_datel'] . ')" data-target="#modalView"><i class="fa-solid fa-pen"></i> Edit</button>';
            $row = [];
            $row[] = $no;
            $row[] = $temp['nama_datel'];
            $row[] = $temp['id_datel'];
            $row[] = $temp['n_st_dm_datel'];
            $row[] = $aksi;
            $dataDatel[] = $row;
        }
        $result['data'] = $dataDatel;
        echo json_encode($result);
        exit();
    }


    // Fungsi STO
    public function viewModalSto()
    {
        $data = [
            'datel' => $this->ModelDatel->allData()
        ];
        return view('pvita/datamaster/modaltambah/formsto', $data);
    }

    public function insertsto()
    {
        $data = [
            'nama_sto'         => strtoupper($this->request->getPost('nama_sto')),
            'datel_sto'     => $this->request->getPost('id_datel_sto'),
            'status_sto'     => 1,
        ];
        if ($this->ModelSto->checksto($data) == 0) {
            $this->ModelSto->tambahSto($data);
            return json_encode("200");
        } else {
            return json_encode("gagal");
        }
    }

    public function ajaxDataTableSto()
    {
        $data['sto'] =  $this->ModelSto->allData();
        $dataSTO = [];
        $no = 0;
        foreach ($data['sto'] as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="editSTO(' . $temp['id_sto'] . ')"  data-target="#modalView"><i class="fa-solid fa-pen"></i> Edit</button>';
            $row = [];
            $row[] = $no;
            $row[] = $temp['nama_datel'];
            $row[] = $temp['nama_sto'];
            $row[] = $temp['n_st_dm_sto'];
            $row[] = $aksi;
            $dataSTO[] = $row;
        }
        $result['data'] = $dataSTO;
        echo json_encode($result);
        exit();
    }
    public function viewModalEditSTO()
    {
        $aa = $this->request->getPost('id_sto');
        $data =  $this->ModelSto->dataSto($aa);
        $statussto =  $this->ModelStoSt->allData();
        $datab = [
            "data" => $data,
            "statussto" => $statussto,
            "datel" =>  $this->ModelDatel->allData()
        ];
        // return json_encode($data);
        return view('pvita/datamaster/modaledit/editsto', $datab);
    }
    public function updateSTO()
    {
        $data = [
            'id_sto'         => $this->request->getPost('id_sto'),
            'nama_sto'       => strtoupper($this->request->getPost('nama_sto')),
            'datel_sto'      => $this->request->getPost('id_datel_sto'),
            'status_sto'      => $this->request->getPost('status_sto'),
        ];
        $datab = $this->ModelSto->validasiStoName($data);
        $ss = "";
        foreach ($datab as $key) {
            $ss .= $key['id_sto'];
        }
        if ((int)$ss == $data['id_sto'] or $datab == []) {
            $this->ModelSto->updateSTOData($data);
            return json_encode("200");
        } else {
            return "Gagal";
        }
    }


    // Fungsi User
    public function viewModalUser()
    {
        $data = [
            'datel' => $this->ModelDatel->allData(),
            'level' => $this->ModelLevel->allData()
        ];
        return view('pvita/datamaster/modaltambah/formuser', $data);
    }

    public function insertuser()
    {
        $data = [
            'nik'             => $this->request->getPost('nik'),
            'password'        => md5($this->request->getPost('password')),
            'nama_user'       => $this->request->getPost('nama_user'),
            'cp_user'         => $this->request->getPost('cp_user'),
            'time_add_user'   => date('d-m-Y'),
            'add_user'        => session()->get('nama'),
            'lv_user'         => $this->request->getPost('lv_user'),
            'datel_user'      => $this->request->getPost('datel_user'),
            'st_user'         => 1,
        ];
        if (json_encode($this->ModelUser->checknik($data)) == 0) {
            $this->ModelUser->tambahUser($data);
            return json_encode("200");
        } else {
            return json_encode("Gagal");
        }
    }

    public function updateUser()
    {
        $data = [
            'id_user'           => $this->request->getPost('id_user'),
            'nik'               => $this->request->getPost('nik'),
            'nama_user'         => $this->request->getPost('nama_user'),
            'cp_user'           => $this->request->getPost('cp_user'),
            'datel_user'        => $this->request->getPost('datel_user'),
            'lv_user'           => $this->request->getPost('lv_user'),
            'st_user'           => $this->request->getPost('st_user'),
        ];

        $datab = $this->ModelUser->validasiNIK($data);
        $ss = "";
        foreach ($datab as $key) {
            $ss .= $key['id_user'];
        }
        if ((int)$ss == $data['id_user'] or $datab == []) {
            $this->ModelUser->updateUser($data);
            return json_encode("200");
        } else {
            return "Gagal";
        }
    }

    public function ajaxDataTableUser()
    {
        $data['user'] =  $this->ModelUser->allData();
        $datauser = [];
        $no = 0;
        foreach ($data['user'] as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="editUser(' . $temp['id_user'] . ')"data-target="#modalView"><i class="fa-solid fa-pen"></i> Edit</button>';
            $aktif = '<span class="badge bg-success"><b>Aktif</b></span>';
            $nAktif = '<span class="badge bg-danger"><b>Tidak Aktif</b></span>';
            $row = [];
            $row[] = $no;
            $row[] = $temp['nama_datel'];
            $row[] = $temp['nama_user'];
            $row[] = $temp['nik'];
            $row[] = $temp['cp_user'];
            $row[] = $temp['nama_level'];
            $row[] = $temp['add_user'];
            if ($temp['st_user'] == 1) {
                $row[] = $aktif;
            } else {
                $row[] = $nAktif;
            }
            $row[] = $aksi;
            $datauser[] = $row;
        }
        $result['data'] = $datauser;
        echo json_encode($result);
        exit();
    }

    public function viewModalEditUser()
    {
        $aa = $this->request->getPost('id_user');
        $data =  $this->ModelUser->dataUser($aa);
        $datab = [
            "data" => $data,
            "aktif" =>  $this->ModelUserSt->allData(),
            "datel" =>  $this->ModelDatel->allData(),
            "level" =>  $this->ModelLevel->allData()
        ];
        // return json_encode($data);
        return view('pvita/datamaster/modaledit/edituser', $datab);
    }

    // Fungsi Teknisi
    public function viewModalTeknisi()
    {
        $data = [
            'datel' => $this->ModelDatel->allData()
        ];
        return view('pvita/datamaster/modaltambah/formteknisi', $data);
    }

    public function viewModalEditTeknisi()
    {
        $aa = $this->request->getPost('id_teknisi');
        $data =  $this->ModelTeknisi->dataTeknisi($aa);
        $datab = [
            "data" => $data,
            "aktif" =>  $this->ModelUserSt->allData(),
            "datel" =>  $this->ModelDatel->allData(),
            "level" =>  $this->ModelLevel->allData()
        ];
        // return json_encode($data);
        return view('pvita/datamaster/modaledit/editteknisi', $datab);
    }

    public function insertTeknisi()
    {
        $data = [
            'id_tele_tek'         => $this->request->getPost('id_tele_tek'),
            'nik_tek'             => $this->request->getPost('nik_tek'),
            'user_tele_tek'       => $this->request->getPost('user_tele_tek'),
            'nama_tek'            => $this->request->getPost('nama_tek'),
            'con_tek'             => $this->request->getPost('con_tek'),
            'mitra'               => $this->request->getPost('mitra'),
            'labor'               => $this->request->getPost('labor'),
            'crew'                => $this->request->getPost('crew'),
            'time_add_tek'        => date('Y-m-d H:i:s'),
            'user_add_tek'        => session()->get('nama'),
            'datel_tek'           => $this->request->getPost('datel_tek'),
            'st_tek'              => 1,
            'st_idle'              => 1,
            'st_absen'              => 1,
        ];
        // return $this->ModelTeknisi->tambahTeknisi($data);
        if (json_encode($this->ModelTeknisi->checkdata($data)) == 0) {
            $this->ModelTeknisi->tambahTeknisi($data);
            return json_encode("200");
        } else {
            return json_encode("Gagal");
        }
    }

    public function updateTeknisi()
    {
        $data = [
            'id_teknisi'          => $this->request->getPost('id_teknisi'),
            'id_tele_tek'         => $this->request->getPost('id_tele_tek'),
            'nik_tek'             => $this->request->getPost('nik_tek'),
            'user_tele_tek'       => $this->request->getPost('user_tele_tek'),
            'nama_tek'            => $this->request->getPost('nama_tek'),
            'con_tek'             => $this->request->getPost('con_tek'),
            'mitra'               => $this->request->getPost('mitra'),
            'labor'               => $this->request->getPost('labor'),
            'crew'                => $this->request->getPost('crew'),
            'datel_tek'           => $this->request->getPost('datel_tek'),
            'st_tek'              => $this->request->getPost('st_tek'),
        ];
        $datab = $this->ModelTeknisi->validasiNIK($data);
        $ss = "";
        foreach ($datab as $key) {
            $ss .= $key['id_teknisi'];
        }
        $dataa = $this->ModelTeknisi->validasitele($data);
        $aa = "";
        foreach ($dataa as $key) {
            $aa .= $key['id_teknisi'];
        }
        // return json_encode((int)$ss == $data['id_teknisi']);
        if (((int)$ss == $data['id_teknisi'] or $datab == []) and ((int)$aa == $data['id_teknisi'] or $dataa == [])) {
            $this->ModelTeknisi->updateTeknisi($data);
            return json_encode("200");
        } else {
            return "Gagal";
        }
    }

    public function ajaxDataTableTeknisi()
    {
        $data['tek'] =  $this->ModelTeknisi->allData();
        $dataTek = [];
        $no = 0;
        foreach ($data['tek'] as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="editTeknisi(' . $temp['id_teknisi'] . ')"data-target="#modalView"><i class="fa-solid fa-pen"></i> Edit</button>';
            $aktif = '<span class="badge bg-success"><b>Aktif</b></span>';
            $nAktif = '<span class="badge bg-danger"><b>Tidak Aktif</b></span>';
            $row = [];
            $row[] = $no;
            $row[] = $temp['nama_datel'];
            $row[] = $temp['nama_tek'];
            $row[] = $temp['nik_tek'];
            $row[] = $temp['mitra'];
            $row[] = $temp['id_tele_tek'];
            $row[] = $temp['user_tele_tek'];
            $row[] = $temp['con_tek'];
            $row[] = $temp['labor'];
            $row[] = $temp['crew'];
            $row[] = $temp['user_add_tek'];
            if ($temp['st_tek'] == 1) {
                $row[] = $aktif;
            } else {
                $row[] = $nAktif;
            }
            $row[] = $aksi;
            $dataTek[] = $row;
        }
        $result['data'] = $dataTek;
        echo json_encode($result);
        exit();
    }

    // Fungsi Sales
    public function viewModalSales()
    {
        $data = [
            'datel' => $this->ModelDatel->allData()
        ];
        return view('pvita/datamaster/modaltambah/formsales', $data);
    }

    public function viewModalEditSales()
    {
        $aa = $this->request->getPost('id_sf');
        $data =  $this->ModelSales->dataSales($aa);
        $datab = [
            "data" => $data,
            "aktif" =>  $this->ModelUserSt->allData(),
            "datel" =>  $this->ModelDatel->allData(),
            "level" =>  $this->ModelLevel->allData()
        ];
        // return json_encode($data);
        return view('pvita/datamaster/modaledit/editsales', $datab);
    }

    public function insertSf()
    {
        $data = [
            'nama_sf'          => $this->request->getPost('nama_sf'),
            'id_tele_sf'       => $this->request->getPost('id_tele_sf'),
            'user_tele_sf'     => $this->request->getPost('user_tele_sf'),
            'agency'           => $this->request->getPost('agency'),
            'kcon'             => $this->request->getPost('kcon'),
            'datel_sf'         => $this->request->getPost('datel_sf'),
            'time_add_sf'      => date('Y-m-d H:i:s'),
            'user_add_sf'      => session()->get('nama'),
            'st_sf'            => 1,
        ];
        if (json_encode($this->ModelSales->checkdata($data)) == 0) {
            $this->ModelSales->tambahSales($data);
            return json_encode("200");
        } else {
            return json_encode("Gagal");
        }
    }

    public function updateSales()
    {
        $data = [
            'id_sf'            => $this->request->getPost('id_sf'),
            'nama_sf'          => $this->request->getPost('nama_sf'),
            'id_tele_sf'       => $this->request->getPost('id_tele_sf'),
            'user_tele_sf'     => $this->request->getPost('user_tele_sf'),
            'agency'           => $this->request->getPost('agency'),
            'kcon'             => $this->request->getPost('kcon'),
            'datel_sf'         => $this->request->getPost('datel_sf'),
            'st_sf'           => $this->request->getPost('st_sf')
        ];
        $datab = $this->ModelSales->validasiId($data);
        $ss = "";
        foreach ($datab as $key) {
            $ss .= $key['id_sf'];
        }
        $dataa = $this->ModelSales->validasiK($data);
        $aa = "";
        foreach ($dataa as $key) {
            $aa .= $key['id_sf'];
        }
        //and //
        // echo json_encode((int)$ss == $data['id_sf']) . " " . json_encode($datab == []) . " " . json_encode((int)$aa == $data['id_sf']);
        if (((int)$aa == $data['id_sf'] or $dataa == []) and ((int)$ss == $data['id_sf'] or $datab == [])) {
            $this->ModelSales->updateSales($data);
            return json_encode("200");
        } else {
            return "Gagal";
        }
    }

    public function ajaxDataTableSales()
    {
        $data['sales'] =  $this->ModelSales->allData();
        $dataSf = [];
        $no = 0;
        foreach ($data['sales'] as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="editSales(' . $temp['id_sf'] . ')"data-target="#modalView"><i class="fa-solid fa-pen"></i> Edit</button>';
            $aktif = '<span class="badge bg-success"><b>Aktif</b></span>';
            $nAktif = '<span class="badge bg-danger"><b>Tidak Aktif</b></span>';
            $row = [];
            $row[] = $no;
            $row[] = $temp['nama_datel'];
            $row[] = $temp['nama_sf'];
            $row[] = $temp['kcon'];
            $row[] = $temp['agency'];
            $row[] = $temp['id_tele_sf'];
            $row[] = $temp['user_tele_sf'];
            $row[] = $temp['user_add_sf'];
            if ($temp['st_sf'] == 1) {
                $row[] = $aktif;
            } else {
                $row[] = $nAktif;
            }
            $row[] = $aksi;
            $dataSf[] = $row;
        }
        $result['data'] = $dataSf;
        echo json_encode($result);
        exit();
    }
}
