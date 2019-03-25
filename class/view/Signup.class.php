<?php


class Signup extends Page 
{

    
    function __construct()
    {
        
            $this->doc = parent::initHTML("Signup",'');


            $this->doc .= parent::topNav(); 

            $this->signUpCheck();
            
            $this->doc .= $this->formSignUp();

            $this->doc .= parent::endBal("body");
            $this->doc .= parent::endBal("html");
        
    }
    function formSignUp()
    {
        $form ='<form class="signUp" action="signup.php" method="POST" >
            <label>username :</label><br>
            <input type="text" name="uid" placeholder="Username"><br>
            <label>password :</label><br>
            <input type="password" name="pwd" placeholder="password"><br>
            <button type="submit" name="submit">Sign up</button>
            <input name= "f_id" type="hidden" value="signup">
            </form>';
        return $form;
        
        
        
    }
   
    protected function signUpCheck()
    {
        if (isset( $_POST['f_id']))
        {
            

            $uidpg= pg_escape_string($_REQUEST['uid']);
            $pwdpg = pg_escape_string($_REQUEST['pwd']);




            
            $uid = htmlspecialchars($uidpg);
            $pwd = htmlspecialchars($pwdpg);





            //error handler 
            //check empty fields 


            if(false)//strpos($uid, '<') !== false||strpos($a, '>') !== false
            {
                header("location:signup.php?signUp=NoInjectionXd");

                    exit();

            }
            else
            {


                if(empty($uid) ||empty($pwd))
                {

                    //echo "<script>alert('empty')/script>";
                    header("location:signup.php?signUp=empty");

                    exit(); 
                }

                else//valid character check
                {
                    
                    $conn = new Connection();
                    $pdo = $conn->getPDO();

                    $sql = $pdo->prepare("SELECT * FROM public.movie_user WHERE username=:uid");
                    $sql->bindParam(':uid', $uid);
                    $sql->execute();
                    $data = $sql->fetchAll();
                    $rows = count($data);


                    if($rows>0 )
                    {
                        header("location:signup.php?signUp=UserUtiliser");
                        exit(); 


                    }
                    else
                    {
                        //hasshing
                        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);


                        $sql= $pdo->prepare("INSERT INTO public.movie_user (username, hashed_password)
                        VALUES (:uid,:hashedPwd)");
                        
                        $sql->bindParam(':uid', $uid);
                        $sql->bindParam(':hashedPwd', $hashedPwd);

                        $sql->execute();

                        header("location:signup.php?signUp=Sucsess");
                        exit(); 
                    }  

                }

                    
                
            }

        }
        
    }
}