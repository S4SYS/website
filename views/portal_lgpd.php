<section id="portal_lgpd" class="section">

    <div class="container">

        <div class="row">
            <div class="title-box text-center">
                <h2 class="title">Portal LGPD</h2>
            </div>
        </div>
        <p>
            Respeitamos a sua privacidade e disponibilizamos recursos em nosso Portal LGPD garantindo o exerc&iacute;cio dos seus direitos na Lei Geral de Prote&ccedil;&atilde;o de Dados Pessoais.
        </p>
        <!--p>
            Selecione abaixo a(s) op&ccedil;&atilde;o(&otilde;es) desejada(s):
        </p-->
        <p>
        A privacidade dos seus dados &eacute; nossa responsabilidade, caso queira solicitar informa&ccedil;&otilde;es 
        e exercer de direitos previstos na Lei Geral de Prote&ccedil;&atilde;o de Dados (LGPD), 
        selecione as op&ccedil;&otilde;es abaixo e preencha as etapas.
        </p>

        <div class="col-md-8 col-md-offset-2 contact-form">
            <div class="row">
                <form id="formPortalLgpd" name="formPortalLgpd" action="api.php" method="post" enctype="multipart/form-data" 
                onSubmit="return Helper.validateForm($(this));">
                    <div class="col-md-12">
                        <table class="table table-condensed table-striped">
                            <tr>
                                <td>
                                    <label for="opcoesLgpdRequisicao">Requisi&ccedil;&atilde;o</label>
                                </td>
                                <td>
                                    <input type="radio" class="form-control checkboxLgpd"  name="opcoesLgpd" id="opcoesLgpdRequisicao" aria-describedby="basic-addon1">
                                </td>                                
                            </tr>
                            <tr id="requisicaoContent">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="opcoesLgpdConsulta">Consulta</label>
                                </td>
                                <td>
                                    <input type="radio" class="form-control  checkboxLgpd"  name="opcoesLgpd" id="opcoesLgpdConsulta" aria-describedby="basic-addon1">
                                </td>
                            </tr>
                            <tr id="consultaContent">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="opcoesLgpdViolacao">Reportar uma viola&ccedil;&atilde;o</label>
                                </td>
                                <td>
                                    <input type="radio" class="form-control checkboxLgpd"  name="opcoesLgpd" id="opcoesLgpdViolacao" aria-describedby="basic-addon1">
                                </td>
                            </tr>
                            <tr id="violacaoContent">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="opcoesLgpdDuvidas">D&uacute;vidas e Contato</label>
                                </td>
                                <td>
                                    <input type="radio" class="form-control checkboxLgpd"  name="opcoesLgpd" id="opcoesLgpdDuvidas" aria-describedby="basic-addon1">
                                </td>
                            </tr>
                            <tr id="duvidasContent">
                                <td colspan="2"></td>
                            </tr>
                        </table> 
                </form>                                
            </div>
        </div>
    </div>
</section>
