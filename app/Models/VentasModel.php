<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table      = 'ventas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    //eliminacion de filas
    protected $useSoftDeletes = false;

    protected $allowedFields = ['folio', 'total', 'id_usuario', 'id_caja', 'id_cliente', 'forma_pago', 'estado'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function obtenerVentas($estado = 1)
    {
        $this->select('ventas.*, U.username AS vendedor, C.name AS cliente');
        $this->join('usuarios AS U', 'ventas.id_usuario = U.id');
        $this->join('clientes AS C', 'ventas.id_cliente = C.id');
        $this->where('ventas.estado', $estado);
        $this->orderBy('ventas.created_at', 'DESC');

        $ventas = $this->findAll();
        return $ventas;
    }

    public function ventasHoy($fechaHoy)
    {
        $this->select("sum(total) AS total");
        $where = "estado = 1 AND DATE(created_at) = '$fechaHoy'";
        $enviar = $this->where($where)->findAll();
        // dd($this->getLastQuery());
        return $enviar;
    }
}
