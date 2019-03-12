<?php
    
    class Index extends Page
    {

        
        public function __construct()
        {
            
            $this->doc = parent::initHTML("Index",'');
            
            
            $this->doc .= parent::topNav(); 
            
        
            $this->doc .= parent::endBal("body");
            $this->doc .= parent::endBal("html");
                      
        }
        
    
        
    }
    
    



?>