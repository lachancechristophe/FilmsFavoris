<?php
require("Page.class.php");
require("../../dao/lib/Connection.class.php");

class ShowMovies extends Page {
    private $moviesList = [];
    public function __construct(){
        $moviesList = connectandfetch();
        
    }
}