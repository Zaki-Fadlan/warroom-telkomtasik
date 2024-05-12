<?php

namespace App\Controllers;


use App\Models\ModelPvitaData;


// use PhpMyAdmin\Server\Status\Data;


class User extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->ModelPvitaData = new ModelPvitaData();
    }

    public function index()
    {
        // Data User
        $dataUser =  $this->ModelPvitaData->dataUser();
        $datauser = [];
        $no = 0;
        foreach ($dataUser as $temp) {
            $no++;
            $row = [];
            $row['id_user'] = $temp['id_user'];
            $row['nama_user'] = $temp['nama_user'];
            $row['datel_user'] = $temp['datel_user'];
            $row['nik'] = $temp['nik'];
            $row['cp'] = $temp['cp_user'];
            $row['nama_level'] = $temp['nama_level'];

            $datauser[] = (object) $row;
        }
        $total = count($dataUser);
        $result = $datauser;

        echo json_encode(array(
            'total' => $total,
            'data'    => $result
        ));
        exit();
    }
}
