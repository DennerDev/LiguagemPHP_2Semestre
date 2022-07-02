<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>SGP - Sistema Gerencial de Pets</title>
	</head>

	<body>
		<h1>Sistema Gerencial de Pets</h1>
		<hr>
		<h2>Cadastrando Pet. . .</h2>

		<?php
			// salvar como incluirPet.php
			
			// dados chegam na matriz $_GET[""] ou $_POST[""]
			
			// Variável:
			// =========
			// Espaço em memória do computador que se dá um nome 
			// e armazena um valor que pode ser posteriormente alterado (varidado)
			
			// Matriz:
			// =======
			// Espaço em memória do computador que se dá um nome 
			// e armazena diversos valores em posições diferentes que podem ser 
			// posteriormente alterados
			
			// 1 - Receber os dados do formulário em variáveis
			$nome		= $_GET["nome"];
			$tipo		= $_GET["tipo"];
			$sexo		= $_GET["sexo"];
			$nomeDono	= $_GET["nomeDono"];
			$idade		= $_GET["idade"];
			
			// 2 - Validação básica de dados
			
			// nome do pet não pode estar em branco
			
			// == operador de comparação (compara o valor da esquerda c/o da direita)
			// = operador de atribuição (atribui o valor da direita no elemento à esquerda)
			
			if ($nome=="")
			{
				die("<b>Nome do Pet</b> deve ser informado. Sistema cancelado!");
			}
			
			// nome do dono do pet não pode estar em branco
			if ($nomeDono=="")
			{
				die("<b>Nome do Dono do Pet</b> deve ser informado. Sistema cancelado!");
			}
			
			// o tipo do pet não pode estar em branco (opção escolha)
			if($tipo=="")
			{
				die("<b>Tipo do pet</b> deve ser informado. Sistema Cancelado!");
			}
			
			// 3 - Exibir os dados na tela
			echo "Nome: <b>$nome</b><br>";
			echo "Tipo: <b>$tipo</b><br>";
			echo "Sexo: <b>$sexo</b><br>";
			echo "Nome do Dono: <b>$nomeDono</b><br>";
			echo "Idade: <b>$idade</b><hr>";
			
			/*
				PHP - funções nativas para acesso ao MYSQL
				mysqli_connect 	- Conecta no Servidor MYSQL
				mysqli_select_db- Abre o banco de dados existente no MYSQL
				mysqli_error	- Devolve o último erro ocorrido numa conexão
				mysqli_query	- Envia um comando p/o MYSQL executar
				
				=======
				Não usem as funções com prefixo  mysql_ (estão obsoletas)
				Usem apenas as funções c/prefixo mysqli_
				
			*/
			
			
			// 4 - Abrir o banco de dados
			// .1 Conectar no MYSQL
			
			// Função mysqli_connect() tenta conectar num servidor mysql_affected_rows
			
			// Parâmetros (Strings)
			// p1	=> endereço do servidor MYSQL
			// p2	=> usuário existente no servidor MYSQL
			// p3 	=> senha deste usuário
			
			// => Devolve um objeto de conexão
			
			$con = mysqli_connect("localhost", "root", "");
			
			// .2 Abrir / selecionar o banco
			
			// Função mysqli_select_db() tenta abrir um banco de dados existente no MYSQL
			
			// Parâmetros:
			// p1	=>	Objeto de conexão existente
			// p2	=>	Nome do banco (String)
			
			mysqli_select_db($con, "sgp") or 
				die(
					"Ocorreu um erro na abertura do banco de dados:<br>" . mysqli_error($con)
				);
			
			// 5 - Criar a variável c/comando SQL de inserção de dados
			
			$sql ="INSERT INTO pets (	nome, 
										sexo, 
										tipo, 
										nomeDono, 
										idade) 
							VALUES (	'$nome', 
										'$sexo', 
										'$tipo', 
										'$nomeDono', 
										$idade)" ;
			
			// - Exibir o comando na tela para testar no console
			// Se funcionou, esconde o comando da tela
			//die($sql);
			
			
			// 6 - Enviar o comando de inserção de dados p/o MYSQL
			
			// Função mysqli_query() tenta enviar um comando SQL para o MYSQL
			
			// Parâmetros:
			// p1	=> Objeto de conexão existente
			// p2	=> Comando SQL (String/Texto)
			
			mysqli_query($con, $sql) or 
				die(
					"Erro na inserção do Pet:<br>"  . mysqli_error($con)
				);
			
			// Se chegou aqui é pq funcionou
			echo "Pet <b>$nome</b> cadastrado com sucesso!";
		?>
		<hr>
		Clique <a href="novoPet.html">aqui</a> para novo cadastro.
	</body>
</html>