<?php
session_start();
include('../conexao.php');
$id = $_SESSION['id'];

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$aniversario = filter_input(INPUT_POST, 'aniversario', FILTER_SANITIZE_STRING);

$nomesobrenome = $nome . " " . $sobrenome;


if ($nome && $sobrenome && $email && $aniversario != ""){
    $altera_dados = "UPDATE usuario SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', aniversario = '$aniversario(yyyy\mm\dd)' WHERE usuario.id = '$id'";
    mysqli_query($conexao, $altera_dados);

    $altera_nome_feed = "UPDATE `feed` SET `nome` = '$nomesobrenome' WHERE `feed`.`usuario_id` = $id";
    mysqli_query($conexao, $altera_nome_feed);

    $altera_nome_chat = "UPDATE `chat` SET `nome` = '$nomesobrenome' WHERE `chat`.`usuario_id` = $id";
    mysqli_query($conexao, $altera_nome_chat);

    header('Location: /SA/pages/config.php');
} else {
    echo "<script> alert('Por favor, preencha todos os dados.'); history.go(-1); </script>";
}
?>
