<?php
require("Page.class.php");
require("../../dao/lib/Connection.class.php");

class ShowMovies extends Page {
    private $moviesList = [];
    public function __construct(){
        $pdo = new Connection().getPDO();
        $query = "SELECT * FROM movies;";
        $moviesList = $pdo->query($query);
    }

    private function displayFormatted($stmt)
    {
       /* $retStr = parent::beginBal("tr");

        $retStr .= parent::beginEndBal("td", "ID");
        $retStr .= parent::beginEndBal("td", "Nom");
        $retStr .= parent::beginEndBal("td", "Adresse");
        $retStr .= parent::beginEndBal("td", "Supprimer");

        $retStr .= parent::endBal("tr");

        foreach ($stmt as $row) {
            $retStr .= parent::beginBal("tr");

            $retStr .= parent::beginEndBal("td", $row['id']);
            $retStr .= parent::beginEndBal("td", $row['nom']);
            $retStr .= parent::beginEndBal("td", $row['adresse']);
            $lienSupprimer = "delete.php?proprietaire_id=" . $row['id'];
            $retStr .= parent::beginEndBal("td", parent::createLink($lienSupprimer, 'Supprimer'));

            $retStr .= parent::endBal("tr");
        }
        return $retStr;*/
    }
}