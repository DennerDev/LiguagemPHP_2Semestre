<!doctype html> <!-- salvar como listagem.php -->
<html lang="pt-br">
	<head>
		<title>SGP - Sistema Gerencial de Pets</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<h1>SGP - Sistema Gerencial de Pets</h1>
		<h3>Listagem de Pets</h3>
		<hr>
		<?php
			/*
				Objetivo:
				=========
				Listar os registros de pets cadastrados
				
				Passos:
				=======
				1 - Conectar no MYSQL
				2 - Abrir (selecionar) o banco SGP
				3 - Colocar numa variável o comando de seleção de dados
				4 - Enviar o comando de seleção de dados para o MYSQL
				5 - Obter o número de linhas (registros) do record set $registros
					- Se for menor que 1, avisar que cadastro está vazio e encerrar o programa
					- Caso contrário, mostrar o número de pets ($linhas) encontrados.
				6 - Exibir os registros de dados (de $registros)
			*/


			// 1 - Conectar no MYSQL
			$servidor 	= "localhost";
			$usuario	= "root";
			$senha		= "";
			$banco		= "sgp";
			$conexao = mysqli_connect($servidor, $usuario, $senha);
			
			
			// 2 - Abrir (selecionar) o banco SGP
			mysqli_select_db($conexao, $banco) or 
				die(
					"Erro na abertura do banco de dados:<br>" . mysqli_error($conexao)
				);

			// 3 - Colocar numa variável o comando de seleção de dados
			$comandoSQL = "SELECT * FROM pets";

			// Mostra a variável com o comando na tela,
			// copia e cola no console do MYSQL para testar
			//die($comandoSQL);
			
			// Após testar o comando e verificar que está correto /
			// funcionando no console, deve-se esconder o comando da tela
			
			// 4 - Enviar o comando de seleção de dados para o MYSQL
			//     usando a função mysqli_query() que devolve um objeto 
			//	   do tipo Record Set (conjunto de registros)
			
			$registros = mysqli_query($conexao, $comandoSQL) or 
				die(
					"Erro na seleção de dados:<br>" . mysqli_error($conexao)
				);
			
			// $registros é um objeto complexo, que contém 
			// os nomes dos campos e os registros devolvidos pelo
			// comando de seleção de dados SQL
			
			/*	$registros é algo parecido com isto:
				+----+----------+------+------+--------------+-------+
				| id | nome     | sexo | tipo | nomeDono     | idade |
				+----+----------+------+------+--------------+-------+
				|  1 | Nina     | F    | G    | Carlos Majer |     7 |
				|  3 | Soneca   | M    | C    | Ana          |     2 |
				|  2 | Neguinho | M    | G    | Carlos Majer |    13 |
			->	|  5 | Ligeiro  | M    | P    | Ana          |     2 |
				|  4 | Mimosa   | F    | C    | Cristina     |     3 |
				+----+----------+------+------+--------------+-------+
			*/
			
			// 5 - Obter o número de linhas (registros) do record set $registros
			$linhas = mysqli_num_rows($registros);
			
			if($linhas<1)
			{
				// Se o número de linhas for menor que 1, é porque o cadastro
				// está vazio, então, devo avisar o (a) usuário (a) e 
				// encerrar o programa.
				die("Cadastro de Pets vazio. Sistema Encerrado!");
			}
			
			echo "<b>$linhas</b> Pets existentes<hr>";
			
			// 6 - Exibir os registros de dados (de $registros)
			
			// Lendo as linhas de $registros
			for($n=0; $n<$linhas; $n++)
			{
				$dados = mysqli_fetch_array($registros);
			
				echo "ID: " 	. $dados["id"] 		. "<br>";
				echo "Nome: " 	. $dados["nome"] 	. "<br>";
				echo "Sexo: " 	. $dados["sexo"] 	. "<br>";
				echo "Tipo: " 	. $dados["tipo"] 	. "<br>";
				echo "Idade: " 	. $dados["idade"] 	. "<br>";
				echo "Dono: " 	. $dados["nomeDono"]. "<hr>";
			}

			/*
				mysqli_fetch_array leu $registros e criou $dados assim:
				$dados["id"] = 1;
				$dados["nome"] = "Nina";
				$dados["sexo"] = "F";
				$dados["tipo"] = "G";
				$dados["idade"] = 7;
				$dados["nomeDono"] = "Carlos Majer";
			*/
		?>
		Fim da Listagem.
	</body>
</html>