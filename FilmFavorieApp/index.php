<?php
session_start();
include('Navigateur.php');
//Includes génériques
include('website/class/dao/lib/Connection.class.php');
include('website/class/view/lib/Page.class.php');
//Includes pour login.php
require_once('website/class/view/Login.class.php');
//Includes pour signup.php
require_once('website/class/view/Signup.class.php');
//Includes pour index.php
require_once('website/class/view/Index.class.php');
//Includes pour show_movies.php
require_once('website/class/view/ShowMovie.class.php');
//Includes pour show_users.php
require_once('website/class/view/ShowUser.class.php');
//Includes pour show_favorites
require_once('website/class/view/ShowFavorite.class.php');
//Includes pour add_movie
require_once('website/class/view/AddMovie.class.php');


$navigateur = new Navigateur();
$navigateur->start();
