<?php

namespace App\Controllers;

use App\Models\LogsModel;

class Logout extends BaseController
{
    protected $logs;

    public function __construct()
    {
        $this->logs = new LogsModel();
    }

    public function index()
    {
        $session = session();

        $ip = $_SERVER['REMOTE_ADDR'];
        $detalles = $_SERVER['HTTP_USER_AGENT'];

        $this->logs->save([
            'id_usuario' => $session->id_username,
            'evento' => 'Cerrar de session',
            'ip' => $ip,
            'detalles' => $detalles,
        ]);

        $session->destroy();
        return redirect()->to(base_url());
    }
}
