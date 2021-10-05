<?php
include '../app/Views/backend/sb_admin/head.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Dashboard</h1>
        <a href="#" class="shadow-sm d-none d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total de productos -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">
                                Total de Prouctos</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">
                                <?php echo $totalProductos; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-box-open fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url() . '/productos'; ?>">Ver detalles</a>
                </div>
            </div>
        </div>
        <!-- ventas del dia -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">
                                Ventas del Día</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">
                                <?php if ($ventasHoy[0]->total == null) {
                                    echo '0';
                                } else {
                                    echo $ventasHoy[0]->total;
                                } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-cash-register fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="text-success" href="<?php echo base_url() . '/ventas'; ?>">Ver detalles</a>
                </div>
            </div>
        </div>

        <!-- Productos con Stock Minimo -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-info h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-info text-uppercase">
                                Productos con Stock Mínimo</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">
                                <?php echo $stockMinimo; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-layer-group fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="text-info" href="<?php echo base_url() . '/ventas'; ?>">Ver detalles</a>
                </div>
            </div>
        </div>

    </div>
    <!-- Content Row -->

</div>
<!-- /.container-fluid -->
<?php
include '../app/Views/backend/sb_admin/footer.php';
?>