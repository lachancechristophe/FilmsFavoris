<?php
session_start();

require_once('class/dao/lib/Connection.class.php');
require_once('class/view/lib/Page.class.php');
require_once('class/view/ShowMovie.class.php');

if(!empty($_REQUEST['movie_id']) && $_REQUEST['favorite'] == "true"){
    //Code pour inserer un nouveau record dans UserMovie
    /*
    $conn = new Connection();
    $pdo = $conn->getPDO();
    $query = "INSERT INTO favorite_movie (user_id, movie_id)";
    $query .= "VALUES ('" . "', '" . $_REQUEST['movie_id'] . "');";
    //$pdo->query($query);
    echo $query;
    */
}

$showMovie = new ShowMovie();
$showMovie->showDoc();
