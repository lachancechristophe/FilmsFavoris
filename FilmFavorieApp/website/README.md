Projet rapide de programmeurs rapides

CREATE TABLE movie_user_confirm (
    id SERIAL PRIMARY KEY,
    user_id int,
    confirm_code varchar,
    confirmed boolean
)