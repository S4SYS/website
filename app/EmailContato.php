<?php

require_once 'PhpMailer/PhpMailer.php';


final class EmailContato
{
    const SMTP_HOST     = 'smtp-mail.outlook.com';
    const SMTP_PORT     = 587;
    const SMTP_AUTH     = true;
    const SMTP_SECURE   = 'tls';
    const SMTP_DEBUG    = false;
    const SMTP_DO_DEBUG = 0;

    const MAIL_USER = 'contato@s4sys.com.br';
    const MAIL_PASS = 'X52HtI7rFRaV9S5*Aguwa^X1';
    const MAIL_FROM = 'contato@s4sys.com.br'; 
    //const MAIL_TO   = 'deployment@s4sys.com.br';
    const MAIL_TO   = 'contato@s4sys.com.br';
    const NAME_FROM = 'S4Sys Contato Site';

    private $nome;
    private $email;
    private $assunto;
    private $textMessage;
    private $mailer;

    /**
     * @param array $postData
     */
    public function __construct($postData)
    {
        $this->nome        = utf8_decode($postData['name']);
        $this->email       = utf8_decode($postData['email']);
        $this->assunto     = utf8_decode($postData['subject']);
        $this->textMessage = utf8_decode($postData['message']);
    }


    /**
     * @return array
     */
    public function init(): array
    {
        $this->mailer = new PHPMailer();
        $this->mailer->IsSmtp();
        $this->mailer->SMTPDebug = self::SMTP_DEBUG;
        $this->mailer->do_debug = self::SMTP_DO_DEBUG;
        $this->mailer->SMTPAuth = self::SMTP_AUTH;
        $this->mailer->SMTPSecure = self::SMTP_SECURE;
        $this->mailer->Host = self::SMTP_HOST;
        $this->mailer->Port = self::SMTP_PORT;
        $this->mailer->IsHTML(true);
        $this->mailer->Username = self::MAIL_USER;
        $this->mailer->Password = self::MAIL_PASS;
        $this->mailer->setFrom(self::MAIL_FROM, self::NAME_FROM);
        $this->mailer->Subject = $this->assunto;
        $this->mailer->Body = $this->getEmailMessage();
        $this->mailer->AddAddress(self::MAIL_TO);

        $response = $this->mailer->Send();
        return ['success' => 1, 'msg' => $response];
    }

    /**
     * @return string
     */
    private function getEmailMessage(): string
    {
        return implode('', [
            "<ul>",
            "<li>Nome: {$this->nome}</li>",
            "<li>Email: {$this->email}</li>",
            "<li>Assunto: {$this->assunto}</li>",
            "<li>Mensagem: {$this->textMessage}</li>",
            "</ul>"
        ]);
    }
}
