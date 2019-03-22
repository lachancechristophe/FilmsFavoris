<?php
    
    class Index extends Page
    {
        public $user;
        
        public function __construct()
        {
            $this->sessionShow();
            
            $this->doc = parent::initHTML("Index",'');
            
            
            $this->doc .= parent::topNav(); 
            $this->doc .='<h1>Bienvenu utilisateur '.$this->user.'</h1>';
        
            $this->doc .= parent::endBal("body");
            $this->doc .= parent::endBal("html");
                      
        }
        public function sessionShow()
        {
            if(isset($_SESSION['user_id']))
            {
                $this->user = $_SESSION['user_id'];
                 
            }
            else{
                
                $this->user = "de l'espace";
            }
            
            
        }
        
    
        
    }
    
    



?>