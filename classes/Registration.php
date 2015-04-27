 <?php
require_once('Connection.php');
class Registration
{
	protected $username,
			  $email,
			  $password,
			  $password_again,
			  $db;

	
    public function __construct() 
    {
		$this->db = new Connection();
        $this->db = $this->db->connect();   
    }

    public function username($username)
    {
    	$username          = preg_replace('/\s+/', ' ', trim($username));
        $usernameLength    = mb_strlen($username);
        $usernameValidChar = preg_match("/^\p{L}{0}+(\p{L}|[0-9 ])+$/u", $username);

        $query  = $this->db->prepare("SELECT     `username` 
                                      FROM       `USERS` 
                                      WHERE      `username`=?");
        $query -> bindParam(1, $username);
        $query -> execute();

        if($usernameLength>4 && $usernameValidChar==true && $query->rowCount()==0)
        {
            $this->username = $username;
            return $this;
        }
        else
        {
            $this->username = null;
            if($usernameLength<5)
            {
                echo 'Too short... ' .(5-$usernameLength).' more<br />';
            }

            if($usernameLength!=0)
            {
                if(!$usernameValidChar)
                {
                    echo 'Forbidden character...</br>';
                }
            }
            
            if($query->rowCount()==1)
            {
                echo  'This username is already used...<br />';    
            } 

        }
    }

    public function email($email)
    {
        $validEmail  = filter_var($email, FILTER_VALIDATE_EMAIL);
        $emailLength = mb_strlen($email);
        $query       = $this->db->prepare("SELECT     `email` 
                                           FROM       `USERS` 
                                           WHERE      `email`=?");
        $query -> bindParam(1, $email);
        $query -> execute();

        if($validEmail && $query->rowCount()==0 && $emailLength!=0)
        {
           $this->email = $email;
           return $this;
        }
        else
        {
            $this->email = null;
            if($emailLength!=0)
            {
                if(!$validEmail)
                    {
                        echo 'This is not a valid E-mail...<br />';
                    }
            }
            if($query->rowCount()!=0)
            {
                echo 'This E-mail is already registered...<br />';
            }
        }
    }

    public function password($password)
    {
        $passwordLength = mb_strlen($password);
        if($passwordLength>5)
        {
            $this->password = $password;
            return $this;
        }
        else 
        {
            $this->password = null;
            if($passwordLength>0 && $passwordLength<6)
            {
                echo 'Too short...'.(6-$passwordLength).' more';
            }
        }
    }

    public function password_again($password_again, $passwordVal)
    {
        if($password_again==$passwordVal)
        {
            $this->password_again = $password_again;
            return $this;
        }
        else
        {
            $this->password_again = null;
            echo 'no match<br>';
        }
    }

    public function encrypt()
    {
        $this->password = md5($this->password);
        return $this;
    }

    public function register()
    {
        $query  = $this->db->prepare( "INSERT INTO `USERS`(`username`, `email`, `password`) VALUES (?, ?, ?)");
        $query -> bindParam(1, $this->username);
        $query -> bindParam(2, $this->email);
        $query -> bindParam(3, $this->password);
        $query -> execute();
        echo "registration completed, log in and chat with awesome people :)";
    }

}

$Registration = new Registration();

if(isset($_POST['username']))       {$Registration->username($_POST['username']);}
if(isset($_POST['email']))          {$Registration->email($_POST['email']);}
if(isset($_POST['password']))       {$Registration->password($_POST['password']);}
if(isset($_POST['password_again'])
&& isset($_POST['passwordVal']))    {$Registration->password_again($_POST['password_again'], $_POST['passwordVal']);}
?>




