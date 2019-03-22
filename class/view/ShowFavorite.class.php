<?php
class ShowFavorite extends Page {
    private $favoriteList = [];
    public function __construct(){
        $conn = new Connection();
        $pdo = $conn->getPDO();
        $query = "SELECT * FROM favorite_movie";
        $favoriteList = $pdo->query($query);
        
        
        $this->doc = parent::initHTML("Show Favorite",'');
            
            
        $this->doc .= parent::topNav(); 

        $this->createFormatted($favoriteList);
        
        $this->doc .= parent::endBal("body");
        $this->doc .= parent::endBal("html");
    }

    private function createFormatted($stmt)
    {
        $retStr = parent::beginBal("table");
        $retStr .=parent::beginBal("tr");

        $retStr .= parent::beginEndBal("td", "ID User");
        $retStr .= parent::beginEndBal("td", "ID Movie");
        
        

        $retStr .= parent::endBal("tr");

        foreach ($stmt as $row) {
            $retStr .= parent::beginBal("tr");

            $retStr .= parent::beginEndBal("td", $row['user_id']);
            $retStr .= parent::beginEndBal("td", $row['movie_id']);
            $retStr .= parent::endBal("tr");
        }
        $retStr .= parent::endBal("table");
        $this->doc .= $retStr;
    }
}