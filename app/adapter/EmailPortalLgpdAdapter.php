<?php

require_once 'app/AbstractEmail.php';
require_once 'app/model/AbstractModel.php';
require_once 'app/ApiRequest.php';

final class EmailPortalLgpdAdapter extends AbstractEmail
{
    use ApiRequest;

    private $codigo;
    private $cliente;

    /**
     * @param AbstractModel $model
     */
    public function __construct(AbstractModel $model)
    {
        $this->codigo   = $model->codigo;
        $this->mailTo   = $model->email;
        $this->cliente  = $model->cliente;
        $this->assunto  = 'Código para consulta';
        $this->nameFrom = "Portal LGPD - {$this->cliente->nome}";
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
            "<table border=\"0\" width=\"100%\">",
            "<tr>",
            "<td>",
            "<a href=\"https://www.s4sys.com.br\">",
            "<img src=\"http://www.s4sys.com.br/images/logo_s4sys.png\">",
            "</a>",
            "</td>",
            "</tr>",
            "<tr>",
            "<td>",
            "<p>",
            "A {$this->cliente->nome} agradece o seu contato, segue o c&oacute;digo para consultar sua requisi&ccedil;&atilde;o:",
            "<h4><a href=\"{$this->url}?acao=emailConsulta&codigo={$this->codigo}\">{$this->codigo}</a></h4>",
            "</p>",
            "<p><a href=\"{$this->cliente->dominio}\">{$this->cliente->dominio}</a></p>",
            "</td>",
            "</tr>",
            "</table>"
        ]);
    }
}