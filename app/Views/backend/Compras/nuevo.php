<?= $template['head'] ?>
<?php $id_compra = uniqid(); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $validation =  \Config\Services::validation(); ?>
    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Nuevo Compra</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/compras" class="btn btn-info">Volver</a>
        </div>
        <form method="post" id="form_compra" action="<?php echo base_url(); ?>/compras/guardarCompra" autocomplete="off">
            <?= csrf_field() ?>
            <div class="card-body">
                <!-- grupo -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Código</label>
                            <input type="text" id="codigoCompra" class="form-control" name="codigo" value="" autofocus placeholder="Ingresa el codigo y enter" />
                            <div id="errorProducto"></div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Nombre del Producto</label>
                            <input id='nameProducto' type="text" class="form-control" name="name" autofocus required disabled />
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Cantidad</label>
                            <input id='cantidadProducto' type="number" class="form-control" name="cantidad" value="" autofocus required min="1" />
                        </div>
                    </div>
                </div>
                <!-- grupo -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Precio de Compra</label>
                            <input id='PrecioProducto' type="number" class="form-control" name="precio_compra" value="" autofocus required disabled />
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Sub Total</label>
                            <input id='SubtotalProducto' type="number" class="form-control" name="subtotal" value="" autofocus required disabled />
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="text-white form-label">__</label>
                            <input type="hidden" id="idProducto" name="idProducto">
                            <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra; ?>">
                            <button id="agregarProducto" type="button" class="btn btn-primary btn-block">Agregar Producto</button>
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
                        <label style="font-weight: bold; font-size: 30px; text-align: center;">TOTAL S/</label>
                        <input type="text" id="totalCompra" name="totalCompra" size="7" value="0.00" readonly="true" style="font-weight: bold; font-size: 30px; text-align: center;">
                        <button type="button" id="completa_compra" class="btn btn-primary">Completar Compra</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->
<?= $template['footer'] ?>