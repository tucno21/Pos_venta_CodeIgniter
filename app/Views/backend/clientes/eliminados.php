<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Clientes Eliminados</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/clientes" class="btn btn-info">Volver</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>email</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente) : ?>
                            <tr>
                                <td><?php echo $cliente->id; ?></td>
                                <td><?php echo $cliente->name; ?></td>
                                <td><?php echo $cliente->direccion; ?></td>
                                <td><?php echo $cliente->telefono; ?></td>
                                <td><?php echo $cliente->email; ?></td>
                                <td>
                                    <a href="<?php echo base_url('/clientes/restablecer?id=' . $cliente->id); ?>" class="btn btn-success alertaRestaurar"><i class="fas fa-arrow-circle-up"></i></a>
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