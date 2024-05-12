<?php

namespace App\Controllers;


use App\Models\ModelPvitaData;


// use PhpMyAdmin\Server\Status\Data;


class Apipvitasto extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->ModelPvitaData = new ModelPvitaData();
    }

    public function index()
    {
        // Data STO
        $dataSTO =  $this->ModelPvitaData->dataSto();
        $datasto = [];
        $no = 0;
        foreach ($dataSTO as $temp) {
            $no++;
            $row = [];
            $row['id_sto'] =  $temp['id_sto'];
            $row['datel_sto'] = $temp['datel_sto'];
            $row['nama_sto'] = $temp['nama_sto'];
            $row['status_sto'] = $temp['status_sto'];

            $datasto[] =  $row;
        }
        $result['data'] = $datasto;
        echo json_encode($result);
        exit();
    }
}
