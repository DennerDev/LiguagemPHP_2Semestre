<!doctype html> <!-- salvar como alterarPet.php-->
<html lang="pt-br">
	<head>
		<title>Alteração de Pet</title>
		<meta charset="UTF-8">
	</head>
	
	<body>
		<h1>Sistema Gerencial de Pets</h1>
		<h3>Alteração de Pet</h3>
		<hr>
		<?php
			/*	Objetivo:
				=========
				receber o id e o nome de um pet, buscar seus dados 
				da tabela (Pets) e exibir os dados na tela.
				
				Em seguida, efetuar a gravação destes dados.
				
				Seqüencia de Passos:
				====================
				1. Verificar se o id e o nome do pet vieram via método GET.
					=> Se não vieram, avisar usuário e interromper programa
					=> Se vieram, enviar estes dados para variáveis
				
				2. Conectar no MYSQL
				3. Abrir o banco de dados SGP
				4. Ler os dados do pet informado
					=> Colocar o comando de seleção de dados numa variável
					=> Enviar o comando p/o MYSQL
			*/
			
			// 1. Verificar se o id e o nome do pet vieram via método GET.
			if( isset($_GET["id"]) && isset($_GET["nome"]) )
			{
				// Objetos vieram. Vou salvar em variáveis
				$id 	= $_GET["id"];
				$nome	= $_GET["nome"];
			}
			else
			{
				// => Se não vieram, avisar usuário e interromper programa
				die("Rotina executada de forma incorreta. Sistema interrompido.");
			}
			
			// 2. Conectar no MYSQL
			$con = mysqli_connect("localhost","root","");
			
			// 3. Abrir o banco de dados SGP
			mysqli_select_db($con, "sgp") or 
				die(
					"Erro na abertura do banco:<br>" . mysqli_error($con)
				);

			// 4. Ler os dados do pet informado
			//	=> Colocar o comando de seleção de dados numa variável
			$comandoSQL = "SELECT * FROM pets WHERE id=$id";
			
			// Exibo o comando na tela p/ copiar e testar no console MYSQL
			// Funcionando o teste do comando, escondo ele da tela
			//die($comandoSQL);

			// => Enviar o comando p/o MYSQL
			$registro = mysqli_query($con, $comandoSQL) or 
				die(
					"Erro na seleção do Pet:<br>" . mysqli_error($con)
				);
			// Gerou um record set com os dados do Pet. 
			/*
				+----+----------+------+------+--------------+-------+
				| id | nome     | sexo | tipo | nomeDono     | idade |
				+----+----------+------+------+--------------+-------+
				|  2 | Neguinho | M    | G    | Carlos Majer |    13 |
				+----+----------+------+------+--------------+-------+
			*/
			// Verificar se existem linhas dentro do record set
			$linhas = mysqli_num_rows($registro);
			if($linhas<1)
			{
				// Pegt sumiu. Foi excluído por outra pessoa?
				die("Pet <b>$nome</b> não foi mais encontrado no cadastro. Será que foi excluído?");
			}
			
			// Pet encontrado. Vamos mostrar os dados
			// Ler o record set $registro e passar os dados para 
			// a matriz $dados
			$dados = mysqli_fetch_array($registro);
			
			// Colocar os dados da matriz em variáveis
			$id	 	 = $dados["id"];
			$nome 	 = $dados["nome"];
			$tipo 	 = $dados["tipo"];
			$sexo 	 = $dados["sexo"];
			$idade 	 = $dados["idade"];
			$nomeDono= $dados["nomeDono"];
		?>
		
		<form action="gravarPet.php" method="get">
		
			<input type="hidden" name="id" value="<?php echo $id;?>">

			
			Nome:
			<input 	type="text"
					name="nome"
					maxlength="30"
					required
					size="30"
					value="<?php echo $nome;?>"
					placeholder="Informe o nome de seu Pet">
			<br>
			<?php
				$chkMasculino="";
				$chkFeminino="";
				
				if($sexo=="M") 
					$chkMasculino="checked";
				
				if($sexo=="F") 
					$chkFeminino="checked";
			?>
			Sexo:
			<input type="radio" name="sexo" value="M" <?php echo $chkMasculino; ?>> Masculino
			<input type="radio" name="sexo" value="F" <?php echo $chkFeminino; ?>> Feminino
			<br>
			
			<?php
				$selCachorro="";
				$selGato="";
				$selPassaro="";
				$selReptil="";
				$selOutros="";
				
				if($tipo=="C")	
					$selCachorro="selected";
				
				if($tipo=="G")	$selGato="selected";
				if($tipo=="P")	$selPassaro="selected";
				if($tipo=="R")	$selReptil="selected";
				if($tipo=="O")	$selOutros="selected";
			?>
			Tipo:
			<select name="tipo">
				<option value="">Escolha</option>
				<option value="C" <?php echo $selCachorro; ?> 	>Cachorro</option>
				<option value="G" <?php echo $selGato; ?>		>Gato</option>
				<option value="P" <?php echo $selPassaro; ?>	>Pássaro</option>
				<option value="R" <?php echo $selReptil; ?>		>Réptil</option>
				<option value="O" <?php echo $selOutros; ?>		>Outros</option>
			</select>
			<br>
			
			Dono:
			<input 	type="text"
					name="nomeDono"
					value="<?php echo $nomeDono; ?>"
					placeholder="Informe o nome do dono"
					maxlength="50"
					size="50">
			<br>
			<fieldset>
				<legend>Dados Médicos</legend>
				Idade:
				<input 	type="number"
						name="idade"
						min="0"
						max="120"
						value="<?php echo $idade; ?>">
			</fieldset>
			<hr>
			<input type="submit" value="Gravar alteração de dados">
		</form>
		
	</body>
</html>