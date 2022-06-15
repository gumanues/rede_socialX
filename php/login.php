<?php
session_start();
include('conexao.php');

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = md5(mysqli_real_escape_string($conexao, $_POST['senha']));

if (isset($_POST["email"]) && $_POST["email"] != "") 
 {
	$sql = "SELECT * FROM usuario WHERE email = '$email'";
	$res = mysqli_query($conexao, $sql);
	$total = mysqli_num_rows($res);
	while ($f = mysqli_fetch_array($res))
	{
    $id = $f['id'];
	$_SESSION['nome'] = $f['nome'] . " " . $f['sobrenome'];
	}

$query = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);
 
if($row == 1) {
	$_SESSION['id'] = $id;
	header('Location: ../pages/feed.php');	
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	echo "<script> alert('A senha ou email está incorreta.'); history.go(-1); </script>";
	session_destroy(); 
    exit();
}
} 



?>