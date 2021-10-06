<?php

namespace App\Controllers;

use App\Models\LogsModel;
use App\Models\UsuariosModel;

class Home extends BaseController
{
    protected $usuarios, $logs;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->usuarios = new UsuariosModel();
        $this->logs = new LogsModel();
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

                        $ip = $_SERVER['REMOTE_ADDR'];
                        $detalles = $_SERVER['HTTP_USER_AGENT'];

                        $this->logs->save([
                            'id_usuario' => $usuario->id,
                            'evento' => 'inicio de session',
                            'ip' => $ip,
                            'detalles' => $detalles,
                        ]);

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
