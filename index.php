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
  <meta name="keywords" content="">
  <meta name="description" content="">

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
  require_once 'views/home.php';
  require_once 'views/sobre.php';
  require_once 'views/historia.php';
  require_once 'views/portfolio.php';
  require_once 'views/time.php';
  require_once 'views/servicos.php';
  //require_once 'views/depoimentos.php';
  require_once 'views/contato.php';
  require_once 'views/footer.php';
  require_once 'views/modal_politica.php';
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
</body>

</html>

<script>
  const POLICY_COOKIE_NAME = '4sys_policy';

  class Politica {
    policyModal;

    constructor() {
      this.policyModal = $('#myModal');
    }

    init() {
      if (!this.getCookie(POLICY_COOKIE_NAME)) this.policyModal.modal('show');
      this.clickEvent();
    }

    clickEvent() {
      let self = this;
      $('#btnPolitica').click(function() {
        document.cookie = "4sys_policy=true; expires=Fri, 31 Dec 2021 23:59:59 UTC";
        self.policyModal.modal('hide');
      });
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
  }


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
          $(this).attr('disabled', true);
          self.sendForm();
        }
      });
    }

    sendForm() {
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

          this.cleanForm();
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

  }

  var politica = new Politica();
  var contact = new Contact();

  politica.init();
  contact.init();

  $('img').each(function() {
    if ($(this).attr('alt') === 'www.000webhost.com')
      $(this).hide();
  });
</script>