<?php

require 'conexao.php';

class Noticia{

	private $inicioDaSemana;
	private $fimDaSemana;

	public function __construct()
	{
		// conecta com o banco de dados
		$conexao = new Conexao();
		$conexao->conectar();
		date_default_timezone_set('America/Sao_Paulo');
		$this->inicioDaSemana = date('d/m',strtotime('-3 days'));
		$this->fimDaSemana = date('d/m',strtotime('+3 days')); 
	}

	public function salvarDados($titulo,$topico,$desc,$link,$imagem)
	{
		// inserir dados do formulario no banco 
		global $pdo;
		global $msgErro;
		$hoje = date('d/m/Y');

		if (empty($titulo) || empty($topico) || empty($desc) || empty($link) || empty($imagem)) {
			$msgErro = "Erro ao cadastrar, algum campo está vazio";
			echo '<script language="javascript">';
			echo 'alert("Erro ao cadastrar, algum campo está vazio!")';
			echo '</script>';
		}else{
			try {
			$inserir = $pdo->prepare("INSERT INTO noticias(titulo,topico,descricao,link,imagem,diaPostagem) 
								  VALUES(:tit,:top,:des,:link,:img,:d)");
			$inserir->bindValue(":tit",$titulo);
			$inserir->bindValue(":top",$topico);
			$inserir->bindValue(":des",$desc);
			$inserir->bindValue(":link",$link);
			$inserir->bindValue(":img",$imagem);
			$inserir->bindValue(":d",$hoje);
			$inserir->execute();
			return true;
			} catch (Exception $e) {
				$msgErro = "Erro ao Cadastrar!";
				echo '<script language="javascript">';
				echo 'alert("Erro ao cadastrar, algum campo está vazio!")';
				echo '</script>';
				return false;
			}
		}
	}
	public function exibeDados()
	{
		global $pdo;
		global $msgErro;
		global $array;
		$inicioDaSemana = intval(date('d',strtotime('-3 days')));
		$fimDaSemana = intval(date('d',strtotime('+3 days'))); 
		
		$selectDataPostagem = $pdo->prepare("SELECT diaPostagem FROM noticias");
		$selectDataPostagem->execute();
		$resultado = $selectDataPostagem->fetchAll(PDO::FETCH_ASSOC);

		foreach ($resultado as $data) {
			$dataPostagem = $data['diaPostagem'];
			$dia = intval(mb_substr($data['diaPostagem'], 0, 2));

			if ($dia >= $inicioDaSemana) {
				$selectAll = $pdo->prepare("SELECT * FROM noticias WHERE diaPostagem = '$dataPostagem'");
				$selectAll->execute();
				$array = $selectAll->fetchAll(PDO::FETCH_ASSOC);
				return $array;
			}else{
				return false;
			}
		}
	}
	public function exibePesquisa($topico)
	{
		global $pdo;
		global $resultadoPesquisa;

		$selectAll = $pdo->prepare("SELECT * FROM noticias WHERE topico = '$topico'");
		$selectAll->execute();
		$resultadoPesquisa = $selectAll->fetchAll(PDO::FETCH_ASSOC);
		return $resultadoPesquisa;
	}

	public function excluirMateria($codigo)
	{
		global $pdo;
		$excluir = $pdo->prepare("DELETE FROM noticias WHERE codigo = :cod");
		$excluir->bindValue(":cod",$codigo);
		$excluir->execute();
		if ($excluir->execute()) {
			echo '<script language="javascript">';
			echo 'alert("Notícia excluida com sucesso!")';
			echo '</script>';
		}else{
			echo '<script language="javascript">';
			echo 'alert("Erro ao excluir a notícia")';
			echo '</script>';
		}
	}

	public function getTopico()
	{
		global $pdo;
		$selectAll = $pdo->prepare("SELECT DISTINCT topico FROM noticias");
		$selectAll->execute();
		$array = $selectAll->fetchAll(PDO::FETCH_ASSOC);
		foreach ($array as $topico) {
			echo "<option>{$topico['topico']}</option>";
		}
	}
	public function getData()
	{
		echo "{$this->inicioDaSemana} À {$this->fimDaSemana}";
	}
}




 ?>