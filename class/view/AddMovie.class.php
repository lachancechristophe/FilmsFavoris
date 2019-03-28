<?php


class Addmovie extends Page 
{

    
    public function __construct()
    {

        $this->verifAddMovie();
        

        $this->doc = parent::initHTML("Add Movie",'');


        $this->doc .= parent::topNav(); 
        
        $this->doc .= $this->formAddMovie();
        $this->doc .= parent::endBal("body");
        $this->doc .= parent::endBal("html");
        
    }
    protected function formAddMovie()
    {
        $form ='<form class="add_movie" action="add_movie.php" method="POST" enctype="multipart/form-data">
            <label>cover :</label><br><br>
            <input type="file" name="cover" id="cover"><br><br>
            <label>name :</label><br>
            <input type="text" name="name" placeholder="name"><br>
            <label>producer :</label><br>
            <input type="text" name="producer" placeholder="producer"><br>
            <label>release date :</label><br>
            <input type="text" name="date" placeholder="date"><br><br>
            <button type="submit" name="submit">Sign Movie</button>
            <input name = "add_movie" type="hidden" value="add_movie">

            </form>';
        return $form;
        
        
        
    }
   
    protected function checkAddMovieCover()
    {
        if (isset( $_POST['add_movie']))
        {   
            $type = $_FILES['cover']['type'];
            $size = $_FILES['cover']['size']; 

            if($type != 'image/png' && $type != 'image/jpeg')
            {
                header("location: add_movie.php?Cover=WrongType$type");
                exit(); 
            }
            else
            {
                if($size > 1000000)
                {
                   header("location: add_movie.php?Cover=SizeTooBig");
                    exit();  

                }
                else
                {
                    return true;
                    /*
                    
                    */
                }

            }
            if ($movefile)
            {
              header("location: add_movie.php?upload=Sucess");
            }

        }
    }
    protected function checkAddMovieInfo()
    {
        if (isset( $_POST['add_movie']))
        {   

            $namepg= pg_escape_string($_REQUEST['name']);
            $producerpg = pg_escape_string($_REQUEST['producer']);
            $datepg = pg_escape_string($_REQUEST['date']);
            
            $name = htmlspecialchars($namepg);
            $producer = htmlspecialchars($producerpg);
            $date = htmlspecialchars($datepg);
            





            if(empty($name) || empty($producer) || empty($date))
            {

               
                header("location:Add_movie.php?Addmovie=empty");

                exit(); 
            }

            else
            {
                return true;
                
                

            }

        }
              
    }
    protected function verifAddMovie()
    {
        $boolVerifInfo= $this->checkAddMovieInfo();

        $boolVerifCover = $this->checkAddMovieCover();

        if (!$boolVerifCover && !$boolVerifInfo )
        {
            echo 'no';
        }
        else
        {
            $conn = new Connection();
            $pdo = $conn->getPDO();

            $sql = $pdo->prepare("INSERT INTO public.movie (name, producer, release_date)
            VALUES (:name,:producer,:date)");
            
            $sql->bindParam(':name', $name);
            $sql->bindParam(':producer', $producer);
            $sql->bindParam(':date', $date);

            $sql->execute();

            $stmt = $pdo->query("SELECT COUNT(*) FROM  movie as number");
        
         
            $row = $stmt->fetch();
            

            $file_tmp = $_FILES['cover']['tmp_name']; 
            
            $upload_folder = 'style/img/movie_cover/';

            $file_name = $row['count'];


            $movefile = move_uploaded_file($file_tmp,$upload_folder .$file_name."_movie_cover.png");
            




            
            header("location:Add_movie.php?Addmovie=Sucsess");
            exit(); 


        }
              
    }
}