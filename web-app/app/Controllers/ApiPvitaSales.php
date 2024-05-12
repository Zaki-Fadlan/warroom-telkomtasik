<?php

namespace App\Controllers;


use App\Models\ModelPvitaData;


// use PhpMyAdmin\Server\Status\Data;


class Sales extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->ModelPvitaData = new ModelPvitaData();
    }

    public function index()
    {
        // Data SF
        $dataSF =  $this->ModelPvitaData->dataSf();
        $datasf = [];
        $no = 0;
        foreach ($dataSF as $temp) {
            $no++;
            $row = [];
            $row['id_Sf'] = $temp['id_sf'];
            $row['nama_datel'] = $temp['nama_datel'];
            $row['nama_sf'] = $temp['nama_sf'];
            $row['agency'] = $temp['agency'];
            $row['kcon'] = $temp['kcon'];
            $row['user_tele_sf'] = $temp['user_tele_sf'];
            $row['id_tele_sf'] = $temp['id_tele_sf'];
            $row['user_add_sf'] = $temp['user_add_sf'];
            $row['time_add_sf'] = $temp['time_add_sf'];

            if ($temp['st_sf'] == 1) {
                $row['st_sf'] = "Aktif";
            } else {
                $row['st_sf'] = "Tidak Aktif";
            }
            $datasf[] = (object) $row;
        }
        $result['sales'] = $datasf;
        echo json_encode($result);
        exit();
    }
}
