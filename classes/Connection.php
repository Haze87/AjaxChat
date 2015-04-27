<?php
class Connection 
{
	protected $host = '127.0.0.1',
			  $username = 'root',
			  $password = '',
			  $database = '';

	public function connect()
	{
		return new PDO("mysql:host=".$this->host."; dbname=".$this->database, $this->username, $this->password);	
	}
}

