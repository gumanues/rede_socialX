<?php
session_start();
include('../conexao.php');
$id = $_SESSION['id'];

$senha_antiga = md5(filter_input(INPUT_POST, 'senha_antiga', FILTER_SANITIZE_STRING));
$senha = md5(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));
$senha_novamente = md5(filter_input(INPUT_POST, 'senha_novamente', FILTER_SANITIZE_STRING));


if ($senha != $senha_novamente) {
    echo "<script> alert('Senhas diferentes, verifique novamente.'); history.go(-1); </script>";
} if ($senha == $senha_antiga) {
    echo "<script> alert('Senhas antiga igual a nova, verifique novamente.'); history.go(-1); </script>";
} else {
    $altera_senha = "UPDATE usuario SET senha = '$senha' WHERE usuario.id = '$id'";
    $resultado_senha = mysqli_query($conexao, $altera_senha);
    header('Location: /SA/index.html');
    session_destroy(); 
    exit();
}

