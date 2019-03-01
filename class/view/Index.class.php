<?php
    
    require ("lib/page.class.php");
    require("../../dao/lib/Connection.class.php");
    class Index extends Page
    {

        
        public function __construct()
        {
            
            $this->doc = parent::initHTML("Accueil", "");
            $this->doc .= parent::createLink("../../show_movies.php", "Link to the movies");       
            $this->doc .= parent::endBal("body");
            $this->doc .= parent::endBal("html");
                      
        }
        
    
        
    }
    
    



?>