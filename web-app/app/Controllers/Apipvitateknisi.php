<?php

namespace App\Controllers;


use App\Models\ModelPvitaData;


// use PhpMyAdmin\Server\Status\Data;


class Apipvitateknisi extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->ModelPvitaData = new ModelPvitaData();
    }

    public function index()
    {
        $dataTeknisi =  $this->ModelPvitaData->dataTeknisi();
        $datateknisi = [];
        $no = 0;
        foreach ($dataTeknisi as $temp) {
            $no++;
            $row = [];
            $row['id_teknisi'] = $temp['id_teknisi'];
            $row['datel_tek'] = $temp['datel_tek'];
            $row['nama_teknisi'] = $temp['nama_tek'];
            $row['contact'] = $temp['con_tek'];
            $row['mitra'] = $temp['mitra'];
            $row['labor'] = $temp['labor'];
            $row['crew'] = $temp['crew'];
            $row['id_tele'] = $temp['id_tele_tek'];
            $row['user_tele'] = $temp['user_tele_tek'];
            $row['wkt'] = $temp['time_add_tek'];
            $row['addeddby'] = $temp['user_add_tek'];
            if ($temp['st_tek'] == 1) {
                $row['st_tek'] = "Aktif";
            } else {
                $row['st_tek'] = "Tidak Aktif";
            }
            $row['abs'] = $temp['st_absen'];
            $datateknisi[] = $row;
        }
        $result['data'] = $datateknisi;
        echo json_encode($result);
        exit();
    }
}
