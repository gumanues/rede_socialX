<?php
session_start();
include('../conexao.php');
$id = $_SESSION['id'];

$senha_exclusao = md5(filter_input(INPUT_POST, 'senha_exclusao', FILTER_SANITIZE_STRING));

$sql = "SELECT * FROM usuario WHERE id = '$id'";

	$res = mysqli_query($conexao, $sql);
	$total = mysqli_num_rows($res);
	while ($s = mysqli_fetch_array($res))
	{
    $senha = $s['senha'];
	}

    if ($senha_exclusao == $senha) {
        $exclui_fk_chat = "DELETE FROM chat WHERE `chat`.`usuario_id` = '$id' AND id > 0";
        $resultado_exclusao_chat = mysqli_query($conexao, $exclui_fk_chat);

        $exclui_fk_perfil = "DELETE FROM feed WHERE `feed`.`usuario_id` = '$id' AND id > 0";
        $resultado_exclusao_perfil = mysqli_query($conexao, $exclui_fk_perfil);      

        $exclui_fk_feed = "DELETE FROM perfil WHERE `perfil`.`usuario_id` = '$id' AND id > 0";
        $resultado_exclusao_feed = mysqli_query($conexao, $exclui_fk_feed);

        $exclui_conta = "DELETE FROM usuario WHERE `usuario`.`id` = '$id'";
        $resultado_exclusao = mysqli_query($conexao, $exclui_conta);
        header('Location: /SA/index.html');
        session_destroy(); 
        exit();
    } else {
        echo "<script> alert('A senha está incorreta.'); history.go(-1); </script>";
    }

