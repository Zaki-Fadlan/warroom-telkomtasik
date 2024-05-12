<?php

namespace App\Controllers;

use App\Models\ModelSto;
use App\Models\ModelAllWo;
use App\Models\ModelDatel;
use App\Models\ModelLevel;
use App\Models\ModelStatus;
use App\Models\ModelUser;
use App\Models\ModelTeknisi;


class Pvitamanja extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'WO MANJA',
            'isi' => 'pvita/womanja/index',
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
        $data =  $this->ModelAllWo->manja();
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $temp['order_id'];
            $row[] = $temp['nama_sto'];
            $row[] = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="dispatch(' . $temp['id'] . ')" data-target="#modalView">Proses WO</button>';;
            $row[] =  $temp['manja_date'];;
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
                $row[] =  $temp['no_plgn'];
                $row[] =  str_replace('$$$', ',', $temp['tikor_plgn']);
                $row[] =  $temp['ket_teknisi'];
                $row[] =  date('d/m/Y H:i:s', $temp['wf_teknisi']);
            } else {
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
            }
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
        ];
        $data =  $this->ModelAllWo->manjafilter($filterData);
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $temp['order_id'];
            $row[] = $temp['nama_sto'];
            $row[] = '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="dispatch(' . $temp['id'] . ')" data-target="#modalView">Proses WO</button>';;
            $row[] = "-";
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
                $row[] =  $temp['no_plgn'];
                $row[] =  str_replace('$$$', ',', $temp['tikor_plgn']);
                $row[] =  $temp['ket_teknisi'];
                $row[] =  date('d/m/Y H:i:s', $temp['wf_teknisi']);
            } else {
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
                $row[] = "-";
            }
            $dataDatel[] = $row;
        }
        $result['data'] = $dataDatel;
        echo json_encode($result['data']);
        exit();
    }
    public function viewModal()
    {
        $aa = $this->request->getPost('id_wo');
        $allTeknisi = $this->ModelTeknisi->allData();
        $final_dateknisi = [];
        foreach ($allTeknisi as $key => $temp) {
            if ($temp['st_absen'] == 1 and $temp['st_idle'] == 1) {
                $row = [];
                $row['tele_id'] = $temp['id_tele_tek'];
                $row['nama_teknisi'] = $temp['nama_tek'];
                $row['datel'] = $temp['nama_datel'];
                $row['jml_wo'] = $this->ModelTeknisi->jmlWo($temp['id_teknisi']);
                array_push($final_dateknisi, (object) $row);
            }
        }
        $datab = [
            "data" => $this->ModelAllWo->getDataScbe($aa),
            "sto" => $this->ModelSto->allData(),
            "teknisiWO" => json_encode($final_dateknisi),
            "all_teknisi" =>  $this->ModelTeknisi->allData(),

        ];
        // return json_encode($final_dateknisi);
        return view('pvita/womanja/modal', $datab);
    }
    public function proseswo()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = strtotime(date("d-m-Y H:i:s")) - 25320;

        $data = [
            'id'            => $this->request->getPost('id'),
            'id_nama_teknisi'       => $this->ModelTeknisi->checkIdbyIDtele($this->request->getPost('teknisibaru')),
            'ket_dispatch'       => $this->request->getPost('keterangan'),
            'na_isi_tek'       => session()->get('id_user'),
            'wi_tek'       => $now,
            'st_wo'       => 8,
        ];
        // Get WO Data
        $dataPesan = $this->ModelAllWo->getDataScbe($data['id']);
        $pesan = "Anda Mendapatkan WO MANJA, Silahkan Survei kembali ke TKP!.\nWO detail:\n";
        $oldTeknisi = 0;
        $order_idOld = "";
        foreach ($dataPesan as $temp) {
            $pesan .= "- STO : " . $temp['nama_sto'] .
                "\n- Order ID : " . $temp['order_id'] .
                "\n- Stamp Amser :  " . date('d/m/Y H:i:s', $temp['stamp_ampser']) .
                "\n- Track ID :  " . $temp['track_id'] .
                "\n- Layanan :  " . $temp['nama_layanan'] .
                "\n- Kecepatan :  " . $temp['nama_kecepatan'] .
                "\n- Nama :  " . $temp['ncp'] .
                "\n- Kontak :  " . $temp['kcp'] .
                "\n- Kontak Alternatif :  " . $temp['kacp'] .
                "\n- Alamat Lengkap :  " . $temp['alamat'] .
                "\n- Patokan Alamat :  " . $temp['pat_alamat'] .
                "\n- Desa :  " . $temp['desa'] .
                "\n- Kecamatan :  " . $temp['kecamatan'] .
                "\n- Tikor ODP:  " . str_replace('$$$', ',', $temp['tikor_odp']) .
                "\n- Tikor Calon Pelanggan :  " . str_replace('$$$', ',', $temp['tikor_cp']) .
                "\n- Datek ODP :  " . $temp['datel_odp'] .
                "\n- Estimasi Panjang DC : " . $temp['est_pj_dc'] . ' M' .
                "\n- Agency SF: " . $temp['agency'] .
                "\n- K-Contact SF : " . $temp['kcon'] .
                "\n- Username SF : " . $temp['user_sf'] .
                "\n- Keterangan Sales :  " . $temp['ket_sales'] .
                "\n- Nama Sales : " . $temp['nama_sf'] .
                "\n- Nomor SC : " . $temp['sc_a'] .
                "\n- Keterangan Inputer : " . $temp['ket_val'] .
                "\n- HD : " . $temp['nama_user'] .
                "\n- Keterangan HD : " . $temp['ket_dispatch'];
            $oldTeknisi += $this->ModelTeknisi->gettingIdTeleTeknisi($temp['id_nama_teknisi']);
            $order_idOld .= $temp['order_id'];
        }
        $replyMarkup = array(
            'keyboard' => array(
                array("BISA DITARIK PT1", "KENDALA", "WO MANJA"),
            ),
        );
        $encodedMarkup = json_encode($replyMarkup);
        $token = "5427617081:AAEtLWUlWlHD_g5Z95GOLurb16iBC4e_5Xg"; // token bot
        $dataT = [
            'text' => $pesan,
            'chat_id' => $this->request->getPost('teknisibaru'), //contoh bot, group id -442697126
            'reply_markup' => $encodedMarkup,
        ];
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($dataT));

        $dataTt = [
            'text' => "WO " . $order_idOld . " Telah diambil dari anda!!",
            'chat_id' => $oldTeknisi, //contoh bot, group id -442697126
            'reply_markup' => $encodedMarkup,
        ];
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($dataTt));

        $this->ModelAllWo->updateScbe($data);
        return json_encode("200");
    }
}
