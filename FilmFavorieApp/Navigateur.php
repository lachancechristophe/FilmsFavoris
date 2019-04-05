<?php
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
                $page->showDoc();
                break;

            case 'show_favorite':
                $page = new ShowFavorite();
                $page->showDoc();
                break;

            case 'show_user':
                $page = new ShowUser();
                $page->showDoc();
                break;

            case 'show_movie':
                $page = new ShowMovie();
                $page->showDoc();
                break;

            case 'login':
                $page = new Login();
                $page->showDoc();
                
                break;

            case 'signup':
                $page = new Signup();
                $page->showDoc();
                break;

            default:
                $page = new Index();
                $page->showDoc();



        }

    }

}