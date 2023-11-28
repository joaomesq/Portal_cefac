<?php
//validar
require_once './php_action/validar.php';

?>
<!DOCTYPE html>
<html lang="pt-ao">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

     <link rel="stylesheet" href="./css/custom.css">

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
     	<h2><?php echo $_SESSION['usuario']; ?></h2>
          <a href="biblioteca.php?sair=1">Sair</a>
     </main>
     <footer></footer>
     <script type="text/javascript" src="./js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./js/materialize.min.js"></script>
</body>
</html>