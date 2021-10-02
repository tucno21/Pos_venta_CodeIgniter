<?= $template['head'] ?>
<?php $id_venta = uniqid(); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Nueva Venta</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/ventas" class="btn btn-info">Volver</a>
        </div>
        <form method="post" id="form_venta" action="<?php echo base_url(); ?>/ventas/guardarVenta" autocomplete="off">

            <input type="hidden" id="id_venta" name="id_venta" value="<?php echo $id_venta; ?>">
            <div class="card-body">

                <!-- grupo -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ui-widget">
                                <label for="clienteV">Cliente:</label>
                                <input id="id_cliente" class="form-control" type="hidden" name="id_cliente" value="1">
                                <input id="clienteV" class="form-control" type="text" name="cliente" placeholder="Escribe el nombre" value="Publico en general" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="forma_pago">Forma de pago:</label>
                            <select name="forma_pago" id="forma_pago" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <option selected value="001">Efectivo</option>
                                <option value="002">Tarjeta</option>
                                <option value="003">Transferencia</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- grupo -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Código de barras</label>
                            <input type="hidden" id="id_producto" name="id_producto" />
                            <input type="text" id="codigoVenta" class="form-control" name="codigo" autofocus placeholder="Ingresa el codigo y enter" />
                            <div id="errorProducto"></div>
                        </div>
                        <div class="col-12 col-sm-4 text-center">
                            <div class="">-</div>
                            <label style="font-weight: bold; font-size: 30px; text-align: center;">TOTAL S/</label>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="text-danger">-</div>
                            <input type="text" id="totalVenta" name="totalVenta" size="7" value="0.00" readonly="true" style="font-weight: bold; font-size: 30px; text-align: center;">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" id="completa_venta" class="btn btn-primary">Completar Venta</button>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <table class="table table-hover table-striped table-responsive tablaproductosVenta" width="100%">
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
            </div>

        </form>
    </div>

</div>
<!-- /.container-fluid -->
<?= $template['footer'] ?>