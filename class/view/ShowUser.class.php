<?php
class ShowUser extends Page {
    private $usersList = [];
    public function __construct(){
        $conn = new Connection();
        $pdo = $conn->getPDO();
        $query = "SELECT * FROM movie_user";
        $usersList = $pdo->query($query);
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
            $retStr .= parent::beginEndBal("td", $row['username']);

            $retStr .= parent::endBal("tr");
        }
        $retStr .= parent::endBal("table");
        $this->doc .= $retStr;
    }
}