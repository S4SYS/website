<?php

require_once 'app/Connection.php';
require_once 'app/model/Requisicao.php';


final class RequisicaoDao extends Connection
{
    /**
     * @param Requisicao $requisicao
     * 
     * @return array
     */
    public function save(Requisicao $requisicao): array 
    {
        $sql = "INSERT INTO requisicao(codigo, pedido, cpf, telefone, email, arquivo, setor_id, tipo_requisicao_id) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $requisicao->getCodigo());
            $p_sql->bindValue(2, $requisicao->getPedido());
            $p_sql->bindValue(3, $requisicao->getCpf());
            $p_sql->bindValue(4, $requisicao->getTelefone());
            $p_sql->bindValue(5, $requisicao->getEmail());
            $p_sql->bindValue(6, $requisicao->getArquivo());
            $p_sql->bindValue(7, $requisicao->getSetor()->id);
            $p_sql->bindValue(8, $requisicao->getTipoRequisicao()->id);
            $p_sql->execute();

            $requisicao->setId($this->getInstance()->lastInsertId());
            
            return [
                'success' => true, 
                'data'    => $requisicao
            ];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }


    /**
     * @param Requisicao $requisicao
     * 
     * @return array
     */
    public function getByCode(Requisicao $requisicao): array
    {
        $sql = "SELECT requisicao.*, 
                       setor.nome AS nome_setor, 
                       tipo_requisicao.nome AS nome_tipo_requisicao,
                       status.nome AS nome_status  
                FROM requisicao
                INNER JOIN tipo_requisicao ON requisicao.tipo_requisicao_id = tipo_requisicao.id 
                INNER JOIN setor ON requisicao.setor_id = setor.id
                INNER JOIN status ON requisicao.status_id = status.id  
                WHERE requisicao.codigo = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $requisicao->getCodigo());
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetch(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}
