<?php 

 	class Conexao{
 		private $pdo;
 		public $msgErro = "";
 		private $nome = "newsdb";
 		private $host = "localhost";
 		private $usuario = "root";
 		private $senha = "";	

 		public function conectar()
 		{
 			global $pdo;
 			global $msgErro;
 			try {
 				$pdo = new PDO("mysql:dbname=".$this->nome.";host=".$this->host,$this->usuario,$this->senha);

 			} catch (Exception $e) {
 				$msgErro = $e->getMessage();
 			}
 		}


 	}



 ?>