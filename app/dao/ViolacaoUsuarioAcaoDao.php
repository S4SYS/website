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

    /**
     * @param ViolacaoUsuarioAcao $violacaoUsuarioAcao
     * 
     * @return array
     */
    public function getByCode(ViolacaoUsuarioAcao $violacaoUsuarioAcao): array
    {
        $sql = "SELECT 
                usuario_acao.descricao,
                usuario_acao.comentario,
                usuario_acao.created_at,
                usuario.nome,
                violacao.email 
                FROM usuario_acao
                INNER JOIN usuario ON usuario_acao.usuario_id = usuario.id 
                INNER JOIN acao ON usuario_acao.acao_id = acao.id
                INNER JOIN violacao_usuario_acao ON violacao_usuario_acao.usuario_acao_id = usuario_acao.id
                INNER JOIN violacao ON violacao_usuario_acao.violacao_id = violacao.id
                WHERE violacao_usuario_acao.violacao_id = ?
                ORDER BY violacao_usuario_acao.id DESC";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $violacaoUsuarioAcao->getViolacao()->id);
            $p_sql->execute();
            
            return ['success' => true, 'data' => $p_sql->fetchAll(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }     
    }
}