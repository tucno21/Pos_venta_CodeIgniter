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
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/unidades/index', [
            'unidades' => $unidades,
            'template' => $template,
        ]);
    }



    public function nuevo()
    {
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        return view('backend/unidades/nuevo', [
            'template' => $template,
        ]);
    }

    public function editar()
    {
        $id = $_GET['id'];
        $unidad = $this->unidades->where('id', $id)->first();
        // print_r($unidades);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/unidades/editar', [
            'unidad' => $unidad,
            'template' => $template,
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

    public function actualizar()
    {
        $this->unidades->update($this->request->getPost('id'), [
            'name' => $this->request->getPost('name'),
            'short_name' => $this->request->getPost('short_name')
        ]);

        return redirect()->to(base_url() . '/unidades');
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $this->unidades->update($id, [
            'estado' => 0
        ]);

        return redirect()->to(base_url() . '/unidades');
    }
}
