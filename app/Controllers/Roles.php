<?php

namespace App\Controllers;

use App\Models\RolesModel;

class roles extends BaseController
{

    protected $roles;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->roles = new RolesModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index($estado = 1)
    {
        //buscar el estado en la tabla
        $roles = $this->roles->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/roles/index', [
            'roles' => $roles,
            'template' => $template,
        ]);
    }



    public function nuevo()
    {
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        return view('backend/roles/nuevo', [
            'template' => $template,
        ]);
    }

    public function insertar()
    {
        $inputs = $this->validate([
            'name' => 'required|min_length[3]|is_unique[roles.name]',
        ]);

        if (!$inputs) {
            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/roles/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
            ]);
        } else {
            $this->roles->save([
                'name' => $this->request->getPost('name'),
            ]);

            return redirect()->to(base_url() . '/roles');
        }
    }

    public function editar()
    {
        $id = $_GET['id'];
        $unidad = $this->roles->where('id', $id)->first();
        // print_r($roles);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/roles/editar', [
            'unidad' => $unidad,
            'template' => $template,
        ]);
    }

    public function actualizar()
    {
        $inputs = $this->validate([
            'name' => 'required|min_length[3]',
        ]);

        if (!$inputs) {
            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/roles/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
            ]);
        } else {

            $this->roles->update($this->request->getPost('id'), [
                'name' => $this->request->getPost('name'),
            ]);

            return redirect()->to(base_url() . '/roles');
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $this->roles->update($id, [
            'estado' => 0
        ]);

        return redirect()->to(base_url() . '/roles');
    }

    //crear una variable sobre el estado y solo mostrar
    public function eliminados($estado = 0)
    {
        //buscar el estado en la tabla
        $roles = $this->roles->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/roles/eliminados', [
            'roles' => $roles,
            'template' => $template,
        ]);
    }

    public function restablecer()
    {
        $id = $_GET['id'];
        $this->roles->update($id, [
            'estado' => 1
        ]);

        return redirect()->to(base_url() . '/roles');
    }
}
