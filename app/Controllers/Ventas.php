<?php

namespace App\Controllers;


use stdClass;
use App\Models\VentasModel;
use App\Models\ClientesModel;
use App\Models\ProductosModel;
use App\Models\DetalleVentaModel;
use App\Models\ConfiguracionesModel;
use App\Models\TemporalComprasModel;


class Ventas extends BaseController
{

    protected $ventas, $ventasTemporal, $productos, $detalleVenta, $tienda, $clientes;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->ventas = new VentasModel();
        $this->productos = new ProductosModel();
        $this->ventasTemporal = new TemporalComprasModel();
        $this->detalleVenta = new DetalleVentaModel();
        $this->tienda = new ConfiguracionesModel();
        $this->clientes = new ClientesModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index($estado = 1)
    {
        //buscar el estado en la tabla
        // $ventas = $this->ventas->where('estado', 1)->findAll();
        $ventas = $this->ventas->obtenerVentas();
        // d($ventas);

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/ventas/index', [
            'ventas' => $ventas,
            'template' => $template,
        ]);
    }

    public function venta()
    {
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        return view('backend/ventas/venta', [
            'template' => $template,
        ]);
    }

    public function autocompletarClientes()
    {
        $enviarDatos = array();

        $valor = $this->request->getGet('term');

        // $clientes = $this->clientes->where('estado', 1)->findAll();

        $clientes = $this->clientes->like('name', $valor)->where('estado', 1)->findAll();

        if (!empty($clientes)) {
            foreach ($clientes as $cliente) {
                $data['id'] = $cliente->id;
                $data['value'] = $cliente->name;
                array_push($enviarDatos, $data);
            }
        }
        // d($valor);

        echo json_encode($enviarDatos);
    }


    public function autocompletarCompra()
    {
        $enviarDatos = array();

        $valor = $this->request->getGet('term');

        // $clientes = $this->clientes->where('estado', 1)->findAll();

        $productos = $this->productos->like('codigo', $valor)->where('estado', 1)->findAll();

        if (!empty($productos)) {
            foreach ($productos as $producto) {
                $data['id'] = $producto->id;
                $data['value'] = $producto->codigo;
                $data['label'] = $producto->codigo . ' - ' . $producto->name;
                array_push($enviarDatos, $data);
            }
        }
        // d($valor);

        echo json_encode($enviarDatos);
    }


    public function ventaTemporal()
    {
        $id_producto = $_GET['id_producto'];
        $cantidad = $_GET['cantidad'];
        $id_venta = $_GET['id_venta'];

        $producto = $this->productos->where('id', $id_producto)->first();

        $resultado['enviado'] = false;
        $resultado['error'] = '';

        if ($producto) {
            $ventasTemporal = $this->ventasTemporal->where('id_producto', $producto->id)->first();

            if ($ventasTemporal && $producto->id == $ventasTemporal->id_producto) {

                $cantidadNuevo = $ventasTemporal->cantidad + $cantidad;
                $subtotalNuevo = $producto->precio_venta * $cantidadNuevo;


                $res = $this->ventasTemporal->update($ventasTemporal->id, [
                    'cantidad' => $cantidadNuevo,
                    'subtotal' => $subtotalNuevo,
                ]);

                $resultado['enviado'] = true;
                $resultado['verVenta'] = $this->verVentaTemporal($id_venta);
                $resultado['total'] = $this->verTotalVenta($id_venta);
                // d($resultado);
            } else {
                $subtotal = $producto->precio_compra * $cantidad;
                // d($subtotal);
                $res = $this->ventasTemporal->save([
                    'folio' => $id_venta,
                    'id_producto' => $id_producto,
                    'codigo' => $producto->codigo,
                    'name' => $producto->name,
                    'cantidad' => $cantidad,
                    'precio' => $producto->precio_venta,
                    'subtotal' => $subtotal,
                ]);
                // d($res);
                $resultado['enviado'] = true;
                $resultado['verVenta'] = $this->verVentaTemporal($id_venta);
                $resultado['total'] = $this->verTotalVenta($id_venta);
            }
        }

        echo json_encode($resultado);
    }

    public function verVentaTemporal($id_venta)
    {
        $ventasTemporales = $this->ventasTemporal->where('folio', $id_venta)->findAll();
        $fila = '';
        $numFila = 0;
        // d($ventasTemporales);

        foreach ($ventasTemporales as $filaVenta) {
            $numFila++;
            $fila .= "<tr id='fila" . $numFila . "'>";
            $fila .= "<td>" . $numFila . "</td>";
            $fila .= "<td>" . $filaVenta->codigo . "</td>";
            $fila .= "<td>" . $filaVenta->name . "</td>";
            $fila .= "<td>" . $filaVenta->precio . "</td>";
            $fila .= "<td>" . $filaVenta->cantidad . "</td>";
            $fila .= "<td>" . $filaVenta->subtotal . "</td>";
            $fila .= "<td>
            <button id_temporalVenta='" . $filaVenta->id . "' type='button' class='btn btn-danger alertaBorrar'><i class='fas fa-trash-alt'></i></button>
            </td>";
            $fila .= "</tr>";
        }

        return $fila;
    }

    public function verTotalVenta($id_venta)
    {
        $ventasTemporales = $this->ventasTemporal->where('folio', $id_venta)->findAll();
        $total = 0;

        foreach ($ventasTemporales as $filaVenta) {
            $total += $filaVenta->subtotal;
        }

        return $total;
    }

    public function eliminarTemporal()
    {

        $id_venta = $_GET['id_venta'];
        $id_temporal = $_GET['id_temporal'];

        $resultado['enviado'] = false;

        $ventaTemporal = $this->ventasTemporal->where('id', $id_temporal)->first();

        if ($ventaTemporal) {
            if ($ventaTemporal->cantidad > 1) {
                $cantidadVenta = $ventaTemporal->cantidad - 1;
                $nuevoSubtotal = $ventaTemporal->precio * $cantidadVenta;

                $res = $this->ventasTemporal->update($ventaTemporal->id, [
                    'cantidad' => $cantidadVenta,
                    'subtotal' => $nuevoSubtotal,
                ]);

                $resultado['enviado'] = true;
                $resultado['verVenta'] = $this->verVentaTemporal($id_venta);
                $resultado['total'] = $this->verTotalVenta($id_venta);
            } else {
                $borrar = $this->ventasTemporal->where('id', $id_temporal)->delete();

                if ($borrar) {
                    $resultado['enviado'] = true;
                    $resultado['verVenta'] = $this->verVentaTemporal($id_venta);
                    $resultado['total'] = $this->verTotalVenta($id_venta);
                }
            }
        }

        echo json_encode($resultado);
    }

    public function guardarVenta()
    {
        $id_venta = $this->request->getPost('id_venta');
        $total = $this->request->getPost('totalVenta');
        $id_cliente = $this->request->getPost('id_cliente');
        $forma_pago = $this->request->getPost('forma_pago');


        $session = session();

        $guardar = $this->ventas->save([
            'folio' => $id_venta,
            'total' => $total,
            'id_usuario' => $session->id_username,
            'id_caja' =>  $session->id_caja,
            'id_cliente' =>  $id_cliente,
            'forma_pago' => $forma_pago,
        ]);

        if ($guardar) {
            $tablaVenta = $this->ventas->where('folio', $id_venta)->first();

            if ($tablaVenta) {

                $ventasTemporales = $this->ventasTemporal->where('folio', $tablaVenta->folio)->findAll();

                foreach ($ventasTemporales as $venTemp) {
                    $this->detalleVenta->save([
                        'id_venta' => $tablaVenta->id,
                        'id_producto' => $venTemp->id_producto,
                        'name' => $venTemp->name,
                        'cantidad' => $venTemp->cantidad,
                        'precio' => $venTemp->precio,
                    ]);

                    $producto = $this->productos->where('id', $venTemp->id_producto)->first();

                    $this->productos->update($venTemp->id_producto, [
                        'existencias' => $producto->existencias - $venTemp->cantidad,
                    ]);
                }

                $this->ventasTemporal->where('folio', $tablaVenta->folio)->delete();
            }

            return redirect()->to(base_url() . '/ventas');
        }
    }


    public function verPdf()
    {
        $valor['id'] = $_GET['id'];
        $id = json_decode(json_encode($valor));
        // d($id);

        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/ventas/verPdf', [
            'template' => $template,
            'id' => $id,
        ]);
    }

    public function generapdf()
    {
        $id = $_GET['id'];

        $datosVenta = $this->ventas->where('id', $id)->first();

        $detalleVentas = $this->detalleVenta->select('*')->where('id_venta ', $id)->findAll();

        $tienda = $this->tienda->first();
        // d($detalleVentas);

        $pdf = new \FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetTitle("venta");
        $pdf->SetFont('Arial', 'B', 10);

        // $pdf->Cell(tamaño ancho, alto, "Entrada de ventas", borde(0=sinlinea 1=linea), salto de linea, "C=centrado", 1:fondomegro);
        $pdf->Cell(70, 5, $tienda->name, 0, 1, "C");
        $pdf->SetFont('Arial', 'B', 9);
        // $pdf->image(base_url() . '/images/logo.png', X, Y, ancho, alto);
        $pdf->image(base_url() . '/images/logo.png', 10, 8, 10, 10, 'PNG');

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(70, 5, $tienda->direccion, 0, 1, "C");

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(20, 5, 'Fecha: ', 0, 0, "R");
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(50, 5, $datosVenta->created_at, 0, 1, "L");

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(20, 5, 'Ticket: ', 0, 0, "R");
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(50, 5, $datosVenta->folio, 0, 1, "L");

        //salto de linea
        $pdf->Ln();


        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(7, 5, "Cant", 0, 0, "L");
        $pdf->Cell(30, 5, "Nombre", 0, 0, "C");
        $pdf->Cell(13, 5, "Precio", 0, 0, "L");
        $pdf->Cell(20, 5, "Importe", 0, 1, "L");

        $fila = 1;
        foreach ($detalleVentas as $dc) {
            $pdf->Cell(7, 5, $dc->cantidad, 0, 0, "C");
            $pdf->Cell(30, 5, utf8_decode($dc->name), 0, 0, "C");
            $pdf->Cell(13, 5, $dc->precio, 0, 0, "L");
            $importe = number_format($dc->precio * $dc->cantidad, 2, '.', ',');
            $pdf->Cell(20, 5, 's/ ' . $importe, 0, 1, "L");
            $fila++;
        }

        //salto de linea
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(35, 5, "Total", 0, 0, "C");
        $total = number_format($datosVenta->total, 2, '.', ',');
        $pdf->Cell(35, 5, 's/ ' . $total, 0, 1, "C");

        $pdf->Ln();
        // $pdf->Ln();

        $pdf->SetFont('Arial', '', 8);
        // $pdf->MultiCell(ancho, alto, texto, borde, aliniacion, colorFondo);
        $pdf->MultiCell(70, 4, $tienda->leyenda, 0, "C", 0);


        //para ver archivos pdf en codinayter
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("ticket.pdf", "I");
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $venta = $this->ventas->where('id', $id)->first();

        $estado = $this->ventas->update($id, [
            'estado' => 0,
        ]);

        if ($estado) {

            $detalleVenta = $this->detalleVenta->where('id_venta', $venta->id)->findAll();

            foreach ($detalleVenta as $dv) {
                $product = $this->productos->where('id', $dv->id_producto)->first();
                $existencia = $product->existencias + $dv->cantidad;
                $this->productos->update($product->id, [
                    'existencias' => $existencia,
                ]);
            }

            return redirect()->to(base_url() . '/ventas');
        }

        // d($venta->estado);
    }
}
