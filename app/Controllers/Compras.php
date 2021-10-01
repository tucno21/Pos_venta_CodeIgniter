<?php

namespace App\Controllers;


use stdClass;
use App\Models\ComprasModel;
use App\Models\ProductosModel;
use App\Models\DetalleCompraModel;
use App\Models\ConfiguracionesModel;
use App\Models\TemporalComprasModel;

class Compras extends BaseController
{

    protected $compras, $comprasTemporal, $productos, $detalleCompra, $tienda;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->compras = new ComprasModel();
        $this->productos = new ProductosModel();
        $this->comprasTemporal = new TemporalComprasModel();
        $this->detalleCompra = new DetalleCompraModel();
        $this->tienda = new ConfiguracionesModel();
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


    public function compraTemporal()
    {
        $id_producto = $_GET['id_producto'];
        $cantidad = $_GET['cantidad'];
        $id_compra = $_GET['id_compra'];

        $producto = $this->productos->where('id', $id_producto)->first();

        $resultado['enviado'] = false;
        $resultado['error'] = '';

        if ($producto) {
            $compraTemporal = $this->comprasTemporal->where('folio', $id_compra)->first();

            if ($compraTemporal && $producto->id == $compraTemporal->id_producto) {

                $subtotal = $producto->precio_compra * $cantidad;
                // d($subtotal);

                $res = $this->comprasTemporal->update($compraTemporal->id, [
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                ]);

                $resultado['enviado'] = true;
                $resultado['verCompra'] = $this->verCompraTemporal($id_compra);
                $resultado['total'] = $this->verTotalCompra($id_compra);
                // d($res);

            } else {
                $subtotal = $producto->precio_compra * $cantidad;
                // d($subtotal);
                $res = $this->comprasTemporal->save([
                    'folio' => $id_compra,
                    'id_producto' => $id_producto,
                    'codigo' => $producto->codigo,
                    'name' => $producto->name,
                    'cantidad' => $cantidad,
                    'precio' => $producto->precio_compra,
                    'subtotal' => $subtotal,
                ]);
                // d($res);
                $resultado['enviado'] = true;
                $resultado['verCompra'] = $this->verCompraTemporal($id_compra);
                $resultado['total'] = $this->verTotalCompra($id_compra);
            }
        }

        echo json_encode($resultado);
    }

    public function verCompraTemporal($id_compra)
    {
        $comprasTemporales = $this->comprasTemporal->where('folio', $id_compra)->findAll();
        $fila = '';
        $numFila = 0;

        foreach ($comprasTemporales as $filaCompra) {
            $numFila++;
            $fila .= "<tr id='fila" . $numFila . "'>";
            $fila .= "<td>" . $numFila . "</td>";
            $fila .= "<td>" . $filaCompra->codigo . "</td>";
            $fila .= "<td>" . $filaCompra->name . "</td>";
            $fila .= "<td>" . $filaCompra->precio . "</td>";
            $fila .= "<td>" . $filaCompra->cantidad . "</td>";
            $fila .= "<td>" . $filaCompra->subtotal . "</td>";
            $fila .= "<td>
            <button id_temporal='" . $filaCompra->id . "' type='button' class='btn btn-danger alertaBorrar'><i class='fas fa-trash-alt'></i></button>
            </td>";
            $fila .= "</tr>";
        }

        return $fila;
    }

    public function verTotalCompra($id_compra)
    {
        $comprasTemporales = $this->comprasTemporal->where('folio', $id_compra)->findAll();
        $total = 0;

        foreach ($comprasTemporales as $filaCompra) {
            $total += $filaCompra->subtotal;
        }

        return $total;
    }

    public function eliminarTemporal()
    {

        $id_compra = $_GET['id_compra'];
        $id_temporal = $_GET['id_temporal'];

        $borrar = $this->comprasTemporal->where('id', $id_temporal)->delete();

        $resultado['enviado'] = false;

        if ($borrar) {
            $resultado['enviado'] = true;
            $resultado['verCompra'] = $this->verCompraTemporal($id_compra);
            $resultado['total'] = $this->verTotalCompra($id_compra);
        }

        echo json_encode($resultado);
    }

    public function guardarCompra()
    {
        $id_compra = $this->request->getPost('id_compra');
        $total = $this->request->getPost('totalCompra');

        $session = session();

        $guardar = $this->compras->save([
            'folio' => $id_compra,
            'total' => $total,
            'id_usuario' => $session->id_username,
        ]);

        if ($guardar) {
            $tablaCompra = $this->compras->where('folio', $id_compra)->first();

            if ($tablaCompra) {

                $comprasTemporales = $this->comprasTemporal->where('folio', $tablaCompra->folio)->findAll();

                foreach ($comprasTemporales as $comTemp) {
                    $this->detalleCompra->save([
                        'id_compra' => $tablaCompra->id,
                        'id_producto' => $comTemp->id_producto,
                        'nombre' => $comTemp->name,
                        'cantidad' => $comTemp->cantidad,
                        'precio' => $comTemp->precio,
                    ]);

                    $producto = $this->productos->where('id', $comTemp->id_producto)->first();

                    $this->productos->update($comTemp->id_producto, [
                        'existencias' => $producto->existencias + $comTemp->cantidad,
                    ]);
                }

                $this->comprasTemporal->where('folio', $tablaCompra->folio)->delete();
            }

            return redirect()->to(base_url() . '/productos');
        }
    }


    public function verPdf()
    {
        $valor['id'] = $_GET['id'];
        $id = json_decode(json_encode($valor));
        // d($id);

        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/compras/verPdf', [
            'template' => $template,
            'id' => $id,
        ]);
    }

    public function generapdf()
    {
        $id = $_GET['id'];

        $datosCompra = $this->compras->where('id', $id)->first();

        $detalleCompra = $this->detalleCompra->select('*')->where('id_compra ', $id)->findAll();

        $tienda = $this->tienda->first();
        // d($tienda);

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("compra");
        $pdf->SetFont('Arial', 'B', 10);

        // $pdf->Cell(tamaño ancho, alto, "Entrada de compras", borde(0=sinlinea 1=linea), salto de linea, "C=centrado", 1:fondomegro);
        $pdf->Cell(195, 5, "Entrada de compras", 0, 1, "C");
        $pdf->SetFont('Arial', 'B', 9);
        // $pdf->image(base_url() . '/images/logo.png', X, Y, ancho, alto);
        $pdf->image(base_url() . '/images/logo.png', 185, 10, 20, 20, 'PNG');

        $pdf->Cell(50, 5, $tienda->name, 0, 1, "L");
        $pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, "L");
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $tienda->direccion, 0, 1, "L");

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(20, 5, 'Fecha: ', 0, 0, "L");
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $datosCompra->created_at, 0, 1, "L");

        //salto de linea
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(195, 5, "Detalle de Productos", 1, 1, "C", 1);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(14, 5, utf8_decode("N°"), 1, 0, "L");
        $pdf->Cell(25, 5, utf8_decode("Código"), 1, 0, "L");
        $pdf->Cell(77, 5, "Nombre", 1, 0, "L");
        $pdf->Cell(25, 5, "Precio", 1, 0, "L");
        $pdf->Cell(25, 5, "Cantidad", 1, 0, "L");
        $pdf->Cell(29, 5, "Importe", 1, 1, "L");

        $fila = 1;
        foreach ($detalleCompra as $dc) {
            $pdf->Cell(14, 5, $fila, 1, 0, "L");
            $pdf->Cell(25, 5, utf8_decode($dc->id_compra), 1, 0, "L");
            $pdf->Cell(77, 5, utf8_decode($dc->nombre), 1, 0, "L");
            $pdf->Cell(25, 5, $dc->precio, 1, 0, "L");
            $pdf->Cell(25, 5, $dc->cantidad, 1, 0, "L");
            $importe = number_format($dc->precio * $dc->cantidad, 2, '.', ',');
            $pdf->Cell(29, 5, 's/ ' . $importe, 1, 1, "L");
            $fila++;
        }

        //salto de linea
        $pdf->Ln();


        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(120, 5, " ", 0, 0, "C");
        $pdf->Cell(45, 5, "Total", 1, 0, "C");
        $total = number_format($datosCompra->total, 2, '.', ',');
        $pdf->Cell(30, 5, 's/ ' . $total, 1, 1, "C");


        //para ver archivos pdf en codinayter
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("compra_pdf.pdf", "I");
    }
}
