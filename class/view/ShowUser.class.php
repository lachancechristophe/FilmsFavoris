<?php
class ShowUser extends Page {
    private $moviesList = [];
    public function __construct(){
        $conn = new Connection();
        $pdo = $conn->getPDO();
        $query = "SELECT * FROM user";
        $moviesList = $pdo->query($query);
        $this->createFormatted($usersList);
    }

    private function createFormatted($stmt)
    {
        $retStr = parent::beginBal("table");
        $retStr .=parent::beginBal("tr");

        $retStr .= parent::beginEndBal("td", "ID");
        $retStr .= parent::beginEndBal("td", "Username");
        
        

        $retStr .= parent::endBal("tr");

        foreach ($stmt as $row) {
            $retStr .= parent::beginBal("tr");

            $retStr .= parent::beginEndBal("td", $row['id']);
            $retStr .= parent::beginEndBal("td", $row['user_name']);
            
            $lienFavoriter = "favorite.php?user_id=" . $row['id'];
            $retStr .= parent::beginEndBal("td", parent::createLink($lienFavoriter, 'Favoriter'));

            $retStr .= parent::endBal("tr");
        }
        $retStr .= parent::endBal("table");
        $this->doc .= $retStr;
    }
}