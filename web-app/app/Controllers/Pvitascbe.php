<?php

namespace App\Controllers;

use App\Models\ModelSto;
use App\Models\ModelDatel;
use App\Models\ModelAllWo;
use App\Models\ModelTeknisi;
use Dotenv\Dotenv;



class Pvitascbe extends BaseController
{
    protected $botToken;
    public function index()
    {
        $data = [
            'tittle' => 'WO SCBE',
            'isi' => 'pvita/woscbe/index',
            'sto' => $this->ModelSto->allData(),
            'datel' => $this->ModelDatel->allData(),
            'teknisi' => $this->ModelTeknisi->allData(),

        ];
        return view('layoutpvita/wrapper', $data);
    }
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(ROOTPATH);
        $dotenv->load();
        $this->botToken = getenv('BOT_TECHNICIAN_TOKEN');

        helper('form');
        $this->ModelSto = new ModelSto();
        $this->ModelDatel = new ModelDatel();
        $this->ModelAllWo = new ModelAllWo();
        $this->ModelTeknisi = new ModelTeknisi();
    }
    public function viewDispatchModal()
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
        ];
        // return json_encode($final_dateknisi);
        return view('pvita/woscbe/modalscbe', $datab);
    }

    public function ajaxDataTableScbe()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data =  $this->ModelAllWo->scbe();
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" onclick="dispatch(' . $temp['id'] . ')" data-target="#modalView"><b>Dispatch WO</b></button>';
            $row = [];
            $row[] = $no;
            $row[] = $aksi;
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
            $row[] = date('d/m/Y H:i:s', (int)$temp['wi_val']); //$temp['wi_val'];
            $row[] = $temp['n_validasi'];
            $row[] = $temp['n_fcc'];
            $row[] = $temp['sc_a'];
            $row[] = $temp['ket_val'];
            $row[] = $temp['nama_user'];
            $dataDatel[] = $row;
        }
        $result['data'] = $dataDatel;
        echo json_encode($result);
        exit();
    }
    public function updateDispatch()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = strtotime(date("d-m-Y H:i:s")) - 25200;

        $data = [
            'id'            => $this->request->getPost('id'),
            'sektor'          => $this->request->getPost('sektor'),
            'id_nama_teknisi'       => $this->ModelTeknisi->checkIdbyIDtele($this->request->getPost('teknisiDispatch')),
            'ket_dispatch'       => $this->request->getPost('keterangan'),
            'na_isi_tek'       => session()->get('id_user'),
            'wi_tek'       => $now,
            'st_wo'       => 8,
        ];
        $this->ModelAllWo->updateScbe($data);
        $dataPesan = $this->ModelAllWo->getDataScbe($data['id']);
        $pesan = "Anda Mendapatkan WO Baru dengan detail:\n";
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
        }
        $replyMarkup = array(
            'keyboard' => array(
                array("BISA DITARIK PT1", "KENDALA", "WO MANJA"),
            ),
        );
        $encodedMarkup = json_encode($replyMarkup);
        $dataT = [
            'text' => $pesan,
            'chat_id' => $this->request->getPost('teknisiDispatch'), //contoh bot, group id -442697126
            'reply_markup' => $encodedMarkup,
        ];
        file_get_contents("https://api.telegram.org/bot" . $this->botToken . "/sendMessage?" . http_build_query($dataT));
        return json_encode("200");
    }
    public function ajaxDataTableScbeFilter()
    {
        date_default_timezone_set("Asia/Jakarta");
        $filterData = [
            'sTime'          => strtotime(str_replace('/', '-', $this->request->getPost('start_time'))),
            'eTime'         => strtotime(str_replace('/', '-', $this->request->getPost('end_time'))) + 86400,
            'stoPlace'         => explode(',', $this->request->getPost('sto')),
        ];
        $data =  $this->ModelAllWo->scbeFilter($filterData);
        $dataDatel = [];
        $no = 0;
        foreach ($data as $temp) {
            $no++;
            $aksi = '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" onclick="dispatch(' . $temp['id'] . ')" data-target="#modalView"><b>Dispatch WO</b></button>';
            $row = [];
            $row[] = $no;
            $row[] = $aksi;
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
            $row[] = date('d/m/Y H:i:s', $temp['wi_val']); //$temp['wi_val'];
            $row[] = $temp['n_validasi'];
            $row[] = $temp['n_fcc'];
            $row[] = $temp['sc_a'];
            $row[] = $temp['ket_val'];
            $row[] = $temp['nama_user'];
            $dataDatel[] = $row;
        }
        // return json_encode($dataDatel);
        $result['data'] = $dataDatel;
        echo json_encode($result['data']);
        exit();
    }
    public function viewForbidenModal()
    {
        return view('pvita/wovalidasi/modalforbidden');
    }
}
