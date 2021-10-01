<?= $template['head'] ?>
<?php $id_compra = uniqid(); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-2 text-gray-800 h3">Nueva Venta</h1>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <a href="<?php echo base_url(); ?>/ventas" class="btn btn-info">Volver</a>
        </div>
        <form method="post" id="form_venta" action="<?php echo base_url(); ?>/ventas/guardarVenta" autocomplete="off">


        </form>
    </div>

</div>
<!-- /.container-fluid -->
<?= $template['footer'] ?>