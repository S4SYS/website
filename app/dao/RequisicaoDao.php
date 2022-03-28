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
        $sql = "INSERT INTO requisicao(codigo, pedido, cpf, nome, telefone, email, arquivo, setor_id, tipo_requisicao_id) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $requisicao->getCodigo());
            $p_sql->bindValue(2, $requisicao->getPedido());
            $p_sql->bindValue(3, $requisicao->getCpf());
            $p_sql->bindValue(4, $requisicao->getNome());
            $p_sql->bindValue(5, $requisicao->getTelefone());
            $p_sql->bindValue(6, $requisicao->getEmail());
            $p_sql->bindValue(7, $requisicao->getArquivo());
            $p_sql->bindValue(8, $requisicao->getSetor()->id);
            $p_sql->bindValue(9, $requisicao->getTipoRequisicao()->id);
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
     * @return array
     */
    public function get(): array
    {
        $sql = "SELECT requisicao.*, 
                       setor.nome AS nome_setor, 
                       tipo_requisicao.nome AS nome_tipo_requisicao,
                       status.nome AS nome_status  
                FROM requisicao
                INNER JOIN tipo_requisicao ON requisicao.tipo_requisicao_id = tipo_requisicao.id 
                INNER JOIN setor ON requisicao.setor_id = setor.id
                INNER JOIN status ON requisicao.status_id = status.id";                

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetchAll(PDO::FETCH_ASSOC)];

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


    /**
     * @param Requisicao $requisicao
     * 
     * @return array
     */
    public function getStatusByCode(Requisicao $requisicao): array
    {
        $sql = "SELECT status.*, requisicao.email, requisicao.codigo  
                FROM requisicao
                INNER JOIN status ON requisicao.status_id = status.id
                WHERE requisicao.id = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $requisicao->getId());
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetch(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }        
    }


    /**
     * @param Requisicao $requisicao
     * 
     * @return array
     */
    public function updateStatus(Requisicao $requisicao): array
    {
        $sql = "UPDATE requisicao SET status_id = ? WHERE id = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $requisicao->getStatus()->id);
            $p_sql->bindValue(2, $requisicao->getId());
            
            return ['success' => $p_sql->execute(), 'data' => $requisicao];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}
