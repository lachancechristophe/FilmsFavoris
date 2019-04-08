<?php
namespace FilmFavoris;

class Navigateur
{
    public function start()
    {
        $page = '';
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        switch ($page) {

            case 'detail_movie':
                $page = new DetailMovie();
                break;
            case 'add_movie':
                $page = new AddMovie();
                break;

            case 'show_favorite':
                $page = new ShowFavorite();
                break;

            case 'show_user':
                $page = new ShowUser();
                break;

            case 'confirm_user':
                $page = new Confirmation();
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
