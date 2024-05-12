<?php

namespace App\Controllers;

use App\Models\ModelSto;
use App\Models\ModelUser;
use App\Models\ModelDatel;
use App\Models\ModelLevel;
use App\Models\ModelTeknisi;
use App\Models\ModelSales;
use App\Models\ModelStAct;
use App\Models\ModelDatelSt;
use App\Models\ModelStoSt;
use App\Models\ModelUserSt;

// use PhpMyAdmin\Server\Status\Data;


class Pvitafilter extends BaseController
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
        $this->ModelSto = new ModelSto();
        $this->ModelUser = new ModelUser();
        $this->ModelTeknisi = new ModelTeknisi();
        $this->ModelSales = new ModelSales();
        $this->ModelStAct = new ModelStAct();
        $this->ModelDatelSt = new ModelDatelSt();
        $this->ModelStoSt = new ModelStoSt();
        $this->ModelUserSt = new ModelUserSt();
    }
    public function searchSto()
    {
        $data = [
            'id_datel'           => $this->request->getPost('id_datel'),
        ];

        $datab = $this->ModelSto->filterSto($data);
        $datauser = [];
        foreach ($datab as $temp) {
            $row = [];
            $row[] = $temp['id_sto'];
            $row[] = $temp['nama_sto'];
            $row[] = $temp['datel_sto'];
            if ($temp['status_sto'] == 1) {
                $row[] = "Aktif";
            }
            $datauser[] = $row;
        }
        echo json_encode((object)$datauser);
        exit();
    }
}
