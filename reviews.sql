--
-- PostgreSQL database dump
--

-- Dumped from database version 10.12
-- Dumped by pg_dump version 10.12

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
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


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: comments; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.comments (
    id_comment integer NOT NULL,
    id_user integer NOT NULL,
    id_review integer NOT NULL,
    comment_text text NOT NULL,
    date_added_comment timestamp without time zone DEFAULT timenow() NOT NULL
);


ALTER TABLE public.comments OWNER TO postgres;

--
-- Name: comments_id_comment_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.comments_id_comment_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.comments_id_comment_seq OWNER TO postgres;

--
-- Name: comments_id_comment_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.comments_id_comment_seq OWNED BY public.comments.id_comment;


--
-- Name: reviews; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reviews (
    id_review integer NOT NULL,
    id_user integer NOT NULL,
    film_title character varying(200) NOT NULL,
    poster character varying(100) NOT NULL,
    trailer character varying(200),
    text_review text NOT NULL,
    date_added_review date DEFAULT now() NOT NULL
);


ALTER TABLE public.reviews OWNER TO postgres;

--
-- Name: reviews_id_review_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reviews_id_review_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reviews_id_review_seq OWNER TO postgres;

--
-- Name: reviews_id_review_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.reviews_id_review_seq OWNED BY public.reviews.id_review;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id_user integer NOT NULL,
    name character varying(30) NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(200) NOT NULL,
    access character(1) DEFAULT 0 NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_user_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_user_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_user_seq OWNER TO postgres;

--
-- Name: users_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_user_seq OWNED BY public.users.id_user;


--
-- Name: comments id_comment; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comments ALTER COLUMN id_comment SET DEFAULT nextval('public.comments_id_comment_seq'::regclass);


--
-- Name: reviews id_review; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reviews ALTER COLUMN id_review SET DEFAULT nextval('public.reviews_id_review_seq'::regclass);


--
-- Name: users id_user; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id_user SET DEFAULT nextval('public.users_id_user_seq'::regclass);


--
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.comments (id_comment, id_user, id_review, comment_text, date_added_comment) FROM stdin;
1	1	1	Комментарий к мстителям	2020-03-14 00:00:00
2	1	1	Второй коммент к мстителям	2020-03-14 00:00:00
3	1	3	Коммент к ип ману 111	2020-03-14 00:00:00
4	1	3	Второй коммент к ип ману	2020-03-14 00:00:00
5	3	1	Коммент от марка к мстителям	2020-03-14 00:00:00
6	3	8	Коммент от марка викинги	2020-03-14 00:00:00
7	4	1	Фильм	2020-03-14 00:00:00
14	5	3	уцацуа	2020-03-14 19:04:58
16	1	1	<script>alert('Hi!');</script>	2020-03-15 00:02:50
31	1	4	fwe	2020-03-16 00:28:01
32	1	4	fe	2020-03-16 00:28:06
33	1	4	fwe	2020-03-16 00:28:09
34	1	4	wef	2020-03-16 00:28:24
60	1	22	Комментарий 1	2020-03-17 15:25:29
61	5	22	Комментарий 2	2020-03-17 15:26:12
62	12	22	Комментарий 3	2020-03-17 15:27:59
49	1	4	комментарий	2020-03-16 14:11:56
15	1	1	фильм:"'ie	2020-03-15 00:02:09
12	5	3	Коммент к ип ману	2020-03-14 19:02:26.965818
63	12	9	Комментарий....	2020-03-17 15:43:54
29	9	2	Железный рыцарь	2020-03-15 18:08:49
\.


--
-- Data for Name: reviews; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reviews (id_review, id_user, film_title, poster, trailer, text_review, date_added_review) FROM stdin;
3	1	Ип ман	uploads/40f129169cc0953ipman.jpg	GlvNygqGh70	Текст обзора об фильме Ип Ман	2020-03-13
8	3	Викинги	uploads/00365e55350e496vikings.jpg	1YVxm0GKhkM	Фильм повествует о ранних набегах викингов на Британские острова. Центральным персонажем является герой исландских саг Рагнар Лодброк. Этот мифический викинг на родине почитается как легендарный герой и в популярности уступает разве что Сигурду Убийце Фафнира. Но если Сигурд персонаж уж совсем мифический и встречается только в сказочных мотивах, то имя Рагнара Лодброка пересекается с реальными событиями и фактами, упоминаемыми не только в исландских рукописях. Однако был ли у него исторический прототип, или речь идет о неком собирательном образе национального героя, с абсолютной точностью сказать нельзя.\r\nСериал «Викинги» - не что иное, как одна из возможных интерпретаций истории.	2020-03-13
9	3	Аватар	uploads/1bbdf2df14349b1avatar.jpg		Текс о фильме аватар	2020-03-13
4	1	Миссия невыполнима протокол фантом	uploads/15c7552f9971e3fmn.jpg	_D2o8Gz81_o	В фильме Миссия невыполнима: Протокол Фантом после взрыва Московского Кремля подразделение МВФ закрывается и является главным подозреваемым по данному делу. Агенты вынуждены скрываться, и помощи им ждать уже не откуда. Итан Хант и его коллеги должны собраться с силами и очистить своё имя от необоснованных обвинений, выходя на след настоящих террористов.	2020-03-13
2	1	Железный рыцарь	uploads/30e0f673e2c8ec7iron.jpg		Обзор о железном рыцаре	2020-03-13
22	1	Грань будущего	uploads/053fdf0d8fab8b1gg.jpg	lRbMOyy_Bdw	Последний успешный бой случился у Вердена. Это аллюзия к страшной исторической мясорубке первой мировой, где погибли миллионы.\r\n\r\nВ Вердене землян привела к победе сержант Рита Вратаски (Emily Blunt), которую прозвали Ангелом Вердена (а так-же еще одним прозвищем, которое мы тут упоминать не будем). Она уничтожала врагов сотнями и из неё сделали героя.\r\n\r\nНаш герой, Уильям Кейдж (Том Круз), является журналистом из США и прилетает в Великобританию, где готовится "секретный" десант вглубь объятой огнём Европы, захваченной Мимиками (так называют пришельцев).\r\n\r\nОперация высадки будет в Нормандии, прямо как уже во второй мировой.\r\n\r\nВ Лондоне он, общаясь с генералом армии, с удивлением узнаёт, что он поедет в центр событий и будет принимать участие в самой высадке. Причина в том, что им нужен человек с камерой на земле дабы покрывать события.\r\n\r\nКейдж не очень рад такому повороту (верная смерть) и пытается всячески прикрыться корочками и бумажками, что он гражданин США и вообще репортёр. Вторая стадия отрицания в виде агрессии (угроза сообщить в СМИ про плохого генерала) тоже не имеет должного эффекта, нашего героя скручивают и уволакивают в штаб войск.	2020-03-17
23	12	Матрица	uploads/59c9d28db6c3d74mm.jpg	YihPA42fdQ8	Описание к фильму матрица	2020-03-17
1	1	Мстители	uploads/78365e0f679d4945avengers.jpg	bxwt6TvNxas	Текст о мстителях	2020-03-13
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id_user, name, email, password, access) FROM stdin;
2	Джон	John@inbox.ru	$2y$10$mGB/EdJkXlu6iyXFbFQZN.vgFLg9hvjFwg2UP90jUJfkPg0Uob32e	0
1	Виталий	garshin.1999@inbox.ru	$2y$10$PMLzB.KTmVc.F0q3Mv1ccetepUrxJrioEAnnEfNHsvQN783ZnM3Im	1
3	Mark	mark@gmail.com	$2y$10$orv0xj8mxsV6TRuqSbdwuOv9GtPOpOzfja/FUaNuwSiwX1eECZyki	1
4	Антон	a.popov.d@gmail.com	$2y$10$1.IG96n/j0EYipHEP3XA.emLsYj4I0ke8lR3JVLU4gUB/MRUbDa8O	0
5	Михаил Лебедев-Ли	artem.342@yandex.ru	$2y$10$5c0nLajouDL4N/dm6XnX3OV/0P2ipl.WwQf5LOEvGUrk7FQVoiCKK	0
6	Олег	oleg22@mail.ru	$2y$10$.0/FCT.FN9IQoKVn7Hx96Os1q5YpU4akVdDo6PUbklF.pZmWwAML.	0
9	Еще-один человек	someperson@23.com	$2y$10$d5Rf5Cr1dcShsRMMTTC1NOpghI075jqHchU/gU.XtuKxAU3qUVbN2	0
11	пкцпцп-цпцу-	wgwg2g2g@inbox.ru	$2y$10$NQjwakQoHguQNzR/FKwfzuBpdeAv0Gy3cmWSqN6k5wKY58ZyCnzky	0
12	Владимир	vladimir@gmail.com	$2y$10$MmlWgsoLaVydAx9c5w2On.VtPhgZQt2Q/3X3vSDPcuuU34QWn.EEu	1
\.


--
-- Name: comments_id_comment_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.comments_id_comment_seq', 63, true);


--
-- Name: reviews_id_review_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reviews_id_review_seq', 24, true);


--
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_user_seq', 13, true);


--
-- Name: comments pk_comments; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comments
    ADD CONSTRAINT pk_comments PRIMARY KEY (id_comment);


--
-- Name: reviews pk_reviews; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT pk_reviews PRIMARY KEY (id_review);


--
-- Name: users pk_users; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT pk_users PRIMARY KEY (id_user);


--
-- Name: comments_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX comments_pk ON public.comments USING btree (id_comment);


--
-- Name: relationship_1_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX relationship_1_fk ON public.comments USING btree (id_user);


--
-- Name: relationship_2_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX relationship_2_fk ON public.reviews USING btree (id_user);


--
-- Name: relationship_3_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX relationship_3_fk ON public.comments USING btree (id_review);


--
-- Name: reviews_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX reviews_pk ON public.reviews USING btree (id_review);


--
-- Name: users_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX users_pk ON public.users USING btree (id_user);


--
-- Name: comments fk_comments_relations_reviews; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comments
    ADD CONSTRAINT fk_comments_relations_reviews FOREIGN KEY (id_review) REFERENCES public.reviews(id_review) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: comments fk_comments_relations_users; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comments
    ADD CONSTRAINT fk_comments_relations_users FOREIGN KEY (id_user) REFERENCES public.users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reviews fk_reviews_relations_users; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT fk_reviews_relations_users FOREIGN KEY (id_user) REFERENCES public.users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

