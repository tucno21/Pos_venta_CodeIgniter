<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Ventas Eliminadas</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/ventas" class="btn btn-info">Volver</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableVentas" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Folio</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Vendedor</th>
                            <th>PDF</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas as $venta) : ?>
                            <tr>
                                <td><?php echo $venta->created_at; ?></td>
                                <td><?php echo $venta->folio; ?></td>
                                <td><?php echo $venta->cliente; ?></td>
                                <td><?php echo $venta->total; ?></td>
                                <td><?php echo $venta->vendedor; ?></td>
                                <td>
                                    <a href="<?php echo base_url('/ventas/verPdf?id=' . $venta->id); ?>" class="btn btn-success"><i class="far fa-file-pdf"></i></a>
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