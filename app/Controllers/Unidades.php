<?php

namespace App\Controllers;

use App\Models\UnidadesModel;

class Unidades extends BaseController
{

    protected $unidades;

    public function __construct()
    {
        $this->unidades = new UnidadesModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index($estado = 1)
    {
        //buscar el estado en la tabla
        $unidades = $this->unidades->where('estado', $estado)->findAll();
        $data = ['titulo' => 'Unidades', 'datos' => $unidades];

        // print_r($data);

        return view('backend/unidades/index', $data);
    }
}
