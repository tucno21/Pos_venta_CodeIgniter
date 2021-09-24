<?php

namespace App\Controllers;

use App\Models\CajasModel;

class Cajas extends BaseController
{

    protected $cajas;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->cajas = new CajasModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index($estado = 1)
    {
        //buscar el estado en la tabla
        $cajas = $this->cajas->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/cajas/index', [
            'cajas' => $cajas,
            'template' => $template,
        ]);
    }



    public function nuevo()
    {
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        return view('backend/cajas/nuevo', [
            'template' => $template,
        ]);
    }

    public function insertar()
    {
        $inputs = $this->validate([
            'numero_caja' => 'required|numeric|is_unique[cajas.numero_caja]',
            'name' => 'required|min_length[3]',
            'folio' => 'required|numeric',
        ]);

        if (!$inputs) {
            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/cajas/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
            ]);
        } else {
            $this->cajas->save([
                'numero_caja' => $this->request->getPost('numero_caja'),
                'name' => $this->request->getPost('name'),
                'folio' => $this->request->getPost('folio'),
            ]);

            return redirect()->to(base_url() . '/cajas');
        }
    }

    public function editar()
    {
        $id = $_GET['id'];
        $unidad = $this->cajas->where('id', $id)->first();
        // print_r($cajas);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/cajas/editar', [
            'unidad' => $unidad,
            'template' => $template,
        ]);
    }

    public function actualizar()
    {
        $inputs = $this->validate([
            'numero_caja' => 'required|numeric',
            'name' => 'required|min_length[3]',
            'folio' => 'required|numeric',
        ]);

        if (!$inputs) {
            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/cajas/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
            ]);
        } else {

            $this->cajas->update($this->request->getPost('id'), [
                'numero_caja' => $this->request->getPost('numero_caja'),
                'name' => $this->request->getPost('name'),
                'folio' => $this->request->getPost('folio'),
            ]);

            return redirect()->to(base_url() . '/cajas');
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $this->cajas->update($id, [
            'estado' => 0
        ]);

        return redirect()->to(base_url() . '/cajas');
    }

    //crear una variable sobre el estado y solo mostrar
    public function eliminados($estado = 0)
    {
        //buscar el estado en la tabla
        $cajas = $this->cajas->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/cajas/eliminados', [
            'cajas' => $cajas,
            'template' => $template,
        ]);
    }

    public function restablecer()
    {
        $id = $_GET['id'];
        $this->cajas->update($id, [
            'estado' => 1
        ]);

        return redirect()->to(base_url() . '/cajas');
    }
}
