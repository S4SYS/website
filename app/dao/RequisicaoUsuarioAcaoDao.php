<?php

require_once 'app/Connection.php';
require_once 'app/model/RequisicaoUsuarioAcao.php';

final class RequisicaoUsuarioAcaoDao extends Connection
{
    /**
     * @param RequisicaoUsuarioAcao $requisicaoUsuarioAcao
     * 
     * @return array
     */
    public function save(RequisicaoUsuarioAcao $requisicaoUsuarioAcao): array
    {
        $sql = "INSERT INTO requisicao_usuario_acao(requisicao_id, usuario_acao_id)
                VALUES(?, ?)";
        
        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $requisicaoUsuarioAcao->getRequisicao()->id);
            $p_sql->bindValue(2, $requisicaoUsuarioAcao->getUsuarioAcao()->id);
            $p_sql->execute();

            $requisicaoUsuarioAcao->setId($this->getInstance()->lastInsertId());

            return [
                'success' => true, 
                'data'    => $requisicaoUsuarioAcao
            ];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}