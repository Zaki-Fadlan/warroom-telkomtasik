<?php

namespace App\Controllers;

use App\Models\ModelPvitaData;

class Pvitaalldata extends BaseController
{
    public function __construct()
    {
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
            $row['no'] = $no;
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

        // Data STO
        $dataSTO =  $this->ModelPvitaData->dataSto();
        $datasto = [];
        $no = 0;
        foreach ($dataSTO as $temp) {
            $no++;
            $row = [];
            $row['no'] = $no;
            $row['nama_datel'] = $temp['nama_datel'];
            $row['nama_sto'] = $temp['nama_sto'];
            if ($temp['st_sto'] == 1) {
                $row['st_sto'] = "Aktif";
            } else {
                $row['st_sto'] = "Tidak Aktif";
            }
            $datasto[] = (object) $row;
        }
        $result['sto'] = $datasto;

        // Data Teknisi
        $dataTeknisi =  $this->ModelPvitaData->dataTeknisi();
        $datateknisi = [];
        $no = 0;
        foreach ($dataTeknisi as $temp) {
            $no++;
            $row = [];
            $row['no'] = $no;
            $row['nama_datel'] = $temp['nama_datel'];
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
            $datateknisi[] = (object) $row;
        }
        $result['teknisi'] = $datateknisi;

        // Data Datel
        $dataDatel =  $this->ModelPvitaData->dataDatel();
        $datadatel = [];
        $no = 0;
        foreach ($dataDatel as $temp) {
            $no++;
            $row = [];
            $row['no'] = $no;
            $row['nama_datel'] = $temp['nama_datel'];
            if ($temp['st_datel'] == 1) {
                $row['status_datel'] = "Aktif";
            } else {
                $row['status_datel'] = "Tidak Aktif";
            }
            $datadatel[] = (object) $row;
        }
        $result['datel'] = $datadatel;

        // Data User
        $dataUser =  $this->ModelPvitaData->dataUser();
        $datauser = [];
        $no = 0;
        foreach ($dataUser as $temp) {
            $no++;
            $row = [];
            $row['no'] = $no;
            $row['nama_datel'] = $temp['nama_datel'];
            $row['nama_user'] = $temp['nama_user'];
            $row['nik'] = $temp['nik'];
            $row['cp'] = $temp['cp_user'];
            $row['nama_level'] = $temp['nama_level'];

            $datauser[] = (object) $row;
        }
        $result['user'] = $datauser;

        echo json_encode($result);
        exit();
    }
    public function dataUser()
    {
        // Data User
        $dataUser =  $this->ModelPvitaData->dataUser();
        $datauser = [];
        $no = 0;
        foreach ($dataUser as $temp) {
            $no++;
            $row = [];
            $row['no'] = $no;
            $row['nama_user'] = $temp['nama_user'];
            $row['datel_user'] = $temp['datel_user'];
            $row['nik'] = $temp['nik'];
            $row['cp'] = $temp['cp_user'];
            $row['nama_level'] = $temp['nama_level'];

            $datauser[] = (object) $row;
        }
        $result = $datauser;

        echo json_encode($result);
        exit();
    }
    public function dataSf()
    {
        // Data SF
        $dataSF =  $this->ModelPvitaData->dataSf();
        $datasf = [];
        $no = 0;
        foreach ($dataSF as $temp) {
            $no++;
            $row = [];
            $row['no'] = $no;
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
    public function dataTeknisi()
    {
        $dataTeknisi =  $this->ModelPvitaData->dataTeknisi();
        $datateknisi = [];
        $no = 0;
        foreach ($dataTeknisi as $temp) {
            $no++;
            $row = [];
            $row['no'] = $no;
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
            $datateknisi[] = (object) $row;
        }
        $result['teknisi'] = $datateknisi;
        echo json_encode($result);
        exit();
    }
    public function dataDatel()
    {
        // Data Datel
        $dataDatel =  $this->ModelPvitaData->dataDatel();
        $datadatel = [];
        $no = 0;
        foreach ($dataDatel as $temp) {
            $no++;
            $row = [];
            $row['no'] = $no;
            $row['nama_datel'] = $temp['nama_datel'];
            if ($temp['st_datel'] == 1) {
                $row['status_datel'] = "Aktif";
            } else {
                $row['status_datel'] = "Tidak Aktif";
            }
            $datadatel[] = (object) $row;
        }
        $result['datel'] = $datadatel;
        echo json_encode($result);
        exit();
    }
    public function dataSto()
    {
        // Data STO
        $dataSTO =  $this->ModelPvitaData->dataSto();
        $datasto = [];
        $no = 0;
        foreach ($dataSTO as $temp) {
            $no++;
            $row = [];
            $row['no'] = $no;
            $row['datel_sto'] = $temp['datel_sto'];
            $row['nama_sto'] = $temp['nama_sto'];

            $datasto[] = (object) $row;
        }
        $result['sto'] = $datasto;
        echo json_encode($result);
        exit();
    }
}
