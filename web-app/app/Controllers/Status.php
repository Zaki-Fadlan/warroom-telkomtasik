<?php

namespace App\Controllers;


use App\Models\ModelStatus;


// use PhpMyAdmin\Server\Status\Data;


class Status extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->ModelStatus = new ModelStatus();
    }

    public function index()
    {
        $dataSt =  $this->ModelStatus->allData();
        $dataSt = [];
        $no = 0;
        foreach ($dataSt as $temp) {
            $no++;
            $row = [];
            $row['id_st_wo'] = $temp['id_st_wo'];
            $row['n_stwo'] = $temp['n_stwo'];
            $dataSt[] = (object) $row;
        }
        $result['status'] = $dataSt;
        echo json_encode($result);
        exit();
    }
}
