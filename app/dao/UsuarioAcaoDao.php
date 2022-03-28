<?php

require_once 'app/Connection.php';
require_once 'app/model/UsuarioAcao.php';

final class UsuarioAcaoDao extends Connection
{
    /**
     * @param UsuarioAcao $usuarioAcao
     * 
     * @return array
     */
    public function save(UsuarioAcao $usuarioAcao): array
    {
        $sql = "INSERT INTO usuario_acao(usuario_id, acao_id, descricao, comentario, tabela, atual_id, anterior_id)
                VALUES(?, ?, ?, ?, ?, ?, ?)";
        
        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $usuarioAcao->getUsuario()->id);
            $p_sql->bindValue(2, $usuarioAcao->getAcao()->id);
            $p_sql->bindValue(3, $usuarioAcao->getDescricao());
            $p_sql->bindValue(4, $usuarioAcao->getComentario());
            $p_sql->bindValue(5, $usuarioAcao->getTabela());
            $p_sql->bindValue(6, $usuarioAcao->getAtualId());
            $p_sql->bindValue(7, $usuarioAcao->getAnteriorId());
            $p_sql->execute();

            $usuarioAcao->setId($this->getInstance()->lastInsertId());
       
            return ['success' => true, 'data' => $usuarioAcao];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }    
    
}
