<?php

namespace App\Controllers;

use App\Models\UnidadesModel;
use App\Models\ProductosModel;
use App\Models\CategoriasModel;

class Productos extends BaseController
{

    protected $productos;
    protected $categorias;
    protected $unidades;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->productos = new ProductosModel();
        $this->categorias = new CategoriasModel();
        $this->unidades = new UnidadesModel();
    }

    //crear una variable sobre el estado y solo mostrar
    public function index($estado = 1)
    {
        //buscar el estado en la tabla
        $productos = $this->productos->where('estado', 1)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/productos/index', [
            'productos' => $productos,
            'template' => $template,
        ]);
    }

    public function nuevo()
    {
        $categorias = $this->categorias->where('estado', 1)->findAll();
        $unidades = $this->unidades->where('estado', 1)->findAll();

        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        return view('backend/productos/nuevo', [
            'template' => $template,
            'categorias' => $categorias,
            'unidades' => $unidades,
        ]);
    }


    public function insertar()
    {
        $inputs = $this->validate([
            'codigo' => 'required|min_length[3]|is_unique[productos.codigo]',
            'name' => 'required|min_length[3]',
            'unidadId' => 'required|numeric|is_not_unique[unidades.id]',
            'categoriaId' => 'required|numeric|is_not_unique[categorias.id]',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'stock_minimo' => 'required|numeric',
            'inventariable' => 'required|numeric',
        ]);

        if (!$inputs) {
            $categorias = $this->categorias->where('estado', 1)->findAll();
            $unidades = $this->unidades->where('estado', 1)->findAll();

            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/productos/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
                'categorias' => $categorias,
                'unidades' => $unidades,
            ]);
        } else {
            $this->productos->save([
                'codigo' => $this->request->getPost('codigo'),
                'name' => $this->request->getPost('name'),
                'unidadId' => $this->request->getPost('unidadId'),
                'categoriaId' => $this->request->getPost('categoriaId'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable')
            ]);

            return redirect()->to(base_url() . '/productos');
        }
    }

    public function editar()
    {
        $id = $_GET['id'];
        $producto = $this->productos->where('id', $id)->first();
        // print_r($productos);

        $categorias = $this->categorias->where('estado', 1)->findAll();
        $unidades = $this->unidades->where('estado', 1)->findAll();

        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/productos/editar', [
            'producto' => $producto,
            'template' => $template,
            'categorias' => $categorias,
            'unidades' => $unidades,
        ]);
    }

    public function actualizar()
    {
        $inputs = $this->validate([
            'codigo' => 'required|min_length[3]|is_unique[productos.codigo]',
            'name' => 'required|min_length[3]',
            'unidadId' => 'required|numeric|is_not_unique[unidades.id]',
            'categoriaId' => 'required|numeric|is_not_unique[categorias.id]',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'stock_minimo' => 'required|numeric',
            'inventariable' => 'required|numeric',
        ]);

        if (!$inputs) {
            $categorias = $this->categorias->where('estado', 1)->findAll();
            $unidades = $this->unidades->where('estado', 1)->findAll();

            $template['head'] =  view('backend/sb_admin/head');
            $template['footer'] =  view('backend/sb_admin/footer');
            return view('backend/productos/nuevo', [
                'validation' => $this->validator,
                'template' => $template,
                'categorias' => $categorias,
                'unidades' => $unidades,
            ]);
        } else {

            $this->productos->update($this->request->getPost('id'), [
                'codigo' => $this->request->getPost('codigo'),
                'name' => $this->request->getPost('name'),
                'unidadId' => $this->request->getPost('unidadId'),
                'categoriaId' => $this->request->getPost('categoriaId'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable')
            ]);

            return redirect()->to(base_url() . '/productos');
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $this->productos->update($id, [
            'estado' => 0
        ]);

        return redirect()->to(base_url() . '/productos');
    }

    //crear una variable sobre el estado y solo mostrar
    public function eliminados($estado = 0)
    {
        //buscar el estado en la tabla
        $productos = $this->productos->where('estado', $estado)->findAll();

        // print_r($data);
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');
        // print_r($template['head']);

        return view('backend/productos/eliminados', [
            'productos' => $productos,
            'template' => $template,
        ]);
    }

    public function restablecer()
    {
        $id = $_GET['id'];
        $this->productos->update($id, [
            'estado' => 1
        ]);

        return redirect()->to(base_url() . '/productos');
    }

    public function verPdf()
    {
        $template['head'] =  view('backend/sb_admin/head');
        $template['footer'] =  view('backend/sb_admin/footer');

        return view('backend/productos/verPdf', [
            'template' => $template,
        ]);
    }

    public function codebar()
    {
        $generaBarcode = new \bar_code();

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10, 10);
        $pdf->SetTitle('Código de barras');

        $productos = $this->productos->where('estado', 1)->findAll();

        foreach ($productos as $producto) {
            $codigo = $producto->codigo;

            $generaBarcode->barcode($codigo . '.png', $codigo, 20, 'horizontal', 'code128', true);

            $pdf->Image($codigo . '.png');
        }
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('codigo.pdf', 'I');

        // d($productos);
    }
}
