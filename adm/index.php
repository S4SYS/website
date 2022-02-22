<?php

@session_start();

// TODO: vericar se ha a sessao do usuario.
if(!isset($_SESSION['idUsuario'])) die("<script>location.href = 'login.php';</script>");

echo "Bem-vindo {$_SESSION['nomeUsuario']}";

?>


