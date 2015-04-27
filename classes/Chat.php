<?php

class Chat
{
	private $username,
	        $db;

	public function __construct()
	{
	  $this->db = new Connection();
      $this->db = $this->db->connect();
	}

	public function postNewMessage($username, $message_text)
	{
		$query = $this->db->prepare("SELECT `username` FROM `USERS` WHERE `id` = ?");
		$query -> bindParam(1, $username);
		$query -> execute();

    	if($query->rowCount()==1)
    	{
    	  	$result = $query->fetch();
    	  	$this->username = $result['username'];
    	}	
		 	
		$query  = $this->db->prepare( "INSERT INTO `CHAT`(`username`, `message_text`) VALUES (?, ?)");
	    $query -> bindParam(1, $this->username);
        $query -> bindParam(2, $message_text);
        $query -> execute();
	}

	public function getMessages() 
	{
		$query  = $this->db->prepare("SELECT * FROM `CHAT`");
		$query->execute();
		$result = $query->fetchAll();
		foreach ($result as $key => $value) 
		{
			$message = '<div class="chLine">'.
			           '<strong>'.
			            htmlentities($value['username']).': '.
			            '</strong>'.	          
			            htmlentities($value['message_text']).		          
			            '</div>';
			echo $message;
		}
			
	}

}

?>