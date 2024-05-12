<?php

namespace App\Controllers;

class Pvitabackup extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'Data Backup',
            'isi' => 'pvita/backup/index',
        ];
        return view('layoutpvita/wrapper', $data);
    }
}
