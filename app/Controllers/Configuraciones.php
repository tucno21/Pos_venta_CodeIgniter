<?php

namespace App\Controllers;

use App\Models\ConfiguracionesModel;

class Configuraciones extends BaseController
{

    protected $configuraciones;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->configuraciones = new ConfiguracionesModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index()
    {
        $config = $this->configuraciones->first();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/configuraciones/index', [
            'config' => $config,
            'template' => $template,
        ]);
    }

    public function actualizar()
    {
        $inputs = $this->validate([
            'name' => 'required|min_length[3]',
            'rfc' => 'required|min_length[3]',
            'telefono' => 'required|numeric',
            'email' => 'required|valid_email',
            'direccion' => 'required|min_length[3]',
            'leyenda' => 'required|min_length[3]',
        ]);

        if (!$inputs) {
            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/configuraciones/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
            ]);
        } else {

            $this->configuraciones->update($this->request->getPost('id'), [
                'name' => $this->request->getPost('name'),
                'rfc' => $this->request->getPost('rfc'),
                'telefono' => $this->request->getPost('telefono'),
                'email' => $this->request->getPost('email'),
                'direccion' => $this->request->getPost('direccion'),
                'leyenda' => $this->request->getPost('leyenda')
            ]);

            return redirect()->to(base_url() . '/configuraciones');
        }
    }
}
