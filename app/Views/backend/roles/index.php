<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Roles</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/roles/nuevo" class="btn btn-info">Agregar</a>
            <a href="<?php echo base_url(); ?>/roles/eliminados" class="btn btn-warning">Eliminados</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $rol) : ?>
                            <tr>
                                <td><?php echo $rol->id; ?></td>
                                <td><?php echo $rol->name; ?></td>
                                <td>
                                    <a href="<?php echo base_url('/roles/editar?id=' . $rol->id); ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('/roles/eliminar?id=' . $rol->id); ?>" class="btn btn-danger alertaBorrar"><i class="fas fa-trash-alt"></i></a>
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