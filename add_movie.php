<?php
session_start();

require_once('class/dao/lib/Connection.class.php');
require_once('class/view/lib/Page.class.php');
require_once('class/view/AddMovie.class.php');

$signup = new AddMovie();
$signup->showDoc();
