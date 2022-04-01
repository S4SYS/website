<?php

require_once 'PhpMailer/PhpMailer.php';
require_once 'Config.php';

abstract class AbstractEmail
{  
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
        $this->mailer->SMTPDebug = Config::SMTP_DEBUG;
        $this->mailer->do_debug = Config::SMTP_DO_DEBUG;
        $this->mailer->SMTPAuth = Config::SMTP_AUTH;
        $this->mailer->SMTPSecure = Config::SMTP_SECURE;
        $this->mailer->Host = Config::SMTP_HOST;
        $this->mailer->Port = Config::SMTP_PORT;
        $this->mailer->IsHTML(true);
        $this->mailer->Username = Config::MAIL_USER;
        $this->mailer->Password = Config::MAIL_PASS;
        $this->mailer->setFrom(Config::MAIL_FROM, $this->nameFrom);
        $this->mailer->Subject = $this->assunto;
        $this->mailer->Body = $this->getEmailMessage();
        $this->mailer->AddAddress($this->mailTo);
        $this->mailer->addCC(Config::MAIL_COPY);
        $this->mailer->addReplyTo($this->replyTo);

        $response = $this->mailer->Send();

        return ['success' => 1, 'msg' => $response];
    }

    /**
     * @return string
     */
    abstract protected function getEmailMessage(): string;

}