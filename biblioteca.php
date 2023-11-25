<?php
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
            echo "Livro carregado com sucesso para acessar, clique aqui: <a href='$caminho' target='_blank'>Clique Aqui</a>";
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
            echo "Livro carregado com sucesso para acessar, clique aqui: <a href='$caminho' target='_blank'>Clique Aqui</a>";
        else:
            echo "Fallha ao enviar arquivo";
        endif;
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
    <title>YIA | Portal Informática</title>
</head>
<body>
    <header>
        <h1><img src="../img/LOGO-CHANAX-BLACK.png"></h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="notas.php">Notas</a></li>
                <li><a href="biblioteca.php">Biblioteca</a></li>
            </ul>
        </nav>
     </header>

     <main>
        <h2>User_name</h2>
        <article class="conteudo">
            <section class="materia">
                <h3>Apresentações</h3>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Disciplina</th>
                            <th>Título</th>
                            <th>Professor</th>
                            <th>Link</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>SEAC</td>
                            <td>Endereçamento IP</td>
                            <td>Maria Soares</td>
                            <td><a href="#">download</a></td>
                        </tr>
                        <tr>
                            <td>Progamação</td>
                            <td>Introdução ao HTML5</td>
                            <td>Cadiny</td>
                            <td><a href="#">download</a></td>
                        </tr>
                    </tbody>
                </table>

                <button name="adicionar_apresentacao">Adicionar</button>
                <form action="" method="POST" name="apresentacao" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Adicionar Apresentação</legend>

                        <p><input type="text" name="disciplina" placeholder="Disciplina"></p>
                        <p><input type="file" name="arquivo_apresentacao"></p>

                        <button name="carregar_apresentacao" type="submite">Upload</button>
                        <button type="reset">Limpar</button>
                    </fieldset>
                </form>
            </section>

            <section class="livros">
                <h3>Livros</h3>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Ano de Publicação</th>
                            <th>Link</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>HTML5 & CSS3</td>
                            <td>Lucas Mazza</td>
                            <td>2012</td>
                            <td><a href="#">download</a></td>
                        </tr>
                        <tr>
                            <td>MD_Redes de Computador</td>
                            <td>Santa Maria</td>
                            <td>2018</td>
                            <td><a href="#">download</a></td>
                        </tr>
                    </tbody>
                </table>

                <button name="adicionar_livro">Adiconar</button>
                <form name="livro" action="" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Adicionar Livro</legend>

                        <p><input type="text" name="autor_livro" placeholder="Autor"></p>
                        <p><input type="text" name="categoria_livro" placeholder="Categoria"></p>
                        <p><input type="number" name="ano_publicacao_livro" placeholder="Ano de Publicação"></p>
                        <p><input type="file" name="arquivo_livro"></p>
                        
                        <button name="carregar_livro" type="submite">Upload</button>
                        <button type="reset">Limpar</button>
                    </fieldset>
                </form>
            </section>
        </article>
     </main>
     <footer></footer>
</body>
</html>