<?php
class ShowUser extends Page {
    private $userList = [];
    public function __construct(){
        $pdo = new Connection().getPDO();
        $query = "SELECT * FROM user;";
        $userList = $pdo->query($query);
        createFormatted($userList);
    }

    private function createFormatted($stmt)
    {
       $retStr = parent::beginBal("tr");

        $retStr .= parent::beginEndBal("td", "ID");
        $retStr .= parent::beginEndBal("td", "Username");
        
        

        $retStr .= parent::endBal("tr");

        foreach ($stmt as $row) {
            $retStr .= parent::beginBal("tr");

            $retStr .= parent::beginEndBal("td", $row['id']);
            $retStr .= parent::beginEndBal("td", $row['username']);
            $lienSupprimer = "favorite.php?user_id=" . $row['id'];
            $retStr .= parent::beginEndBal("td", parent::createLink($lienSupprimer, 'Supprimer'));

            $retStr .= parent::endBal("tr");
        }
        $this->$doc .= $retStr;
    }
}