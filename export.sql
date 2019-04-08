--
-- PostgreSQL database dump
--

-- Dumped from database version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: logging_function(); Type: FUNCTION; Schema: public; Owner: master
--

CREATE FUNCTION public.logging_function() RETURNS trigger
    LANGUAGE plpgsql
    SET search_path TO 'public'
    AS $$
    BEGIN
        IF TG_OP = 'UPDATE' THEN
            INSERT INTO journal_evenements
            (usager, action, tablename, champ,
            data_before, data_after, moment)
            VALUES (current_user, TG_OP, TG_TABLE_NAME, '',
            row_to_json(OLD.*), row_to_json(NEW.*), NOW());
            RETURN NEW;
        ELSE 
            INSERT INTO journal_evenements
            (usager, action, tablename, champ,
            data_before, data_after, moment)
            VALUES (current_user, TG_OP, TG_TABLE_NAME, '',
            NULL, row_to_json(NEW.*), NOW());
            RETURN NEW;
        END IF;
    END;
    $$;


ALTER FUNCTION public.logging_function() OWNER TO master;

--
-- Name: trigger_function(); Type: FUNCTION; Schema: public; Owner: master
--

CREATE FUNCTION public.trigger_function() RETURNS trigger
    LANGUAGE plpgsql
    SET search_path TO 'public'
    AS $$
    BEGIN
        INSERT INTO test2(text)
        VALUES (NEW.text);
        RETURN NEW;
    END;
    $$;


ALTER FUNCTION public.trigger_function() OWNER TO master;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: favorite_movie; Type: TABLE; Schema: public; Owner: master
--

CREATE TABLE public.favorite_movie (
    id integer NOT NULL,
    movie_id integer,
    user_id integer
);


ALTER TABLE public.favorite_movie OWNER TO master;

--
-- Name: favorite_movie_id_seq; Type: SEQUENCE; Schema: public; Owner: master
--

CREATE SEQUENCE public.favorite_movie_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.favorite_movie_id_seq OWNER TO master;

--
-- Name: favorite_movie_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: master
--

ALTER SEQUENCE public.favorite_movie_id_seq OWNED BY public.favorite_movie.id;


--
-- Name: films; Type: TABLE; Schema: public; Owner: master
--

CREATE TABLE public.films (
    id integer NOT NULL,
    name character varying,
    producer character varying,
    release_date character varying
);


ALTER TABLE public.films OWNER TO master;

--
-- Name: films_id_seq; Type: SEQUENCE; Schema: public; Owner: master
--

CREATE SEQUENCE public.films_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.films_id_seq OWNER TO master;

--
-- Name: films_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: master
--

ALTER SEQUENCE public.films_id_seq OWNED BY public.films.id;


--
-- Name: journal_evenements; Type: TABLE; Schema: public; Owner: master
--

CREATE TABLE public.journal_evenements (
    id integer NOT NULL,
    usager character varying,
    action character varying,
    tablename character varying,
    champ character varying,
    data_before json,
    data_after json,
    moment date
);


ALTER TABLE public.journal_evenements OWNER TO master;

--
-- Name: journal_evenements_id_seq; Type: SEQUENCE; Schema: public; Owner: master
--

CREATE SEQUENCE public.journal_evenements_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.journal_evenements_id_seq OWNER TO master;

--
-- Name: journal_evenements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: master
--

ALTER SEQUENCE public.journal_evenements_id_seq OWNED BY public.journal_evenements.id;


--
-- Name: movie; Type: TABLE; Schema: public; Owner: master
--

CREATE TABLE public.movie (
    id integer NOT NULL,
    name character varying,
    producer character varying,
    release_date character varying
);


ALTER TABLE public.movie OWNER TO master;

--
-- Name: movie_id_seq; Type: SEQUENCE; Schema: public; Owner: master
--

CREATE SEQUENCE public.movie_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movie_id_seq OWNER TO master;

--
-- Name: movie_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: master
--

ALTER SEQUENCE public.movie_id_seq OWNED BY public.movie.id;


--
-- Name: movie_user; Type: TABLE; Schema: public; Owner: master
--

CREATE TABLE public.movie_user (
    id integer NOT NULL,
    username character varying,
    hashed_password character varying,
    confirmed boolean,
    email character varying
);


ALTER TABLE public.movie_user OWNER TO master;

--
-- Name: movie_user_confirm; Type: TABLE; Schema: public; Owner: master
--

CREATE TABLE public.movie_user_confirm (
    id integer NOT NULL,
    user_id integer,
    confirm_code character varying,
    confirmed boolean
);


ALTER TABLE public.movie_user_confirm OWNER TO master;

--
-- Name: movie_user_confirm_id_seq; Type: SEQUENCE; Schema: public; Owner: master
--

CREATE SEQUENCE public.movie_user_confirm_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movie_user_confirm_id_seq OWNER TO master;

--
-- Name: movie_user_confirm_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: master
--

ALTER SEQUENCE public.movie_user_confirm_id_seq OWNED BY public.movie_user_confirm.id;


--
-- Name: movie_user_id_seq; Type: SEQUENCE; Schema: public; Owner: master
--

CREATE SEQUENCE public.movie_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movie_user_id_seq OWNER TO master;

--
-- Name: movie_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: master
--

ALTER SEQUENCE public.movie_user_id_seq OWNED BY public.movie_user.id;


--
-- Name: favorite_movie id; Type: DEFAULT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.favorite_movie ALTER COLUMN id SET DEFAULT nextval('public.favorite_movie_id_seq'::regclass);


--
-- Name: films id; Type: DEFAULT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.films ALTER COLUMN id SET DEFAULT nextval('public.films_id_seq'::regclass);


--
-- Name: journal_evenements id; Type: DEFAULT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.journal_evenements ALTER COLUMN id SET DEFAULT nextval('public.journal_evenements_id_seq'::regclass);


--
-- Name: movie id; Type: DEFAULT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.movie ALTER COLUMN id SET DEFAULT nextval('public.movie_id_seq'::regclass);


--
-- Name: movie_user id; Type: DEFAULT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.movie_user ALTER COLUMN id SET DEFAULT nextval('public.movie_user_id_seq'::regclass);


--
-- Name: movie_user_confirm id; Type: DEFAULT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.movie_user_confirm ALTER COLUMN id SET DEFAULT nextval('public.movie_user_confirm_id_seq'::regclass);


--
-- Data for Name: favorite_movie; Type: TABLE DATA; Schema: public; Owner: master
--

COPY public.favorite_movie (id, movie_id, user_id) FROM stdin;
11	11	15
12	12	16
13	13	16
15	11	16
\.

--
-- Data for Name: movie; Type: TABLE DATA; Schema: public; Owner: master
--

COPY public.movie (id, name, producer, release_date) FROM stdin;
9	Tom Clancy''s Fallout &amp; Knuckles	Ed Hardy	2004
10	Film epique	Roger Miller	2211
11	Tom Clancy''s Fallout &amp; Knuckles	Ed Hardy	2000
12	Babine et Banane	Céline Dion	1998
13	Brouette magnifique	Guy Cloutier	1969
\.


--
-- Data for Name: movie_user; Type: TABLE DATA; Schema: public; Owner: master
--

COPY public.movie_user (id, username, hashed_password, confirmed, email) FROM stdin;
15	Christophe	$2y$10$ht05j6mnCOajTgVpf98YmOqif3oidwHKGngIf5xfZvfVgIs4rdHoa	t	humaindaujourdhui@gmail.com
16	Martin	$2y$10$QEr4aNmFmKYmLkogJ6KM0eV/QCBshlMZWnw.KC7yrLyB/pr0J./Bi	t	super@lala.com
\.


--
-- Data for Name: movie_user_confirm; Type: TABLE DATA; Schema: public; Owner: master
--

COPY public.movie_user_confirm (id, user_id, confirm_code, confirmed) FROM stdin;
8	15	bb36b64	t
9	16	66676df	t
\.


--
-- Name: favorite_movie_id_seq; Type: SEQUENCE SET; Schema: public; Owner: master
--

SELECT pg_catalog.setval('public.favorite_movie_id_seq', 15, true);


--
-- Name: films_id_seq; Type: SEQUENCE SET; Schema: public; Owner: master
--

SELECT pg_catalog.setval('public.films_id_seq', 2, true);


--
-- Name: journal_evenements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: master
--

SELECT pg_catalog.setval('public.journal_evenements_id_seq', 5, true);


--
-- Name: movie_id_seq; Type: SEQUENCE SET; Schema: public; Owner: master
--

SELECT pg_catalog.setval('public.movie_id_seq', 13, true);


--
-- Name: movie_user_confirm_id_seq; Type: SEQUENCE SET; Schema: public; Owner: master
--

SELECT pg_catalog.setval('public.movie_user_confirm_id_seq', 9, true);


--
-- Name: movie_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: master
--

SELECT pg_catalog.setval('public.movie_user_id_seq', 16, true);


--
-- Name: favorite_movie favorite_movie_pkey; Type: CONSTRAINT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.favorite_movie
    ADD CONSTRAINT favorite_movie_pkey PRIMARY KEY (id);


--
-- Name: films films_pkey; Type: CONSTRAINT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.films
    ADD CONSTRAINT films_pkey PRIMARY KEY (id);


--
-- Name: journal_evenements journal_evenements_pkey; Type: CONSTRAINT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.journal_evenements
    ADD CONSTRAINT journal_evenements_pkey PRIMARY KEY (id);


--
-- Name: movie movie_pkey; Type: CONSTRAINT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.movie
    ADD CONSTRAINT movie_pkey PRIMARY KEY (id);


--
-- Name: movie_user_confirm movie_user_confirm_pkey; Type: CONSTRAINT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.movie_user_confirm
    ADD CONSTRAINT movie_user_confirm_pkey PRIMARY KEY (id);


--
-- Name: movie_user movie_user_pkey; Type: CONSTRAINT; Schema: public; Owner: master
--

ALTER TABLE ONLY public.movie_user
    ADD CONSTRAINT movie_user_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

