<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $validation =  \Config\Services::validation(); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Nuevo Producto</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url(); ?>/productos" class="btn btn-info">Volver</a>
        </div>
        <form action="<?php echo base_url(); ?>/productos/insertar" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <div class="card-body">
                <!-- codigo y nombre -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Código</label>
                            <input type="text" class="form-control <?php if ($validation->getError('codigo')) : ?>is-invalid<?php endif ?>" name="codigo" value="<?php echo set_value('codigo'); ?>" autofocus required />
                            <?php if ($validation->getError('codigo')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('codigo') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control <?php if ($validation->getError('name')) : ?>is-invalid<?php endif ?>" name="name" value="<?php echo set_value('name'); ?>" autofocus required />
                            <?php if ($validation->getError('name')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- unidad y categoria -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Unidad</label>
                            <div class="is-invalid">

                                <select class="form-control <?php if ($validation->getError('unidadId')) : ?>is-invalid<?php endif ?>" name="unidadId" required>
                                    <option value="">Seleccione</option>
                                    <?php foreach ($unidades as $unidad) : ?>
                                        <option <?php echo set_value('unidadId') === $unidad->id ? 'selected' : ''; ?> value="<?php echo $unidad->id; ?>"><?php echo $unidad->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php if ($validation->getError('unidadId')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('unidadId') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Categoria</label>

                            <select class="form-control <?php if ($validation->getError('categoriaId')) : ?>is-invalid<?php endif ?>" name="categoriaId" <?php if ($validation->getError('categoriaId')) : ?>is-invalid<?php endif ?>" required>
                                <option value="">Seleccione</option>
                                <?php foreach ($categorias as $cat) : ?>
                                    <option <?php echo set_value('categoriaId') === $cat->id ? 'selected' : ''; ?> value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <?php if ($validation->getError('categoriaId')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('categoriaId') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- precio compra y venta -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Precio de compra</label>
                            <input type="number" class="form-control <?php if ($validation->getError('precio_compra')) : ?>is-invalid<?php endif ?>" name="precio_compra" value="<?php echo set_value('precio_compra'); ?>" autofocus required />
                            <?php if ($validation->getError('precio_compra')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('precio_compra') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Precio de venta</label>
                            <input type="number" class="form-control <?php if ($validation->getError('precio_venta')) : ?>is-invalid<?php endif ?>" name="precio_venta" value="<?php echo set_value('precio_venta'); ?>" autofocus required />
                            <?php if ($validation->getError('precio_venta')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('precio_venta') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- stock minimo y inventarioado? -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Stock Mínimo</label>
                            <input type="number" class="form-control <?php if ($validation->getError('stock_minimo')) : ?>is-invalid<?php endif ?>" name="stock_minimo" value="<?php echo set_value('stock_minimo'); ?>" autofocus required />
                            <?php if ($validation->getError('stock_minimo')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('stock_minimo') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Es Inventariable</label>

                            <select class="form-control <?php if ($validation->getError('inventariable')) : ?>is-invalid<?php endif ?>" name="inventariable" <?php if ($validation->getError('inventariable')) : ?>is-invalid<?php endif ?>" required>
                                <option <?php echo set_value('inventariable') == 1 ? 'selected' : ''; ?> value="1">Si</option>
                                <option <?php echo set_value('inventariable') == 0 ? 'selected' : ''; ?> value="0">No</option>
                            </select>

                            <?php if ($validation->getError('inventariable')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('inventariable') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->
<?= $template['footer'] ?>