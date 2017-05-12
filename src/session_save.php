<?php 
	class session_save
	{
		private $link;
		const HOST = 'localhost';
		const DB = 'twar';
		const USER = 'root';
		const PASS = 'alfa12';

		function open ()  // Abre a conexao com o mysql 
		{
			$link = new mysqli(self::HOST, self::USER, self::PASS, self::DB);
			$this->link = $link;
			if (mysqli_connect_errno()) return false;
			return true;
		}

		function close () // fecha a conexao
		{
			if($this->link->close())
				return true;
			return false;
		}

		function read ( $id ) // define como os dados da sessão serão lidos
		{
			$sql = "SELECT data FROM sessions WHERE id = '$id'";
			$query = $this->link->query($sql);
			$data = $query->fetch_array(MYSQLI_ASSOC);
			return $data['data'];
		}

		function write ( $id, $data ) // define como os dados da sessão serão armazenados
		{
			$sql = "REPLACE INTO sessions VALUES ('$id', '$data')";
			$query = $this->link->query($sql);
			if ( $query ) return true;
			return false;
		}

		function destroy ( $id ) // destrói a sessão 
		{
			$sql = "DELETE FROM sessions WHERE id = '$id'";
			$query = $this->link->query($sql);
			if ( $query ) return true;
			return false;
		}
		
		function gc ($maxlifetime) //coletor de lixo
		{
			return true;
		}

		function __construct()
		{
			//função que Define como o php trata as sessões
			session_set_save_handler(array(&$this,'open'), array(&$this,'close'),array(&$this,'read'), array(&$this,'write'),
                        array(&$this,'destroy'),array(&$this,'gc'));
		} 
        }
 

