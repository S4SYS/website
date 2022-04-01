<?php

require_once 'app/Connection.php';
require_once 'app/model/Status.php';

final class StatusDao extends Connection
{    
    /**
     * @param Status $status
     * 
     * @return array
     */
    public function get(Status $status): array
    {
        $sql = "SELECT * FROM status WHERE cliente_id = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $status->getCliente()->id);
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetchAll(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }


    /**
     * @param Status $status
     * 
     * @return array
     */
    public function getByCode(Status $status): array
    {
        $sql = "SELECT * FROM status WHERE id = ? AND cliente_id = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $status->getId());
            $p_sql->bindValue(2, $status->getCliente()->id);
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetch(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    /**
     * @param Status $status
     * 
     * @return array
     */
    public function save(Status $status): array
    {
        $sql = "INSERT INTO status(id, nome, cliente_id) VALUES(?, ?, ?)";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $status->getId());
            $p_sql->bindValue(2, $status->getNome());
            $p_sql->bindValue(3, $status->getCliente()->id);
            $p_sql->execute();

            $status->setId($this->getInstance()->lastInsertId());
            
            return [
                'success' => true, 
                'data'    => $status
            ];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    /**
     * @param Status $status
     * 
     * @return array
     */
    public function update(Status $status): array
    {
        $sql = "UPDATE status SET nome = ? WHERE id = ? AND cliente_id = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $status->getNome());
            $p_sql->bindValue(2, $status->getId());
            $p_sql->bindValue(3, $status->getCliente()->id);
     
            return [
                'success' => $p_sql->execute(), 
                'data'    => $status
            ];
        } catch(Exception $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}
