<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>SGP - Gravando o Pet...</title>
	</head>
	
	<body>
		<h1>SGP - Sistema Gerencial de Pets</h1>
		<hr>
		<h3>Incluindo Pet...</h3>
		
		<?php
		/* Gravar arquivo como incluirPet.php na 
		pasta de projeto orientada (dentro de www) */
		
		/*
			VARIÁVEL
			Espaço de memória no computador, que se dá um nome e 
			consegue armazenar um determinado valor que pode mudar (variar)
			
			MATRIZ / VETOR
			Espaço de memória no computador, que se dá um nome e
			consegue armazenar DIVERSOS valores em posições diferentes, que
			podem variar
		*/
		
		// 1 - Recebendo os dados do formulário em variáveis
		$nome		= $_POST["nome"];
		$sexo		= $_POST["sexo"];
		$tipo		= $_POST["tipo"];
		$nomeDono	= $_POST["nomeDono"];
		$idade		= $_POST["idade"];
		$obs  		= $_POST["obs"];
		
		// Foto (arquivo) chega na matriz $_FILES[""]
		$foto		= $_FILES["foto"]["name"];

		// 2 - Validação simples de dados
		/*
		se o nome do pet estiver vazio
		--> aviso e interrompo o programa
		*/
		if($nome=="")
		{
			die("<b>Nome do Pet</b> deve ser informado. Sistema interrompido!");
		}
		
		if($nomeDono=="")
		{
			die("<b>Nome do Dono do Pet</b> deve ser informado. Sistema interrompido!");
		}
		
		if ($tipo=="")
		{
			die("<b>Tipo</b> do Pet deve ser informado. Sistema interrompido!");
		}
		
		// 3 - Exibindo os dados
		echo "O nome do Pet é <b>$nome</b><br>";
		echo "Seu sexo é <b>$sexo</b><br>";
		echo "Ele é do tipo <b>$tipo</b><br>";
		echo "Nome do Dono: <b>$nomeDono</b><br>";
		echo "Idade do Pet: <b>$idade</b><hr>";
		echo "Observações:<br> $obs<br>";
		
		if($foto<>""){
			// foto não está vazia, exibir demais dados
			$tipoArquivo	= $_FILES["foto"]["type"];
			$tamanhoArquivo	= $_FILES["foto"]["size"];
			$tmpLocal		= $_FILES["foto"]["tmp_name"];
			
			echo "<fieldset>";
			echo "	<legend>Dados do arquivo</legend>";
			echo "	Arquivo: <b>$foto</b> <br>";
			echo "	Tipo: <b> $tipoArquivo</b> <br>";
			echo "	Tamanho: <b> $tamanhoArquivo bytes</b><br>";
			echo "  Nome Temporário: <b>$tmpLocal</b>" ;
			echo "</fieldset>";
			
			// Transferindo o arquivo do local temporário para a pasta imgs
			move_uploaded_file($tmpLocal, "imgs/$foto");
		}
		
		// 4 - Abrindo o banco de dados
		// .1 - Conexão com o servidor MYSQL (Wamp)
		
		/* A função mysqli_connect() tenta uma conexão num determinado
		 endereço (servidor), usando um usuário e senha válidas
		 e em caso de sucesso, retorna um objeto de conexão
		
			mysqli_connect(p1, p2, p3)
		
			PARÂMETROS (STRINGS):
			=====================
			- p1 = endereço do servidor (localhost)
			- p2 = usuário existente neste servidor 
			- p3 = a senha deste usuário
			
			RETORNO
			=======
			Em caso de sucesso, a função retorna um objeto de conexão.
		*/
		
		$con = mysqli_connect("localhost", "root", "");

		// .2 - Abertura do banco de dados
		
		/*  A função mysqli_select_db() tenta abrir um banco de dados
			existente na conexão informada 
			
			mysqli_select_db(p1, p2)
			
			PARÂMETROS:
			==========
			- p1 - Objeto de conexão existente - criado pelo mysqli_connect()
			- p2 - O nome de um banco de dados existente (string) na conexão informada
		*/
		
		mysqli_select_db( $con, "sgp") or 
			die(    
				"Erro na seleção do banco de dados:<br>" . 
					mysqli_error($con)
			);
		
		// 5 -Tentativa de inserção de registro
		//  .1 - Criação da variável com o comando de inserção SQL
		
		$sql = "INSERT INTO pets (nome,   sexo,    tipo,   nomeDono,  idade,    foto,   obs) VALUES 
								 ('$nome','$sexo','$tipo','$nomeDono',$idade, '$foto', '$obs')";
		
		// die($sql);
		
		// .2 Enviando o comando de inclusão para o banco
		
		
		/*  A função mysqli_query() tenta enviar um comando SQL
			para o MYSQL executar.
			
			mysqli_query(p1, p2)
			
			PARÂMETROS:
			==========
			- p1 - Objeto de conexão existente - criado pelo mysqli_connect()
			- p2 - O comando SQL a ser executado (String / variável)
			
			query = Comando SQL
		*/
		
		
		mysqli_query( $con, $sql) or 
			die(
				"Erro na inserção do registro de Pet: <br>" .
					mysqli_error($con) 
			);
		
		echo "Pet <b>$nome</b> inserido com sucesso!<hr>";
		
		/*
		// 6 - Exibição do Pet cadastrado
		$rs = mysqli_query($con , "SELECT LAST_INSERT_ID() FROM pets");
		
		$dados = mysqli_fetch_array($rs);
		
		$idCriado = $dados[0];
		echo "Pet <b>[$idCriado] $nome</b> inserido na tabela Pets.";
		*/
		?>
		Clique <a href="novoPet.html">aqui</a> para inserir um novo Pet.
		<br>
		Clique <a href="listagem.php">aqui</a> para <b>Listagem de Pets</b>.
	</body>
</html>