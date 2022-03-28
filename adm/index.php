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

    <?php require_once 'views/wrapper.php'; ?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php require_once 'views/modal.php'; ?>
    
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

            if(counter === 0){
                $(this).addClass('disabled').text('Aguarde...');
                sendForm($form);
            } 
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
                    //window.location.reload();
                    let reference = window.location.hash.replace('#', '');
                    let id = document.getElementById('btnSalvar').dataset.id;
                    window.location.href = `timeline.php?ref=${reference}&id=${id}`;                    
                } 
            });            
        }

    </script>


</body>

</html>

