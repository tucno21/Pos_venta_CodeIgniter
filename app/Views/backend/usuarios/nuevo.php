<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $validation =  \Config\Services::validation(); ?>
    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Nuevo Producto</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/usuarios" class="btn btn-info">Volver</a>
        </div>
        <form action="<?php echo base_url(); ?>/usuarios/insertar" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <div class="card-body">
                <!-- usuarios y nombre -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Usuario</label>
                            <input type="text" class="form-control <?php if ($validation->getError('username')) : ?>is-invalid<?php endif ?>" name="username" value="<?php echo set_value('username'); ?>" autofocus required />
                            <?php if ($validation->getError('username')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username') ?>
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

                <!-- Password -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control <?php if ($validation->getError('password')) : ?>is-invalid<?php endif ?>" name="password" value="<?php echo set_value('password'); ?>" autofocus required />
                            <?php if ($validation->getError('password')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Repite Contraseña</label>
                            <input type="password" class="form-control <?php if ($validation->getError('repassword')) : ?>is-invalid<?php endif ?>" name="repassword" value="<?php echo set_value('repassword'); ?>" autofocus required />
                            <?php if ($validation->getError('repassword')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('repassword') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- unidad y categoria -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Caja</label>

                            <select class="form-control <?php if ($validation->getError('id_rol')) : ?>is-invalid<?php endif ?>" name="id_rol" <?php if ($validation->getError('id_rol')) : ?>is-invalid<?php endif ?>" required>
                                <option value="">Seleccione</option>
                                <?php foreach ($cajas as $caja) : ?>
                                    <option <?php echo set_value('id_rol') === $caja->id ? 'selected' : ''; ?> value="<?php echo $caja->id; ?>"><?php echo $caja->name; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <?php if ($validation->getError('id_rol')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('id_rol') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Rol</label>
                            <div class="is-invalid">

                                <select class="form-control <?php if ($validation->getError('id_caja')) : ?>is-invalid<?php endif ?>" name="id_caja" required>
                                    <option value="">Seleccione</option>
                                    <?php foreach ($roles as $rol) : ?>
                                        <option <?php echo set_value('id_caja') === $rol->id ? 'selected' : ''; ?> value="<?php echo $rol->id; ?>"><?php echo $rol->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php if ($validation->getError('id_caja')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('id_caja') ?>
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