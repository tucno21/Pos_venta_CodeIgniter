<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $validation =  \Config\Services::validation(); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Configuraciones</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url(); ?>/dashboard" class="btn btn-info">Panel Informativo</a>
        </div>
        <form action="<?php echo base_url(); ?>/configuraciones/actualizar" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <div class="card-body">
                <!-- nombre y RFC -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Nombre de la tienda</label>
                            <input type="text" class="form-control <?php if ($validation->getError('name')) : ?>is-invalid<?php endif ?>" name="name" value="<?php echo $config->name; ?>" autofocus required />
                            <?php if ($validation->getError('name')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">RFC</label>
                            <input type="text" class="form-control <?php if ($validation->getError('rfc')) : ?>is-invalid<?php endif ?>" name="rfc" value="<?php echo $config->rfc; ?>" autofocus required />
                            <?php if ($validation->getError('rfc')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('rfc') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Telefono y correo -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Telefono de la tienda</label>
                            <input type="number" class="form-control <?php if ($validation->getError('telefono')) : ?>is-invalid<?php endif ?>" name="telefono" value="<?php echo $config->telefono; ?>" autofocus required />
                            <?php if ($validation->getError('telefono')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('telefono') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control <?php if ($validation->getError('email')) : ?>is-invalid<?php endif ?>" name="email" value="<?php echo $config->email; ?>" autofocus required />
                            <?php if ($validation->getError('email')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- direccion y leyenda -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Direción</label>
                            <input type="text" class="form-control <?php if ($validation->getError('direccion')) : ?>is-invalid<?php endif ?>" name="direccion" value="<?php echo $config->direccion; ?>" autofocus required />
                            <?php if ($validation->getError('direccion')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('direccion') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Leyenda del ticket</label>
                            <input type="text" class="form-control <?php if ($validation->getError('leyenda')) : ?>is-invalid<?php endif ?>" name="leyenda" value="<?php echo $config->leyenda; ?>" autofocus required />
                            <?php if ($validation->getError('leyenda')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('leyenda') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- LOGO -->
                <div class="form-group">
                    <label for="imagen">Logo de la tienda:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <spam class="input-group-text"><i class="fab fa-slack"></i></spam>
                        </div>
                        <input type="file" name="logo" id="imagen" class="visorFoto" multiple>
                    </div>
                </div>
                <div class="form-group">
                    <div class="card" style="width: 8rem;">
                        <?php if (isset($config->logo)) : ?>
                            <img class="img-thumbnail card-img-top previsualizar" src="../imagenes/<?php echo $candidato->logo; ?>" alt="Card image cap">
                        <?php else : ?>
                            <img class="img-thumbnail card-img-top previsualizar" src="../backendAL/img/voto.jpg" alt="Card image cap">
                        <?php endif; ?>
                        <div class="card-body">
                            <p class="card-text">Peso máximo de 1mb</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="id" value="<?php echo $config->id; ?>">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->
<?= $template['footer'] ?>