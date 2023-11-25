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
}
?>

<!DOCTYPE html>
<html lang="pt-ao">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>YIA | Portal Informática</title>
</head>
<body>
      <header>
     	<h1>Logo</h1>
     	<nav>
     		<ul>
     			<li><a href="index.php">Home</a></li>
     			<li><a href="notas.php">Notas</a></li>
     			<li><a href="biblioteca.php">Biblioteca</a></li>
     			<li><a href="login.php">Login</a></li>
     		</ul>
     	</nav>
     </header>

     <main>
     	<section class="login">
     		<form action="" method="POST" name="form_login">
     			<label>User</label>
     			<p>
     				<input type="text" name="nome" placeholder="Entre com email ou número de estudadnte">
     			</p>
     			<label>Password</label>
     			<p>
     				<input type="password" name="senha" placeholder="Password">
     			</p>
     			<a href="#">Esqueceu a senah?</a>
     			<br>
     			<button type="submit" name="btn_entrar">Entrar</button>
     		</form>
     	</section>
     </main>

     <footer></footer>
</body>
</html>