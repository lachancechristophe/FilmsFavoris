<?php
class ShowMovie extends Page {
    private $moviesList = [];
    public function __construct(){
        $conn = new Connection();
        $pdo = $conn->getPDO();
        $query = "SELECT * FROM movie";
        $moviesList = $pdo->query($query);
        $this->createFormatted($moviesList);
    }

    private function createFormatted($stmt)
    {
        $retStr = parent::beginBal("table");
        $retStr .=parent::beginBal("tr");

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
            $retStr .= parent::beginEndBal("td", $row['producteur']);
            $retStr .= parent::beginEndBal("td", $row['datesortie']);
            $lienFavoriter = "show_movies.php?movie_id=" . $row['id'] . "&favorite=true";
            $retStr .= parent::beginEndBal("td", parent::createLink($lienFavoriter, 'Favoriter'));

            $retStr .= parent::endBal("tr");
        }
        $retStr .= parent::endBal("table");
        $this->doc .= $retStr;
    }
}