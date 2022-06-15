<link rel="stylesheet" href="../css/feed.css">
<?php 
session_start();
include('../php/conexao.php');
include_once('header.php');
$id = $_SESSION['id'];
$nome = $_SESSION['nome'];


#enviar mensagem
if(isset($_POST['send_mensagem_feed']) && $_POST['send_mensagem_feed'] != "") {
    $send_mensagem_feed = filter_input(INPUT_POST, 'send_mensagem_feed', FILTER_SANITIZE_STRING);
    $enviar_mensagem = "INSERT INTO `feed` (`id`, `nome`, `mensagem_feed`, `imagem_feed`, `usuario_id`) VALUES (NULL, '$nome', '$send_mensagem_feed', NULL, '$id')";
    $resultado_msg = mysqli_query($conexao, $enviar_mensagem);
}
# envier imagem
if (isset($_FILES["imagem_feed"]) && $_FILES["imagem_feed"] != "") {
    $foto_feed = $_FILES["imagem_feed"];
    $nomeFinal = time().'.jpg';
        if (move_uploaded_file($foto_feed['tmp_name'], $nomeFinal)) {
            $tamanhoImg = filesize($nomeFinal);
            $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg)); 
            $img_insert = "INSERT INTO `feed` (`id`, `nome`, `mensagem_feed`, `imagem_feed`, `usuario_id`) VALUES (NULL, '$nome', NULL, '$mysqlImg', '$id')";
            mysqli_query ($conexao, $img_insert);
            unlink($nomeFinal);
    }
}

?>


<form enctype="multipart/form-data" action="feed.php" method="post">
    <div class="submit">
        <input class="inputmsg" name="send_mensagem_feed" type="text" placeholder="O que está pensando?"
            maxlength="500">
        
    </div>
</div>
    <div class="enviar">
        <button class="botao" name="enviar" type="submit">Enviar</button>
        <label for="arquivo">Enviar arquivo</label>
        <input id="arquivo" type="file" name="imagem_feed">
    </div>
</form>

<?php


$sql_feed = "SELECT * FROM feed ORDER BY id DESC";
$res_feed = mysqli_query($conexao, $sql_feed);

$sql_img = "SELECT * FROM feed ORDER BY id DESC";
$res_img = mysqli_query($conexao, $sql_img);

while ($g = mysqli_fetch_array($res_feed)) {
    $id_foto = $g['usuario_id'];
    $sql_imgperfil = "SELECT * FROM `perfil` WHERE usuario_id = '$id_foto' ORDER BY `perfil`.`imagens` ASC";
    $res_imgperfil = mysqli_query($conexao, $sql_imgperfil);
    if ($row1 = mysqli_fetch_object($res_imgperfil)) {
    echo "<div class='nome'><img src='data:image/jpeg;base64," . base64_encode( $row1->imagens ) . "' />" .$g['nome'] . "</div>";
    } else {
    echo "<div class='nome'><img src='../img/perfil.jpg' />" .$g['nome'] . "</div>";
    }
    echo "<div class='mensagem'>" . $g['mensagem_feed']; 
    if ($g['mensagem_feed']) {
        $src = '"';
    } else {
        $src = 'data:image/jpeg;base64,';  
    }
    $row = mysqli_fetch_object($res_img);
    $none = 'none';
    echo '<img onerror="this.style.display = ' . $none . '"" src="' . $src . base64_encode( $row->imagem_feed ) . '" /></div>';
    
}
?>


</body>


</html>