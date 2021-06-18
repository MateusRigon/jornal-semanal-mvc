<?php 
require 'C:\xampp\htdocs\jornalSemanal\src\Model\Noticia.php';
$titulo = "Página inicial";
$news = new Noticia();

require 'html-inicio.php'; 
?>
  <style type="text/css"><?php include '../public/CSS/home-page.css'; ?></style>
  </head>
<body>
    <div>
      <!-- head da pagina -->
      <header>
        <div class="d-flex justify-content-center">
          <div class="d-flex flex-column">
            <div id="titulo"><h1>BOLETIM SEMANAL</h1></div>
            <div class="semana d-flex justify-content-center mb-3 mt-3"><h3><?php $news->getData(); ?></h3></div>
          </div>
        </div>
      </header>

      <!-- corpo da pagina -->

      <div class="container">
        <div class="d-flex">
          <form method="POST">
            <label for="topicos" class="mr-2">Pesquisar por tópico</label>
            <select name="topicos" class="mb-5">
              <option selected="true" disabled="disabled">Escolha</option>
              <?php $news->getTopico(); ?>
            </select>
            <input type="submit" name="pesquisar" value="ok">
          </form>
          <a href="register">cadastrar nova noticia</a>
        </div>
        <h1 class="pt-2 pb-2 mb-5">RESUMO DE NOTÍCIAS</h1>
          <?php
           if (isset($_POST['pesquisar'])){
              $news->exibePesquisa($_POST['topicos']);
              global $resultadoPesquisa;
              foreach ($resultadoPesquisa as $noticia) {
                ?>
                  <div class="mb-4" id="noticia">
                   <h1 id="topico" class="pt-2 pb-2 mb-4"><?php echo $noticia['topico']; ?></h1>
                   <h3><?php echo $noticia['titulo']; ?></h3>
                   <p><?php echo $noticia['diaPostagem'] ?></p>
                   <p>
                     <?php echo $noticia['descricao']; ?> 
                   </p>
                   <div class="d-flex">
                     <a class="mr-4" href="<?php echo $noticia['link']; ?>">Clique aqui para acessar a matéria completa</a>
                     <form method="POST">
                       <input type="hidden" name="id" value="<?php echo $noticia['codigo']; ?>">
                       <input type="submit" name="excluir" value="Excluir matéria">
                     </form>
                   </div>
                  </div>
                <?php
              }
           }else{

            $news->exibeDados();
            global $array;
            
            if ($array === NULL) {
              echo "Não há nenhum dado no sistema, por favor cadastre uma nova notícia.";
            }else{
              foreach ($array as $noticia) {
               ?>
                <div class="mb-4" id="noticia">
                 <h1 id="topico" class="pt-2 pb-2 mb-4"><?php echo $noticia['topico']; ?></h1>
                 <h3><?php echo $noticia['titulo']; ?></h3>
                 <p><?php echo $noticia['diaPostagem'] ?></p>
                 <p>
                   <?php echo $noticia['descricao']; ?> 
                 </p>
                 <div class="d-flex">
                   <a class="mr-4" href="<?php echo $noticia['link']; ?>">Clique aqui para acessar a matéria completa</a>
                   <form method="POST">
                     <input type="hidden" name="id" value="<?php echo $noticia['codigo']; ?>">
                     <input type="submit" name="excluir" value="Excluir matéria">
                   </form>
                 </div>
                </div>
                <?php
              }
            }
           }
           if (isset($_POST['excluir'])) {
                  $news->excluirMateria($_POST['id']);
            }
        ?>
              

      </div>
    </div>
  
<?php require 'html-fim.php'; ?>