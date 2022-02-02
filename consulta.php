<?php

if(!isset($_POST['codigo'])) header('Location: ./');

require_once 'app/ApiRequest.php';
require_once 'app/File.php';

final class Consulta
{
    use ApiRequest;
}

?>
<html lang="pt-br" class="no-js">

<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <meta charset="utf-8">
    <title>S4Sys - Smart 4 System</title>
    <meta name="author" content="">
    <meta name="keywords" content="s4sys">
    <meta name="description" content="Inteligência para Negócios Inteligentes">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!--styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="js/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="js/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="js/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="css/magnific-popup.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <link rel="stylesheet" href="css/etlinefont.css">
    <link href="css/style.css" type="text/css" rel="stylesheet" />


</head>

<body data-target="#main-menu">
    <!--Start Page loader -->
    <div id="pageloader">
        <div class="loader text-center">
            <img src="images/progress.gif" alt='loader' />
        </div>
    </div>
    <!--End Page loader -->
    <?php require_once 'views/topo_sem_menu.php'; ?>
    
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="title-box text-center">
                    <h2 class="title">Consulta LGPD</h2>
                </div>
            </div>
            <div class="row">
                <p class="text-right"><button class="btn btn-green" id="backConsulta">Voltar</button></p>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered .table-condensed" id="tableConsulta">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--Plugins-->
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/jquery.easypiechart.js"></script>
    <script type="text/javascript" src="js/jquery.appear.js"></script>
    <script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
    <script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>

</body>

</html>

<script>
    const FILE_PATH = '<?=File::TARGET_DIR;?>';

    class ViewConsulta {
        dadosApi;
        dadosTabela;
        thead;
        tbody;

        init() {
            document.getElementById('backConsulta').addEventListener('click', () => {
                location.href = './'
            });
            this.dadosApi = JSON.parse('<?= (new Consulta())->get("consulta&codigo={$_POST['codigo']}"); ?>');
            this.identificarDados();
            this.setTable();
        }

        identificarDados() {
            if (!this.dadosApi.violacao.data)
                this.setDadosRequisicao();
            else
                this.setDadosViolacao();
        }

        setDadosRequisicao() {
            this.dadosTabela = this.dadosApi.requisicao.data;
            this.thead = this.getTableHeadRequisicao();
            this.tbody = this.getTableBodyRequisicao();
        }

        setDadosViolacao() {
            this.dadosTabela = this.dadosApi.violacao.data;
            this.thead = this.getTableHeadViolacao();
            this.tbody = this.getTableBodyViolacao();
        }

        setTable() {
            let table = document.getElementById('tableConsulta');
            table.children[0].innerHTML = this.thead;
            table.children[1].innerHTML = this.tbody;
        }

        getTableHeadViolacao() {
            return [
                '<tr>',
                '<th>C&oacute;digo</th>',
                '<th>CPF</th>',
                '<th>Email</th>',
                '<th>Telefone</th>',
                `<th>Viola&ccedil;&atilde;o</th>`,
                '<th>Data</th>',
                '<th>Arquivo</th>',
                '<th>Status</th>',
                '</tr>'
            ].join('');
        }

        getTableHeadRequisicao() {
            return [
                '<tr>',
                '<th>C&oacute;digo</th>',
                '<th>CPF</th>',
                '<th>Email</th>',
                '<th>Telefone</th>',
                '<th>Tipo de Requisi&ccedil;&atilde;o</th>',
                '<th>Pedido</th>',
                '<th>Setor</th>',
                '<th>Data</th>',
                '<th>Arquivo</th>',
                '<th>Status</th>',
                '</tr>'
            ].join('');
        }

        getTableBodyViolacao() {
            return [
                '<tr>',
                `<td>${this.dadosTabela.codigo}</td>`,
                `<td>${this.dadosTabela.cpf}</td>`,
                `<td>${this.dadosTabela.email}</td>`,
                `<td>${this.dadosTabela.telefone}</td>`,
                `<td>${this.dadosTabela.descricao}</td>`,
                `<td>${this.dadosTabela.created_at}</td>`,
                `<td>`,
                `<a href="${FILE_PATH}/${this.dadosTabela.arquivo}" target="_blank">${this.dadosTabela.arquivo}</a>`,
                `</td>`,
                `<td>${this.dadosTabela.nome_status}</td>`,
                '</tr>'
            ].join('');
        }

        getTableBodyRequisicao() {
            return [
                '<tr>',
                `<td>${this.dadosTabela.codigo}</td>`,
                `<td>${this.dadosTabela.cpf}</td>`,
                `<td>${this.dadosTabela.email}</td>`,
                `<td>${this.dadosTabela.telefone}</td>`,
                `<td>${this.dadosTabela.nome_tipo_requisicao}</td>`,
                `<td>${this.dadosTabela.pedido}</td>`,
                `<td>${this.dadosTabela.nome_setor}</td>`,
                `<td>${this.dadosTabela.created_at}</td>`,
                `<td>`,
                `<a href="${FILE_PATH}/${this.dadosTabela.arquivo}" target="_blank">${this.dadosTabela.arquivo}</a>`,
                `</td>`,
                `<td>${this.dadosTabela.nome_status}</td>`,
                '</tr>'
            ].join('');
        }
    }

    var consulta = new ViewConsulta();
    consulta.init();
</script>