<?php
require_once('class/dao/libConnection.class.php');
require_once('class/view/lib/Page.class.php');
require_once('class/view/ShowMovie.class.php');

$showMovie = new ShowMovie();
$showMovie->showDoc();
