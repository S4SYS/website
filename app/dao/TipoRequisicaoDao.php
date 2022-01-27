<?php

require_once 'app/Connection.php';
require_once 'app/model/TipoRequisicao.php';

final class TipoRequisicaoDao extends Connection
{
    /**
     * @return array
     */
    public function get(): array
    {
        $sql = "SELECT * FROM tipo_requisicao";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetchAll(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception];
        }
    }

}