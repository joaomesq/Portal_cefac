<?php
//validar
require_once './php_action/validar.php';

?>
<!DOCTYPE html>
<html lang="pt-ao">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="./css/normalize.css">
     <link rel="stylesheet" href="./css/custom.css">

	<title>YIA | Portal Informática</title>
</head>
<body>
     <header class="cabecalho">
          <section>
     	<h1><a href="index.php"><img src="./img/logo_black.png"></a></h1>
          
          <button class="btn_open">Open</button>
          <div class="modal">
          <button class="btn_close">X</button>
     	<nav>
     		<ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="notas.php">Notas</a></li>
                    <li><a href="biblioteca.php">Biblioteca</a></li>
                    <li><a href="login.php">Login</a></li>
               </ul>
     	</nav>
          </section>
          <h2><span><?php echo $_SESSION['usuario']; ?></span></h2>
     </header>

     <main class="principal">
          <a href="biblioteca.php?sair=1" class="btn_sair">Sair</a>
     </main>

     <footer class="center">
          <p>"Chanax: Desenvolvendo ideias, criando soluções"</p>
          <p>&copy; 2023 - Todos os direitos reservados a Chanax Tecnolog.</p>
     </footer>

     <script type="text/javascript" src="./js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./js/materialize.min.js"></script>

    <script>
          $(".btn_open").click(function () {
               $(".modal").show();
          })
          $(".btn_close").click(function () {
               $(".modal").hide();
          });
     </script>
</body>
</html>