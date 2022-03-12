<?php

@session_start();

// Verica se ha a sessao do usuario.
if(!isset($_SESSION['idUsuario'])) die("<script>location.href = 'login.php';</script>");

require_once '../app/File.php';

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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <!--div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div-->
                <div class="sidebar-brand-text mx-3">
                    <img src="../images/logo_s4sys.png">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Requisicao -->
            <li class="nav-item">
                <a class="nav-link sideMenu" data-hash="#requisicao">
                    <i class="fas fa-fw fa-bullhorn"></i>
                    <span>Requisi&ccedil;&atilde;o</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Violacao -->
            <li class="nav-item">
                <a class="nav-link sideMenu" data-hash="#violacao">
                    <i class="fas fa-fw fa-ban"></i>
                    <span>Viola&ccedil;&atilde;o</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Status -->
            <li class="nav-item">
                <a class="nav-link sideMenu" data-hash="#status">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Status</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Procurar..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION['nomeUsuario'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="../api.php" method="post" id="formLogout">
                                    <a class="dropdown-item" href="javascript:document.getElementById('formLogout').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                    <input type="hidden" name="acao" value="logout">
                                </form>                                
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div id="main" class="container-fluid">

                    <!-- Page Heading -->
                    <div id="pageHeading" class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 id="pageTitle" class="h3 mb-4 text-gray-800"></h1>
                    </div>
                    
                    <!-- Loader image -->
                    <div class="mb-12 text-center">
                        <span id="loader"></span>
                    </div>
                    
                    <!-- Content -->
                    <div class="card shadow mb-4" id="bodyContent"></div>    
     
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; S4SYS 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal Padrão -->
    <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <!--button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button-->
                    <a class="btn btn-primary" style="cursor:pointer;" id="btnSalvar">Salvar</a>
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

    <!-- Datatables -->    
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
        
    <!-- Page Views -->
    <script src="views/js/Modal.js"></script>
    <script src="views/js/Lista.js"></script>
    <script src="views/js/Requisicao.js"></script>
    <script src="views/js/Violacao.js"></script>
    <script src="views/js/Status.js"></script>
    <script>
        const HASH_REQUISICAO = '#requisicao';
        const HASH_VIOLACAO   = '#violacao' ;
        const HASH_STATUS     = '#status';
        const FILE_PATH = '<?=File::TARGET_DIR;?>';

        /*
        * Classe que trata o carregamento do conteudo interno, ao carregar a pagina e 
        * de acordo com o menu selecionado.
        */
        class ViewFactory
        {
            $main;
            $title;
            $content;
    
            view;

            constructor()
            {
                this.$main    = $('#main');
                this.$title   = this.$main.find('#pageTitle');
                this.$content = this.$main.find('#bodyContent');
            }

            init()
            {                
                this.setContent();                                
            }            

            setContent()
            {
                let self = this;
                let $loader = this.$main.find('#loader'); 
                $loader.html('<img src="img/loading.gif" width="124" height="124"">');
                $loader.delay(1000).fadeOut('slow', () => {
                    self.getView(self).init(self.$content);
                });
            }

            getView(self)
            {
                switch(window.location.hash){
                    case(HASH_REQUISICAO):
                        self.$title.html('Requisi&ccedil;&otilde;es');
                        return new Requisicao();
                    case(HASH_VIOLACAO):
                        self.$title.html('Viola&ccedil;&otilde;es');
                        return new Violacao();
                    case(HASH_STATUS):
                        self.$title.html('Status');
                        self.$main.append(this.getAddButton().join(''));                        
                        return new Status();       
                    default:
                        self.$title.html('Requisi&ccedil;&otilde;es');
                        return new Requisicao();        
                }
            }

            getAddButton()
            {
                return [
                    `<button id="add" data-hash="${window.location.hash}" data-action="add" onClick="Modal.init(this);" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">`,
                    'Adicionar',
                    '</button>'
                ];
            }           
        }
        
        let viewFactory = new ViewFactory(); 
        viewFactory.init();

         
  
        $('.sideMenu').click(function(){
            window.location.hash = this.dataset.hash;
            window.location.reload(); 
        });     

        $('#actionModal').find('#btnSalvar').click(function(){
            let $form = $('#actionModal').find('form');

            let counter = 0;
            $form.find('.required').each(function(){
                if(!$(this).val()){
                    counter++;
                    $(this).focus();
                }
            });

            if(counter === 0) sendForm($form);
        });

        function sendForm($form)
        {   
            $.ajax({
                type: "POST",
                url: "../api.php",
                data: $form.serialize(),
                processData: false,
                dataType : "json",                
                success: function(response) {
                    if(response['success'] == true) window.location.reload();
                } 
            });            
        }

    </script>


</body>

</html>

