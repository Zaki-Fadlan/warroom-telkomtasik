<?php

namespace App\Controllers;

use App\Models\ModelAuth;
use App\Models\ModelLevel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelAuth = new ModelAuth();
        $this->ModelLevel = new ModelLevel();
    }

    public function index()
    {
        $data = [
            'nik'         => $this->request->getPost('nik'),
            'password'    => (md5($this->request->getPost('password'))),
            'lv_user'     => $this->request->getPost('lv_user')
        ];
        if (session()->get('level') != "") {
            return redirect()->to(base_url());
        } else {
            if ($data['nik'] != "" and $data['password'] != "" and $data['lv_user'] != "") {
                $nik = $this->request->getPost('nik');
                $level = $this->request->getPost('lv_user');
                $password = (md5($this->request->getPost('password')));

                $cek_user = $this->ModelAuth->login_user($nik, $password, $level);
                if ($cek_user) {
                    if ($cek_user['st_user'] == 1) {
                        session()->set('log', true);
                        session()->set('id_user', $cek_user['id_user']);
                        session()->set('nik', $cek_user['nik']);
                        session()->set('nama', $cek_user['nama_user']);
                        foreach ($this->ModelLevel->allData() as $key) {
                            if ($key['id_level'] == $level) {
                                session()->set('level', $key['nama_level']);
                                session()->set('id_level', $key['id_level']);
                            }
                        }
                        echo "200";
                    } else {
                        return "Akun anda sudah tidak aktif";
                    }
                } else {
                    $cek_user = $this->ModelAuth->ceknik($nik, $password, $level);
                    echo $cek_user;
                }
            } else {
                return redirect()->to(base_url());
            }
        }
    }
    public function logout()
    {
        session()->remove('log');
        session()->remove('nik');
        session()->remove('nama');
        session()->remove('level');
        return redirect()->to(base_url());
    }
}
