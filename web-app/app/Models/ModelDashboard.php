<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDashboard extends Model
{
    // WO Validasi
    public function allData($data)
    {
        $dataWO['totalMasuk'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])
            ->join('dm_sto', 'dm_sto.id_sto = all_wo.sto', 'left')
            ->join('dm_kecepatan', 'dm_kecepatan.id_kecepatan = all_wo.kecepatan', 'left')
            ->join('dm_layanan', 'dm_layanan.id_layanan = all_wo.layanan', 'left')
            ->join('dm_validasi', 'dm_validasi.id_validasi = all_wo.st_val', 'left')
            ->join('dm_fcc', 'dm_fcc.id_fcc = all_wo.st_fcc', 'left')
            ->join('user_sf', 'user_sf.id_sf = all_wo.sf_id', 'left')
            ->join('dm_wo_st', 'dm_wo_st.id_st_wo = all_wo.st_wo', 'left')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalKendala'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 4)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalPs'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 5)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalEntryInputer'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 1)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalEntryHD'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 2)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalWoProgress'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 3)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalfccNovalid'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 6)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalSiapDispatch'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 7)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalDiposesTeknisi'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 8)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalReqSC'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 9)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalMenungguAktifasi'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 10)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $dataWO['totalReq'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', 11)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        return $dataWO;
    }
    public function tabelProgress($data, $sto, $status)
    {
        $total = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('st_wo', $status)->where('sto', $sto)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        return $total;
    }
    public function summaryKendala($data)
    {
        $total['pic_rna'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('tp_kendala', 1)->where('st_wo', 4)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $total['cancel'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('tp_kendala', 2)->where('st_wo', 4)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $total['trek'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('tp_kendala', 3)->where('st_wo', 4)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $total['manja'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('tp_kendala', 4)->where('st_wo', 4)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $total['jarak_jauh'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('tp_kendala', 5)->where('st_wo', 4)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $total['odp_us'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('tp_kendala', 6)->where('st_wo', 4)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        $total['odp_full'] = count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('tp_kendala', 7)->where('st_wo', 4)
            ->orderBy('id', 'DESC')
            ->get()->getResultArray());
        return $total;
    }
    public function summaryPerforma($data)
    {
        $total['validasi'] = (((($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wi_val!=', "")->selectSum('wi_val')->get()->getRow())->wi_val) - (($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wi_val!=', "")->selectSum('stamp_ampser')->get()->getRow())->stamp_ampser)) / count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wi_val!=', "")->get()->getResultArray())) / 60 / 60;
        $total['dispatch'] = (((($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wi_val!=', "")->where('wi_tek!=', "")->selectSum('wi_tek')->get()->getRow())->wi_tek) - (($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wi_val!=', "")->where('wi_tek!=', "")->selectSum('wi_val')->get()->getRow())->wi_val)) / count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wi_val!=', "")->where('wi_tek!=', "")->get()->getResultArray())) / 60 / 60;
        $total['ft'] = (((($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wf_teknisi!=', "")->where('wi_tek!=', "")->selectSum('wf_teknisi')->get()->getRow())->wf_teknisi) - (($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wf_teknisi!=', "")->where('wi_tek!=', "")->selectSum('wi_tek')->get()->getRow())->wi_tek)) / count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wi_tek!=', "")->where('wi_tek!=', "")->get()->getResultArray())) / 60 / 60;
        $total['rs'] = (((($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wf_teknisi!=', "")->where('wareq_sc!=', "")->selectSum('wareq_sc')->get()->getRow())->wareq_sc) - (($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wf_teknisi!=', "")->where('wareq_sc!=', "")->selectSum('wf_teknisi')->get()->getRow())->wf_teknisi)) / count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wf_teknisi!=', "")->where('wareq_sc!=', "")->get()->getResultArray())) / 60 / 60;
        $total['is'] = (((($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wareq_sc!=', "")->where('wi_sc!=', "")->selectSum('wi_sc')->get()->getRow())->wi_sc) - (($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wareq_sc!=', "")->where('wi_sc!=', "")->selectSum('wareq_sc')->get()->getRow())->wareq_sc)) / count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wareq_sc!=', "")->where('wi_sc!=', "")->get()->getResultArray())) / 60 / 60;
        $total['act'] = (((($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wi_sc!=', "")->where('wa_akt_wo!=', "")->selectSum('wa_akt_wo')->get()->getRow())->wa_akt_wo) - (($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wi_sc!=', "")->where('wa_akt_wo!=', "")->selectSum('wi_sc')->get()->getRow())->wi_sc)) / count($this->db->table('all_wo')->where('stamp_ampser<=', $data['eTime'])->where('stamp_ampser>=', $data['sTime'])->where('wi_sc!=', "")->where('wa_akt_wo!=', "")->get()->getResultArray())) / 60 / 60;
        return $total;
    }

    public function summary()
    {
        $stwo = $this->db->table('dm_wo_st')->get()->getResultArray();
        $finalstwo = [];
        foreach ($stwo as $valKen => $key) {
            if ($key['id_st_wo'] != 7) {
                $row = [];
                $row[] = $key['n_st_wo'];
                $row[] = count($this->db->table('all_wo')->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                $finalstwo[] = $row;
            }
        }
        return $finalstwo;
    }
    public function summarytabel()
    {
        $sto = $this->db->table('dm_sto')->get()->getResultArray();
        $datel = $this->db->table('dm_datel')->get()->getResultArray();
        $finalData = [];
        foreach ($datel as $valdat) {
            $nama_datel = '<a data-toggle="collapse" data-target="#summary' . $valdat['id_datel'] . '" href="#" class="text-center accordion-toggle"><b>' . $valdat['nama_datel'] . '</b>';
            $jmlmasuk = 0;
            $entryInputer = 0;
            $fccnok = 0;
            $entryHD = 0;
            $progress = 0;
            $reqsc = 0;
            $aktifasi = 0;
            $kendala = 0;
            $ps = 0;
            $edit = 0;
            $entryInputer = 0;
            $diprosesTeknisi = 0;
            $stoData = [];
            foreach ($sto as $valSto) {
                if ($valdat['id_datel'] == $valSto['datel_sto']) {
                    $row = [];
                    $row[] = $valSto["nama_sto"];
                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->get()->getResultArray());
                    $jmlmasuk += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 1)->get()->getResultArray());
                    $entryInputer += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 1)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 6)->get()->getResultArray());
                    $fccnok += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 6)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 2)->get()->getResultArray());
                    $entryHD += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 2)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 8)->get()->getResultArray());
                    $diprosesTeknisi += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 8)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 3)->get()->getResultArray());
                    $progress += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 3)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 9)->get()->getResultArray());
                    $reqsc += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 9)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 10)->get()->getResultArray());
                    $aktifasi += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 10)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 4)->get()->getResultArray());
                    $kendala += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 5)->get()->getResultArray());
                    $ps += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 5)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 11)->get()->getResultArray());
                    $edit += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 11)->get()->getResultArray());

                    $stoData[] = $row;
                }
            }
            // $finalData[] = [$nama_datel, $jmlmasuk, $entryInputer, $fccnok, $entryHD, $diprosesTeknisi, $progress, $reqsc, $aktifasi, $kendala, $ps, $edit];
            $finalData[] = $stoData;
        }
        return $finalData;
    }
    public function kendala()
    {
        $kendala = $this->db->table('dm_kendala')->get()->getResultArray();
        $finalKendala = [];
        foreach ($kendala as  $key) {
            $row = [];
            $row[] = $key['n_tipe_kendala'];
            $row[]  = count($this->db->table('all_wo')->where('st_wo', 4)->where('tp_kendala', $key['id_kendala'])->get()->getResultArray());
            $finalKendala[] = $row;
        }
        return $finalKendala;
    }
    public function kendalaTabel()
    {
        $sto = $this->db->table('dm_sto')->get()->getResultArray();
        $datel = $this->db->table('dm_datel')->get()->getResultArray();
        $finalData = [];
        foreach ($datel as $valdat) {
            $nama_datel = $valdat['nama_datel'];
            $jmlKendala = 0;
            $picrna = 0;
            $calcel = 0;
            $trek = 0;
            $manja = 0;
            $jarakjauh = 0;
            $odpus = 0;
            $odpfull = 0;
            $stoData = [];
            foreach ($sto as $valSto) {
                if ($valdat['id_datel'] == $valSto['datel_sto']) {
                    $row = [];
                    $row[] = $valSto["nama_sto"];
                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 4)->get()->getResultArray());
                    $jmlKendala += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 1)->where('st_wo', 4)->get()->getResultArray());
                    $picrna += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 1)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 2)->where('st_wo', 4)->get()->getResultArray());
                    $calcel += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 2)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 3)->where('st_wo', 4)->get()->getResultArray());
                    $trek += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 3)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 4)->where('st_wo', 4)->get()->getResultArray());
                    $manja += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 4)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 5)->where('st_wo', 4)->get()->getResultArray());
                    $jarakjauh += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 5)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 6)->where('st_wo', 4)->get()->getResultArray());
                    $odpus += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 6)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 7)->where('st_wo', 4)->get()->getResultArray());
                    $odpfull += count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('tp_kendala', 7)->where('st_wo', 4)->get()->getResultArray());

                    $finalData[] = $row;
                }
            }
            // $finalData[] = [$nama_datel, $jmlKendala, $picrna, $calcel, $trek, $manja, $jarakjauh, $odpus, $odpfull];
            // $finalData[] = $stoData;
        }
        return $finalData;
    }
    public function progressTime()
    {
        $data = [];
        $tTv = (($this->db->table('all_wo')->where('wi_val!=', "")->selectSum('wi_val')->get()->getRow())->wi_val) - (($this->db->table('all_wo')->where('wi_val!=', "")->selectSum('stamp_ampser')->get()->getRow())->stamp_ampser);
        $jmlValidasi = count($this->db->table('all_wo')->where('wi_val!=', "")->get()->getResultArray());
        if ($jmlValidasi != 0) {
            $data[] = ["Validasi", number_format($tTv / $jmlValidasi / 3600, 2)];
        } else {
            $data[] = ["Validasi", 0];
        }

        $tTf = (($this->db->table('all_wo')->where('wi_tek!=', "")->where('wi_val!=', "")->selectSum('wi_tek')->get()->getRow())->wi_tek) - (($this->db->table('all_wo')->where('wi_tek!=', "")->where('wi_val!=', "")->selectSum('wi_val')->get()->getRow())->wi_val);
        $jmlFt = count($this->db->table('all_wo')->where('wi_val!=', "")->where('wi_tek!=', "")->get()->getResultArray());
        if ($jmlFt != 0) {
            $data[] = ["Dispatch WO", number_format($tTf / $jmlFt / 3600, 2)];
        } else {
            $data[] = ["Dispatch WO", 0];
        }

        $tTd = (($this->db->table('all_wo')->where('wi_tek!=', "")->where('wf_teknisi!=', "")->selectSum('wf_teknisi')->get()->getRow())->wf_teknisi) - (($this->db->table('all_wo')->where('wi_tek!=', "")->where('wf_teknisi!=', "")->selectSum('wi_tek')->get()->getRow())->wi_tek);
        $jmlDispatch = count($this->db->table('all_wo')->where('wf_teknisi!=', "")->where('wi_tek!=', "")->get()->getResultArray());
        if ($jmlDispatch != 0) {
            $data[] = ['Feedback Teknisi', number_format($tTd / $jmlDispatch / 3600, 2)];
        } else {
            $data[] = ["Feedback Teknisi", 0];
        }

        $tTr = (($this->db->table('all_wo')->where('wareq_sc!=', "")->where('wf_teknisi!=', "")->selectSum('wareq_sc')->get()->getRow())->wareq_sc) - (($this->db->table('all_wo')->where('wareq_sc!=', "")->where('wf_teknisi!=', "")->selectSum('wf_teknisi')->get()->getRow())->wf_teknisi);
        $jmlreq = count($this->db->table('all_wo')->where('wf_teknisi!=', "")->where('wareq_sc!=', "")->get()->getResultArray());
        if ($jmlreq != 0) {
            $data[] = ['Request SC', number_format($tTr / $jmlreq / 3600, 2)];
        } else {
            $data[] = ["Request SC", 0];
        }
        $tTs = (($this->db->table('all_wo')->where('wi_sc!=', "")->where('wareq_sc!=', "")->selectSum('wi_sc')->get()->getRow())->wi_sc) - (($this->db->table('all_wo')->where('wi_sc!=', "")->where('wareq_sc!=', "")->selectSum('wareq_sc')->get()->getRow())->wareq_sc);
        $jmlinSC = count($this->db->table('all_wo')->where('wi_sc!=', "")->where('wareq_sc!=', "")->get()->getResultArray());
        if ($jmlinSC != 0) {
            $data[] = ['Input SC', number_format($tTs / $jmlinSC / 3600, 2)];
        } else {
            $data[] = ["Input SC", 0];
        }
        $tTa = (($this->db->table('all_wo')->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->selectSum('wa_akt_wo')->get()->getRow())->wa_akt_wo) - (($this->db->table('all_wo')->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->selectSum('wi_sc')->get()->getRow())->wi_sc);
        $jmlakt = count($this->db->table('all_wo')->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->get()->getResultArray());
        if ($jmlakt != 0) {
            $data[] = ['Aktifasi', number_format($tTa / $jmlakt / 3600, 2)];
        } else {
            $data[] = ["Aktifasi", 0];
        }

        return $data;
    }
    public function progressTabel()
    {
        $sto = $this->db->table('dm_sto')->get()->getResultArray();
        $datel = $this->db->table('dm_datel')->get()->getResultArray();
        $finalData = [];
        foreach ($datel as $valdat) {
            $nama_datel = $valdat['nama_datel'];
            $validasi = 0;
            $jumlahValidasi = 0;
            $dispatch = 0;
            $jumlahDispatch = 0;
            $ft = 0;
            $jumlahFt = 0;
            $reqsc = 0;
            $jumlahReqsc = 0;
            $insc = 0;
            $jumlahInsc = 0;
            $akt = 0;
            $jumlahAktifasi = 0;
            $stoData = [];
            foreach ($sto as $valSto) {
                if ($valdat['id_datel'] == $valSto['datel_sto']) {
                    $data = [];
                    $data[] = $valSto['nama_sto'];
                    $tTv = (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_val!=', "")->selectSum('wi_val')->get()->getRow())->wi_val) - (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_val!=', "")->selectSum('stamp_ampser')->get()->getRow())->stamp_ampser);
                    $validasi += $tTv;
                    $jmlValidasi = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_val!=', "")->get()->getResultArray());
                    $jumlahValidasi += $jmlValidasi;
                    if ($jmlValidasi != 0) {
                        $data[] =  number_format($tTv / $jmlValidasi / 3600, 2) . " Jam";
                    } else {
                        $data[] =  "-";
                    }

                    $tTd = (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_tek!=', "")->where('wf_teknisi!=', "")->selectSum('wf_teknisi')->get()->getRow())->wf_teknisi) - (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_tek!=', "")->where('wf_teknisi!=', "")->selectSum('wi_tek')->get()->getRow())->wi_tek);
                    $dispatch += $tTd;
                    $jmlDispatch = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wf_teknisi!=', "")->where('wi_tek!=', "")->get()->getResultArray());
                    $jumlahDispatch += $jmlDispatch;
                    if ($jmlDispatch != 0) {
                        $data[] =  number_format($tTd / $jmlDispatch / 3600, 2) . " Jam";
                    } else {
                        $data[] = "-";
                    }

                    $tTf = (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_tek!=', "")->where('wi_val!=', "")->selectSum('wi_tek')->get()->getRow())->wi_tek) - (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_tek!=', "")->where('wi_val!=', "")->selectSum('wi_val')->get()->getRow())->wi_val);
                    $ft += $tTf;
                    $jmlFt = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_val!=', "")->where('wi_tek!=', "")->get()->getResultArray());
                    $jumlahFt += $jmlFt;
                    if ($jmlFt != 0) {
                        $data[] = number_format($tTf / $jmlFt / 3600, 2) . " Jam";
                    } else {
                        $data[] = "-";
                    }

                    $tTr = (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wareq_sc!=', "")->where('wf_teknisi!=', "")->selectSum('wareq_sc')->get()->getRow())->wareq_sc) - (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wareq_sc!=', "")->where('wf_teknisi!=', "")->selectSum('wf_teknisi')->get()->getRow())->wf_teknisi);
                    $reqsc += $tTr;
                    $jmlreq = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wf_teknisi!=', "")->where('wareq_sc!=', "")->get()->getResultArray());
                    $jumlahReqsc += $jmlreq;
                    if ($jmlreq != 0) {
                        $data[] =  number_format($tTr / $jmlreq / 3600, 2) . " Jam";
                    } else {
                        $data[] =  "-";
                    }

                    $tTs = (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_sc!=', "")->where('wareq_sc!=', "")->selectSum('wi_sc')->get()->getRow())->wi_sc) - (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_sc!=', "")->where('wareq_sc!=', "")->selectSum('wareq_sc')->get()->getRow())->wareq_sc);
                    $insc += $tTs;
                    $jmlinSC = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wi_sc!=', "")->where('wareq_sc!=', "")->get()->getResultArray());
                    $jumlahInsc += $jmlinSC;
                    if ($jmlinSC != 0) {
                        $data[] = number_format($tTs / $jmlinSC / 3600, 2) . " Jam";
                    } else {
                        $data[] =  "-";
                    }

                    $tTa = (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->selectSum('wa_akt_wo')->get()->getRow())->wa_akt_wo) - (($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->selectSum('wi_sc')->get()->getRow())->wi_sc);
                    $akt += $tTa;
                    $jmlakt = count($this->db->table('all_wo')->where('sto', $valSto['id_sto'])->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->get()->getResultArray());
                    $jumlahAktifasi += $jmlakt;
                    if ($jmlakt != 0) {
                        $data[] = number_format($tTa / $jmlakt / 3600, 2) . " Jam";
                    } else {
                        $data[] = "-";
                    }
                    $stoData[] = $data;
                }
            }
            if ($jumlahValidasi > 0) {
                $v = number_format($validasi / $jumlahValidasi / 3600, 2) . " Jam";
            } else {
                $v = "-";
            }
            if ($jumlahDispatch > 0) {
                $d = number_format($dispatch / $jumlahDispatch / 3600, 2) . " Jam";
            } else {
                $d = "-";
            }
            if ($jumlahFt > 0) {
                $f = number_format($ft / $jumlahFt / 3600, 2) . " Jam";
            } else {
                $f = "-";
            }
            if ($jumlahReqsc > 0) {
                $r = number_format($reqsc / $jumlahReqsc / 3600, 2) . " Jam";
            } else {
                $r = "-";
            }
            if ($jumlahInsc > 0) {
                $i = number_format($insc / $jumlahInsc / 3600, 2) . " Jam";
            } else {
                $i = "-";
            }
            if ($jumlahAktifasi > 0) {
                $a = number_format($akt / $jumlahAktifasi / 3600, 2) . " Jam";
            } else {
                $a = "-";
            }
            // $finalData[] = [$nama_datel, $v, $d, $f, $r, $i, $a];
            $finalData[] = $stoData;
        }
        return $finalData;
    }

    // Filter
    public function summaryFilter($dataFilterDate)
    {
        $stwo = $this->db->table('dm_wo_st')->get()->getResultArray();
        $finalstwo = [];
        foreach ($stwo as $valKen => $key) {
            if ($key['id_st_wo'] != 7) {
                $row = [];
                $row[] = $key['n_st_wo'];
                if ($key['id_st_wo'] == 1) {
                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                }
                if ($key['id_st_wo'] == 2) {
                    $row[] = count($this->db->table('all_wo')->where('wi_val>', $dataFilterDate['sTime'])->where('wi_val<', $dataFilterDate['eTime'])->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                }
                if ($key['id_st_wo'] == 3) {
                    $row[] = count($this->db->table('all_wo')->where('wf_teknisi>', $dataFilterDate['sTime'])->where('wf_teknisi<', $dataFilterDate['eTime'])->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                }
                if ($key['id_st_wo'] == 4) {
                    $row[] = count($this->db->table('all_wo')->where('wf_teknisi>', $dataFilterDate['sTime'])->where('wf_teknisi<', $dataFilterDate['eTime'])->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                }
                if ($key['id_st_wo'] == 5) {
                    $row[] = count($this->db->table('all_wo')->where('wa_akt_wo>', $dataFilterDate['sTime'])->where('wa_akt_wo<', $dataFilterDate['eTime'])->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                }
                if ($key['id_st_wo'] == 6) {
                    $row[] = count($this->db->table('all_wo')->where('wi_val>', $dataFilterDate['sTime'])->where('wi_val<', $dataFilterDate['eTime'])->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                }
                if ($key['id_st_wo'] == 8) {
                    $row[] = count($this->db->table('all_wo')->where('wi_tek>', $dataFilterDate['sTime'])->where('wi_tek<', $dataFilterDate['eTime'])->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                }
                if ($key['id_st_wo'] == 9) {
                    $row[] = count($this->db->table('all_wo')->where('wareq_sc>', $dataFilterDate['sTime'])->where('wareq_sc<', $dataFilterDate['eTime'])->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                }
                if ($key['id_st_wo'] == 10) {
                    $row[] = count($this->db->table('all_wo')->where('wi_sc>', $dataFilterDate['sTime'])->where('wi_sc<', $dataFilterDate['eTime'])->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                }
                if ($key['id_st_wo'] == 11) {
                    $row[] = count($this->db->table('all_wo')->where('wa_akt_wo>', $dataFilterDate['sTime'])->where('wa_akt_wo<', $dataFilterDate['eTime'])->where('st_wo', $key['id_st_wo'])->get()->getResultArray());
                }
                $finalstwo[] = $row;
            }
        }
        return $finalstwo;
    }
    public function summarytabelFilter($dataFilterDate)
    {
        $sto = $this->db->table('dm_sto')->get()->getResultArray();
        $datel = $this->db->table('dm_datel')->get()->getResultArray();
        $finalData = [];
        foreach ($datel as $valdat) {
            $nama_datel = $valdat['nama_datel'];
            $jmlmasuk = 0;
            $entryInputer = 0;
            $fccnok = 0;
            $entryHD = 0;
            $progress = 0;
            $reqsc = 0;
            $aktifasi = 0;
            $kendala = 0;
            $ps = 0;
            $edit = 0;
            $entryInputer = 0;
            $diprosesTeknisi = 0;
            $stoData = [];
            foreach ($sto as $valSto) {
                if ($valdat['id_datel'] == $valSto['datel_sto']) {
                    $row = [];
                    $row[] = $valSto["nama_sto"];
                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->get()->getResultArray());
                    $jmlmasuk += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 1)->get()->getResultArray());
                    $entryInputer += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 1)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('wi_val>', $dataFilterDate['sTime'])->where('wi_val<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 6)->get()->getResultArray());
                    $fccnok += count($this->db->table('all_wo')->where('wi_val>', $dataFilterDate['sTime'])->where('wi_val<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 6)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('wi_val>', $dataFilterDate['sTime'])->where('wi_val<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 2)->get()->getResultArray());
                    $entryHD += count($this->db->table('all_wo')->where('wi_val>', $dataFilterDate['sTime'])->where('wi_val<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 2)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('wi_tek>', $dataFilterDate['sTime'])->where('wi_tek<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 8)->get()->getResultArray());
                    $diprosesTeknisi += count($this->db->table('all_wo')->where('wi_tek>', $dataFilterDate['sTime'])->where('wi_tek<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 8)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('wf_teknisi>', $dataFilterDate['sTime'])->where('wf_teknisi<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 3)->get()->getResultArray());
                    $progress += count($this->db->table('all_wo')->where('wf_teknisi>', $dataFilterDate['sTime'])->where('wf_teknisi<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 3)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('wareq_sc>', $dataFilterDate['sTime'])->where('wareq_sc<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 9)->get()->getResultArray());
                    $reqsc += count($this->db->table('all_wo')->where('wareq_sc>', $dataFilterDate['sTime'])->where('wareq_sc<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 9)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('wi_sc>', $dataFilterDate['sTime'])->where('wi_sc<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 10)->get()->getResultArray());
                    $aktifasi += count($this->db->table('all_wo')->where('wi_sc>', $dataFilterDate['sTime'])->where('wi_sc<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 10)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('wf_teknisi>', $dataFilterDate['sTime'])->where('wf_teknisi<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 4)->get()->getResultArray());
                    $kendala += count($this->db->table('all_wo')->where('wf_teknisi>', $dataFilterDate['sTime'])->where('wf_teknisi<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('wa_akt_wo>', $dataFilterDate['sTime'])->where('wa_akt_wo<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 5)->get()->getResultArray());
                    $ps += count($this->db->table('all_wo')->where('wa_akt_wo>', $dataFilterDate['sTime'])->where('wa_akt_wo<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 5)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 11)->get()->getResultArray());
                    $edit += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 11)->get()->getResultArray());

                    $stoData[] = $row;
                }
            }
            // $finalData[] = [$nama_datel, $jmlmasuk, $entryInputer, $fccnok, $entryHD, $diprosesTeknisi, $progress, $reqsc, $aktifasi, $kendala, $ps, $edit];
            $finalData[] = $stoData;
        }
        return $finalData;
    }
    public function kendalaFilter($dataFilterDate)
    {
        $kendala = $this->db->table('dm_kendala')->get()->getResultArray();
        $finalKendala = [];
        foreach ($kendala as  $key) {
            $row = [];
            $row[] = $key['n_tipe_kendala'];
            $row[]  = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('st_wo', 4)->where('tp_kendala', $key['id_kendala'])->get()->getResultArray());
            $finalKendala[] = $row;
        }
        return $finalKendala;
    }
    public function kendalaTabelFilter($dataFilterDate)
    {
        $sto = $this->db->table('dm_sto')->get()->getResultArray();
        $datel = $this->db->table('dm_datel')->get()->getResultArray();
        $finalData = [];
        foreach ($datel as $valdat) {
            $nama_datel = $valdat['nama_datel'];
            $jmlKendala = 0;
            $picrna = 0;
            $calcel = 0;
            $trek = 0;
            $manja = 0;
            $jarakjauh = 0;
            $odpus = 0;
            $odpfull = 0;
            $stoData = [];
            foreach ($sto as $valSto) {
                if ($valdat['id_datel'] == $valSto['datel_sto']) {
                    $row = [];
                    $row[] = $valSto["nama_sto"];
                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 4)->get()->getResultArray());
                    $jmlKendala += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 1)->where('st_wo', 4)->get()->getResultArray());
                    $picrna += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 1)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 2)->where('st_wo', 4)->get()->getResultArray());
                    $calcel += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 2)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 3)->where('st_wo', 4)->get()->getResultArray());
                    $trek += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 3)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 4)->where('st_wo', 4)->get()->getResultArray());
                    $manja += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 4)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 5)->where('st_wo', 4)->get()->getResultArray());
                    $jarakjauh += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 5)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 6)->where('st_wo', 4)->get()->getResultArray());
                    $odpus += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 6)->where('st_wo', 4)->get()->getResultArray());

                    $row[] = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 7)->where('st_wo', 4)->get()->getResultArray());
                    $odpfull += count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('tp_kendala', 7)->where('st_wo', 4)->get()->getResultArray());

                    $finalData[] = $row;
                }
            }
            // $finalData[] = [$nama_datel, $jmlKendala, $picrna, $calcel, $trek, $manja, $jarakjauh, $odpus, $odpfull];
            // $finalData[] = $stoData;
        }
        return $finalData;
    }
    public function progressTimeFilter($dataFilterDate)
    {
        $data = [];
        $tTv = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_val!=', "")->selectSum('wi_val')->get()->getRow())->wi_val) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_val!=', "")->selectSum('stamp_ampser')->get()->getRow())->stamp_ampser);
        $jmlValidasi = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_val!=', "")->get()->getResultArray());
        if ($jmlValidasi != 0) {
            $data[] = ["Validasi", number_format($tTv / $jmlValidasi / 3600, 2)];
        } else {
            $data[] = ["Validasi", 0];
        }

        $tTf = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_tek!=', "")->where('wi_val!=', "")->selectSum('wi_tek')->get()->getRow())->wi_tek) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_tek!=', "")->where('wi_val!=', "")->selectSum('wi_val')->get()->getRow())->wi_val);
        $jmlFt = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_val!=', "")->where('wi_tek!=', "")->get()->getResultArray());
        if ($jmlFt != 0) {
            $data[] = ["Dispatch WO", number_format($tTf / $jmlFt / 3600, 2)];
        } else {
            $data[] = ["Dispatch WO", 0];
        }

        $tTd = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_tek!=', "")->where('wf_teknisi!=', "")->selectSum('wf_teknisi')->get()->getRow())->wf_teknisi) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_tek!=', "")->where('wf_teknisi!=', "")->selectSum('wi_tek')->get()->getRow())->wi_tek);
        $jmlDispatch = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wf_teknisi!=', "")->where('wi_tek!=', "")->get()->getResultArray());
        if ($jmlDispatch != 0) {
            $data[] = ['Feedback Teknisi', number_format($tTd / $jmlDispatch / 3600, 2)];
        } else {
            $data[] = ["Feedback Teknisi", 0];
        }

        $tTr = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wareq_sc!=', "")->where('wf_teknisi!=', "")->selectSum('wareq_sc')->get()->getRow())->wareq_sc) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wareq_sc!=', "")->where('wf_teknisi!=', "")->selectSum('wf_teknisi')->get()->getRow())->wf_teknisi);
        $jmlreq = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wf_teknisi!=', "")->where('wareq_sc!=', "")->get()->getResultArray());
        if ($jmlreq != 0) {
            $data[] = ['Request SC', number_format($tTr / $jmlreq / 3600, 2)];
        } else {
            $data[] = ["Request SC", 0];
        }
        $tTs = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_sc!=', "")->where('wareq_sc!=', "")->selectSum('wi_sc')->get()->getRow())->wi_sc) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_sc!=', "")->where('wareq_sc!=', "")->selectSum('wareq_sc')->get()->getRow())->wareq_sc);
        $jmlinSC = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wi_sc!=', "")->where('wareq_sc!=', "")->get()->getResultArray());
        if ($jmlinSC != 0) {
            $data[] = ['Input SC', number_format($tTs / $jmlinSC / 3600, 2)];
        } else {
            $data[] = ["Input SC", 0];
        }
        $tTa = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->selectSum('wa_akt_wo')->get()->getRow())->wa_akt_wo) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->selectSum('wi_sc')->get()->getRow())->wi_sc);
        $jmlakt = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->get()->getResultArray());
        if ($jmlakt != 0) {
            $data[] = ['Aktifasi', number_format($tTa / $jmlakt / 3600, 2)];
        } else {
            $data[] = ["Aktifasi", 0];
        }

        return $data;
    }
    public function progressTabelFilter($dataFilterDate)
    {
        $sto = $this->db->table('dm_sto')->get()->getResultArray();
        $datel = $this->db->table('dm_datel')->get()->getResultArray();
        $finalData = [];
        foreach ($datel as $valdat) {
            $nama_datel = $valdat['nama_datel'];
            $validasi = 0;
            $jumlahValidasi = 0;
            $dispatch = 0;
            $jumlahDispatch = 0;
            $ft = 0;
            $jumlahFt = 0;
            $reqsc = 0;
            $jumlahReqsc = 0;
            $insc = 0;
            $jumlahInsc = 0;
            $akt = 0;
            $jumlahAktifasi = 0;
            $stoData = [];
            foreach ($sto as $valSto) {
                if ($valdat['id_datel'] == $valSto['datel_sto']) {
                    $data = [];
                    $data[] = $valSto['nama_sto'];
                    $tTv = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_val!=', "")->selectSum('wi_val')->get()->getRow())->wi_val) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_val!=', "")->selectSum('stamp_ampser')->get()->getRow())->stamp_ampser);
                    $validasi += $tTv;
                    $jmlValidasi = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_val!=', "")->get()->getResultArray());
                    $jumlahValidasi += $jmlValidasi;
                    if ($jmlValidasi != 0) {
                        $data[] =  number_format($tTv / $jmlValidasi / 3600, 2) . " Jam";
                    } else {
                        $data[] =  "-";
                    }

                    $tTd = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_tek!=', "")->where('wf_teknisi!=', "")->selectSum('wf_teknisi')->get()->getRow())->wf_teknisi) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_tek!=', "")->where('wf_teknisi!=', "")->selectSum('wi_tek')->get()->getRow())->wi_tek);
                    $dispatch += $tTd;
                    $jmlDispatch = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wf_teknisi!=', "")->where('wi_tek!=', "")->get()->getResultArray());
                    $jumlahDispatch += $jmlDispatch;
                    if ($jmlDispatch != 0) {
                        $data[] =  number_format($tTd / $jmlDispatch / 3600, 2) . " Jam";
                    } else {
                        $data[] = "-";
                    }

                    $tTf = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_tek!=', "")->where('wi_val!=', "")->selectSum('wi_tek')->get()->getRow())->wi_tek) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_tek!=', "")->where('wi_val!=', "")->selectSum('wi_val')->get()->getRow())->wi_val);
                    $ft += $tTf;
                    $jmlFt = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_val!=', "")->where('wi_tek!=', "")->get()->getResultArray());
                    $jumlahFt += $jmlFt;
                    if ($jmlFt != 0) {
                        $data[] = number_format($tTf / $jmlFt / 3600, 2) . " Jam";
                    } else {
                        $data[] = "-";
                    }

                    $tTr = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wareq_sc!=', "")->where('wf_teknisi!=', "")->selectSum('wareq_sc')->get()->getRow())->wareq_sc) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wareq_sc!=', "")->where('wf_teknisi!=', "")->selectSum('wf_teknisi')->get()->getRow())->wf_teknisi);
                    $reqsc += $tTr;
                    $jmlreq = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wf_teknisi!=', "")->where('wareq_sc!=', "")->get()->getResultArray());
                    $jumlahReqsc += $jmlreq;
                    if ($jmlreq != 0) {
                        $data[] =  number_format($tTr / $jmlreq / 3600, 2) . " Jam";
                    } else {
                        $data[] =  "-";
                    }

                    $tTs = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_sc!=', "")->where('wareq_sc!=', "")->selectSum('wi_sc')->get()->getRow())->wi_sc) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_sc!=', "")->where('wareq_sc!=', "")->selectSum('wareq_sc')->get()->getRow())->wareq_sc);
                    $insc += $tTs;
                    $jmlinSC = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wi_sc!=', "")->where('wareq_sc!=', "")->get()->getResultArray());
                    $jumlahInsc += $jmlinSC;
                    if ($jmlinSC != 0) {
                        $data[] = number_format($tTs / $jmlinSC / 3600, 2) . " Jam";
                    } else {
                        $data[] =  "-";
                    }

                    $tTa = (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->selectSum('wa_akt_wo')->get()->getRow())->wa_akt_wo) - (($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->selectSum('wi_sc')->get()->getRow())->wi_sc);
                    $akt += $tTa;
                    $jmlakt = count($this->db->table('all_wo')->where('stamp_ampser>', $dataFilterDate['sTime'])->where('stamp_ampser<', $dataFilterDate['eTime'])->where('sto', $valSto['id_sto'])->where('wa_akt_wo!=', "")->where('wi_sc!=', "")->get()->getResultArray());
                    $jumlahAktifasi += $jmlakt;
                    if ($jmlakt != 0) {
                        $data[] = number_format($tTa / $jmlakt / 3600, 2) . " Jam";
                    } else {
                        $data[] = "-";
                    }
                    $stoData[] = $data;
                }
            }
            if ($jumlahValidasi > 0) {
                $v = number_format($validasi / $jumlahValidasi / 3600, 2) . " Jam";
            } else {
                $v = "-";
            }
            if ($jumlahDispatch > 0) {
                $d = number_format($dispatch / $jumlahDispatch / 3600, 2) . " Jam";
            } else {
                $d = "-";
            }
            if ($jumlahFt > 0) {
                $f = number_format($ft / $jumlahFt / 3600, 2) . " Jam";
            } else {
                $f = "-";
            }
            if ($jumlahReqsc > 0) {
                $r = number_format($reqsc / $jumlahReqsc / 3600, 2) . " Jam";
            } else {
                $r = "-";
            }
            if ($jumlahInsc > 0) {
                $i = number_format($insc / $jumlahInsc / 3600, 2) . " Jam";
            } else {
                $i = "-";
            }
            if ($jumlahAktifasi > 0) {
                $a = number_format($akt / $jumlahAktifasi / 3600, 2) . " Jam";
            } else {
                $a = "-";
            }
            // $finalData[] = [$nama_datel, $v, $d, $f, $r, $i, $a];
            $finalData[] = $stoData;
        }
        return $finalData;
    }
}
