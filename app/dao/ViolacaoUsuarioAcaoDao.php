<?php

require_once 'app/Connection.php';
require_once 'app/model/ViolacaoUsuarioAcao.php';

final class ViolacaoUsuarioAcaoDao extends Connection
{
    
    /**
     * @param ViolacaoUsuarioAcao $violacaoUsuarioAcao
     * 
     * @return array
     */
    public function save(ViolacaoUsuarioAcao $violacaoUsuarioAcao): array
    {
        $sql = "INSERT INTO violacao_usuario_acao(violacao_id, usuario_acao_id)
                VALUES(?, ?)";
        
        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $violacaoUsuarioAcao->getViolacao()->id);
            $p_sql->bindValue(2, $violacaoUsuarioAcao->getUsuarioAcao()->id);
            $p_sql->execute();

            $violacaoUsuarioAcao->setId($this->getInstance()->lastInsertId());

            return [
                'success' => true, 
                'data'    => $violacaoUsuarioAcao
            ];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}