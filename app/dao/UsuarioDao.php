<?php

require_once 'app/Connection.php';
require_once 'app/model/Usuario.php';

final class UsuarioDao extends Connection
{
    /**
     * @param Usuario $usuario
     * 
     * @return array
     */
    public function authenticate(Usuario $usuario): array
    {
        $sql = "SELECT * FROM usuario WHERE login = ? AND senha = ?";

        try{
            $p_sql = $this->getInstance()->prepare($sql);
            $p_sql->bindValue(1, $usuario->getLogin());
            $p_sql->bindValue(2, $usuario->getSenha());
            $p_sql->execute();

            return ['success' => true, 'data' => $p_sql->fetch(PDO::FETCH_ASSOC)];

        } catch(PDOException $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}
