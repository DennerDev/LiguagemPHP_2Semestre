<!doctype html> 
<!-- salvar como excluirPet.php-->
<html lang="pt-br">
	<head>
		<title>Exclusão de Pet</title>
		<meta charset="UTF-8">
	</head>
	
	<body>
		<h1>Sistema Gerencial de Pets</h1>
		<h3>Exclusão de Pet</h3>
		<hr>
		<?php
			/*	Objetivo
				========
				Com base num id enviado via método GET, da listagem,
				eliminar o pet da tabela.
				
				Passos
				======
				1 - Verificar se foi enviado o id via GET
					- Se foi enviado, guardo o id numa variável
					- Se não foi enviado, aviso o usuário e encerro o programa
				
				2 - Conectar no MYSQL
				3 - Abrir o banco de dados SGP
				4 - Colocar o comando de exclusão numa variável
				5 - Exibiar na tela e testar o comando no console
			  		Se funcionar, esconder o comando da tela
				6 - Enviar o comando para o MYSQL
			*/
			
			//1 - Verificar se foi enviado o id via GET
			//		- Se não foi enviado, aviso o usuário e encerro o programa
			if(isset($_GET["id"]))
			{
				//- Se foi enviado, guardo o id numa variável
				$id = $_GET["id"];
			}
			else
			{
				//- Se não foi enviado, aviso o usuário e encerro o programa
				die("Rotina chamada incorretamente. Sistema encerrado.");
			}
			
			// Se foi enviado o nome do pet
			if(isset($_GET["nome"]))
			{
				echo "Excluindo pet " . $_GET["nome"] . "<hr>";
			}
			
			// 2 - Conectar no MYSQL
			$con = mysqli_connect("localhost","root","");
			
			// 3 - Abrir o banco de dados SGP
			mysqli_select_db($con,"sgp") or 
				die(
					"Erro na abertura do banco de dados:<br>" . mysqli_error($con)
				);
				
			// 4 - Colocar o comando de exclusão numa variável
			$comando="DELETE FROM pets WHERE id=$id";
			
			// 5 -  Exibiar na tela e testar o comando no console
			// 		Se funcionar, esconder o comando da tela
			// die($comando);
			
			// 6 - Enviar o comando para o MYSQL
			mysqli_query($con, $comando) or 
				die("Erro na exclusão do Pet: <br>" . mysqli_error($con));
			
			echo "Pet excluído com sucesso!<hr>";
		?>
		Clique <a href="listagem.php">aqui</a> para Listagem de Pets
		
	</body>
</html>