<?php

@session_start();

require_once 'app/ApiRequest.php';

final class Index { use ApiRequest; }

?>

<!doctype html>
<!--
	Lamoda by TEMPLATE STOCK
	templatestock.co @templatestock
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->


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


  <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

<body data-spy="scroll" data-target="#main-menu">


  <!--Start Page loader -->
  <div id="pageloader">
    <div class="loader text-center">
      <img src="images/progress.gif" alt='loader' />
    </div>
  </div>
  <!--End Page loader -->

  <?php

  
  require_once 'views/menu.php';

  echo '<span id="mainPages">';
  require_once 'views/modal_politica.php';
  require_once 'views/home.php';
  require_once 'views/servicos.php';
  require_once 'views/sobre.php';
  require_once 'views/historia.php';
  require_once 'views/portfolio.php';
  require_once 'views/time.php';
  require_once 'views/depoimentos.php';  
  require_once 'views/contato.php';
  require_once 'views/lgpd.php';
  echo '</span>';

  echo '<span id="politicaPage" style="display:none;">';
  require_once 'views/politica.php';
  echo '</span>';

  echo '<span id="contatoLgpdPage" style="display:none;">';
  require_once 'views/contato_lgpd.php';
  echo '</span>';

  echo '<span id="portalLgpdPage" style="display:none;">';
  require_once 'views/portal_lgpd.php';
  echo '</span>';

  echo '<span id="successPage" style="display:none;">';
  require_once 'views/success.php';
  echo '</span>';

  require_once 'views/footer.php';


  ?>



  <a href="#" class="scrollup"> <i class="fa fa-chevron-up"> </i> </a>


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

  <script type="text/javascript" src="views/js/Helper.js"></script>

  <!-- Google Recaptcha V3 -->
  <script src="https://www.google.com/recaptcha/api.js?render=6LeMLngUAAAAAJgxYunr01z9AYdOputDgVtqlNcq"></script>

</body>

</html>

<script>

  const POLICY_COOKIE_NAME = '4sys_policy';

  class Lgpd {
    policyModal;

    constructor() {
      this.policyModal = $('#myModal');
    }

    init() 
    {      
      if (!this.getCookie(POLICY_COOKIE_NAME)) this.policyModal.modal('show');
      this.clickEvents();
      this.verifyHashUrl();
    }

    verifyHashUrl()
    {
      let hash = window.location.hash;

      switch(hash){
        case('#success'):
          this.showSuccessContent(400);
          break;
        case('#portal'):
          this.showPortalLgpdContent(400, this);
          break;  
        case('#error'):
          alert('errrrouuu!!');
          break;

        default: return;  
      }
    }

    showSuccessContent(delay)
    {
      $("html, body").animate({ scrollTop: 0 }, delay);
      $('#mainPages, #contatoLgpdPage, #portalLgpdPage, #politicaPage').hide();
      $('#successPage').show();
      $('.topMenu').closest('li').removeClass('active');
      this.policyModal.modal('hide');
    }

    clickEvents() 
    {
      let self = this;
      $('#btnPolitica').click(function() {
        document.cookie = "4sys_policy=true; expires=Fri, 31 Dec 2026 23:59:59 UTC";
        self.policyModal.modal('hide');
      });
      $('#linkPaginaPoliticaFooter').click(function() { self.showPolicyContent(400, self); });
      $('#linkPaginaPoliticaModal').click(function(){ self.showPolicyContent(2000, self); });
      $('#linkPaginaPoliticaLgpd').click(function(){ self.showPolicyContent(2000, self); });
      $('#linkPaginaContatoLgpd').click(function(){ self.showContatoLgpdContent(400, self); });
      $('#linkPaginaPortalLgpd').click(function(){ self.showPortalLgpdContent(400, self); });
      $('#backLgpd').click(function(){ window.location.hash = ''; window.location.reload(); });      
      $('.topMenu').click(function() { 
        self.hidePolicyContent(this); 
        self.hideContatoLgpdContent(this); 
        self.hidePortalLgpdContent(this);
        window.location.hash = ''; 
        $('#successPage').hide();
      });
    }

    showPolicyContent(delay, elem)
    {
      $("html, body").animate({ scrollTop: -100 }, delay);
      $('#mainPages, #contatoLgpdPage, #portalLgpdPage, #successPage').hide();
      $('#politicaPage').show();
      $('#linkPaginaPoliticaMenu').closest('li').addClass('active');      
      //$('.topMenu').closest('li').removeClass('active');
      elem.policyModal.modal('hide');
    }

    hidePolicyContent(elem)
    {
      window.location.hash = '';
      $('#mainPages').show();
      $('#politicaPage').hide();
      $('html, body').stop().animate({ scrollTop: $($(elem).attr('href')).offset().top }, 2000, 'easeOutExpo');
    }

    showContatoLgpdContent(delay, elem)
    {      
      $("html, body").animate({ scrollTop: -100 }, delay);
      $('#mainPages, #politicaPage, #portalLgpdPage, #successPage').hide();
      $('#contatoLgpdPage').show();
      $('#linkPaginaPoliticaMenu').closest('li').addClass('active');      
      //$('.topMenu').closest('li').removeClass('active');
      elem.policyModal.modal('hide');
    }

    hideContatoLgpdContent(elem)
    {
      window.location.hash = '';
      $('#mainPages').show();
      $('#contatoLgpdPage').hide();
      $('html, body').stop().animate({ scrollTop: $($(elem).attr('href')).offset().top }, 2000, 'easeOutExpo');
    }

    showPortalLgpdContent(delay, elem)
    {
      window.location.hash = '';
      $("html, body").animate({ scrollTop: -100 }, delay);
      $('#mainPages, #politicaPage, #contatoLgpdPage, #successPage').hide();
      $('#portalLgpdPage').show();
      $('#linkPaginaPoliticaMenu').closest('li').addClass('active');      
      //$('.topMenu').closest('li').removeClass('active');
      elem.policyModal.modal('hide');
    }

    hidePortalLgpdContent(elem)
    {
      window.location.hash = '';
      $('#mainPages').show();
      $('#portalLgpdPage').hide();
      $('html, body').stop().animate({ scrollTop: $($(elem).attr('href')).offset().top }, 2000, 'easeOutExpo');
    }

    getCookie(cname) {
      let name = cname + "=";
      let decodedCookie = decodeURIComponent(document.cookie);
      let ca = decodedCookie.split(';');
      for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }
  }// end class


  class Contact {
    $form;
    $name;
    $email;
    $subject;
    $message;
    $button;

    constructor() {
      this.$form = $('#formContact');
      this.$button = $('#sendBtn');
      this.$name = this.$form.find('#name');
      this.$email = this.$form.find('#email');
      this.$subject = this.$form.find('#subject');
      this.$message = this.$form.find('#message');
    }

    init() {
      let self = this;
      this.$button.click(() => {
        if (self.validarForm()) {
          this.$button.attr('disabled', true);
          self.validateCaptcha();
        }
      });
    }

    validateCaptcha() {
      let self = this;
      let key = '6LeMLngUAAAAAJgxYunr01z9AYdOputDgVtqlNcq';

      grecaptcha.ready(function() {
        grecaptcha.execute(key, {
          action: 'rastreio'
        }).then((token) => {
          $.get('recaptcha.php', {
            token
          }, function(data) {
            if (data.success == true && data.score > parseFloat(0.5))
              self.sendForm();
            else
              alert('Falha na verifica\u00e7\u00e3o do Recaptcha.');
          }, 'json');
        });
      });
    }

    sendForm() {
      let self = this;
      $.ajax({
        type: "POST",
        url: "mail.php",
        data: this.$form.serialize(),
        cache: false,
        dataType: 'json',
        success: function(data) {
          if (data['success'] == 1)
            alert('Mensagem enviada com sucesso!');

          else
            alert(data['msg']);

          self.cleanForm();
        }
      });
    }

    validarForm() {
      if (!this.$name.val()) {
        this.warning(this.$name, 'Por favor, informe o seu nome.');
        return false;
      }

      if (!this.$email.val()) {
        this.warning(this.$email, 'Por favor, informe o seu email.');
        return false;
      }

      if (!this.$subject.val()) {
        this.warning(this.$subject, 'Por favor, informe o assunto.');
        return false;
      }

      if (!this.$message.val()) {
        this.warning(this.$message, 'Por favor, digite a mensagem.');
        return false;
      }

      return true;
    }

    warning(elem, msg) {
      elem.focus();
      alert(msg);
    }

    cleanForm() {
      this.$name.val('');
      this.$email.val('');
      this.$subject.val('');
      this.$message.val('');
      this.$button.removeAttr('disabled');
    }

  }// end class

  const ID_PORTAL_REQUISICAO = 'opcoesLgpdRequisicao';
  const ID_PORTAL_CONSULTA   = 'opcoesLgpdConsulta';
  const ID_PORTAL_VIOLACAO   = 'opcoesLgpdViolacao';
  const ID_PORTAL_DUVIDAS    = 'opcoesLgpdDuvidas';

  class ViewPortalLgpd
    {
        $form;
        $requisicaoContent;
        $consultaContent;
        $violacaoContent;
        
        showTime;
        buttonLabel;
        dadosApi;
        options;
        acao;

        constructor()
        {
            this.$form = $('#formPortalLgpd'); 
        }

        init()
        {
          this.dadosApi = $.parseJSON('<?=(new Index())->get('index');?>');
          this.showTime = 2000;
          this.setCheckboxChangeEvent();    
        }

        setCheckboxChangeEvent()
        {
          let self = this;
          let $checkboxLgpd = this.$form.find('.checkboxLgpd');

          $checkboxLgpd.change(function(){
              self.setContentByElementId($(this).attr('id'));
          }); 
        }


        setContentByElementId($id)
        {         
          this.$requisicaoContent = this.$form.find('#requisicaoContent');
          this.$consultaContent   = this.$form.find('#consultaContent');
          this.$violacaoContent   = this.$form.find('#violacaoContent');
  
          switch($id){
            case(ID_PORTAL_REQUISICAO):
              this.setRequisicaoContent();
              break;
            case(ID_PORTAL_CONSULTA): 
              this.setConsultaContent();
              break;
            case(ID_PORTAL_VIOLACAO): 
              this.setViolacaoContent();
              break;
            case(ID_PORTAL_DUVIDAS): 
              $('#linkPaginaContatoLgpd').click();
              break;    
          }
        }
        
        setRequisicaoContent()
        {
          this.acao = 'requisicao';
          this.buttonLabel = 'Finalizar e Enviar minha requisi&ccedil;&atilde;o';          
          this.$requisicaoContent
          .show(this.showTime)
          .find('td')
          .html(this.getRequisicaoContent());
          
          this.clearConsultaContent();
          this.clearViolacaoContent();
        }

        getRequisicaoContent()
        {
          return [
            ...this.getTextoLei(),
            ...this.getCampoTipoRequisicao(),
            ...this.getCampoSetor(),
            ...this.getCampoPedido(),
            ...this.getCampoCpf(),
            ...this.getCampoNome(),
            ...this.getCampoTelefone(),
            ...this.getCampoEmail(),
            ...this.getCampoArquivo(),
            ...this.getHiddenAction(),
            ...this.getSendButton()    
          ].join('');
        }
        
        getCampoTipoRequisicao()
        {
          this.options = this.dadosApi.tipo_requisicao.data;
          
          return [
            '<div class="col-md-12">',
            '<select name="tipoRequisicao" id="tipoRequisicao" class="form-control required">',
            ...this.getHtmlOptions(),
            '</select>',
            '</div>'
          ];          
        }

        getCampoSetor()
        {
          this.options = this.dadosApi.setor.data; 
          
          return [
            '<div class="col-md-12">',
            '<label for="setor">Setor</label>',
            '<select name="setor" id="setor" class="form-control required">',
            '<option value="">Selecione o setor que deseja encaminhar a solicita&ccedil;&atilde;o</option>',
            ...this.getHtmlOptions(),
            '</select>',
            '</div>'
          ];                    
        }


        getCampoPedido()
        {
          return [
            '<div class="col-md-12">',
            '<label for="pedido">Pedido<label>',
            '&nbsp;<span style="font-weight:normal !important;">',
            'Informe abaixo a descri&ccedil;&atilde;o da sua requisi&ccedil;&atilde;o:',
            '</span>',
            '<textarea class="form-control required" cols="100" name="pedido" id="pedido">',
            '</textarea>',
            '</div>'
          ];
        }


        getCampoCpf()
        {
          return [
            '<div class="col-md-4">',
            '<label for="cpf">CPF<label>',
            '<input type="text" name="cpf" id="cpf" class="form-control required" maxlength="14" onKeyUp="Helper.getCpfMask(this);">',
            '</div>'
          ];
        }


        getCampoNome()
        {
          return [
            '<div class="col-md-4">',
            '<label for="nome">Nome Completo<label>',
            '<input type="text" name="nome" id="nome" class="form-control required">',
            '</div>'
          ];
        }


        getCampoTelefone()
        {
          return [
            '<div class="col-md-4">',
            '<label for="cpf">Telefone<label>',
            '<input type="text" name="telefone" id="telefone" class="form-control" maxlength="15" onKeyUp="Helper.getPhoneMask(this);">',
            '</div>'
          ];
        }

        getCampoEmail()
        {
          return [
            '<div class="col-md-4">',
            '<label for="cpf">Email<label>',
            '<input type="text" name="email" id="email" class="form-control required">',
            '</div>'
          ];
        }

        getCampoArquivo()
        {
          return [
            '<div class="col-md-6">',
            '<label for="arquivo">Anexar arquivo caso necess&aacute;rio<label>',
            '<input type="file" name="arquivo" id="arquivo" class="form-control">',
            '</div>'
          ];
        }        

        getSendButton()
        {
          return [
            '<div class="col-md-6 text-right">',
            '<button id="sendBtnPortalLgpd" class="btn btn-green">',
            this.buttonLabel,
            '</button>',
            '</div>'
          ];
        }

        clearRequisicaoContent()
        {
          this.$requisicaoContent          
          .hide()
          .find('td')
          .html('');
        }

        setConsultaContent()
        {
          this.acao = 'consulta';
          this.$form.attr('action', 'consulta.php'); 
          this.buttonLabel = 'Enviar';         
          this.$consultaContent
          .show(this.showTime)
          .find('td')
          .html(this.getConsultaContent());

          this.clearRequisicaoContent();
          this.clearViolacaoContent();
        }

        getConsultaContent()
        {
          return [
            ...this.getCampoConsulta(),
            ...this.getHiddenAction(),
            ...this.getSendButton() 
          ].join('');
        }

        getCampoConsulta()
        {
          return [
            '<div class="col-md-6">',
            '<label for="consulta">Consultar o andamento da minha requisi&ccedil;&atilde;o<label>',
            '<input type="text" class="form-control required" name="codigo" id="codigo" maxlength="14">',
            '</div>'
          ];
        }

        clearConsultaContent()
        {
          this.$consultaContent
          .hide()
          .find('td')
          .html('');
        }

        setViolacaoContent()
        {
          this.acao = 'violacao';
          this.buttonLabel = 'Enviar';          
          this.$violacaoContent
          .show(this.showTime)
          .find('td')
          .html(this.getViolacaoContent());

          this.clearRequisicaoContent();
          this.clearConsultaContent();
        }

        getViolacaoContent()
        {
          return [
            ...this.getTextoLei(),
            ...this.getTextoViolacao(),
            ...this.getCampoCpf(),
            ...this.getCampoNome(),
            ...this.getCampoTelefone(),
            ...this.getCampoEmail(),
            ...this.getCampoViolacao(),
            ...this.getCampoArquivo(),
            ...this.getHiddenAction(),
            ...this.getSendButton()
          ].join('');
        }

        getTextoViolacao()
        {
          return [
            '<div class="col-md-12">',
            '<p class="alert alert-warning" role="alert">',
            'A S4Sys adotar&aacute; todas as provid&ecirc;ncias necess&aacute;rias para apurar este incidente,',
            '&nbsp;tomando todas as medidas cab&iacute;veis &agrave; nossa disposi&ccedil;&atilde;o.',
            '&nbsp;Para facilitar a investiga&ccedil;&atilde;o, anexe algum arquivo (formato pdf) necess&aacute;rio &agrave; demonstra&ccedil;&atilde;o e comprova&ccedil;&atilde;o do ocorrido.',
            '&nbsp;A seguir, informe-nos tudo o que aconteceu, em detalhes.',
            '</p>',
            '</div>'
          ];
        }

        getTextoLei()
        {
          return [
            '<div class="col-md-12">',
            '<p class="alert alert-warning" role="alert">',
            'Os dados a seguir ser&atilde;o coletados com a &uacute;nica finalidade de identificar',
            '&nbsp;o titular dos dados pessoais para viabilizar e facilitar',
            '&nbsp;o exerc&iacute;cio de seus direitos previstos na Lei n&ordm; 13.709/2018.',
            '</p>',
            '</div>'
          ];
        }

        getCampoViolacao()
        {
          return [
            '<div class="col-md-12">',
            '<label for="descricao">Reportar uma viola&ccedil;&atilde;o<label>',
            '<textarea class="form-control required" cols="100"  name="descricao" id="descricao">',
            '</textarea>',
            '</div>'
          ];
        }

        clearViolacaoContent()
        {
          this.$violacaoContent
          .hide()          
          .find('td')
          .html('');
        }        

        getHtmlOptions()
        {
          return this.options.map(row => {
              return `<option value="${row.id}">${row.nome}</option>`;
          });
        }

        getHiddenAction()
        {
          return `<input type="hidden" name="acao" value="${this.acao}">`;
        }

    }// end class
  
  var lgpd = new Lgpd();
  var contact = new Contact();
  var viewPortalLgpd = new ViewPortalLgpd(); 

  lgpd.init();
  contact.init();
  viewPortalLgpd.init();


  $('img').each(function() {
    if ($(this).attr('alt') === 'www.000webhost.com')
      $(this).hide();
  });
</script>