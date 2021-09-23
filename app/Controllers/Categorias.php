<?php

namespace App\Controllers;

use App\Models\CategoriasModel;

class Categorias extends BaseController
{

    protected $categorias;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->categorias = new CategoriasModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index($estado = 1)
    {
        //buscar el estado en la tabla
        $categorias = $this->categorias->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/categorias/index', [
            'categorias' => $categorias,
            'template' => $template,
        ]);
    }



    public function nuevo()
    {
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        return view('backend/categorias/nuevo', [
            'template' => $template,
        ]);
    }

    public function insertar()
    {

        $inputs = $this->validate([
            'name' => 'required|min_length[3]',
        ]);

        if (!$inputs) {
            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/categorias/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
            ]);
        } else {
            $this->categorias->save([
                'name' => $this->request->getPost('name')
            ]);
            return redirect()->to(base_url() . '/categorias');
        }
    }

    public function editar()
    {
        $id = $_GET['id'];
        $categoria = $this->categorias->where('id', $id)->first();
        // print_r($categorias);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/categorias/editar', [
            'categoria' => $categoria,
            'template' => $template,
        ]);
    }


    public function actualizar()
    {
        $this->categorias->update($this->request->getPost('id'), [
            'name' => $this->request->getPost('name'),
            'short_name' => $this->request->getPost('short_name')
        ]);

        return redirect()->to(base_url() . '/categorias');
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $this->categorias->update($id, [
            'estado' => 0
        ]);

        return redirect()->to(base_url() . '/categorias');
    }

    //crear una variable sobre el estado y solo mostrar
    public function eliminados($estado = 0)
    {
        //buscar el estado en la tabla
        $categorias = $this->categorias->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/categorias/eliminados', [
            'categorias' => $categorias,
            'template' => $template,
        ]);
    }

    public function restablecer()
    {
        $id = $_GET['id'];
        $this->categorias->update($id, [
            'estado' => 1
        ]);

        return redirect()->to(base_url() . '/categorias');
    }
}
