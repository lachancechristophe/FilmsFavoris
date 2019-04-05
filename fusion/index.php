<?php
namespace FilmFavoris;

session_start();
include('Navigateur.php');
//Includes génériques
include('class/dao/lib/Connection.class.php');
include('class/view/lib/Page.class.php');
//Includes pour login.php
require_once('class/view/Login.class.php');
//Includes pour signup.php
require_once('class/view/Signup.class.php');
//Includes pour index.php
require_once('class/view/Index.class.php');

require_once('class/view/Confirmation.class.php');
//Includes pour show_movies.php
require_once('class/view/ShowMovie.class.php');
//Includes pour show_users.php
require_once('class/view/ShowUser.class.php');
//Includes pour show_favorites
require_once('class/view/ShowFavorite.class.php');
//Includes pour add_movie
require_once('class/view/AddMovie.class.php');
//Includes pour detail_movie
require_once('class/view/DetailMovie.class.php');


$navigateur = new Navigateur();
$navigateur->start();
