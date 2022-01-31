<?php

require_once 'app/AbstractEmail.php';

final class EmailContatoAdapter extends AbstractEmail
{
    public function __construct(array $params)
    {
        $this->nome        = utf8_decode($params['name']);
        $this->replyTo     = utf8_decode($params['email']);
        $this->assunto     = utf8_decode($params['subject']);
        $this->textMessage = utf8_decode($params['message']);
        $this->nameFrom    = 'Contato - S4SYS';
        $this->mailTo      = 'contato@s4sys.com.br';
    }

    public function init(): array
    {
        return parent::init();
    }

    /**
     * @return string
     */
    protected function getEmailMessage(): string
    {
        return implode('', [
            "<ul>",
            "<li>Nome: {$this->nome}</li>",
            "<li>Email: {$this->replyTo}</li>",
            "<li>Assunto: {$this->assunto}</li>",
            "<li>Mensagem: {$this->textMessage}</li>",
            "</ul>"
        ]);
    }
}