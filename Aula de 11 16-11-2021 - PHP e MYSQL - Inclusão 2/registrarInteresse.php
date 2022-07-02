<html> <!-- salvar como registrarInteresse.php -->
	<head>
		<title>Registro de interesse</title>
		<meta charset="UTF-8">
	</head>
	
	<body>
		<h2>Dados do candidato </h2>
		<?php
			// 1- Salvar em variáveis os dados que estão vindo
			$candidato	= $_POST["candidato"];
			$email		= $_POST["email"];
			$senha		= $_POST["senha"];
			$senha2		= $_POST["senha2"];
			$vaga 		= $_POST["vaga"];
			$experiencia= $_POST["experiencia"];
			
			// arquivos enviados chegam na matriz $_FILES[""]
			$curriculo  = $_FILES["curriculo"]["name"];
			
			// Objetos que se não estiverem ticados não virão
			
			// Forma de tratamento contra erros:
			// ---------------------------------
			// 1. Criar variável c/ valor padronizado se objeto não veio
			
			$HTML		= 0; // 0 equivale a false no PHP
			$CSS		= 0; // qualquer coisa diferente de 0 = true
			$PHP		= 0;
			$MYSQL		= 0;
			$JAVASCRIPT	= 0;
			$JAVA		= 0;
			$C			= 0;
			
			// 2. Verificar se o objeto veio
			// => Neste caso, atualizar a variável
			
			if(isset($_POST["HTML"]))
				$HTML = $_POST["HTML"];
			
			if(isset($_POST["CSS"]))
				$CSS = $_POST["CSS"];
			
			if(isset($_POST["PHP"]))
				$PHP = $_POST["PHP"];
			
			if(isset($_POST["MYSQL"]))
				$MYSQL = $_POST["MYSQL"];
			
			if(isset($_POST["JAVASCRIPT"]))
				$JAVASCRIPT	=$_POST["JAVASCRIPT"];
			
			if(isset($_POST["JAVA"]))
				$JAVA = $_POST["JAVA"];
			
			if(isset($_POST["C"]))
				$C = $_POST["C"];
			
			// 2 - Validação básica
			
			if($candidato=="")
				die("Nome do candidato deve ser informado. Sistema cancelado!");
			
			if($email=="")
				die("E-mail do candidato deve ser informado. Sistema cancelado!");
			
			if($senha=="")
				die("Senha do candidato deve ser informada. Sistema cancelado!");
			
			if($senha<> $senha2)
				die("As senhas informadas estão diferentes. Informe-as novamente.");
			
			echo "Nome do candidato: $candidato <br>";
			echo "e-mail: $email <br>";
			echo "Senha enviada: $senha<br>";
			echo "2a Senha enviada: $senha2<hr>";
			
			echo "<h3>Tecnologias aprendidas</h3>";
			
			// $HTML é diferente de zero ?
			if($HTML)
				echo "HTML<br>";
			
			// Foi informado conhecimento em CSS?
			if($CSS=="1")
				echo "CSS<br>";
			
			if($PHP=="1")
				echo "PHP<br>";
			
			if($MYSQL=="1")
				echo "MYSQL<br>";
			
			if($JAVASCRIPT=="1")
				echo "JAVASCRIPT<br>";

			if($JAVA=="1")
				echo "JAVA<br>";
			
			if($C=="1")
				echo "C<br>";
			
			echo "<br>";
			echo "Vaga desejada:<br>";
			
			if($vaga=="E")
				echo "<b>Estagiário(a)</b>";
			
			if($vaga=="J")
				echo "<b>Desenvolvedor(a) Júnior</b>";
			
			if($vaga=="P")
				echo "<b>Desenvolvedor(a) Pleno(a)</b>";
			
			if($vaga=="F")
				echo "<b>Desenvolvedor(a) Full Stack</b>";
			echo "<hr>";
			/*
			candidato
			email
			senha
			senha2
			HTML
			CSS
			PHP
			MYSQL
			JAVASCRIPT
			JAVA
			C
			vaga
			*/
			
			// Conectar no servidor MYSQL
			$con=mysqli_connect("localhost","root","");
			
			// Abrir o banco de dados
			mysqli_select_db($con, "rh") or 
				die("Erro ao abrir o banco:<br>" . mysqli_error($con));
			
			// Inserir o comando de inserção numa variável
			$sql = "INSERT INTO candidatos(
							nome,
							email,
							senha,
							HTML,
							CSS,
							PHP,
							MYSQL,
							JAVASCRIPT,
							JAVA,
							C,
							vaga,
							experiencia,
							curriculo) 
					VALUES (
							'$candidato',
							'$email',
							'$senha',
							'$HTML',
							'$CSS',
							'$PHP',
							'$MYSQL',
							'$JAVASCRIPT',
							'$JAVA',
							'$C',
							'$vaga',
							'$experiencia',
							'$curriculo'
							)";
			// Mostrar a variável na tela para testar no console
			// die($sql);
			
			// Enviar para o banco
			mysqli_query($con, $sql) or 
				die("Erro ao cadastrar o candidato:<br>" . mysqli_error($con));
			
			// Se foi enviado o arquivo ele fica num lugar temporário (no PHP)
			// Tenho que transferir deste lugar temporário para onde eu quero
			if($curriculo<>"")
			{
				// curriculo foi enviado. Preciso transferir ele
				$nomeTemporario = $_FILES["curriculo"]["tmp_name"];

				// Exibindo dados do arquivo
				echo "<hr>";
				echo "Arquivo: $curriculo<br>";
				echo "Tamanho: " . $_FILES["curriculo"]["size"] . " bytes<br>";
				echo "Local Temporário: $nomeTemporario<br>";
				echo "transferindo para pasta curriculos...";
				echo "<hr>";
				
				move_uploaded_file($nomeTemporario , "curriculos/$curriculo");
			}
			
			// Se chegou até aqui é pq funcionou.
			echo "Dados do candidato <b>$candidato</b> cadastrados com sucesso!";
		?>
		<hr>
		Clique <a href="linguagens.html">aqui</a> para cadastrar um novo candidato.
	</body>
</html>