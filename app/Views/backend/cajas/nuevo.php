<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $validation =  \Config\Services::validation(); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Nuevo Caja</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url(); ?>/cajas" class="btn btn-info">Volver</a>
        </div>
        <form action="<?php echo base_url(); ?>/cajas/insertar" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <div class="card-body">

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Numero de caja</label>
                            <input type="number" class="form-control <?php if ($validation->getError('numero_caja')) : ?>is-invalid<?php endif ?>" name="numero_caja" value="<?php echo set_value('numero_caja'); ?>" autofocus required />
                            <?php if ($validation->getError('numero_caja')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('numero_caja') ?>
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

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Folio</label>
                            <input type="number" class="form-control <?php if ($validation->getError('folio')) : ?>is-invalid<?php endif ?>" name="folio" value="<?php echo set_value('folio'); ?>" autofocus required />
                            <?php if ($validation->getError('folio')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('folio') ?>
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