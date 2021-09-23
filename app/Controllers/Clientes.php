<?php

namespace App\Controllers;

use App\Models\ClientesModel;

class Clientes extends BaseController
{

    protected $clientes;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->clientes = new ClientesModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index($estado = 1)
    {
        //buscar el estado en la tabla
        $clientes = $this->clientes->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/clientes/index', [
            'clientes' => $clientes,
            'template' => $template,
        ]);
    }



    public function nuevo()
    {
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/clientes/nuevo', [
            'template' => $template,
        ]);
    }

    public function insertar()
    {
        $inputs = $this->validate([
            'name' => 'required|min_length[3]',
            'direccion' => 'required|min_length[3]',
            'telefono' => 'required|numeric',
            'email' => 'required|valid_email|is_unique[clientes.email]',
        ]);

        if (!$inputs) {
            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');

            return view('backend/clientes/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
            ]);
        } else {
            $this->clientes->save([
                'name' => $this->request->getPost('name'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'email' => $this->request->getPost('email'),
            ]);

            return redirect()->to(base_url() . '/clientes');
        }
    }

    public function editar()
    {
        $id = $_GET['id'];
        $cliente = $this->clientes->where('id', $id)->first();
        // print_r($clientes);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/clientes/editar', [
            'cliente' => $cliente,
            'template' => $template,
        ]);
    }

    public function actualizar()
    {
        $inputs = $this->validate([
            'name' => 'required|min_length[3]',
            'direccion' => 'required|min_length[3]',
            'telefono' => 'required|numeric',
            'email' => 'required|valid_email',
        ]);

        if (!$inputs) {
            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/clientes/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
            ]);
        } else {

            $this->clientes->update($this->request->getPost('id'), [
                'name' => $this->request->getPost('name'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'email' => $this->request->getPost('email'),
            ]);

            return redirect()->to(base_url() . '/clientes');
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $this->clientes->update($id, [
            'estado' => 0
        ]);

        return redirect()->to(base_url() . '/clientes');
    }

    //crear una variable sobre el estado y solo mostrar
    public function eliminados($estado = 0)
    {
        //buscar el estado en la tabla
        $clientes = $this->clientes->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/clientes/eliminados', [
            'clientes' => $clientes,
            'template' => $template,
        ]);
    }

    public function restablecer()
    {
        $id = $_GET['id'];
        $this->clientes->update($id, [
            'estado' => 1
        ]);

        return redirect()->to(base_url() . '/clientes');
    }
}
