<?php
class ShowFavorite extends Page {
    private $favoriteList = [];
    public function __construct(){
        $this->doc = parent::initHTML("Show Favorite",'');

        $this->doc .= parent::topNav(); 

        if(empty($_SESSION['user_id'])){
            $this->doc .= parent::beginEndBal("p", "Il faut etre connecté pour voir les favoris.");
            $this->doc .= parent::endBal("body");
            $this->doc .= parent::endBal("html");
            return;
        }

        $conn = new Connection();
        $pdo = $conn->getPDO();
        $query = "SELECT * FROM favorite_movie ";
        $query .= "INNER JOIN movie ON favorite_movie.movie_id=movie.id ";
        $query .= "WHERE user_id = " . $_SESSION['user_id'];
        $favoriteList = $pdo->query($query);
        $this->createFormatted($favoriteList);
        
        $this->doc .= parent::endBal("body");
        $this->doc .= parent::endBal("html");
    }

    private function createFormatted($stmt)
    {
        $retStr = parent::beginBal('table class ="steelBlueCols"');
        $retStr .=parent::beginBal("tr");

        $retStr .= parent::beginEndBal("td", "ID User");
        $retStr .= parent::beginEndBal("td", "ID Movie");
        $retStr .= parent::beginEndBal("td", "Name");
        $retStr .= parent::beginEndBal("td", "Producer");
        $retStr .= parent::beginEndBal("td", "Date");
        
        

        $retStr .= parent::endBal("tr");

        foreach ($stmt as $row) {
            $retStr .= parent::beginBal("tr");

            $retStr .= parent::beginEndBal("td", $row['user_id']);
            $retStr .= parent::beginEndBal("td", $row['movie_id']);
            $retStr .= parent::beginEndBal("td", $row['name']);
            $retStr .= parent::beginEndBal("td", $row['producer']);
            $retStr .= parent::beginEndBal("td", $row['release_date']);
            $retStr .= parent::endBal("tr");
        }
        $retStr .= parent::endBal("table");
        $this->doc .= $retStr;
    }
}