<?php

@session_start();

// Verica se ha a sessao do usuario.
if (!isset($_SESSION['idUsuario'])) die("<script>location.href = 'login.php';</script>");

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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Css for timeline -->
    <link href="css/timeline.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php require_once 'views/wrapper.php'; ?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page Views -->
    <script src="views/js/Lista.js"></script>
    <script src="views/js/Requisicao.js"></script>
    <script src="views/js/Violacao.js"></script>

    <script>
        const REF_REQUISICAO = 'requisicao';
        const REF_VIOLACAO = 'violacao';
        const REF_STATUS = 'status';

        const urlParams = new URLSearchParams(window.location.search);

        class TimelineFactory 
        {
            id;
            acao;
            reference;
            $main;
            $title;
            $content;

            constructor() 
            {
                this.id = urlParams.get('id');
                this.reference = urlParams.get('ref');
                this.$main = $('#main');
                this.$title = this.$main.find('#pageTitle');
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
                    self.getView(self).getLog(self);
                });
            }
            
            getView(self) 
            {
                switch (self.reference) {
                    case (REF_REQUISICAO):
                        self.$title.html(`Timeline - Requisi&ccedil;&atilde;o #${self.id}`);
                        self.acao = 'get_requisicao_log';
                        return self.getLog(self); 
                    case (REF_VIOLACAO):
                        self.$title.html(`Timeline - Viola&ccedil;&atilde;o #${self.id}`);
                        self.acao = 'get_violacao_log';
                        return self.getLog(self);
                    case (REF_STATUS):
                        self.$title.html(`Timeline - Status #${self.id}`);
                        self.acao = 'get_status_log';
                        return self.getLog(self);
                    default:
                        self.$title.html(`Timeline - Requisi&ccedil;&atilde;o #${self.id}`);
                        self.acao = 'get_requisicao_log';
                        return self.getLog(self);
                }
            }                      

            getLog(self) 
            {
                $.get('../api.php', {
                    id: self.id,
                    acao: self.acao
                }, function(response) {
                    self.$content.html(self.getCard(response.data).join(''));
                }, 'json');
            }

            getCard(dados) 
            {
                return [
                    ...this.getCardHeader(),
                    ...this.getCardBody(dados),
                ];
            }

            getCardHeader() 
            {
                return [
                    '<div class="card-header py-3">',
                    '<h6 class="m-0 font-weight-bold text-primary">',
                    'Timeline',
                    '</h6>',
                    '</div>'
                ];
            }

            getCardBody(dados) 
            {
                return [
                    '<div class="card-body">',
                    ...this.getList(dados),
                    '</div>'
                ];
            }

            getList(dados) 
            {
                return [
                    '<ul class="timeline">',
                    ...this.getItems(dados),
                    '</ul>'
                ];
            }

            getItems(dados) 
            {
                if(dados.length === 0) return ['<li>','N&atilde;o h&aacute; dados para exibir.','</li>'];
                return dados.map(row => {
                    return `
                        <li>
                        <div class="timeline-badge info"><i class="fa fa-check"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">${row.comentario}</h4>
                                <p><small class="text-muted"><i class="fa fa-clock"></i> ${row.created_at}</small></p>
                            </div>
                            <div class="timeline-body">
                                <p>${row.descricao}</p>
                            </div>
                        </div>
                    </li>`;
                });
            }
        }

        let timeline = new TimelineFactory();
        timeline.init();


        $('.sideMenu').click(function() {
            window.location.href = `../adm/${this.dataset.hash}`;
        });
    </script>

</body>

</html>