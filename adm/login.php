<?php
@session_start();

require_once '../app/Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>S4SYS - ADM</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    
</head>

<body class="bg-gradient-secondary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 border-left-secondary border-bottom-dark">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4">
                                            <img src="../images/logo_s4sys.png">
                                        </h1>
                                    </div>
                                    <form class="user" id="formLogin" method="post" action="<?=Config::URL_API;?>" onSubmit="return Login.validadeForm();">
                                        <div class="form-group">
                                            <input type="text" class="required form-control form-control-user" id="login" name="login" aria-describedby="emailHelp" placeholder="login">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="required form-control form-control-user" id="senha" name="senha" placeholder="senha">
                                        </div>
                                        <input type="hidden" name="acao" value="login">
                                        <button class="btn btn-primary btn-user btn-block">
                                            Entrar
                                        </button>
                                    </form>
                                    <?php
                                    if (isset($_GET['auth']) && isset($_SESSION['error_message']) && $_GET['auth'] === 'false') {
                                    ?>
                                        <div class="text-center">
                                            <span class="small" style="color:red !important;"><?= $_SESSION['error_message']; ?></a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="text-center">
                                        <p>&nbsp;</p>
                                    </div>
                                    <div class="text-center">
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        class Login 
        {
            static validadeForm() 
            {                
                let counter = 0;
                let $form = $('#formLogin');

                $form.find('.required').each(function() {
                    if (!$(this).val()) {
                        counter++;
                        $(this).focus();
                    }
                });

                if (counter > 0) return false;

                return true;
            }
        }
    </script>


</body>

</html>