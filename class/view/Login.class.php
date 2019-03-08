<?php


class Login extends Page 
{
    public $doc;    
    
    public function __construct()
    {        

        $this->doc = parent::initHTML("Login", "");
        $this->doc .= parent::endBal("body");
        $this->doc .= parent::endBal("html");
        $this->doc .= parent::beginForm("POST","","formLogin");
        $this->doc .= parent::insertInput("text","username","username :");
        $this->doc .= parent::insertInput("text","password","password :");
        $this->doc .= parent::insertInputWithValue("submit","btn-submit","","Valider");

        $this->checkLogin();

        
    }

    private function checkLogin()
    {
        $conn = new Connection();
        $pdo = $conn->getPDO();

        session_start();
   
        if($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            
            $myusername = $_REQUEST['username'];
            $mypassword = $_REQUEST['password'];            

            $sql = $pdo->prepare('SELECT * FROM public.movie_user WHERE username=:myusername');
            $sql->bindParam(':myusername', $myusername);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_OBJ);
            $rows = count($data);
            
                
            if($rows>0) 
            {

                $passwordpg = $data[0]->hashed_password;
                if(password_verify($mypassword,$passwordpg))
                {
                    $_SESSION['user_id'] = $data[0]->id;
                    
                    header("location: show_movies.php");
                }
                else 
                {
                    echo "Your Login Name or Password is invalid";
                }
                
            }
            else 
            {
                echo "Your Login Name or Password is invalid";
            }
            
        }
    }
        
}
    


