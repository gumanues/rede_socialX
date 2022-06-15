<?php 
include ('conexao.php');

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = md5(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));
$senha2 = md5(filter_input(INPUT_POST, 'senha2', FILTER_SANITIZE_STRING));
$aniversario = filter_input(INPUT_POST, 'aniversario', FILTER_SANITIZE_STRING);



$sql = "SELECT email FROM usuario";
$res = mysqli_query($conexao, $sql);
$total = mysqli_num_rows($res);
while ($f = mysqli_fetch_array($res))
{
$email2 = $f['email'];
}

if ($email2 === $email) {
    echo "<script> alert('Email já cadastrado.'); history.go(-1); </script>";
} else {
    if (isset($_POST["email"]) && $_POST["email"] != "") {
        if ($senha2 == $senha) {
                $cadastro_usuario = "INSERT INTO usuario (nome, sobrenome, email, senha, aniversario) VALUES('$nome', '$sobrenome', '$email', '$senha', '$aniversario(yyyy\mm\dd)')";
                $resultado_usuario = mysqli_query($conexao, $cadastro_usuario); 
        }
        } else {
            echo "<script> alert('Por favor, preencha todos os dados.'); history.go(-1); </script>";
        }
}



?>