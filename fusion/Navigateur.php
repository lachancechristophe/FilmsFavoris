<?php
namespace FilmFavoris;

class Navigateur 
{

    public function start()
    {
        $page = '';        
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
        }
        switch($page){

            case 'add_movie':
                $page = new AddMovie();
                break;

            case 'show_favorite':
                $page = new ShowFavorite();
                break;

            case 'show_user':
                $page = new ShowUser();
                break;

            case 'show_movie':
                $page = new ShowMovie();
                break;

            case 'login':
                $page = new Login();
                break;

            case 'signup':
                $page = new Signup();
                break;

            default:
                $page = new Index();
                break;

        }
        $page->showDoc();

    }

}