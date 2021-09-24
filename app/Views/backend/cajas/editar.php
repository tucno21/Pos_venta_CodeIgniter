<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $validation =  \Config\Services::validation(); ?>
    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Editar Unidad</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/unidades" class="btn btn-info">Volver</a>
        </div>
        <form action="<?php echo base_url(); ?>/unidades/actualizar" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control <?php if ($validation->getError('name')) : ?>is-invalid<?php endif ?>" name="name" value="<?php echo $unidad->name; ?>" autofocus required />
                            <?php if ($validation->getError('name')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Nombre Corto</label>
                            <input type="text" class="form-control <?php if ($validation->getError('short_name')) : ?>is-invalid<?php endif ?>" name="short_name" value="<?php echo $unidad->short_name; ?>" autofocus required />
                            <?php if ($validation->getError('short_name')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('short_name') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $unidad->id; ?>">
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