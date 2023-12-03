<?php
//conexao
require_once 'conect.php';

//Exibir arquivo
function exibir($valor){
	global $conect;
    
    //LIVRO
	if ($valor == 'livro') {
		// code...
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
                     <td><a href='".$livros['caminho_livro']."' target='_blank'><img src='./img/dowload.png'></a></td>
                 </tr>
                 ";
        endwhile;
    else:
        echo "
              <tr>
                  <td>Sem ficheiros</td>
              </tr>
              ";
    endif;
	}
	//APRESENTACAO
	elseif ($valor =="apresentacaco") {
		// code...
		$sql = "SELECT *FROM apresentacao ORDER BY disciplina_apresentacao DESC";
    $consulta = mysqli_query($conect, $sql);

    if(mysqli_num_rows($consulta) != 0):
        while($apresentacoes = mysqli_fetch_assoc($consulta)):
            echo "
                 <tr>
                     <td>".$apresentacoes['disciplina_apresentacao']."</td>
                     <td>".$apresentacoes['titulo_apresentacao']."</td>
                     <td><a href='".$apresentacoes['caminho_apresentacao']."' target='_blank'><img src='./img/dowload.png'></a></td>
                 </tr>
                 ";
        endwhile;
    else:
        echo "
              <tr>
                  <td>Sem ficheiros</td>
              </tr>
              ";
    endif;
	}
}