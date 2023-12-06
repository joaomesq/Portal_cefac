<?php
//Conexão
require_once './php_action/conect.php';

//Iniciando sessão
session_start();

if (isset($_POST['btn_entrar'])) {
	// code...
	$nome = clear($_POST['nome']);
	$senha = clear($_POST['senha']);
    $mensagem;

    if(empty($nome) OR empty($senha)):
    	$mensagem = 'Preencha todos os campos';
    else:
    	$sql = "SELECT nome_usuario FROM usuarios WHERE n_processo_usuario = '$nome' AND senha_usuario = '$senha'";
    	$consulta = mysqli_query($conect, $sql);

    	if(mysqli_num_rows($consulta) == 1 ):
    		$dados = mysqli_fetch_assoc($consulta);
            $mensagem = 'Welcome '.$dados['nome_usuario'];
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $dados['nome_usuario'];
            
            header('Location: index.php');
    	else:
    		$mensagem = 'Credencias incorretas';
    	endif;

    endif;
    $_SESSION['mensagem'] = $mensagem;
}
?>

<!DOCTYPE html>
<html lang="pt-ao">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="stylesheet" href="./css/login.css">
	<title>YIA | Portal Informática</title>
</head>
<body>
    <header class="cabecalho">
     	<h1><img src="./img/logo_black.png"></h1>
    </header>

     <main>
     	<article class="login">
           <section class="card_login">
            <div class="logo_card_login">
                <img src="./img/logo_black.png">
            </div>
            <br>
            <div class="self">
                <h2>The World is amaizing</h2>
                <p>"Chanax: Desenvolvendo ideias, criando soluções"</p>
            </div>
            
            <form action="" method="POST" name="form_login">
                <label>User</label>
                <p>
                    <input type="text" name="nome" placeholder="" autofocus>
                </p>

                <br>
                <br>
                <label>Password</label>
                <p>
                    <input type="password" name="senha" placeholder="">
                </p>
                <p class="forgwat"><a href="#">Esqueceu a senah?</a></p>
                <br>
                <button type="submit" name="btn_entrar">Entrar</button>
            </form>
          </section>

          <section class="void"></section>  
        </article>
     </main>

     <script type="text/javascript" src="./js/validacao_de_formulario.js"></script>
</body>
</html>