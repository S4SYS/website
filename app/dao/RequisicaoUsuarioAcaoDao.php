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

    /**
     * @param RequisicaoUsuarioAcao $requisicaoUsuarioAcao
     * 
     * @return array
     */
    public function getByCode(RequisicaoUsuarioAcao $requisicaoUsuarioAcao): array
    {
        $sql = "SELECT 
                usuario_acao.descricao,
                usuario_acao.comentario,
                usuario_acao.created_at,
                usuario.nome 
                FROM usuario_acao
                INNER JOIN usuario ON usuario_acao.usuario_id = usuario.id 
                INNER JOIN acao ON usuario_acao.acao_id = acao.id
                INNER JOIN requisicao_usuario_acao ON requisicao_usuario_acao.usuario_acao_id = usuario_acao.id
                WHERE requisicao_usuario_acao.requisicao_id = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $requisicaoUsuarioAcao->getRequisicao()->id);
            $p_sql->execute();
            
            return ['success' => true, 'data' => $p_sql->fetchAll(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }     
    }
}