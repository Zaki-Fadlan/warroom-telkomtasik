<?php

namespace App\Controllers;


use App\Models\ModelDatel;


// use PhpMyAdmin\Server\Status\Data;


class Apipvitadatel extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->ModelDatel = new ModelDatel();
    }

    public function index()
    {
        $dataDatel =  $this->ModelDatel->allData();
        $datadatel = [];
        $no = 0;
        foreach ($dataDatel as $temp) {
            $no++;
            $row = [];
            $row['id_datel'] = $temp['id_datel'];
            $row['nama_datel'] = $temp['nama_datel'];
            $row['sto_datel'] = $temp['nama_datel'];
            if ($temp['status_datel'] == 1) {
                $row['status_datel'] = "Aktif";
            } else {
                $row['status_datel'] = "Tidak Aktif";
            }
            $datadatel[] = (object) $row;
        }
        $resultsJS['data'] = $datadatel;
        echo json_encode($resultsJS);
        exit();
    }
}
