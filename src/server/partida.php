<?php
	function partida ( $sock_user1, $sock_user2 )
	{
		#$tabuleiro[][][][]; criar tabuleiro, definição dos biomas, posição das peças, espelhar, etc...
		$vencedor = 0;
		$movimento;
		while (!$vencedor)
		{
			socket_recv($sock_user1, $movimento, 512, 0);
			// código para validar movimentos
			socket_write($sock_user2, $movimento, strlen($movimento));	
			socket_recv($sock_user2, $movimento, 512, 0);
			// código para validar movimentos
			socket_send($sock_user1, $movimento, strlen($movimento));
		}
	}