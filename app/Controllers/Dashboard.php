<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ProductosModel;

class Dashboard extends BaseController
{
    protected $productos, $ventas;

    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->ventas = new VentasModel();
    }

    public function index()
    {
        $session = session();
        // dd($session->id_username);

        if (!isset($session->id_username)) {
            return redirect()->to(base_url() . '/');
        } else {

            $totalProductos = $this->productos->where('estado', 1)->countAllResults(); //num_rows
            $fechaHoy = date('Y-m-d');
            $ventasHoy = $this->ventas->ventasHoy($fechaHoy);
            // dd($totalProductos->getLastQuery());
            // //CANTIDAD
            // $fechaHoy = date('Y-m-d');
            // $where = "estado = 1 AND DATE(created_at) = '$fechaHoy'";
            // $ventasHoy = $this->ventas->where($where)->countAllResults();

            $stockMinimo = $this->productos->productosMinimos();

            // d($stockMinimo);
            return view('backend/dashboard/index', [
                'totalProductos' => $totalProductos,
                'ventasHoy' => $ventasHoy,
                'stockMinimo' => $stockMinimo,
            ]);
        }
    }
}
