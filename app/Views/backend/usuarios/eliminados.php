<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Productos Eliminados</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/productos" class="btn btn-info">Volver</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Existencias</th>
                            <th>Restaurar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto) : ?>
                            <tr>
                                <td><?php echo $producto->id; ?></td>
                                <td><?php echo $producto->codigo; ?></td>
                                <td><?php echo $producto->name; ?></td>
                                <td><?php echo $producto->precio_venta; ?></td>
                                <td><?php echo $producto->existencias; ?></td>
                                <td>
                                    <a href="<?php echo base_url('/productos/restablecer?id=' . $producto->id); ?>" class="btn btn-success alertaRestaurar"><i class="fas fa-arrow-circle-up"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $template['footer'] ?>