<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $validation =  \Config\Services::validation(); ?>
    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Editar Cliente</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/clientes" class="btn btn-info">Volver</a>
        </div>
        <form action="<?php echo base_url(); ?>/clientes/actualizar" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <div class="card-body">
                <!-- nombre y direccion -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control <?php if ($validation->getError('name')) : ?>is-invalid<?php endif ?>" name="name" value="<?php echo $cliente->name; ?>" autofocus required />
                            <?php if ($validation->getError('name')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control <?php if ($validation->getError('direccion')) : ?>is-invalid<?php endif ?>" name="direccion" value="<?php echo $cliente->direccion; ?>" autofocus required />
                            <?php if ($validation->getError('direccion')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('direccion') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- telefono y email -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Telefono</label>
                            <input type="number" class="form-control <?php if ($validation->getError('telefono')) : ?>is-invalid<?php endif ?>" name="telefono" value="<?php echo $cliente->telefono; ?>" autofocus required />
                            <?php if ($validation->getError('telefono')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('telefono') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control <?php if ($validation->getError('email')) : ?>is-invalid<?php endif ?>" name="email" value="<?php echo $cliente->email; ?>" autofocus required />
                            <?php if ($validation->getError('email')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

            </div>
            <div class="card-footer">
                <input type="hidden" name="id" value="<?php echo $cliente->id; ?>">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->
<?= $template['footer'] ?>