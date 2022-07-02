<?php
	// salvar como recebeDados.php
	
	// Recebendo 2 objetos via método GET
	// recebidos na matriz $_GET[""]
	
	echo "Recebido estado civil = " . $_GET["eCivil"];
	echo "<br><br>";
	
	// isset() - Verifica existência de um objeto
	// => true - existe
	// => false- não existe
	
	if(isset($_GET["caixa1"]))
	{
		// Objeto existe / foi enviado
		echo "Recebido caixa de checagem = " . $_GET["caixa1"];
	}
	else
	{
		// Objeto não foi enviado
		echo "Objeto caixa1 não foi enviado.";
	}
?>
