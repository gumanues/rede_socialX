<link rel="stylesheet" href="../css/batepapo.css">
<?php 
session_start();
include('../php/conexao.php');
include_once('header.php');

$id = $_SESSION['id'];
$id_envio = $_SESSION['chat'];
$nome = $_SESSION['nome'];

$sql_nome = "SELECT * FROM usuario WHERE id = '$id_envio'";
$nome_envio = mysqli_query($conexao, $sql_nome);

while ($n = mysqli_fetch_array($nome_envio)) {
    $_SESSION['nome_pessoa'] = $n['nome'] . " " . $n['sobrenome'];
}

echo "<a class='id_chat' href= 'friend.php'><div class='container_id'><h2>Perfil de " . $_SESSION['nome_pessoa'] . "</h2></div></a>";


if(isset($_POST['send_mensagem_chat']) && $_POST['send_mensagem_chat'] != "") {
    $send_mensagem_chat = filter_input(INPUT_POST, 'send_mensagem_chat', FILTER_SANITIZE_STRING);
    $enviar_mensagem = "INSERT INTO `chat` (`id`, `nome`, `mensagem_chat`, `imagem_chat`, `usuario_send`, `usuario_id`) VALUES (NULL, '$nome' , '$send_mensagem_chat', NULL, '$id_envio', '$id')";
    mysqli_query($conexao, $enviar_mensagem);
    

} 
if (isset($_FILES["imagem_chat"]) && $_FILES["imagem_chat"] != "") {
    $foto_chat = $_FILES["imagem_chat"];
    $nomeFinal = time().'.jpg';
    if (move_uploaded_file($foto_chat['tmp_name'], $nomeFinal)) {
        $tamanhoImg = filesize($nomeFinal);
    $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg)); 
    $img_insert = "INSERT INTO `chat` (`id`, `nome`, `mensagem_chat`, `imagem_chat`, `usuario_send`, `usuario_id`) VALUES (NULL, '$nome' , NULL, '$mysqlImg', '$id_envio', '$id')";
    mysqli_query($conexao, $img_insert);
    unlink($nomeFinal);
    }   
}

$sql_chat1 = "SELECT `nome`,`mensagem_chat` FROM chat WHERE usuario_id = '$id' AND usuario_send = '$id_envio'";
$res_chat1 = mysqli_query($conexao, $sql_chat1);

$sql_chat2 = "SELECT `nome`,`imagem_chat` FROM chat  WHERE usuario_id = '$id' AND usuario_send = '$id_envio'";
$res_chat2 = mysqli_query($conexao, $sql_chat2);

$sql_chat1a = "SELECT `nome`,`mensagem_chat` FROM chat WHERE usuario_id = '$id_envio' AND usuario_send = '$id'";
$res_chat1a = mysqli_query($conexao, $sql_chat1a);

$sql_chat2a = "SELECT `nome`,`imagem_chat` FROM chat  WHERE usuario_id = '$id_envio' AND usuario_send = '$id'";
$res_chat2a = mysqli_query($conexao, $sql_chat2a);




while ($g = mysqli_fetch_array($res_chat1)) {
    $sql_imgperfil = "SELECT * FROM `perfil` WHERE usuario_id = '$id' ORDER BY `perfil`.`imagens` ASC";
    $res_imgperfil = mysqli_query($conexao, $sql_imgperfil);
    if ($row1 = mysqli_fetch_object($res_imgperfil)) {
    echo "<div class='nome'><img class='img_nome' src='data:image/jpeg;base64," . base64_encode( $row1->imagens ) . "' />" . $g['nome'] . "</div>";
    } else {
    echo "<div class='nome'><img class='img_nome' src='../img/perfil.jpg' />" . $g['nome'] . "</div>";
    }
    echo "<div class='mensagem'>" . $g['mensagem_chat']; 
    if ($g['mensagem_chat']) {
        $src = '"';
    } else {
        $src = 'data:image/jpeg;base64,';  
    }
    $row1 = mysqli_fetch_object($res_chat2);
    $none = 'none';
    echo '<img class="imagem_envio" onerror="this.style.display = ' . $none . '"" src="' . $src . base64_encode( $row1->imagem_chat ) . '" /></div><br>';
    
}


while ($h = mysqli_fetch_array($res_chat1a)) {
    $sql_imgperfil = "SELECT * FROM `perfil` WHERE usuario_id = '$id_envio' ORDER BY `perfil`.`imagens` ASC";
    $res_imgperfil = mysqli_query($conexao, $sql_imgperfil);
    if ($row1 = mysqli_fetch_object($res_imgperfil)) {
    echo "<div class='nome_friend'><img class='img_nome' src='data:image/jpeg;base64," . base64_encode( $row1->imagens ) . "' />" .$h['nome'] . "</div>";
    } else {
    echo "<div class='nome_friend'><img class='img_nome' src='../img/perfil.jpg' />" .$h['nome'] . "</div>";
    }
    echo "<div class='mensagem_friend'>" . $h['mensagem_chat']; 
    if ($h['mensagem_chat']) {
        $src = '"';
    } else {
        $src = 'data:image/jpeg;base64,';  
    }
    $row1a = mysqli_fetch_object($res_chat2a);
    $none = 'none';
    echo '<img class="imagem_envio" onerror="this.style.display = ' . $none . '"" src="' . $src . base64_encode( $row1a->imagem_chat ) . '" /></div><br>';
}


?>
       <form enctype="multipart/form-data" action="batepapo.php" method="post">
           <div class="container">
           <div class="enviar">
        <button class="botao" name="enviar" type="submit">Enviar</button>
        <label for="arquivo">Enviar arquivo</label>
        <input id="arquivo" type="file" name="imagem_chat">
    </div>
    <div class="submit">
        <input class="inputmsg" name="send_mensagem_chat" type="text" placeholder="O que está pensando?"
            maxlength="500">
    </div>
    </div>
</form>


</body>

</html>

