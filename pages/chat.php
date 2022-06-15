<link rel="stylesheet" href="../css/chat.css">
<?php
session_start();
include('../php/conexao.php');
include_once('header.php');

$id = $_SESSION['id'];

    $sql_usuario = "SELECT * FROM usuario WHERE id NOT IN ('$id')";
    $res_usuario = mysqli_query($conexao, $sql_usuario);

    

?><section><?php
    while ($f = mysqli_fetch_array($res_usuario))
    {  
        echo "<form class='container' action='../php/sessao-chat.php' method='POST'><div class='chat'><a href='batepapo.php' style='color: black;'>";
        echo "<input name='id_envio' type='hidden' value =" . $id_foto = $f['id'] . ">"; 
        $sql_imgperfil = "SELECT * FROM `perfil` WHERE usuario_id = '$id_foto' ORDER BY `perfil`.`imagens` ASC";
        $res_imgperfil = mysqli_query($conexao, $sql_imgperfil);
        if ($row1 = mysqli_fetch_object($res_imgperfil)) {
        echo "<button class='pesquisa' type='submit'><img class='img_chat' src='data:image/jpeg;base64," . base64_encode( $row1->imagens ) . "' /><div>" . $f['nome'] . " " . $f['sobrenome'] . "</div></div></button>"; 
        } else {
        echo "<button class='pesquisa' type='submit'><img class='img_chat' src='../img/perfil.jpg' /><div>" . $f['nome'] . " " . $f['sobrenome'] . "</div></div></button>";
        } 
        echo "</a></div></form></div>";    
    }   

    
 
?></section>
</body>

</html>


