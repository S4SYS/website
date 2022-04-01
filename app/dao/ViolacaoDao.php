<?php

require_once 'app/Connection.php';
require_once 'app/model/Violacao.php';


final class ViolacaoDao extends Connection
{
    /**
     * @param Violacao $violacao
     * 
     * @return array
     */
    public function save(Violacao $violacao): array
    {
        $sql = "INSERT INTO violacao(codigo, cpf, email, nome, telefone, descricao, arquivo, cliente_id) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $violacao->getCodigo());
            $p_sql->bindValue(2, $violacao->getCpf());
            $p_sql->bindValue(3, $violacao->getEmail());
            $p_sql->bindValue(4, $violacao->getNome());
            $p_sql->bindValue(5, $violacao->getTelefone());
            $p_sql->bindValue(6, $violacao->getDescricao());
            $p_sql->bindValue(7, $violacao->getArquivo());
            $p_sql->bindValue(8, $violacao->getCliente()->id);
            $p_sql->execute();
            $violacao->setId($this->getInstance()->lastInsertId());

            return ['success' => true, 'data' => $violacao];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    
    /**
     * @param Violacao $violacao
     * 
     * @return array
     */
    public function get(Violacao $violacao): array
    {
        $sql = "SELECT violacao.*, status.nome AS nome_status 
                FROM violacao
                INNER JOIN status ON violacao.status_id = status.id
                WHERE violacao.cliente_id = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $violacao->getCliente()->id);
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetchAll(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    
    /**
     * @param Violacao $violacao
     * 
     * @return array
     */
    public function getByCode(Violacao $violacao): array
    {
        $sql = "SELECT violacao.*, status.nome AS nome_status 
                FROM violacao
                INNER JOIN status ON violacao.status_id = status.id 
                WHERE codigo = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $violacao->getCodigo());
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetch(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    /**
     * @param Violacao $violacao
     * 
     * @return array
     */
    public function getStatusByCode(Violacao $violacao): array
    {
        $sql = "SELECT status.*, violacao.email, violacao.codigo 
                FROM violacao
                INNER JOIN status ON violacao.status_id = status.id
                WHERE violacao.id = ?
                AND violacao.cliente_id = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $violacao->getId());
            $p_sql->bindValue(2, $violacao->getCliente()->id);
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetch(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }        
    }

    /**
     * @param Violacao $violacao
     * 
     * @return array
     */
    public function updateStatus(Violacao $violacao): array
    {
        $sql = "UPDATE violacao SET status_id = ? WHERE id = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $violacao->getStatus()->id);
            $p_sql->bindValue(2, $violacao->getId());
            
            return ['success' => $p_sql->execute(), 'data' => $violacao];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}




