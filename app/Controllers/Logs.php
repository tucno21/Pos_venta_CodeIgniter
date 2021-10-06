<?php

namespace App\Controllers;

use App\Models\LogsModel;

class Logs extends BaseController
{
    protected $logs;

    public function __construct()
    {
        $this->logs = new LogsModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index()
    {
        // $logs = $this->logs->findAll();
        $logs = $this->logs->logsRegister();
        // dd($logs);

        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/logs/index', [
            'template' => $template,
            'logs' => $logs,
        ]);
    }
}
