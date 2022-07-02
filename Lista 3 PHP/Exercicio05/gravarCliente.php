<?php

	$nome		        = $_GET["nome"];
	$dataNascimento		= $_GET["dataNascimento"];
	$sexo		        = $_GET["sexo"];
	$estadoCivil	    = $_GET["estadoCivil"];
	$email		        = $_GET["email"];
	$telefoneP	        = $_GET["telefoneP"];
	$telefoneS	        = $_GET["telefoneS"];
	$telefoneT	        = $_GET["telefoneT"];
	$telefoneB	        = $_GET["telefoneB"];
	$telefoneV	        = $_GET["telefoneV"];
	$telefoneD	        = $_GET["telefoneD"];
	$tipoA              = $_GET["tipoA"];
	$tipoB              = $_GET["tipoB"];
	$tipoC              = $_GET["tipoC"];
	$obs                = $_GET["obs"];
	
	
	if ($nome=='')
	{
		die("<b>O nome do cliente</b> deve ser informado. Sistema cancelado!");
	} ;
	
	
	if ($email=='')
	{
		die("<b>O email</b> deve ser informado. Sistema cancelado!");
	} ;
	
	
	
	echo "Nome:               <b>$nome</b><br>";
	echo "Data de Nascimento: <b>$dataNascimento</b><br>";
	echo "Sexo:               <b>$sexo</b><br>";
	echo "Estado Civil:       <b>$estadoCivil</b><br>";
	echo "E-mail:             <b>$email</b><hr>";
	echo "Telefone:           <b>$telefoneP</b>"; echo " <b>$telefoneB</b>";    echo "      Tipo:<b>$tipoA</b><br>";
	echo "Telefone:           <b>$telefoneS</b>"; echo " <b>$telefoneV</b>";    echo "      Tipo:<b>$tipoB</b><br>";
	echo "Telefone:           <b>$telefoneT</b>"; echo " <b>$telefoneD</b>";    echo "      Tipo:<b>$tipoC</b><br>";
	echo "OBS:                <b>$obs</b><br>";
	
	$con = mysqli_connect("localhost", "root", "");
	
	$db	 = mysqli_select_db($con, "formulario") or 
		die(
			"Ocorreu um erro na abertura do banco de dados:<br>" . mysqli_error($con)
		);
		
	$sql ="INSERT INTO cadastro (    nome,
	                                 dataNascimento,
								     sexo,
								     estadoCivil,
								     email,
								     telefoneP,
								     telefoneS,
								     telefoneT,
								     telefoneB,
								     telefoneV,
								     telefoneD,
								     tipoA,
								     tipoB,
								     tipoC,
									 obs )
					VALUES      (    '$nome',
                                     '$dataNascimento',
                                     '$sexo',
                                     '$estadoCivil',
                                     '$email',
                                     '$telefoneP',
                                     '$telefoneS',
                                     '$telefoneT',
                                     '$telefoneB',
                                     '$telefoneD',
                                     '$telefoneV',
                                     '$tipoA',
                                     '$tipoB',
                                     '$tipoC',
									 '$obs')" ;
								
	

	mysqli_query($con, $sql) or 
		die(
			"Erro:<br>"  . mysqli_error($con)
		);
		
		
		$rs = mysqli_query($con, "SELECT LAST_INSERT_ID() FROM cadastro");
$dados = mysqli_fetch_array($rs);
$idCriado = $dados[0];
echo "<hr>";
echo "Registro $idCriado inserido na tabela cadastro";

		
	echo "<b>$nome</b> cadastrado com sucesso!";
	
	
?>