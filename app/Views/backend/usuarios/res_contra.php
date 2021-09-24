<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $validation =  \Config\Services::validation(); ?>
    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Modificar Usuario</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/usuarios" class="btn btn-info">Volver</a>
        </div>
        <form action="<?php echo base_url(); ?>/usuarios/actualizar" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <div class="card-body">
                <!-- username y nombre -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Usuario</label>
                            <input type="text" class="form-control <?php if ($validation->getError('username')) : ?>is-invalid<?php endif ?>" name="username" value="<?php echo $usuario->username; ?>" autofocus required />
                            <?php if ($validation->getError('username')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control <?php if ($validation->getError('name')) : ?>is-invalid<?php endif ?>" name="name" value="<?php echo $usuario->name; ?>" autofocus required />
                            <?php if ($validation->getError('name')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- password y repasword -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Contraseña</label>
                            <input type="text" class="form-control <?php if ($validation->getError('password')) : ?>is-invalid<?php endif ?>" name="password" autofocus required />
                            <?php if ($validation->getError('password')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Repite la contraseña</label>
                            <input type="text" class="form-control <?php if ($validation->getError('repassword')) : ?>is-invalid<?php endif ?>" name="repassword" autofocus required />
                            <?php if ($validation->getError('repassword')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('repassword') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->
<?= $template['footer'] ?>