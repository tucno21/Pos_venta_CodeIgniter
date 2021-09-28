<?php

namespace App\Controllers;


use stdClass;
use App\Models\ComprasModel;
use App\Models\ProductosModel;

class Compras extends BaseController
{

    protected $compras;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->compras = new ComprasModel();
        $this->productos = new ProductosModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index($estado = 1)
    {
        //buscar el estado en la tabla
        $compras = $this->compras->where('estado', 1)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/compras/index', [
            'compras' => $compras,
            'template' => $template,
        ]);
    }

    public function nuevo()
    {
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        return view('backend/compras/nuevo', [
            'template' => $template,
        ]);
    }


    public function insertar()
    {
        $inputs = $this->validate([
            'username' => 'required|min_length[3]|is_unique[compras.username]',
            'password' => 'required|min_length[3]',
            'repassword' => 'required|matches[password]',
            'name' => 'required|min_length[3]',
            'id_caja' => 'required|numeric|is_not_unique[cajas.id]',
            'id_rol' => 'required|numeric|is_not_unique[roles.id]',
        ]);

        if (!$inputs) {
            $roles = $this->roles->where('estado', 1)->findAll();
            $cajas = $this->cajas->where('estado', 1)->findAll();

            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/compras/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
                'roles' => $roles,
                'cajas' => $cajas,
            ]);
        } else {
            $this->compras->save([
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'name' => $this->request->getPost('name'),
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol'),
            ]);

            return redirect()->to(base_url() . '/compras');
        }
    }

    public function editar()
    {
        $id = $_GET['id'];
        $usuario = $this->compras->where('id', $id)->first();
        // print_r($compras);

        $roles = $this->roles->where('estado', 1)->findAll();
        $cajas = $this->cajas->where('estado', 1)->findAll();

        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/compras/editar', [
            'usuario' => $usuario,
            'template' => $template,
            'roles' => $roles,
            'cajas' => $cajas,
        ]);
    }

    public function actualizar()
    {
        $inputs = $this->validate([
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[3]',
            'repassword' => 'required|matches[password]',
            'name' => 'required|min_length[3]',
            'id_caja' => 'required|numeric|is_not_unique[cajas.id]',
            'id_rol' => 'required|numeric|is_not_unique[roles.id]',
        ]);

        if (!$inputs) {
            $roles = $this->roles->where('estado', 1)->findAll();
            $cajas = $this->cajas->where('estado', 1)->findAll();

            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/compras/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
                'roles' => $roles,
                'cajas' => $cajas,
            ]);
        } else {

            $this->compras->update($this->request->getPost('id'), [
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'name' => $this->request->getPost('name'),
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol'),
            ]);

            return redirect()->to(base_url() . '/compras');
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $this->compras->update($id, [
            'estado' => 0
        ]);

        return redirect()->to(base_url() . '/compras');
    }

    //crear una variable sobre el estado y solo mostrar
    public function eliminados($estado = 0)
    {
        //buscar el estado en la tabla
        $compras = $this->compras->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/compras/eliminados', [
            'compras' => $compras,
            'template' => $template,
        ]);
    }

    public function restablecer()
    {
        $id = $_GET['id'];
        $this->compras->update($id, [
            'estado' => 1
        ]);

        return redirect()->to(base_url() . '/compras');
    }

    public function rescontra()
    {
        $session = session();

        $usuario = $this->compras->where('id', $session->id_username)->first();

        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/compras/rescontra', [
            'usuario' => $usuario,
            'template' => $template,
        ]);
    }

    public function actualizar_password()
    {
        $inputs = $this->validate([
            'password' => 'required|min_length[3]',
            'repassword' => 'required|matches[password]',
        ]);

        if (!$inputs) {

            $session = session();

            $usuario = $this->compras->where('id', $session->id_username)->first();

            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/compras/rescontra', [
                'usuario' => $usuario,
                'validation' => $this->validator,
                'template' => $template,
            ]);
        } else {
            $session = session();
            $usuario = $this->compras->where('id', $session->id_username)->first();

            $this->compras->update($session->id_username, [
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            ]);

            $mensaje = 'La contraseña se ha cambiado!';
            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/compras/rescontra', [
                'usuario' => $usuario,
                'mensaje' => $mensaje,
                'template' => $template,
            ]);
        }
    }



    public function buscarCodigo()
    {
        $codigo = $_GET['codigo'];

        $this->productos->select('*');
        $this->productos->where('codigo', $codigo);
        $this->productos->where('estado', 1);
        $producto = $this->productos->get()->getRow();
        // $producto = $this->productos->where('codigo', $codigo)->where('estado', 1)->first();

        $res['existe'] = false;
        $res['producto'] = '';
        $res['error'] = '';

        if ($producto) {
            $res['producto'] = $producto;
            $res['existe'] = true;
        } else {
            $res['error'] = 'no existe producto';
            $res['existe'] = false;
            // $objeto = new stdClass();
            // $objeto->error = 'no existe producto';
            // echo json_encode($objeto);
        }

        echo json_encode($res);
    }
}
