<?php
session_start();

require_once('class/view/lib/Page.class.php');
require_once('class/view/DetailMovie.class.php');

$ficheFilm = new DetailMovie();
$ficheFilm->showDoc();