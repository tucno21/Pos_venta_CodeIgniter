<?php

namespace App\Controllers;

use App\Models\CajasModel;
use App\Models\RolesModel;
use App\Models\UsuariosModel;

class Usuarios extends BaseController
{

    protected $usuarios;
    protected $roles;
    protected $cajas;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->usuarios = new UsuariosModel();
        $this->roles = new RolesModel();
        $this->cajas = new CajasModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index($estado = 1)
    {
        //buscar el estado en la tabla
        $usuarios = $this->usuarios->where('estado', 1)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/usuarios/index', [
            'usuarios' => $usuarios,
            'template' => $template,
        ]);
    }

    public function nuevo()
    {
        $roles = $this->roles->where('estado', 1)->findAll();
        $cajas = $this->cajas->where('estado', 1)->findAll();

        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        return view('backend/usuarios/nuevo', [
            'template' => $template,
            'roles' => $roles,
            'cajas' => $cajas,
        ]);
    }


    public function insertar()
    {
        $inputs = $this->validate([
            'username' => 'required|min_length[3]|is_unique[usuarios.username]',
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
            return view('backend/usuarios/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
                'roles' => $roles,
                'cajas' => $cajas,
            ]);
        } else {
            $this->usuarios->save([
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'name' => $this->request->getPost('name'),
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol'),
            ]);

            return redirect()->to(base_url() . '/usuarios');
        }
    }

    public function editar()
    {
        $id = $_GET['id'];
        $usuario = $this->usuarios->where('id', $id)->first();
        // print_r($usuarios);

        $roles = $this->roles->where('estado', 1)->findAll();
        $cajas = $this->cajas->where('estado', 1)->findAll();

        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/usuarios/editar', [
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
            return view('backend/usuarios/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
                'roles' => $roles,
                'cajas' => $cajas,
            ]);
        } else {

            $this->usuarios->update($this->request->getPost('id'), [
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'name' => $this->request->getPost('name'),
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol'),
            ]);

            return redirect()->to(base_url() . '/usuarios');
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $this->usuarios->update($id, [
            'estado' => 0
        ]);

        return redirect()->to(base_url() . '/usuarios');
    }

    //crear una variable sobre el estado y solo mostrar
    public function eliminados($estado = 0)
    {
        //buscar el estado en la tabla
        $usuarios = $this->usuarios->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/usuarios/eliminados', [
            'usuarios' => $usuarios,
            'template' => $template,
        ]);
    }

    public function restablecer()
    {
        $id = $_GET['id'];
        $this->usuarios->update($id, [
            'estado' => 1
        ]);

        return redirect()->to(base_url() . '/usuarios');
    }
}
