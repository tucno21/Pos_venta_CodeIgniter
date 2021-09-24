<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <?php $validation =  \Config\Services::validation(); ?>
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="my-5 border-0 shadow-lg card o-hidden">
                    <div class="p-0 card-body">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="mb-4 text-gray-900 h4">Bienvenido</h1>
                                    </div>
                                    <form class="user" method="post" action="<?php echo base_url(); ?>">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user <?php if ($validation->getError('username')) : ?>is-invalid<?php endif ?>" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ingresa el ususario...">

                                            <?php if ($validation->getError('username')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('username') ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (isset($errorName)) : ?>
                                                <div class="alert alert-danger">
                                                    <?php echo $errorName; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user <?php if ($validation->getError('password')) : ?>is-invalid<?php endif ?>" id="exampleInputPassword" placeholder="Ingresa tu contraseña">

                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('password') ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (isset($errorPass)) : ?>
                                                <div class="alert alert-danger">
                                                    <?php echo $errorPass; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Entrar</button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>