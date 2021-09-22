<?php
include '../app/Views/backend/sb_admin/head.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Nuevo Unidad</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url(); ?>/unidades" class="btn btn-info">Volver</a>
        </div>
        <form action="<?php echo base_url(); ?>/unidades/insertar" method="post" autocomplete="off">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name">Nombre</label>
                            <input id="name" class="form-control" type="text" name="name" autofocus required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="short_name">Nombre Corto</label>
                            <input id="short_name" class="form-control" type="text" name="short_name" autofocus required>
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
<?php
include '../app/Views/backend/sb_admin/footer.php';
?>