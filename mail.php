<?php

require_once 'app/PhpMailer/PhpMailer.php';


final Class EmailContato
{
    const SMTP_HOST   = 'smtp-mail.outlook.com';
    const SMTP_PORT   = 587;
    const SMTP_AUTH   = true;
    const SMTP_SECURE = 'tls';
    const SMTP_DEBUG  = 2;
    
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
        $this->nome        = $postData['name'];
        $this->email       = $postData['email'];
        $this->assunto     = $postData['subject'];
        $this->textMessage = $postData['message'];
    }

    /**
     * @return void
     */
    public function init(): array
    {
        try{
            $this->mailer = new PHPMailer();
            $this->mailer->IsSmtp();
            $this->mailer->SMTPDebug = self::SMTP_DEBUG;

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
            return ['success' => 1, 'data' => $log];

        } catch(\Throwable $exception){
            return ['success' => 0, 'data' => $exception->getMessage()];
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

echo json_encode((new EmailContato($_POST))->init());