<?= $template['head']; ?>
<!-- Begin Page Content -->
<div class="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="panel">
                    <div class="embed-responsive embed-responsive-4by3" style="margin-top: 30px;">
                        <iframe class="embed-responsive-item" src="<?php echo base_url('/ventas/generapdf?id=' . $id->id); ?>"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!-- /.container-fluid -->
<?= $template['footer'] ?>