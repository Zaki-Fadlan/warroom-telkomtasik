<?php

namespace App\Controllers;


class Projectmanagement extends BaseController
{
    public function index()
    {
        $data = [
            'isi' => 'projectmanagement/pjdashboard'
        ];
        return view('projectmanagement/layout/wrapper', $data);
    }
}
