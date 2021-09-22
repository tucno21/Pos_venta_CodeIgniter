<?php
include '../app/Views/backend/sb_admin/head.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Unidades</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url(); ?>/unidades/nuevo" class="btn btn-info">Agregar</a>
            <a href="<?php echo base_url(); ?>/unidades/eliminados" class="btn btn-warning">Eliminados</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Nombre corto</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($unidades as $unidad) : ?>
                            <tr>
                                <td><?php echo $unidad->id; ?></td>
                                <td><?php echo $unidad->name; ?></td>
                                <td><?php echo $unidad->short_name; ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>/unidades/editar<?php echo $unidad->id; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url(); ?>/unidades/eliminar<?php echo $unidad->id; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
<?php
include '../app/Views/backend/sb_admin/footer.php';
?>