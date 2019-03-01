<?php
    
    class Index extends Page
    {

        
        public function __construct()
        {
            
            $this->doc = parent::initHTML("Index", "");
            $this->doc .= parent::createLink("../../login.php", "Click here to Login"); 
            $this->doc .= parent::beginBal("br");
            $this->doc .= parent::createLink("../../signup.php", "Click here to signup");
            $this->doc .= parent::beginBal("br");
            $this->doc .= parent::createLink("../../show_movies.php", "Link to the movies");
            $this->doc .= parent::beginBal("br");
            $this->doc .= parent::createLink("../../show_favorites.php", "Link to the favorite movies");
            $this->doc .= parent::endBal("body");
            $this->doc .= parent::endBal("html");
                      
        }
        
    
        
    }
    
    



?>