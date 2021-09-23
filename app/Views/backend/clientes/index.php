<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Clientes</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/clientes/nuevo" class="btn btn-info">Agregar</a>
            <a href="<?php echo base_url(); ?>/clientes/eliminados" class="btn btn-warning">Eliminados</a>
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
                                    <a href="<?php echo base_url('/clientes/editar?id=' . $cliente->id); ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('/clientes/eliminar?id=' . $cliente->id); ?>" class="btn btn-danger alertaBorrar"><i class="fas fa-trash-alt"></i></a>
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