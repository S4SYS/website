<!doctype html>
<!--
	Lamoda by TEMPLATE STOCK
	templatestock.co @templatestock
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->


<html lang="en-gb" class="no-js">

<head>
  <link rel="icon" type="image/x-icon" href="/favicon.ico" />
  <meta charset="utf-8">
  <title>S4SYS - Smart for System</title>
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
    <div class="loader">
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
  //require_once 'views/blog.php';
  require_once 'views/depoimentos.php';
  require_once 'views/contato.php';
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

</body>

</html>

<script>

  $(document).ready(function(){
    
    var $form    = $('#formContact');
    var $name    = $form.find('#name');
    var $email   = $form.find('#email');
    var $subject = $form.find('#subject');
    var $message = $form.find('#message');
  
    $('#sendBtn').click(function() {
      if(validarForm()) $form.submit();//sendForm();
    });
       
    function sendForm()
    {
       $.post('mail.php', {
          name    : $name,
          email   : $email,
          subject : $subject,
          message : $message
       }, function(data){
          alert(JSON.stringify(data));
       }, 'json');
    }

    function validarForm()
    {
      if(!$name.val()){
        warning($name, 'Por favor, informe o seu nome.');
        return false;
      }
      
      if(!$email.val()){
        warning($email, 'Por favor, informe o seu email.');
        return false;
      }

      if(!$subject.val()){
        warning($subject, 'Por favor, informe o assunto.');
        return false;
      }

      if(!$message.val()){
        warning($message, 'Por favor, digite a mensagem.');
        return false;
      }

      return true;
    }

    function warning(elem, msg)
    {
      elem.focus();
      alert(msg);
    }

  });

    
</script>