<?php
session_start();
include('../conexao.php');

$id = $_SESSION['id'];

    $foto_perfil = $_FILES["imagem_perfil"];
    $foto_fundo = $_FILES["imagem_fundo"];



if ((file_exists($_FILES['imagem_perfil']['tmp_name']) || is_uploaded_file($_FILES['imagem_perfil']['tmp_name'])) && (file_exists($_FILES['imagem_fundo']['tmp_name']) || is_uploaded_file($_FILES['imagem_fundo']['tmp_name']))) 
 {

    $sql_delete = "DELETE FROM perfil WHERE `perfil`.`usuario_id` = $id";
    mysqli_query($conexao, $sql_delete);

        $foto_fundo = $_FILES["imagem_fundo"];
        $nomeFinal1 = time().'.jpg';
        if (move_uploaded_file($foto_fundo['tmp_name'], $nomeFinal1)) {
            $tamanhoImg1 = filesize($nomeFinal1);
            $mysqlImg1 = addslashes(fread(fopen($nomeFinal1, "r"), $tamanhoImg1)); 
            $img_insert1 = "INSERT INTO `perfil` (`id`, `imagens` , `usuario_id`) VALUES (NULL, '$mysqlImg1', '$id')";
            mysqli_query($conexao, $img_insert1);
            unlink($nomeFinal1);
        }   
    
        $foto_perfil = $_FILES["imagem_perfil"];
        $nomeFinal = time().'.jpg';
        if (move_uploaded_file($foto_perfil['tmp_name'], $nomeFinal)) {
            $tamanhoImg = filesize($nomeFinal);
            $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg)); 
            $img_insert = "INSERT INTO `perfil` (`id`, `imagens` , `usuario_id`) VALUES (NULL, '$mysqlImg', '$id')";
            mysqli_query($conexao, $img_insert);
            unlink($nomeFinal);
        }

       

    echo "<script> alert('Imagem alterada com sucesso.'); history.go(-1); </script>";
} else {
    echo "<script> alert('Impossivel alterar apenas uma imagem, selecione duas.'); history.go(-1); </script>";
}

?>


