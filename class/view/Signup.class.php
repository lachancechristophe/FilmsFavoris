<?php


class Signup extends Page 
{

    
    function __construct()
    {
        $this->doc = '';
        $this->signUpCheck();
        $this->formSignUp();
    }
    function formSignUp()
    {
        $this->doc.='<form class="signUp" action="signup.php" method="POST" >
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="password">
            <button type="submit" name="submit">Sign up</button>
            <input name= "f_id" type="hidden" value="signup">
            </form><a href="index.php">acceuil</a>';
        
        
        
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

                    $sql = $pdo->prepare("SELECT * FROM public.user WHERE user_name=:uid");
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


                        $sql= $pdo->prepare("INSERT INTO public.user (user_name, hashed_pwd) VALUES (:uid,:hashedPwd)");
                        
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