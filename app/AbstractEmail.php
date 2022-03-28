<?php

require_once 'PhpMailer/PhpMailer.php';

abstract class AbstractEmail
{
    const SMTP_HOST     = 'smtp-mail.outlook.com';
    const SMTP_PORT     = 587;
    const SMTP_AUTH     = true;
    const SMTP_SECURE   = 'tls';
    
    const SMTP_DEBUG    = false;
    const SMTP_DO_DEBUG = 0;
    
    //const MAIL_USER = 'contato@s4sys.com.br';
    const MAIL_USER = 'freitasfabio811@outlook.com';
    //const MAIL_PASS = 'XFTj@phwZxEQuh{EUp';
        const MAIL_PASS = 'uska#galo2021';
    //const MAIL_FROM = 'contato@s4sys.com.br';
    const MAIL_FROM = 'freitasfabio811@outlook.com';
    const MAIL_COPY = 'deployment@s4sys.com.br';    
  
    protected $mailTo;
    protected $assunto;
    protected $textMessage;
    protected $nameFrom;
    protected $replyTo;
    
    private $mailer;
    
    /**
     * @return array
     */
    protected function init(): array
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
        $this->mailer->setFrom(self::MAIL_FROM, $this->nameFrom);
        $this->mailer->Subject = $this->assunto;
        $this->mailer->Body = $this->getEmailMessage();
        $this->mailer->AddAddress($this->mailTo);
        //$this->mailer->addCC(self::MAIL_COPY);
        $this->mailer->addReplyTo($this->replyTo);

        $response = $this->mailer->Send();

        return ['success' => 1, 'msg' => $response];
    }

    /**
     * @return string
     */
    abstract protected function getEmailMessage(): string;

}