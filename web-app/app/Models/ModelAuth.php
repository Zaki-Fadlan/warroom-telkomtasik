<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{

    public function login_user($nik, $password, $level)
    {
        return $this->db->table('user_web')->where([
            'nik' => $nik,
            'password' => $password,
            'lv_user' => $level,
        ])->get()->getRowArray();
    }
    public function ceknik($nik, $password, $level)
    {
        $checknik = $this->db->table('user_web')->where([
            'nik' => $nik,
        ])->get()->getResultArray();
        // return count($checknik);
        if (count($checknik) > 0) {
            $arr = $this->db->table('user_web')->where([
                'nik' => $nik
            ])->get()->getRowArray();
            if ($arr['password'] != $password) {
                return "Password Salah!!";
            } elseif ($arr['lv_user'] != $level) {
                return "Level Akses Salah!!";
            } else {
                return "Terjadi kesalahan, Periksa kembali data yang anda berikan";
            }
        } else {
            return "NIK tidak ditemukan";
        }
    }
}
