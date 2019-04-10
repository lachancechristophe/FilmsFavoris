<?php
namespace FilmFavoris;

class Index extends Page
{
    public $user;
        
    public function __construct()
    {
        $this->sessionShow();
            
        $this->doc = parent::initHTML("Index", '');
            
            
        $this->doc .= parent::topNav();

        $this->doc .='<div><h1>Bienvenue '.$this->user.'</h1></div>';
        
        $this->doc .= parent::endBal("body");
        $this->doc .= parent::endBal("html");
    }
    public function sessionShow()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user = $_SESSION['user_name'];
        } else {
            $this->user = "utilisateur non connecté. Veuillez créer un compte pour utiliser le site.";
        }
    }
}
