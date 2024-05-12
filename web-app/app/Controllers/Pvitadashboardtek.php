<?php

namespace App\Controllers;

use App\Models\ModelStatus;
use App\Models\ModelKendala;
use App\Models\ModelDashboardTeknisi;
use App\Models\ModelDatel;
use App\Models\ModelSto;
use App\Models\ModelTeknisi;



class Pvitadashboardtek extends BaseController
{

    public function index()
    {
        $data = [
            'tittle' => 'DASHBOARD TEKNISI',
            'isi' => 'pvita/dashboard/index2',
            'sto' => $this->ModelSto->allData(),
            'datel' => $this->ModelDatel->allData(),
        ];
        return view('layoutpvita/wrapper', $data);
    }
    public function __construct()
    {
        helper('form');
        $this->ModelStatus = new ModelStatus();
        $this->ModelKendala = new ModelKendala();
        $this->ModelDatel = new ModelDatel();
        $this->ModelSto = new ModelSto();
        $this->ModelDashboardTeknisi = new ModelDashboardTeknisi();
        $this->ModelTeknisi = new ModelTeknisi();
    }
    public function ajaxDbTeknisi()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data =  $this->ModelDashboardTeknisi->allData();
        $alldata = [];
        foreach ($data as $valdat) {
            $row = [];
            // $timezone = time() - (60 * 60 * 7);
            // $batasHariini = strtotime(date('d-m-Y 00:00:00', $timezone));
            $row[] =  date('d-m-Y H:i:s', $valdat['time_stamp']);
            $row[] = $valdat['nama_datel'];
            $row[] = $valdat['jml_tek'];
            $row[] = $valdat['osom_tek'];
            $row[] = $valdat['buffer_tek'];
            // $listTeknisiOsom = [];
            // $listTeknisiBuffer = [];
            // foreach (explode(',', $valdat['list_osom']) as $key) {
            //     if ($key != "") {
            //         $listTeknisiOsom[] = "<li>" . $this->ModelDashboardTeknisi->gettingNameTeknisi($key) . "</li>";
            //     } else {
            //         $listTeknisiOsom[] = "<li>" . $key . "</li>";
            //     }
            // }
            // foreach (explode(',', $valdat['list_buffer']) as $key) {
            //     if ($key != "") {
            //         $listTeknisiBuffer[] = "<li>" . $this->ModelDashboardTeknisi->gettingNameTeknisi($key) . "</li>";
            //     } else {
            //         $listTeknisiBuffer[] = "<li>" . $key . "</li>";
            //     }
            // }
            // $row[] = "<b>Osom </b> : " . implode('', $listTeknisiOsom) . "<br><b>Buffer </b>:" . implode('', $listTeknisiBuffer);
            $row[] = strval(($valdat['osom_tek'] + $valdat['buffer_tek']) / $valdat['jml_tek'] * 100) . "%";

            $waktuAwalSiang = strtotime("00:00:00") + 28800;
            $waktuSiang =  [
                'awal' => strtotime("00:00:00") + 28800,
                'ahir' => strtotime("00:00:00") + 50400,
            ];
            $waktuSore =  [
                'awal' => strtotime("00:00:00") + 50400,
                'ahir' => strtotime("00:00:00") + 79200,
            ];
            // $row[] = $this->ModelDashboardTeknisi->scbepagi($valdat['sto_id_dbtek'], $waktuAwalSiang);
            // $row[] = $this->ModelDashboardTeknisi->scbesiang($valdat['sto_id_dbtek'], $waktuSiang);
            // $row[] = $this->ModelDashboardTeknisi->scbesore($valdat['sto_id_dbtek'], $waktuSore);
            $row[] = $this->ModelDashboardTeknisi->scbepagi($valdat['sto_id_dbtek'], $valdat['time_stamp']);
            $row[] = $this->ModelDashboardTeknisi->scbesiang($valdat['sto_id_dbtek'], $valdat['time_stamp']);
            $row[] = $this->ModelDashboardTeknisi->scbesore($valdat['sto_id_dbtek'], $valdat['time_stamp']);
            $scbePagi = $this->ModelDashboardTeknisi->scbepagi($valdat['sto_id_dbtek'], $valdat['time_stamp']);
            $scbeSiang = $this->ModelDashboardTeknisi->scbesiang($valdat['sto_id_dbtek'], $valdat['time_stamp']);
            $scbeSore = $this->ModelDashboardTeknisi->scbesore($valdat['sto_id_dbtek'], $valdat['time_stamp']);
            // $scbePagi = $this->ModelDashboardTeknisi->scbepagi($valdat['sto_id_dbtek'], $waktuAwalSiang);
            // $scbeSiang = $this->ModelDashboardTeknisi->scbesiang($valdat['sto_id_dbtek'], $waktuSiang);
            // $scbeSore = $this->ModelDashboardTeknisi->scbesore($valdat['sto_id_dbtek'], $waktuSore);

            $totalWOHI = $scbePagi + $scbeSiang + $scbeSore;
            $row[] = $totalWOHI;

            $row[] = ($totalWOHI) - ($this->ModelDashboardTeknisi->sPS($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp']))) + $this->ModelDashboardTeknisi->sSC($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp']))) + $this->ModelDashboardTeknisi->pInput($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp']))) + $this->ModelDashboardTeknisi->kJaringan($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp']))) + $this->ModelDashboardTeknisi->kPelanggan($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp']))));
            $row[] = $this->ModelDashboardTeknisi->kPelanggan($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp'])));
            $row[] = $this->ModelDashboardTeknisi->kJaringan($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp'])));
            $row[] = $this->ModelDashboardTeknisi->pInput($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp'])));
            $row[] = $this->ModelDashboardTeknisi->sSC($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp'])));
            $row[] = $this->ModelDashboardTeknisi->sPS($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp'])));
            if (($valdat['osom_tek'] + $valdat['buffer_tek']) > 0) {
                $prod = ($this->ModelDashboardTeknisi->sPS($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp']))) + $this->ModelDashboardTeknisi->sSC($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp']))) + $this->ModelDashboardTeknisi->pInput($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp']))) + $this->ModelDashboardTeknisi->kJaringan($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp'])))) / ($valdat['osom_tek'] + $valdat['buffer_tek']);
                $row[] = number_format(($prod), 2, '.', '');
            } else {
                $row[] = "N/A";
            }
            if ($totalWOHI > 0) {
                $order = ($this->ModelDashboardTeknisi->sPS($valdat['sto_id_dbtek'], $valdat['time_stamp']) + $this->ModelDashboardTeknisi->sSC($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp']))) + $this->ModelDashboardTeknisi->pInput($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp']))) + $this->ModelDashboardTeknisi->kJaringan($valdat['sto_id_dbtek'], strtotime(date('d-m-Y 00:00:00', $valdat['time_stamp'])))) / $totalWOHI;
                $row[] = strval(number_format(($order * 100), 2, '.', '')) . " %";
            } else {
                $row[] = "N/A";
            }

            $alldata[] = $row;
        }
        $result['data'] = $alldata;
        echo json_encode($result);
        exit();
    }
    public function insertDbTeknisi()
    {
        if (session()->get('id_level') == 4) {
            date_default_timezone_set("Asia/Jakarta");
            $data = [
                'sto_id_dbtek'          =>  $this->request->getPost('sto'),
                'time_stamp'          => strtotime(date("d-m-Y H:i:s")) - 25200,
                'jml_tek'          =>  $this->request->getPost('jmlTek'),
                'osom_tek'          =>  count(explode(',', $this->request->getPost('osom'))),
                'list_osom'          =>   $this->request->getPost('osom'),
                'buffer_tek'          =>  count(explode(',', $this->request->getPost('buffer'))),
                'list_buffer'          =>  $this->request->getPost('buffer'),
            ];
            $validasi = $this->ModelDashboardTeknisi->validasi($data['sto_id_dbtek']);
            if ($validasi < 1) {
                $this->ModelDashboardTeknisi->insertDb($data);
            } else {
                $this->ModelDashboardTeknisi->upd($data);
            }
            foreach (explode(',', $data['list_osom']) as $key) {
                $updateData = [
                    'st_absen' => 1,
                    'st_idle' => 1
                ];
                $this->ModelDashboardTeknisi->updateAbsen((int)$key, $updateData);
            }
            foreach (explode(',', $data['list_buffer']) as $key) {
                $updateData = [
                    'st_absen' => 1,
                    'st_idle' => 0
                ];
                $this->ModelDashboardTeknisi->updateAbsen((int)$key, $updateData);
            }
            return json_encode(200);
        } else {
            return "";
        }
    }
    public function resetAbsen()
    {
        if (session()->get('id_level') == 4) {
            date_default_timezone_set("Asia/Jakarta");
            $data = [
                'datel_tek'          =>  (int)$this->request->getPost('id_datel'),
                'st_absen'          =>  0,
            ];
            $this->ModelDashboardTeknisi->resetAbsen($data);
            return json_encode(200);
        } else {
            return "";
        }
    }
    public function resetAllAbsen()
    {
        if (session()->get('id_level') == 4) {
            date_default_timezone_set("Asia/Jakarta");
            $data = [
                'st_absen'          =>  0,
            ];
            $this->ModelDashboardTeknisi->resetAllAbsen($data);
            return json_encode(200);
        } else {
            return "";
        }
    }
    public function teknisiRekap()
    {
        $iddatel = $this->request->getPost('datel');
        $data['data'] =  $this->ModelDashboardTeknisi->rekapListteknisi($iddatel);
        return json_encode($data);
    }
    public function rekap()
    {
        if (session()->get('id_level') == 4) {
            date_default_timezone_set("Asia/Jakarta");
            if ($this->request->getPost('osom') != "") {
                $banyak_osom          =   count(explode(',', $this->request->getPost('osom')));
            } else {
                $banyak_osom          =   0;
            }
            if ($this->request->getPost('buffer') != "") {
                $banyak_buffer          =   count(explode(',', $this->request->getPost('buffer')));
            } else {
                $banyak_buffer          =   0;
            }
            $data = [
                'time_stamp'          => strtotime("now") - 25113,
                'sto_id_dbtek'           =>   $this->request->getPost('datel'),
                'osom_tek'            =>  $banyak_osom,
                'list_osom'           =>   $this->request->getPost('osom'),
                'buffer_tek'          =>   $banyak_buffer,
                'list_buffer'         =>  $this->request->getPost('buffer'),
                'jml_tek'         =>  $banyak_buffer + $banyak_osom,

            ];
            $timezone = time() - (60 * 60 * 7);
            $batasHariini = [
                'awal' => strtotime(date('d-m-Y 00:00:00', $timezone)),
                'ahir' => strtotime(date('d-m-Y 23:59:59', $timezone)),
            ];
            $response = $this->ModelDashboardTeknisi->insertDb($data, $batasHariini);
            return json_encode($response);
        } else {
            return json_encode("Kamu bukan Helpdesk!!!");
        }
    }
    public function listTeknisi()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data =  $this->ModelDashboardTeknisi->allData();
        $alldata = [];
        return json_encode($data);
    }

    public function ajaxTableTimTeknisi()
    {
        $data['tek'] =  $this->ModelDashboardTeknisi->getTim();
        $dataTek = [];
        $no = 0;
        foreach ($data['tek'] as $temp) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $temp['nama_datel'];
            $row[] = $temp['nama_tim'];
            $row[] = $temp['anggota_tim'];
            $dataTek[] = $row;
        }
        $result['data'] = $dataTek;
        echo json_encode($result);
        exit();
    }
}
