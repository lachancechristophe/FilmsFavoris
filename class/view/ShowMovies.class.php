<?php
require("Page.class.php");
require("../../dao/lib/Connection.class.php");

class ShowMovies extends Page {
    private $moviesList = [];
    public function __construct(){
        $pdo = new Connection().getPDO();
        $query = "SELECT * FROM movies;";
        $moviesList = $pdo->query($query);
        createFormatted($moviesList);
    }

    private function createFormatted($stmt)
    {
       $retStr = parent::beginBal("tr");

        $retStr .= parent::beginEndBal("td", "ID");
        $retStr .= parent::beginEndBal("td", "Nom");
        $retStr .= parent::beginEndBal("td", "Producteur");
        $retStr .= parent::beginEndBal("td", "Date");
        $retStr .= parent::beginEndBal("td", "Favoriter");

        $retStr .= parent::endBal("tr");

        foreach ($stmt as $row) {
            $retStr .= parent::beginBal("tr");

            $retStr .= parent::beginEndBal("td", $row['id']);
            $retStr .= parent::beginEndBal("td", $row['nom']);
            $retStr .= parent::beginEndBal("td", $row['adresse']);
            $lienSupprimer = "favorite.php?film_id=" . $row['id'];
            $retStr .= parent::beginEndBal("td", parent::createLink($lienSupprimer, 'Supprimer'));

            $retStr .= parent::endBal("tr");
        }
        $this->$doc .= $retStr;
    }
}