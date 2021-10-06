<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\ConfiguracionesModel;


class Reportes extends BaseController
{
    protected $ventas, $ventasTemporal, $productos, $detalleVenta, $tienda, $clientes;

    public function __construct()
    {
        // helper(['form', 'url']);
        // $this->ventas = new VentasModel();
        $this->productos = new ProductosModel();
        // $this->ventasTemporal = new TemporalComprasModel();
        // $this->detalleVenta = new DetalleVentaModel();
        $this->tienda = new ConfiguracionesModel();
        // $this->clientes = new ClientesModel();
    }

    public function stockminimo()
    {
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/reportes/minimo', [
            'template' => $template,
        ]);
    }

    public function stockminimopdf()
    {
        $tienda = $this->tienda->first();


        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10, 10);
        $pdf->SetTitle("Stock Minimo");
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(0, 5, $tienda->name, 0, 1, "C");

        // $pdf->image(base_url() . '/images/logo.png', X, Y, ancho, alto);
        if ($tienda->logo != '') {
            $pdf->image(base_url() . '/images/' . $tienda->logo, 10, 10, 15, 15);
        } else {
            $pdf->image(base_url() . '/images/logo.png', 10, 8, 8, 8, 'PNG');
        }

        $pdf->Ln();
        $pdf->Cell(0, 5, utf8_decode('Reporte de productos con stock Mínimo'), 0, 1, "C");

        $pdf->Ln(10);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 7);

        $pdf->Cell(20, 5, utf8_decode("Código"), 1, 0, "C");
        $pdf->Cell(100, 5, utf8_decode("Nombre"), 1, 0, "C");
        $pdf->Cell(35, 5, utf8_decode("Existencias"), 1, 0, "C");
        $pdf->Cell(35, 5, utf8_decode("Stock Min."), 1, 1, "C");


        $productos = $this->productos->getGroductosMinimos();
        // d($productos);

        foreach ($productos as $producto) {
            $pdf->Cell(20, 5, $producto->codigo, 1, 0, "C");
            $pdf->Cell(100, 5, utf8_decode($producto->name), 1, 0, "C");
            $pdf->Cell(35, 5, utf8_decode($producto->existencias), 1, 0, "C");
            $pdf->Cell(35, 5, utf8_decode($producto->stock_minimo), 1, 1, "C");
        }



        //para ver archivos pdf en codinayter
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("ticket.pdf", "I");
    }
}
