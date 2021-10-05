<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table      = 'productos';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    //eliminacion de filas
    protected $useSoftDeletes = false;

    protected $allowedFields = ['codigo', 'name', 'precio_compra', 'precio_venta', 'existencias', 'stock_minimo', 'inventariable', 'unidadId', 'categoriaId', 'estado'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function productosMinimos()
    {
        $where = "stock_minimo >= existencias AND inventariable = 1 AND estado = 1";
        $datos = $this->where($where)->countAllResults();
        return $datos;
    }
}
