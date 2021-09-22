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

        // print_r($data);

        return view('backend/unidades/index', [
            'unidades' => $unidades,
        ]);
    }



    public function nuevo()
    {
        return view('backend/unidades/nuevo');
    }

    public function editar($id)
    {
        //buscar el id
        $unidad = $this->unidades->where('id', $id)->first();
        // print_r($unidades);
        return view('backend/unidades/editar', [
            'unidad' => $unidad,
        ]);
    }


    public function insertar()
    {
        $this->unidades->save([
            'name' => $this->request->getPost('name'),
            'short_name' => $this->request->getPost('short_name')
        ]);

        return redirect()->to(base_url() . '/unidades');
    }
}
