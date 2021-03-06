<?php
namespace FilmFavoris;

use PDO;

class Signup extends Page
{
    public function __construct()
    {
        $this->doc = parent::initHTML("Signup", '');


        $this->doc .= parent::topNav();
        $this->doc .=  parent::beginEndBal("h1", "Enregistrer un utilisateur");
        
            
        $this->doc .= $this->formSignUp();

        $this->signUpCheck();

        $this->doc .= parent::endBal("body");
        $this->doc .= parent::endBal("html");
    }
    protected function formSignUp()
    {
        $form ='<form class="signUp" action="index.php?page=signup" method="POST" >
            <label>username :</label><br>
            <input type="text" name="uid" placeholder="Username"><br>
            <label>email :</label><br>
            <input type="email" name="email" placeholder="Email address"><br>
            <label>password :</label><br>
            <input type="password" name="pwd" placeholder="password"><br>
            <button type="submit" name="submit">Sign up</button>
            <input name= "f_id" type="hidden" value="signup">
            </form>';
        return $form;
    }
   
    protected function signUpCheck()
    {
        if (isset($_POST['f_id'])) {
            $uidpg= pg_escape_string($_REQUEST['uid']);
            $pwdpg = pg_escape_string($_REQUEST['pwd']);
            $emlpg = pg_escape_string($_REQUEST['email']);
 
            $uid = htmlspecialchars($uidpg);
            $pwd = htmlspecialchars($pwdpg);
            $eml = htmlspecialchars($emlpg);

            //error handler
            //check empty fields

            if (empty($uid) ||empty($pwd) ||empty($eml)) {

                //echo "<script>alert('empty')/script>";
                $this->doc .= "<a class = 'error'>Un champs est vide!</a>";
            } else {//valid character check
                $conn = new Connection();
                $pdo = $conn->getPDO();

                $sql = $pdo->prepare("SELECT * FROM public.movie_user WHERE username=:uid");
                $sql->bindParam(':uid', $uid);
                $sql->execute();
                $data = $sql->fetchAll();
                $rows = count($data);


                if ($rows>0) {
                    $this->doc .= "<a class = 'warn'>Nom d'utilisateur utilisé</a>";
                } else {
                    //hashing
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                    $query = "INSERT INTO public.movie_user (username, hashed_password, email, confirmed)";
                    $query .= "VALUES (:uid,:hashedPwd, :eml, False)";
                    $sql= $pdo->prepare($query);
                    
                    $sql->bindParam(':uid', $uid);
                    $sql->bindParam(':eml', $eml);
                    $sql->bindParam(':hashedPwd', $hashedPwd);

                    $sql->execute();

                    $confirmcode = substr(md5(rand()), 0, 7);
                    $query = "INSERT INTO public.movie_user_confirm (user_id, confirm_code, confirmed)";
                    $query .= "VALUES (:uid,:confirmcode, :false)";
                    $sql= $pdo->prepare($query);
                    $lastIdInsert = $pdo->lastInsertId();
                    $false = "False";
                    $sql->bindParam(':uid', $lastIdInsert);
                    $sql->bindParam(':confirmcode', $confirmcode);
                    $sql->bindParam(':false', $false);

                    $sql->execute();

                    $emailstring = "Confirmation Films Favoris\n\n";
                    $emailstring .= "Pour confirmer votre inscription, visitez la page suivante: \n\n";
                    $emailstring .= "/index.php?page=confirm_user\n\n";
                    $emailstring .= "Et entrez le code suivant:\n\n";
                    $emailstring .= $confirmcode;
                    $emailstring .= "\n\nMerci!";

                    mail($eml, "Confirmation Films Favoris", $emailstring);

                    $this->doc .= "<p class = 'succes'>Compte enregistré!</p>";
                }
            }
        }
    }
}
