<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Compras</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/compras/nuevo" class="btn btn-info">Nueva compra</a>
            <a href="<?php echo base_url(); ?>/compras/eliminados" class="btn btn-warning">Eliminados</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Folio</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($compras as $compra) : ?>
                            <tr>
                                <td><?php echo $compra->id; ?></td>
                                <td><?php echo $compra->folio; ?></td>
                                <td><?php echo $compra->total; ?></td>
                                <td><?php echo $compra->created_at; ?></td>
                                <td>
                                    <a href="<?php echo base_url('/compras/verPdf?id=' . $compra->id); ?>" class="btn btn-success"><i class="far fa-file-pdf"></i></a>
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