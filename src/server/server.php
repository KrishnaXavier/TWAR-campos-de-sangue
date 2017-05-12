<?php
					// Para executar abra o terminal e digite 'php server.php'
	require"websockets.php";
	require"partida.php";


	$porta = '2100'; 
	$host = "172.17.7.158";
	
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); //Cria um socket do tipo stream, seguido verificação de erros
	if ( $socket===false)
	{
		fprintf(STDOUT,socket_strerror(socket_last_error()));
		exit(1);
	}
	
	socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1); // Define a porta como reutilizável

	if (socket_bind($socket, 0, $porta)===false) //Faz a relação entre o socket e a porta 
	{
		fprintf(STDOUT,socket_strerror(socket_last_error()));
		exit(1);
	}

	if ( socket_listen($socket, 20 )===false) //Começa a monitorar
	{
		fprintf(STDOUT,socket_strerror(socket_last_error()));
		exit(1);
	}
	
	

	$clientes =array( $socket );
	
	while ( true )
	{
		$requisicoes = $clientes;   //Copia o array devido a modificação pelo select;
		socket_select ( $requisicoes, $w = null, $e = null, 0, 5 ); // verifica se há dados nas conexões
		if ( in_array(  $socket, $requisicoes ) ) // Testa se há novos clientes
		{ 
			$novo_cliente = socket_accept( $socket );
			$clientes[] = $novo_cliente;
			$cabecalho = socket_read($novo_cliente, 1024); //Le o cabaçalho de requisiçao, em seguida a função que completa a conexão
			perform_handshaking($cabecalho, $novo_cliente, $host, $porta);
			$posicao = array_search($socket, $requisicoes);
			unset($requisicoes[$posicao]);  

	 	}
		foreach ($requisicoes as $novareq ) // Verifica se há novas ofertas de partidas ou ofertas aceitas
		{		
			socket_recv($novareq, $msg, 127,0);
			$req = unmask($msg);
			
		}	
			
	}
