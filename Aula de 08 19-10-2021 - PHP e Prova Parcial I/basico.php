<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Folha de Pagamento</title>
	</head>
	
	<body>
		<h1>Folha de Pagamento</h1>
		<h3><i><u>Proventos</u></i></h3>

		<?php
		// salvar como basico.php
		
		/*
			Variável:
			Espaço na memória do computador
			que damos um nome e que consegue 
			armazenar um dado (valor), que pode ser
			posteriormente alterado (variado).
			
		REGRAS P/ NOME DE VARIÁVEIS (PHP)
		=================================
		1. Deve começar com o sinal de $ (cifrão)
		2. O 1o caractere após o cifrão, deve ser letra ou sublinhado (underline)
		3. Do 2o caractere em diante pode ser usado números
		4. Não pode ter espaços.
		5. Não pode usar caracteres acentuados
			á é í ó ú ç Ç ã õ ï ä ê
		6. Não pode usar caracteres especiais
			* / - + ' " & ( ) ^ ~ { }
			
		EXEMPLOS DE VARIÁVEIS ERRADAS
		=============================
		nome => Não começa com $
		$123milhas => O 1o caractere (após o cifrão) é um número 
		$nome completo => tem espaços 
		$ação => tem caracteres acentuados
		$ano*2021 => tem caractere especial
		
		ATENÇÃO (maiúsculo e minúsculo são relevantes)
		==============================================
		As variáveis com letras maiúsculas ou minpusculas diferentes não são as mesmas:
		$nome # $Nome # $NOME # $nOme # $noMe # $nomE são diferentes
		
		COMPARAÇÃO COM OUTRAS LINGUAGENS (Criação de variáveis)
		=======================================================
		- Linguagens fortemente tipadas: Java, C, outros
			int idade; // Declarando a variável idade como inteira
			char opcao; // Declarando a variável opcao como caractere
			float salario; // Declarando a variável salario como real/ponto flutuante/com casa decimal
			String nome; // Declarando a variável nome como String (texto)
			
			idade = 18; // Inicialização ok - atribuir um valor
			idade= 17.5; // ERRO - inseriu ponto decimal na variável inteira 
			idade = "Boa"; // ERRO - inseriu string na variável inteira 
			
		- Fracamente tipadas: PHP, JavaScript, outros
			$idade=18; // OK
			$idade=18.5; // OK
			$idade = "boa"; //ok
			
			Permite criar uma variável sem fazer a declaração de seu tipo.
			Permite mudar o tipo de dado.
		
		*/
		$nome = "Ana"; 		// String (trecho de texto)
		$idade= 18;			// Número inteiro
		$salario=3520.70;	// Número flutuante (real / casa decimal)
		$casada=false;		// lógica / booleana
		
		// Dados de folha de pagamento
		$salario   = 8510; // salário base de cálculo
		$premio    = 1790;
		$periodos  = 2; // trabalhou manhã e noite
		$bonus     = 950; // por período trabalhado
		
		// Cálculo do salário bruto
		// nomeação de variáveis - padrão Camel Case 
		// 1a palavra minúsculo, 1a letra 2a palavra maiúsculo e o resto da 2a palavra em minúsculo
		$salarioBruto = $salario + 
						$premio + 
						($periodos * $bonus) ;
		
		// Mostrar os proventos (recebimentos) na tela
		
		echo "Salário Base - R$ " .  number_format($salario, 2, ",", "."); 
		echo "<br>";
		
		echo "Prêmio - R$ " . number_format($premio, 2, ",", ".");
		echo "<br>";
		
		echo "Períodos trabalhados: $periodos";
		echo "<br>";
		echo "Bônus Total - R$ " . number_format($periodos * $bonus, 2, ",", ".");
		echo "<br>";
		
		echo "Salário Bruto - R$ <b>" . number_format($salarioBruto, 2, ",", ".") . "</b>";
		
		// number_format(valor a ser formatado , casas decimais, "separador de decimal", "separador de milhar")
		
		?>
	</body>
	
</html>