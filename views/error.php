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
            <div class="alert alert-danger text-center" role="alert">
                <p>Desculpe, ocorreu um erro em sua solicita&ccedil;&atilde;o.</p>
                <?php
                if (isset($_SESSION['error_message'])) {
                ?>
                    <p><?= $_SESSION['error_message']; ?></p>
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
unset($_SESSION['error_message']);
?>