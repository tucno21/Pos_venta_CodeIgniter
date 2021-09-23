<?= $template['head'] ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Editar Categoria</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/categorias" class="btn btn-info">Volver</a>
        </div>
        <form action="<?php echo base_url(); ?>/categorias/actualizar" method="post" autocomplete="off">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name">Nombre</label>
                            <input id="name" class="form-control" type="text" name="name" value="<?php echo $categoria->name; ?>" autofocus required>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $categoria->id; ?>">
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