<?php

require_once 'PhpMailer/PhpMailer.php';


final Class EmailContato
{
    const SMTP_HOST     = 'smtp-mail.outlook.com';
    const SMTP_PORT     = 587;
    const SMTP_AUTH     = true;
    const SMTP_SECURE   = 'tls';
    const SMTP_DEBUG    = false;
    const SMTP_DO_DEBUG = 0;
    
    const MAIL_USER = 'fabio.santos@s4sys.com.br'; // TODO: mudar para contato @s4sys.com.br
    const MAIL_PASS = 'uska#galo2021';
    const MAIL_FROM = 'fabio.santos@s4sys.com.br'; // TODO: mudar para contato @s4sys.com.br

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
        try{
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
            $this->mailer->setFrom(self::MAIL_FROM);
            $this->mailer->Subject = $this->assunto;
            $this->mailer->Body = $this->getEmailMessage();
            $this->mailer->AddAddress($this->email);
            
            $log = $this->mailer->Send();
            return ['success' => 1, 'msg' => $log];

        } catch(\Throwable $exception){
            return ['success' => 0, 'msg' => $exception->getMessage()];
        }        
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
            "<li>Mensagem: {$this->textMessage}</li>",
            "</ul>"
        ]);
    }
}
