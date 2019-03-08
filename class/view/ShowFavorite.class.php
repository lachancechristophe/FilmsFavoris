<?php
class ShowMovie extends Page {
    private $favoritesList = [];
    public function __construct(){
        $conn = new Connection();
        $pdo = $conn->getPDO();
        $query = "SELECT * FROM favorite_movie ";
        $query .= "INNER JOIN movie ON favorite_movie.movie_id = movie.id";
        $query .= "WHERE user_id = "; // TODO: Ajouter le UID de session
        $favoritesList = $pdo->query($query);
        $this->createFormatted($favoritesList);
    }

    private function createFormatted($stmt)
    {
        $retStr = parent::beginBal("table");
        $retStr .=parent::beginBal("tr");

        $retStr .= parent::beginEndBal("td", "ID");
        $retStr .= parent::beginEndBal("td", "Name");
        $retStr .= parent::beginEndBal("td", "Producer");
        $retStr .= parent::beginEndBal("td", "Date");

        $retStr .= parent::endBal("tr");

        foreach ($stmt as $row) {
            $retStr .= parent::beginBal("tr");

            $retStr .= parent::beginEndBal("td", $row['id']);
            $retStr .= parent::beginEndBal("td", $row['name']);
            $retStr .= parent::beginEndBal("td", $row['producer']);
            $retStr .= parent::beginEndBal("td", $row['release_date']);

            $retStr .= parent::endBal("tr");
        }
        $retStr .= parent::endBal("table");
        $this->doc .= $retStr;
    }
}