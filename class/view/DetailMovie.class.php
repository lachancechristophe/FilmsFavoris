<?php
    
    class DetailMovie extends Page
    {
        
        public function __construct()
        {

            $this->doc = parent::initHTML("Detail Movie",'');

            
            
            $this->doc .= parent::topNav(); 

            $this->connectVerif();
  
            $this->doc .= parent::endBal("body");
            $this->doc .= parent::endBal("html");
                      
        }
        public function connectVerif()
        {
            if(isset($_SESSION['user_id']))
            {
                $this->coverDetail(); 
            }
            else
            {
                $this->doc .= '<h1>connecter vous</h1>';
            }
            
            
        }
        public function coverDetail()
        {
            
            $coverUrl = 'style/img/movie_cover/';
            if(!empty($_REQUEST['movie_id']))
            {
                $coverUrl .= $_REQUEST['movie_id'];
            }
            else
            {
                $coverUrl.='';
            }
            $coverUrl.='_movie_cover.png';

            if(file_exists($coverUrl))
            {
                $src=$coverUrl;

            }
            else
            {
                $src='style/img/movie_cover/Default_movie_cover.png" alt="Cover" height="244" width="200';

            }
            
            
            $this->doc .= '<h1>Film Detail</h1>';
            $this->doc .= '<img src="'.$src.'">';

        }
        public function TEST()
        {
            if(!empty($_REQUEST['movie_id']))
            {
                $this->doc .= $_REQUEST['movie_id'];
            }
        }
        


    }
        
        
    
        

    
    



?>