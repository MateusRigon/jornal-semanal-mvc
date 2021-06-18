<?php
  require 'C:\xampp\htdocs\jornalSemanal\src\Model\Noticia.php';
  $titulo = "Cadastro de notícias";
  $noticia = new Noticia();

  if (isset($_POST['pronto'])) {
    $noticia->salvarDados($_POST['titulo'],$_POST['topico'],$_POST['descricao'],$_POST['link'],$_POST['imagem']);
  }
 
  require 'html-inicio.php';
 ?>
  <style type="text/css"><?php include '../public/CSS/cadastro.css'; ?></style>
  </head>
<body>
    <div>
      <!-- head da pagina -->
      <header>
        <a href="home-page">Voltar para Home</a>
      </header>
      <!-- corpo da pagina -->

      <div class="container">
        <form method="POST">
        <h1 class="mb-4">Cadastro de notícias</h1>
        <p class="mb-4">Realize o cadastro de uma nova notícia</p>
        <div class="d-flex flex-column">
          <label for="titulo">Título <span class="requireDot"> * </span></label> 
          <input type="text" name="titulo" placeholder="Ex: Nova proposta governamental..." required>
        </div>
        <div class="d-flex flex-column">
          <label for="topico">Tópico <span class="requireDot"> * </span></label> 
          <input type="text" name="topico" placeholder="Ex: Economia, saúde..." required>
        </div>
        <div class="d-flex flex-column">
          <label for="desc">Descrição</label>
          <p>Informe uma descriçao da notícia</p>
          <textarea name="descricao"></textarea>
        </div>
        <div class="d-flex flex-column">
          <label for="link">Link da matéria</label>
          <p>Endereço original da matéria</p>
          <input type="text" name="link" placeholder="https://" required>
        </div>
        <div class="d-flex flex-column">
          <label for="imagem">Imagem</label>
          <p>Escolha uma imagem para a capa da matéria</p>
          <input type="file" name="imagem">
        </div>
        <div class="d-flex justify-content-center">
           <input id="submit" type="submit" name="pronto" value="Cadastrar">
        </div>
        </form>
      </div>
    </div>
<?php 
    require 'html-fim.php';
 ?>