<?php

namespace App\Controllers;


use stdClass;
use App\Models\ComprasModel;
use App\Models\ProductosModel;
use App\Models\DetalleCompraModel;
use App\Models\TemporalComprasModel;

class Compras extends BaseController
{

    protected $compras, $comprasTemporal, $productos, $detalleCompra;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->compras = new ComprasModel();
        $this->productos = new ProductosModel();
        $this->comprasTemporal = new TemporalComprasModel();
        $this->detalleCompra = new DetalleCompraModel();
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
}
