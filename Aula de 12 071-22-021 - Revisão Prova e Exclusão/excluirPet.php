<!doctype html> <!-- salvar como excluirPet.php -->
<html lang="pt-br">
	<head>
		<title>SGP - Sistema Gerencial de Pets</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<h1>SGP - Sistema Gerencial de Pets</h1>
		<h3>Exclusão de Pet</h3>
		<hr>
		<?php
			/*
			Objetivo:
			=========
			Recebidos o id e nome do Pet, via método GET, exibir o nome 
			na tela, e efetuar a exclusão do Pet informado.
			
			Seqüencia de Passos:
			--------------------
			1. Verificar se foram enviados o id e nome via método GET
			=> Se não foram enviados, avisar o usuário e parar o programa
			
			2. Conectar no Servidor MYSQL
			3. Abrir o banco de dados SGP
			4. Criar a variável com o comando SQL de exclusão de dados
			5. Enviar o comando (variável) p/o MYSQL
			*/
			
			if( isset($_GET["id"]) && isset($_GET["nome"]) )
			{
				$id = $_GET["id"];
				$nome = $_GET["nome"];
			}
			else
			{
				die("Rotina chamada de forma incorreta. Sistema interrompido!");
			}
			
			// Mostrar o pet na tela
			echo "Excluindo pet <b>$nome [$id]</b><br>";
			
			//2. Conectar no Servidor MYSQL
			$servidor 	= "localhost";
			$usuario	= "root";
			$senha		= "";
			$banco 		= "sgp";
			
			$con = mysqli_connect($servidor,$usuario,$senha);
			
			//3. Abrir o banco de dados SGP
			mysqli_select_db($con, $banco) or 
				die("Erro na abertura do banco:<br>" . mysqli_error($con) );
			
			// 4. Criar a variável com o comando SQL de exclusão de dados
			$comandoSQL = "DELETE FROM pets WHERE id=$id";
			
			// Exibimos a variável c/ o comando na tela p/
			// testar no console do MYSQL
			// Se funcionar o teste, esconder o comando da tela
			// die($comandoSQL);
			
			// 5. Enviar o comando (variável) p/o MYSQL
			mysqli_query($con, $comandoSQL) or 
				die("Erro na exclusão do Pet:<br>" . mysqli_error($con) );
				
			// Se chegou até aqui é pq excluiu o Pet
			echo "Pet <b>$nome</b> excluído com sucesso!";
		?>
		
		<hr>
		Clique <a href='listagem.php'>aqui</a> para <b>Listagem de Pets</b>
	</body>
</html>
		