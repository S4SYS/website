<?php
@session_start();
?>
<section id="success" class="section">
    <div class="container">
        <div class="row">
            <p>&nbsp;</p>
            <p class="text-right">
                <button class="btn btn-green" id="backSistema">
                    <span class="fa fa-arrow-left"></span>&nbsp;Voltar ao sistema
                </button>
                <button class="btn btn-green" id="backLgpd">
                    <span class="fa fa-arrow-left"></span>&nbsp;Voltar ao site
                </button>
            </p>
            <div class="alert alert-success text-center" role="alert">
                <p>Sua solicita&ccedil;&atilde;o foi enviada com sucesso.</p>
                <p>Voc&ecirc; receber&aacute; um email com a confirma&ccedil&atilde;o e o c&oacute;digo para consultar o status de sua requisi&ccedil;&atilde;o.</p>
                <?php
                if (isset($_SESSION['codigo'])) {
                ?>
                    <p>C&oacute;digo: <?= $_SESSION['codigo']; ?></p>
                <?php
                }
                ?>
            </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>
    </div>
</section>
<?php
@session_destroy();
unset($_SESSION['codigo']);
?>