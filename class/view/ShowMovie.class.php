<?php
class ShowMovie extends Page {
    private $moviesList = [];
    public function __construct(){
        $conn = new Connection();
        $pdo = $conn->getPDO();
        $query = "SELECT * FROM movie";
        $moviesList = $pdo->query($query);
        
        $this->doc = parent::initHTML("Show Movie",'');
            
            
        $this->doc .= parent::topNav(); 
        
        
        $this->createFormatted($moviesList);
        
        $this->doc .= parent::endBal("body");
        $this->doc .= parent::endBal("html");
    }

    private function createFormatted($stmt)
    {
        $retStr = parent::beginBal("table");
        $retStr .=parent::beginBal("tr");

        $retStr .= parent::beginEndBal("td", "ID");
        $retStr .= parent::beginEndBal("td", "Name");
        $retStr .= parent::beginEndBal("td", "Producer");
        $retStr .= parent::beginEndBal("td", "Date");
        $retStr .= parent::beginEndBal("td", "Favorite");

        $retStr .= parent::endBal("tr");

        foreach ($stmt as $row) {
            $retStr .= parent::beginBal("tr");

            $retStr .= parent::beginEndBal("td", $row['id']);
            $retStr .= parent::beginEndBal("td", $row['name']);
            $retStr .= parent::beginEndBal("td", $row['producer']);
            $retStr .= parent::beginEndBal("td", $row['release_date']);
            $lienFavoriter = "show_movies.php?movie_id=" . $row['id'] . "&favorite=true";
            $retStr .= parent::beginEndBal("td", parent::createLink($lienFavoriter, 'Make Favorite'));

            $retStr .= parent::endBal("tr");
        }
        $retStr .= parent::endBal("table");
        $this->doc .= $retStr;
    }

    
}