<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Eliminados</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/unidades" class="btn btn-info">Volver</a>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($unidades as $unidad) : ?>
                            <tr>
                                <td><?php echo $unidad->id; ?></td>
                                <td><?php echo $unidad->name; ?></td>
                                <td><?php echo $unidad->short_name; ?></td>
                                <td>
                                    <a href="<?php echo base_url('/unidades/restablecer?id=' . $unidad->id); ?>" class="btn btn-success alertaRestaurar"><i class="fas fa-arrow-circle-up"></i></a>
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