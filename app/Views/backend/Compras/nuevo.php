<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $validation =  \Config\Services::validation(); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Nuevo Compra</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url(); ?>/compras" class="btn btn-info">Volver</a>
        </div>
        <form action="<?php echo base_url(); ?>/compras/insertar" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <div class="card-body">
                <!-- grupo -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Código</label>
                            <input type="text" class="form-control <?php if ($validation->getError('codigo')) : ?>is-invalid<?php endif ?>" name="codigo" value="<?php echo set_value('codigo'); ?>" autofocus placeholder="Ingresa el codigo y enter" />
                            <?php if ($validation->getError('codigo')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('codigo') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" name="name" value="" autofocus required disabled />
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" value="" autofocus required />
                        </div>
                    </div>
                </div>
                <!-- grupo -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Precio de Compra</label>
                            <input type="number" class="form-control" name="precio_compra" value="" autofocus required />
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Sub Total</label>
                            <input type="number" class="form-control" name="subtotal" value="" autofocus required disabled />
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label text-white">__</label>
                            <button type="button" class="btn btn-primary btn-block">Agregar Producto</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <table class="table table-hover table-striped table-responsive tablaproductos" width="100%">
                        <thead class="thead-dark">
                            <th>#</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th width="1%"></th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6 offset-md-6">

                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->
<?= $template['footer'] ?>