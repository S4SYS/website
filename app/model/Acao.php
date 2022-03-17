<?php

require_once 'AbstractModel.php';

final class Acao extends AbstractModel
{
    const COD_CREATE     = 1;
    const COD_UPDATE     = 2;
    const COD_DEACTIVATE = 3;
    const COD_DELETE     = 4;
}