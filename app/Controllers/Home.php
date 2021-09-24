<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Home extends BaseController
{
    protected $usuarios;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->usuarios = new UsuariosModel();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $inputs = $this->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            if (!$inputs) {
                return view('login', [
                    'validation' => $this->validator,
                ]);
            } else {

                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');

                $usuario = $this->usuarios->where('username', $username)->first();

                if (isset($usuario)) {
                    $encritar = password_verify($password, $usuario->password);

                    if ($encritar) {
                        $datosSesion = [
                            'id_username' => $usuario->id,
                            'name' => $usuario->name,
                            'id_caja' => $usuario->id_caja,
                            'id_rol' => $usuario->id_rol,
                        ];

                        $session = session();
                        $session->set($datosSesion);

                        return redirect()->to(base_url() . '/dashboard');
                    } else {
                        $errorPass = 'Erro de contraseña';
                        return view('login', [
                            'errorPass' => $errorPass,
                        ]);
                    }
                } else {
                    $errorName = 'El usuario no existe';
                    return view('login', [
                        'errorName' => $errorName,
                    ]);
                }
            }
        } else {
            return view('login', []);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url());
    }
}
