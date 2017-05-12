<?php	

//saidaBiomasJS(definirBiomasAleatorios(10, srcBiomas()), srcBiomaJogadores(), 1);
saidaBiomasJS(srcBiomasTeste(), srcBiomaJogadores(), 2);
//saidaBiomasJS(Array com SRC dos Biomas,  Array com SRC do Bioma Base do Jogador, Valor que define se o Jogador 1 ou Jogador 2)	

function saidaBiomasJS($biomas, $biomasJogadores, $referenciaJogador)
{
		//Saida de Biomas para JS
	echo "\n<script type='text/javascript'>\n";
	echo "biomasDefinidos = [\n";

	if($referenciaJogador==1)
	{
		echo "'".$biomasJogadores[0]."', \n";					
		for($i=0; $i<count($biomas); $i++)
		{
			echo "'".$biomas[$i]."', \n";
		}
		echo "'".$biomasJogadores[1]."', \n";					
	}

	if($referenciaJogador==2)
	{
		echo "'".$biomasJogadores[1]."', \n";					
		for($i=count($biomas); $i>0; $i--)
		{
			echo "'".$biomas[$i-1]."', \n";
		}
		echo "'".$biomasJogadores[0]."', \n";	
	}				

	echo "];\n";
	echo "</script>";		
}

function srcBiomas()
{
		//Biomas
	$arrayBiomas = array(
		'imgs/biomas/deserto.png', 
		'imgs/biomas/floresta.png',
		'imgs/biomas/glacial.png', 
		'imgs/biomas/montanha.png', 
		'imgs/biomas/pantano.png',             	             	
		'imgs/biomas/neutro.png'
		);	
	return $arrayBiomas;
}

function srcBiomaJogadores()
{
	$arrayBiomaJogadores = array(
		'imgs/biomas/castelo-jagador-1.png',
		'imgs/biomas/castelo-jagador-2.png'
		);

	return $arrayBiomaJogadores;
}

function srcBiomasTeste()
{		
	$arrayBiomasTeste = array(
		'imgs/biomas/deserto.png', 
		'imgs/biomas/floresta.png',
		'imgs/biomas/glacial.png', 
		'imgs/biomas/montanha.png', 
		'imgs/biomas/pantano.png',             	             	
		'imgs/biomas/neutro.png',
		'imgs/biomas/deserto.png', 
		'imgs/biomas/floresta.png',
		'imgs/biomas/glacial.png', 
		'imgs/biomas/montanha.png', 
		);	
	return $arrayBiomasTeste;
}


function definirBiomasAleatorios($quantCamposBiomas, $arrayBiomas)
{			
	//Desabilitar 'Notices'
	error_reporting(0);	

	//Definir biomas Aleatoriamente	
	$arrayBiomasAleatorio = [];	
	$biomaPassado=666;
	for($i=0; $i<$quantCamposBiomas; $i++)
	{
		$biomasAleatorio = rand(0, count($arrayBiomas)-1);
		while($biomaPassado==$biomasAleatorio)
			$biomasAleatorio = mt_rand(0, count($arrayBiomas)-1);												
		$arrayBiomasAleatorio[] = $arrayBiomas[$biomasAleatorio];					
		$biomaPassado=$biomasAleatorio;
	}
	return $arrayBiomasAleatorio;
}

