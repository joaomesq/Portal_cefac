<?php
require_once './php_action/validar.php';
//conexao
require_once './php_action/conect.php';

   $user_name = "Mesquita";

   
   function p_trimestre(){
     global $user_name;
     global $conect;
     $sql = "SELECT *FROM notas WHERE trimestre = 1 AND nome_aluno = '$user_name' ORDER BY disciplina desc";
     $consulta = mysqli_query($conect, $sql);

     if( mysqli_num_rows($consulta) != 0){
          
          while($dados = mysqli_fetch_assoc($consulta)):
               $media = ($dados['primeira_nota'] + $dados['segunda_nota'] )/ 2;
               echo "
                    <tr>
                      <td>".$dados['disciplina']."</td>
                      <td>".$dados['primeira_nota']."</td>
                      <td>".$dados['segunda_nota']."</td>
                      <td>".$media."</td>
                    </tr>
                    ";
          endwhile;
     }else{
          echo "
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                    ";
     }
     
   }

   function s_trimestre(){
     global $conect;
     global $user_name;
     $sql = "SELECT *FROM notas WHERE trimestre = 2 AND nome_aluno = '$user_name'";
     $consulta = mysqli_query($conect, $sql);

     if( mysqli_num_rows($consulta) != 0){
          
          while($dados = mysqli_fetch_assoc($consulta)):
               $media = ($dados['primeira_nota'] + $dados['segunda_nota'] )/ 2;
               echo "
                    <tr>
                      <td>".$dados['disciplina']."</td>
                      <td>".$dados['primeira_nota']."</td>
                      <td>".$dados['segunda_nota']."</td>
                      <td>".$media."</td>
                    </tr>
                    ";
          endwhile;
     }else{
          echo "
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                    ";
     }
   }

   function t_trimestre(){
     global $conect;
     global $user_name;
     $sql = "SELECT *FROM notas WHERE trimestre = 3 AND nome_aluno = '$user_name'";
     $consulta = mysqli_query($conect, $sql);

     if( mysqli_num_rows($consulta) != 0){
          
          while($dados = mysqli_fetch_assoc($consulta)):
               $media = ($dados['primeira_nota'] + $dados['segunda_nota'] )/ 2;
               echo "
                    <tr>
                      <td>".$dados['disciplina']."</td>
                      <td>".$dados['primeira_nota']."</td>
                      <td>".$dados['segunda_nota']."</td>
                      <td>".$media."</td>
                    </tr>
                    ";
          endwhile;
     }else{
          echo "
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                    ";
     }
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
          <h1><img src="../img/LOGO-CHANAX-BLACK.png"></h1>
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
          <h2><?php echo $user_name; ?></h2>
          <article class="notas">
               <section class="primeiro_trimestre">
                    <h3>1º Trimestre</h3>
                    <table border="1">
                         <thead>
                              <tr>
                                   <th>Disciplina</th>
                                   <th>1ª Parcelar</th>
                                   <th>2ª Parcelar</th>
                                   <th>Nota Final</th>
                              </tr>
                         </thead>
                         <tbody>
                                   <?php
                                        p_trimestre();
                                   ?>
                         </tbody>
                    </table>
               </section>
               <section class="segundo_trimestre">
                    <h3>2º Trimestre</h3>
                    <table border="1">
                         <thead>
                              <tr>
                                   <th>Disciplina</th>
                                   <th>1ª Parcelar</th>
                                   <th>2ª Parcelar</th>
                                   <th>Nota Final</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                                   s_trimestre();
                              ?>
                         </tbody>
                    </table>
               </section>
               <section class="terceiro_trimestre">
                    <h3>3º Trimestre</h3>
                    <table border="1">
                         <thead>
                              <tr>
                                   <th>Disciplina</th>
                                   <th>1ª Parcelar</th>
                                   <th>2ª Parcelar</th>
                                   <th>Nota Final</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                                   t_trimestre();
                              ?>
                         </tbody>
                    </table>
               </section>
          </article>
     </main>
     <footer></footer>
</body>
</html>