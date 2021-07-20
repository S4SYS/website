<!--Start Contact-->
<section id="contact" class="section parallax">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">

            <div class="title-box text-center white">
                <h2 class="title">Contato</h2>
            </div>
        </div>

        <!--Start contact form-->
        <div class="col-md-8 col-md-offset-2 contact-form">

            <!--div class="contact-info text-center">
                <p>123 4567 890</p>
                <p>123 lorem ipsum, 4th floor, lorem, ipsum </p>
                <p>mail@demo.com </p>
            </div-->

            
            <div class="row">
                <form id="formContact" action="mail.php" method="post">
                    <div class="col-md-4">
                        <input class="form-control" name="name" id="name" placeholder="Nome Completo" type="text">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" name="email" id="email" placeholder="Seu Email" type="email">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" name="subject" id="subject" placeholder="Assunto" type="text">
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" name="message" id="message" rows="7" placeholder="Sua Mensagem"></textarea>
                    </div>
                </form>
                    <div class="col-md-12 text-right">
                        <button id="sendBtn" class="btn btn-green">ENVIAR</button>
                    </div>
            </div>
            
        </div>
        <!--End contact form-->

    </div> <!-- /.container-->
</section>
<!--End Contact-->

