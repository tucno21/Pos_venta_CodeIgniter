<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Cajas</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/cajas/nuevo" class="btn btn-info">Agregar</a>
            <a href="<?php echo base_url(); ?>/cajas/eliminados" class="btn btn-warning">Eliminados</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Numero de caja</th>
                            <th>Nombre</th>
                            <th>Folio</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cajas as $caja) : ?>
                            <tr>
                                <td><?php echo $caja->id; ?></td>
                                <td><?php echo $caja->numero_caja; ?></td>
                                <td><?php echo $caja->name; ?></td>
                                <td><?php echo $caja->folio; ?></td>
                                <td>
                                    <a href="<?php echo base_url('/cajas/editar?id=' . $caja->id); ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('/cajas/eliminar?id=' . $caja->id); ?>" class="btn btn-danger alertaBorrar"><i class="fas fa-trash-alt"></i></a>
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