#Projet rapide de programmeurs rapides

#Comment corriger le tp: 
##1.unzip le tp2_prog serveur
##2.changer le connection située: 
 C:\Users\1734220\Desktop\tp2_prog_Serv\FilmsFavoris\FilmFavorieApp\class\dao\lib
et
C:\Users\1734220\Desktop\tp2_prog_Serv\FilmsFavoris\FilmFavorieWeb\class\dao\lib
avec vos information omnidb(postgres).
##3.Ensuite faire la database avec c'est information : 

CREATE DATABASE favorite_movie;

###data base en premier ensuite le reste 

CREATE
TABLE public.movie_user
(
    id              SERIAL PRIMARY KEY,
  username           VARCHAR(255) ,
  hashed_password VARCHAR(255) 
 );

CREATE
TABLE public.favorite_movie
(
    id              SERIAL PRIMARY KEY,
    user_id           INT,
    movie_id           INT
 );

CREATE
TABLE public.movie
(
    id              SERIAL PRIMARY KEY,
  name VARCHAR(255) ,
  producer VARCHAR(255) ,
  release_date VARCHAR(255)
 );
CREATE TABLE movie_user_confirm (
    id SERIAL PRIMARY KEY,
    user_id int,
    confirm_code varchar,
    confirmed boolean
);
ALTER TABLE
public.movie_user
ADD email varchar(255);

ALTER TABLE
public.movie_user
ADD confirmed boolean;
 
ALTER TABLE
public.movie
ADD cover_path varchar(255);


##4.corriger le tp avec xampp

cette correction est fourni par Gabriel Gagné , Raphael Lavoie et Christhopher lachance.