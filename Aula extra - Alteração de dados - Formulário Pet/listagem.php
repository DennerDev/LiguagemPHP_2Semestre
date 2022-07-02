<!doctype html> 
<html lang="pt-br">
	<head>
		<title>Listagem de Pets</title>
		<meta charset="UTF-8">
	</head>
	
	<body>
		<h1>Sistema Gerencial de Pets</h1>
		<h3>Listagem de Pets</h3>
		<hr>
		<?php
			/* 	Objetivo:
				=========
				Listar, na tela (página web), os Pets cadastrados.
				
				Passos
				======
				1 - Conectar esta página PHP com o MYSQL
				2 - Abrir o banco de dados SQL na conexão aberta
				3 - Executar uma consulta de seleção de dados / registros
					3.1 Inserir o comando SQL de SELEÇÃO numa variável
					3.2 Exibir a variável (com o comando) na tela
					3.3 Copiar o comando (SQL) e testar no console do MYSQL
					3.4 Após testar e funcionar no console, esconder o comando
					3.5 Enviar a variável para o MYSQL executar
				4 - Recuperar o número de linhas de $registros
				  - Se estiver vazia a tabela ($linhas<1), encerrar e avisar usuário
				  - Caso contrário, mostro quantos pets tem na tabela
			*/
			
			// 1 - Conectar esta página PHP com o MYSQL
			$servidor	= "localhost" ;
			$usuario	= "root";
			$senha		= "";
			$banco		= "sgp";
			
			$con = mysqli_connect($servidor, $usuario, $senha);
			
			// 2 - Abrir o banco de dados SQL na conexão aberta
			mysqli_select_db($con, $banco) or 
				die(
					"Erro ao abrir o banco:<br>" . mysqli_error($con) 
				);
			
			//	3 - Executar uma consulta de seleção de dados / registros
			//		3.1 Inserir o comando SQL de SELEÇÃO numa variável
			$comando="SELECT * FROM pets ORDER BY id";

			//		3.2 Exibir a variável (com o comando) na tela
			//		3.3 Copiar o comando (SQL) e testar no console do MYSQL
			//		3.4 Após testar e funcionar no console, esconder o comando
			//die($comando);
			
			//		3.5 Enviar a variável para o MYSQL executar
			//		- recebi um objeto record set (conjunto de registros)
			$registros = mysqli_query($con, $comando);
			
			/* Meu record set $registros está assim:
				+----+----------+------+------+--------------+-------+
				| id | nome     | sexo | tipo | nomeDono     | idade |
				+----+----------+------+------+--------------+-------+
				|  5 | Ligeiro  | M    | P    | Ana          |     4 |
				|  1 | Nina     | F    | G    | Carlos Majer |     7 |
				|  2 | Neguinho | M    | G    | Carlos Majer |    13 |
				|  4 | Mimosa   | F    | C    | Cristina     |     3 |
				|  3 | Soneca   | M    | C    | Ana          |     2 |
			->	+----+----------+------+------+--------------+-------+
			*/
			
			// 4 - Recuperar o número de linhas de $registros
			$linhas = mysqli_num_rows($registros);
			
			//	 - Se estiver vazia a tabela ($linhas<1), encerrar e avisar usuário
			if($linhas<1)
			{
				die("Cadastro de Pets vazio. Sistema Encerrado!");
			}
			// - Caso contrário, mostro quantos pets tem na tabela
			echo "<b>$linhas</b> Pets cadastrados.<hr>";
			
			
			// Iniciando a tabela
			echo "<table border='1'>";
			// 1a linha - títulos das células
			echo "	<tr bgcolor='plum'>";
			echo "		<th>N&ordm;</th>";
			echo "		<th>Nome</th>";
			echo "		<th>Sexo</th>";
			echo "		<th>Tipo</th>";
			echo "		<th>Idade</th>";
			echo "		<th>Dono</th>";
			echo "		<th>Foto</th>";
			echo "		<th>Ações</th>";
			echo "	</tr>";
			
			// Estrutura de repetição para ler, 1 linha de cada vez
			// de $registros, copiar os dados para dentro da matriz 
			// $dados e mostrar estes dados na tela
			
			for($n=0; $n<$linhas; $n++ )
			{
				$dados = mysqli_fetch_array($registros);
				
				// Criar variáveis com os dados lidos
				$id			= $dados["id"];
				$nome		= $dados["nome"];
				$sexo		= $dados["sexo"];
				$tipo		= $dados["tipo"];
				$idade		= $dados["idade"];
				$nomeDono	= $dados["nomeDono"];
				$foto  		= $dados["foto"];
				
				// Exibindo os dados na tabela
				
				if ($n%2==0)
					echo "<tr>";
				else
					echo "<tr bgcolor='lightBlue'>";
				
				echo "	<th bgcolor='silver'>" . ($n+1) . "</th>";
				echo "	<td>$nome</td>";
				echo "	<td>$sexo</td>";
				echo "	<td>$tipo</td>";
				echo "	<td>$idade</td>";
				echo "	<td>$nomeDono</td>";
				
				echo "	<td>";
				if($foto<>""){
					// imagem existe - vamos mostrar
					echo "<img src='imgs/$foto' width='100'>";
				}
				echo "	</td>";
				
				echo "	<td> 
							<a href='excluirPet.php?id=$id&nome=$nome'><img src='imgs/eliminar.png' alt='Excluir Pet $nome' title='Excluir Pet $nome'></a> 
							<a href='alterarPet.php?id=$id&nome=$nome'><img src='imgs/alterar.png'  alt='Alterar Pet $nome' title='Alterar Pet $nome'></a>
						</td>";
				echo "</tr>";
			}
			
			echo "</table>";
		?>
		<hr>
		Clique <a href='novoPet.html'>aqui</a> para Cadastrar um novo Pet
	</body>
</html>