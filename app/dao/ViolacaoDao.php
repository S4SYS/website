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
        $sql = "INSERT INTO violacao(codigo, cpf, email, telefone, descricao) 
        VALUES(?, ?, ?, ?, ?)";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $violacao->getCodigo());
            $p_sql->bindValue(2, $violacao->getCpf());
            $p_sql->bindValue(3, $violacao->getEmail());
            $p_sql->bindValue(4, $violacao->getTelefone());
            $p_sql->bindValue(5, $violacao->getDescricao());
            $p_sql->execute();

            return [
                'success' => true, 
                'id' => $this->getInstance()->lastInsertId(),
                'codigo' => $violacao->getCodigo()
            ];

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
        $sql = "SELECT * FROM violacao WHERE codigo = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $violacao->getCodigo());
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetch(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}




