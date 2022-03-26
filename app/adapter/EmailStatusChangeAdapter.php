<?php

require_once 'app/AbstractEmail.php';
require_once 'app/model/AbstractModel.php';
require_once 'app/ApiRequest.php';

final class EmailStatusChangeAdapter extends AbstractEmail
{
    use ApiRequest;

    private $texto;

    /**
     * @param AbstractModel $model
     */
    public function __construct(AbstractModel $model)
    {
        $this->mailTo   = $model->email;
        $this->texto    = $model->descricao;
        $this->assunto  = 'Atualização de Status';
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
            $this->texto,
            "</p>",
            "</td>",
            "</tr>",
            "</table>"
        ]);
    }
}