<?php
class User
{
	protected $db,
	          $id,
  		      $username,
  		      $password,
            $newPassword,
  		      $email,
            $profilePic;

    public function __construct()
    {
    	$this->db = new Connection();
      $this->db = $this->db->connect();
    }

    public function login($l_user, $l_password)
    {
    	if(!empty($l_user) && !empty($l_password)) 
    	{
    		$query  = $this->db->prepare("SELECT     `id`
                                      FROM       `USERS` 
                                      WHERE     (`username`=? OR `email`=?)
                                      AND        `password` = ?");

	    	$query -> bindParam(1, $l_user);
        $query -> bindParam(2, $l_user);;
        $query -> bindParam(3, md5($l_password));
	    	$query -> execute();

	    	if($query->rowCount()==1)
	    	{
	    	  	$result = $query->fetch();
            $this->id = $result['id'];
            $this->startSession();         
	    	}
        else
        {
          echo "Authentication failed";
        } 
    	}
    	else
    	{
    		echo "All fields are required";
    	}
       return $this;
    }

    public function startSession()
    {
      $_SESSION['id'] = $this->id; 
      return $this;     
    }

    public function setUserSession($session) 
    {
        $this->id = $session;
        return $this;
    }
    
    public function setUserDatas()
    {
       $query =  $this->db->prepare("SELECT * FROM `USERS` WHERE `id`=?");
       $query -> bindParam(1, $this->id);
       $query -> execute();

       if($query->rowCount()==1)
       {
           $result = $query->fetch();
           $this->username   = $result['username'];
           $this->email      = $result['email'];
           $this->password   = $result['password'];

           if($result['profilePic']!=null)
           {
               $this->profilePic = "\"img/users/".$result['profilePic']."\"";
           }
           else
           {
               $this->profilePic = "'img/icons/defaultProfilePic.png'";
           }  
           return $this;      
        }  
    }

    public function get($property)
	{
		switch ($property)
		{
			case 'id'         : echo $this->id;          break;
			case 'username'   : echo $this->username;    break;
			case 'password'   : echo $this->password;    break;
			case 'email'      : echo $this->email;       break;
      case 'profilePic' : echo $this->profilePic;  break;
			default           : echo 'check User class'; break;
		}
        return $this;
	}
}
