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
        $totalProductos = $this->productos->where('estado', 1)->countAllResults(); //num_rows
        $fechaHoy = date('Y-m-d');
        $ventasHoy = $this->ventas->ventasHoy($fechaHoy);
        // dd($totalProductos->getLastQuery());
        // //CANTIDAD
        // $fechaHoy = date('Y-m-d');
        // $where = "estado = 1 AND DATE(created_at) = '$fechaHoy'";
        // $ventasHoy = $this->ventas->where($where)->countAllResults();


        // d($ventasHoy[0]->total);
        return view('backend/dashboard/index', [
            'totalProductos' => $totalProductos,
            'ventasHoy' => $ventasHoy,
        ]);
    }
}
