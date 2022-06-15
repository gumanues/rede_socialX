<?php 
define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'rede_social');
 
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');

mysqli_set_charset($conexao, "utf8");

$sair = isset($_SESSION['id']) ? 'S' : 'N';
if($sair == 'N'){
    header('Location: ../index.html');
}

$today = date("Y-m-d H:i:s");

?>