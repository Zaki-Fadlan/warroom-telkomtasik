<?php

namespace App\Controllers;

use App\Models\ModelStatus;
use App\Models\ModelKendala;
use App\Models\ModelDashboard;
use App\Models\ModelDatel;
use App\Models\ModelSto;



class Pvitadashboard extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'DASHBOARD',
            'isi' => 'pvita/dashboard/index',
            'status' => $this->ModelStatus->allData(),
            'kendala' => $this->ModelKendala->allData(),
        ];
        return view('layoutpvita/wrapper', $data);
    }
    public function __construct()
    {
        helper('form');
        $this->ModelStatus = new ModelStatus();
        $this->ModelKendala = new ModelKendala();
        $this->ModelDashboard = new ModelDashboard();
        $this->ModelDatel = new ModelDatel();
        $this->ModelSto = new ModelSto();
    }
    public function dashboardData()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data['summary'] =  $this->ModelDashboard->summary();
        $data['summaryTabel'] =  $this->ModelDashboard->summarytabel();
        $data['kendalawo'] =  $this->ModelDashboard->kendala();
        $data['progresstime'] =  $this->ModelDashboard->progressTime();
        $data['kendalaTabel'] =  $this->ModelDashboard->kendalaTabel();
        $data['performaTabel'] =  $this->ModelDashboard->progressTabel();
        echo json_encode($data);
        exit();
    }
    public function filterDashboardData()
    {
        date_default_timezone_set("Asia/Jakarta");
        $filterData = [
            'sTime'          => strtotime(str_replace('/', '-', $this->request->getPost('start_time'))),
            'eTime'         => strtotime(str_replace('/', '-', $this->request->getPost('end_time'))) + 86400,
        ];
        $data['summary'] =  $this->ModelDashboard->summaryFilter($filterData);
        $data['summaryTabel'] =  $this->ModelDashboard->summarytabelFilter($filterData);
        $data['progresstime'] =  $this->ModelDashboard->progressTimeFilter($filterData);
        $data['kendalawo'] =  $this->ModelDashboard->kendalaFilter($filterData);
        $data['kendalaTabel'] =  $this->ModelDashboard->kendalaTabelFilter($filterData);
        $data['performaTabel'] =  $this->ModelDashboard->progressTabelFilter($filterData);
        echo json_encode($data);
        exit();
    }
}
