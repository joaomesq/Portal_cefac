<?php
//validar
require_once './php_action/validar.php';
//conexao
require_once './php_action/conect.php';



//UPLOAD APRESENTACAO
function ulpoad_apresentacao(){
    global $conect;

    $disciplina = clear($_POST['disciplina']);

    if($_FILES['arquivo_apresentacao']['size'] == 0)
        die("Selecione o arquivo");

    if(empty($disciplina))
        die("Precisa preenche o campo disciplina");


    if(isset($_FILES['arquivo_apresentacao'])):
        $apresentacao = $_FILES['arquivo_apresentacao'];
        $pasta = 'apresentacao/';

        if($apresentacao['error'])
            die("Fallha ao carregar arquivo");

        $nome_apresentacao = $apresentacao['name'];
        $novo_nome_livro = uniqid();
        $extensao = strtolower(pathinfo($nome_apresentacao, PATHINFO_EXTENSION));
        $caminho = $pasta.$nome_apresentacao.".".$extensao;

        if($extensao != 'pptx' AND $extensao != 'ppt' AND $extensao != 'pps' AND $extensao != 'potx' AND $extensao != 'ppsx')
            die("Tipo de arquivo não aceito");

        $sucesso = move_uploaded_file($apresentacao['tmp_name'], $caminho);

        if($sucesso):
            $sql = "INSERT INTO apresentacao (titulo_apresentacao, disciplina_apresentacao, data_upload_apresentacao, caminho_apresentacao) VALUES ('$nome_apresentacao', '$disciplina', NOW(), '$caminho')";
            $consulta = mysqli_query($conect, $sql);
        else:
            echo "Fallha ao enviar arquivo";
        endif;
    endif;
} 


//UPLOAD LIVROS
function ulpoad_livros(){
    global $conect;

    $autor = clear($_POST['autor_livro']);
    $categoria = clear($_POST['categoria_livro']);
    $ano_publicacao_livro = clear($_POST['ano_publicacao_livro']);

    if($_FILES['arquivo_livro']['size'] == 0)
        die("Selecione o arquivo");

    if(empty($autor) OR empty($categoria) OR empty($ano_publicacao_livro))
        die("Precisa preenche os campos autor, categoria e Ano de Publicacao");


    if(isset($_FILES['arquivo_livro'])):
        $livro = $_FILES['arquivo_livro'];
        $pasta = 'livros/';

        if($livro['error'])
            die("Fallha ao carregar arquivo");

        $nome_livro = $livro['name'];
        $novo_nome_livro = uniqid();
        $extensao = strtolower(pathinfo($nome_livro, PATHINFO_EXTENSION));
        $caminho = $pasta.$nome_livro.".".$extensao;

        if($extensao != 'pdf')
            die("Tipo de arquivo não aceito");

        $sucesso = move_uploaded_file($livro['tmp_name'], $caminho);

        if($sucesso):
            $sql = "INSERT INTO livros (titulo_livro, autor_livro, categoria_livro, ano_publicacao_livro, data_upload_livro, caminho_livro) VALUES ('$nome_livro', '$autor', '$categoria', '$ano_publicacao_livro', NOW(), '$caminho')";
            $consulta = mysqli_query($conect, $sql);
        else:
            echo "Fallha ao enviar arquivo";
        endif;
    endif;
}

//exibir livro
function exibir_livro(){
    global $conect;
    $sql = "SELECT *FROM livros ORDER BY categoria_livro DESC";
    $consulta = mysqli_query($conect, $sql);

    if(mysqli_num_rows($consulta) != 0):
        while($livros = mysqli_fetch_assoc($consulta)):
            echo "
                 <tr>
                     <td>".$livros['titulo_livro']."</td>
                     <td>".$livros['autor_livro']."</td>
                     <td>".$livros['ano_publicacao_livro']."</td>
                     <td>".$livros['categoria_livro']."</td>
                     <td><a href='".$livros['caminho_livro']."' target='_blank'>download</a></td>
                 </tr>
                 ";
        endwhile;
    else:
        echo "Não existem Livros";
    endif;
}

//exibir apresentacao
function exibir_apresentacao(){
    global $conect;
    $sql = "SELECT *FROM apresentacao ORDER BY disciplina_apresentacao DESC";
    $consulta = mysqli_query($conect, $sql);

    if(mysqli_num_rows($consulta) != 0):
        while($apresentacoes = mysqli_fetch_assoc($consulta)):
            echo "
                 <tr>
                     <td>".$apresentacoes['disciplina_apresentacao']."</td>
                     <td>".$apresentacoes['titulo_apresentacao']."</td>
                     <td><a href='".$apresentacoes['caminho_apresentacao']."' target='_blank'>download</a></td>
                 </tr>
                 ";
        endwhile;
    else:
        echo "Não existem Livros";
    endif;
}

 //Upload livro
 if (isset($_POST['carregar_livro'])) {
    ulpoad_livros();
 }

 //...Apresentação
 if(isset($_POST['carregar_apresentacao'])):
    ulpoad_apresentacao();
endif;
?>

<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="stylesheet" href="./css/biblioteca.css">
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

     <main>
        <article class="conteudo">
            <section class="material">
                <h3 class="span"><span>Apresentações</span></h3>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Disciplina</th>
                            <th>Título</th>
                            <th>Link</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            exibir_apresentacao();
                        ?>
                    </tbody>
                </table>
            </section>

            <section class="material">
                <h3 class="span"><span>Livros</span></h3>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Ano de Publicação</th>
                            <th>Categoria</th>
                            <th>Link</th>
                        </tr>
                    </thead>

                    <tbody>
                          <?php
                              exibir_livro();
                          ?>
                    </tbody>
                </table>
            </section>
            </article>

            <article class="adicionar">
            <button name="btn_adicionar" class="btn_adicionar btn_open_adicionar">Adicionar</button>
            <section class="modal_adicionar">

                <button class="btn_close_adicionar">X</button>
                <div class="modal_adicionar_elementos">

                <div class="modal_add adicionar_apresentacao">
                <form action="" method="POST" name="apresentacao" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Adicionar Apresentação</legend>

                        <p>
                            <label>Disciplina</label>
                            <input type="text" name="disciplina" placeholder="Disciplina">
                        </p>
                        <p>
                            <label>Ficheiro</label>
                            <input type="file" name="arquivo_apresentacao">
                        </p>

                        <br>
                        <button name="carregar_apresentacao" type="submite" class="btn_adicionar">Upload</button>
                        <button type="reset" class="limpar">Limpar</button>
                    </fieldset>
                </form>
                </div>

                <div class="modal_add adicionar_livro">
                <form name="livro" action="" method="POST" enctype="multipart/form-data">
                        <fieldset>
                        <legend>Adicionar Livro</legend>

                        <p>
                            <label>Autor</label>
                            <input type="text" name="autor_livro" placeholder="Autor">
                        </p>
                        <p>
                            <label>Categoria</label>
                            <input type="text" name="categoria_livro" placeholder="Categoria">
                        </p>
                        <p>
                            <label>Ano de Publicação</label>
                            <input type="number" name="ano_publicacao_livro" placeholder="Ano de Publicação">
                        </p>
                        <p>
                            <label>Ficheiro</label>
                            <input type="file" name="arquivo_livro">
                        </p>
                        
                        <br>
                        <button name="carregar_livro" type="submite" class="btn_adicionar">Upload</button>
                        <button type="reset" class="limpar">Limpar</button>
                    </fieldset>
                </form>
                </div>

                </div>
            </section>

            <a href="biblioteca.php?sair=1" class="btn_sair">Sair</a>
        </article>
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