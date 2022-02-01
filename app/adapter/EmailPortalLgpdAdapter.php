<?php

require_once 'app/AbstractEmail.php';
require_once 'app/model/AbstractModel.php';

final class EmailPortalLgpdAdapter extends AbstractEmail
{
    private $codigo;

    /**
     * @param AbstractModel $model
     */
    public function __construct(AbstractModel $model)
    {
        $this->codigo   = $model->codigo;
        $this->mailTo   = $model->email;
        $this->assunto  = 'Código para consulta';
        $this->nameFrom = 'Portal LGPD - S4SYS';
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
            "A S4SYS agradece o seu contato, segue o c&oacute;digo para consultar sua requisi&ccedil;&atilde;o:",
            "<h4>{$this->codigo}</h4>",
            "</p>",
            "</td>",
            "</tr>",
            "</table>"
        ]);
    }
}