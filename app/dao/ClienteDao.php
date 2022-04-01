<?php

require_once 'app/Connection.php';
require_once 'app/model/Cliente.php';

final class ClienteDao extends Connection
{
    /**
     * @param Cliente $cliente
     * 
     * @return array
     */
    public function getByToken(Cliente $cliente): array
    {
        $sql = "SELECT * FROM cliente WHERE token = ? and ativo = 1";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $cliente->getToken());
            $p_sql->execute();

            $dados = $p_sql->fetch(PDO::FETCH_ASSOC);
            if(!$dados) return ['success' => false, 'message' => 'Invalid API credentials.'];

            $cliente->setId($dados['id']);
            $cliente->setNome($dados['nome']);
            $cliente->setDominio($dados['dominio']);
            $cliente->setUltimoAcesso(date('Y-m-d H:i:s'));
            
            return $this->updateUltimoAcesso($cliente);

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    /**
     * @param Cliente $cliente
     * 
     * @return array
     */
    private function updateUltimoAcesso(Cliente $cliente): array
    {
        $sql = "UPDATE cliente SET ultimo_acesso = ? WHERE id = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $cliente->getUltimoAcesso());
            $p_sql->bindValue(2, $cliente->getId());
            
            return ['success' => $p_sql->execute(), 'data' => $cliente];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}