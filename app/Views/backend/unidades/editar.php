<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Editar Unidad</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/unidades" class="btn btn-info">Volver</a>
        </div>
        <form action="<?php echo base_url(); ?>/unidades/actualizar" method="post" autocomplete="off">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name">Nombre</label>
                            <input id="name" class="form-control" type="text" name="name" value="<?php echo $unidad->name; ?>" autofocus required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="short_name">Nombre Corto</label>
                            <input id="short_name" class="form-control" type="text" name="short_name" value="<?php echo $unidad->short_name; ?>" autofocus required>
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