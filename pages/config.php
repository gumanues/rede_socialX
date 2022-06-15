<link rel="stylesheet" href="../css/config.css">
<?php 
session_start();
include('../php/conexao.php');
include_once('header.php');
$id = $_SESSION['id'];

$sql = "SELECT * FROM usuario WHERE id = '$id'";
	$res = mysqli_query($conexao, $sql);
	$total = mysqli_num_rows($res);

	while ($f = mysqli_fetch_array($res))
	{
    $nome = $f['nome']; 
    $sobrenome = $f['sobrenome'];
    $email = $f['email'];
    $aniversario = $f['aniversario']; 
	}

if (isset($_GET['sair'])) {
    session_destroy(); 
    header('Location: ../index.html');	
} 

?>

<div class="modal-b">
    <div class="modal-button">
        <button class="botao" onclick="openModal('dv-modal1')">Alterar dados pessoais</button>
    </div>
    <div class="modal-button">
        <button class="botao" onclick="openModal('dv-modal2')">Alterar Foto do Perfil e Fundo</button>
    </div>
    <div class="modal-button">
        <button class="botao"  onclick="openModal('dv-modal3')">Alterar Senha</button>
    </div>
    <div class="modal-button">
        <button class="botao" onclick="openModal('dv-modal4')">Excluir Conta</button>
    </div>
    <div class="modal-button">
        <form action="config.php" method="GET">
            <button class="botao" type='submit' name='sair'>Sair</button>
        </form>
    </div>
</div>




<div id="container">
    <div id="dv-modal1" class="modal1">
        <div class="modal-content1">
            <div class="modal-header1">
                <h1>Cadastro</h1>
            </div>

            <form action="../php/config/altera_dados.php" method="POST">
                <div class="modal-body1">
                    <div class="espaco">
                        <div class="ddt">
                            <label>Nome</label>
                        </div>
                        <input name="nome" <?php echo "value='$nome'" ?> maxlength="80" minlength="2" type="text"> <br>
                        <div class="ddt">
                            <label>Sobrenome</label>
                        </div>
                        <input name="sobrenome" <?php echo "value='$sobrenome'" ?> maxlength="80" minlength="2" type="text">
                    </div>
                    <div class="espaco">
                        <div class="ddt">
                            <label>E-mail</label>
                        </div>
                        <input name="email" <?php echo "value='$email'" ?> maxlength="80" minlength="12" type="email">
                    </div>
                    <div class="ddt">
                        <label>Data de nascimento</label>
                    </div>
                    <div class="espaco">
                        <input name="aniversario" <?php echo "value='$aniversario'" ?> type="date">
                    </div>

                </div>
                <div class="modal-footer1">
                    <button class="botao" type="submit" value="enviar">Enviar</button>
                    <a class="botaoa" type="reset" onclick="closeModal('dv-modal1')">Fechar</a>
                </div>
            </form>

        </div>
    </div>
    <div id="dv-modal2" class="modal1">
        <div class="modal-content1">
            <div class="modal-header1">
                <h2>Alterar Foto do Perfil e Fundo</h2>
            </div>
            <form enctype="multipart/form-data" action="../php/config/altera_imagens.php" method="POST">
                <div class="modal-body1">
                    <div class="espaco">
                        <div class="send_imagem">
                        <label class="inputs" for="img_perfil">Alterar imagem do perfil</label>
                         <input id="img_perfil" type="file" name="imagem_perfil">
                        </div>
                        <div class="send_imagem">
                        <label class="inputs" for="img_fundo">Alterar imagem do fundo</label>
                         <input id="img_fundo" type="file" name="imagem_fundo">
                        </div>
                    </div>
                </div>
                <div class="modal-footer1">
                    <button class="botao " type="submit">Enviar</button>
                        <a class="botaoa" onclick="closeModal('dv-modal2')">Fechar</a>
                </div>
            </form>
        </div>
    </div>
    <div id="dv-modal3" class="modal1">
        <div class="modal-content1">
            <div class="modal-header1">
                <h2>Alterar Senha</h2>
            </div>
            <form action="../php/config/altera_senha.php" method="POST">
                <div class="modal-body1">
                    <div class="ddt">
                        <label>Senha antiga: </label>
                    </div>
                    <div class="espaco">
                        <input name="senha_antiga" type="password" maxlength="80" minlength="6">
                    </div>
                    <br>
                    <br>
                    <a class="botaoa" onclick="openModal('dv-modal5')">Esqueci a senha</a>
                    <br>
                    <br>
                    <div class="ddt">
                        <label>Senha nova: </label>
                    </div>
                    <div class="espaco">
                        <input name="senha" type="password" maxlength="80" minlength="6">
                    </div>
                    <div class="ddt">
                        <label>Senha nova novamente: </label>
                    </div>
                    <div class="espaco">
                        <input name="senha_novamente" type="password" maxlength="80" minlength="6">
                    </div>
                </div>
                <div class="modal-footer1">
                    <button class="botao " type='submit' name='sair'>Alterar</button>
                    <a class="botaoa"onclick="closeModal('dv-modal3')">Fechar</a>
                </div>
            </form>
        </div>
    </div>




    <form action="../php/config/exclui_conta.php" method="POST">
        <div id="dv-modal4" class="modal1">
            <div class="modal-content1">

                <div class="modal-header1">
                    <h2>Digite sua senha para Excluir a conta</h2>
                </div>
                <div class="modal-body1">
                    <div class="ddt">
                        <label>Senha: </label>
                    </div>
                    <div class="espaco">
                        <input name="senha_exclusao" type="password" maxlength="80" minlength="6">
                    </div>
                </div>
                <div class="modal-footer1">
                      <a class="botaoa" onclick="openModal('dv-modal6')">Excluir</a>
                      <a class="botaoa" onclick="closeModal('dv-modal4')">Fechar</a>
                </div>

            </div>
        </div>

        <div id="dv-modal6" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Deseja excluir mesmo?</h1>
                </div>
                <div class="modal-body">

                    <div class="espaco">
                        <h3>A exclusão será permanente e não haverá volta.</h3>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="botaoa" name='sair' type="submit">Sim</button>
                    <a class="botaoa" onclick="closeModal('dv-modal6')">Não</a>
                </div>
            </div>
        </div>

    </form>

    <div id="dv-modal5" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Esqueceu a senha?</h1>
            </div>
            <div class="modal-body">

                <div class="espaco">
                    <h3>Caso esqueça a senha, entre em contato com um de nossos atendentes pelo numero 3400-0000
                    </h3>
                </div>

            </div>
            <div class="modal-footer">
                <a class="botaoa" onclick="closeModal('dv-modal5')">Fechar</a>
            </div>
        </div>
    </div>
</div>






</body>

</html>