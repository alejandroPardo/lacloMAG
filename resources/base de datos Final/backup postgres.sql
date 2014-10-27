--
-- PostgreSQL database dump
--

-- Dumped from database version 9.0.18
-- Dumped by pg_dump version 9.0.18
-- Started on 2014-10-27 17:32:45

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- TOC entry 590 (class 2612 OID 11574)
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: postgres
--

CREATE OR REPLACE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO postgres;

SET search_path = public, pg_catalog;

--
-- TOC entry 482 (class 1247 OID 17133)
-- Dependencies: 6
-- Name: evaluation_type_list; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE evaluation_type_list AS ENUM (
    'BLIND',
    'OPEN',
    'DOUBLEBLIND'
);


ALTER TYPE public.evaluation_type_list OWNER TO postgres;

--
-- TOC entry 485 (class 1247 OID 17138)
-- Dependencies: 6
-- Name: status_list; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE status_list AS ENUM (
    'ACTUAL',
    'ARCHIVED',
    'ONCONSTRUCTION'
);


ALTER TYPE public.status_list OWNER TO postgres;

--
-- TOC entry 586 (class 1247 OID 17537)
-- Dependencies: 6
-- Name: status_paper_evaluators; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE status_paper_evaluators AS ENUM (
    'ASIGNED',
    'ASSIGNED',
    'ACCEPT',
    'REJECT',
    'APPROVED',
    'MINORCHANGE',
    'AUTHORCHANGE',
    'DENIED',
    'CORRECTED',
    'EDITOR'
);


ALTER TYPE public.status_paper_evaluators OWNER TO postgres;

--
-- TOC entry 488 (class 1247 OID 17154)
-- Dependencies: 6
-- Name: status_papers; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE status_papers AS ENUM (
    'UNSENT',
    'SENT',
    'ASSIGNED',
    'ONREVISION',
    'REJECTED',
    'APPROVED',
    'PUBLISHED',
    'UNPUBLISHED',
    'REVIEW'
);


ALTER TYPE public.status_papers OWNER TO postgres;

--
-- TOC entry 491 (class 1247 OID 17165)
-- Dependencies: 6
-- Name: type_evaluator; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE type_evaluator AS ENUM (
    'PRINCIPAL',
    'SURROGATE'
);


ALTER TYPE public.type_evaluator OWNER TO postgres;

--
-- TOC entry 494 (class 1247 OID 17169)
-- Dependencies: 6
-- Name: type_file; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE type_file AS ENUM (
    'COVER',
    'INDEX',
    'EDITORIAL'
);


ALTER TYPE public.type_file OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 143 (class 1259 OID 17175)
-- Dependencies: 6
-- Name: admins; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE admins (
    id integer NOT NULL,
    user_id integer
);


ALTER TABLE public.admins OWNER TO postgres;

--
-- TOC entry 142 (class 1259 OID 17173)
-- Dependencies: 6 143
-- Name: admins_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE admins_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.admins_id_seq OWNER TO postgres;

--
-- TOC entry 2074 (class 0 OID 0)
-- Dependencies: 142
-- Name: admins_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE admins_id_seq OWNED BY admins.id;


--
-- TOC entry 2075 (class 0 OID 0)
-- Dependencies: 142
-- Name: admins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('admins_id_seq', 1, false);


--
-- TOC entry 145 (class 1259 OID 17181)
-- Dependencies: 6
-- Name: authors; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authors (
    id integer NOT NULL,
    user_id integer
);


ALTER TABLE public.authors OWNER TO postgres;

--
-- TOC entry 144 (class 1259 OID 17179)
-- Dependencies: 145 6
-- Name: authors_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE authors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.authors_id_seq OWNER TO postgres;

--
-- TOC entry 2076 (class 0 OID 0)
-- Dependencies: 144
-- Name: authors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE authors_id_seq OWNED BY authors.id;


--
-- TOC entry 2077 (class 0 OID 0)
-- Dependencies: 144
-- Name: authors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authors_id_seq', 1, false);


--
-- TOC entry 147 (class 1259 OID 17187)
-- Dependencies: 6
-- Name: editors; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE editors (
    id integer NOT NULL,
    user_id integer
);


ALTER TABLE public.editors OWNER TO postgres;

--
-- TOC entry 146 (class 1259 OID 17185)
-- Dependencies: 147 6
-- Name: editors_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE editors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.editors_id_seq OWNER TO postgres;

--
-- TOC entry 2078 (class 0 OID 0)
-- Dependencies: 146
-- Name: editors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE editors_id_seq OWNED BY editors.id;


--
-- TOC entry 2079 (class 0 OID 0)
-- Dependencies: 146
-- Name: editors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('editors_id_seq', 1, false);


--
-- TOC entry 149 (class 1259 OID 17193)
-- Dependencies: 6
-- Name: evaluators; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE evaluators (
    id integer NOT NULL,
    user_id integer
);


ALTER TABLE public.evaluators OWNER TO postgres;

--
-- TOC entry 148 (class 1259 OID 17191)
-- Dependencies: 149 6
-- Name: evaluators_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE evaluators_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.evaluators_id_seq OWNER TO postgres;

--
-- TOC entry 2080 (class 0 OID 0)
-- Dependencies: 148
-- Name: evaluators_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE evaluators_id_seq OWNED BY evaluators.id;


--
-- TOC entry 2081 (class 0 OID 0)
-- Dependencies: 148
-- Name: evaluators_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evaluators_id_seq', 1, false);


--
-- TOC entry 151 (class 1259 OID 17199)
-- Dependencies: 1929 1930 1931 6
-- Name: logbooks; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE logbooks (
    id integer NOT NULL,
    user_id integer,
    description character varying(255) DEFAULT NULL::character varying,
    created timestamp without time zone,
    ip character varying(45) DEFAULT NULL::character varying,
    type character varying(20) DEFAULT NULL::character varying
);


ALTER TABLE public.logbooks OWNER TO postgres;

--
-- TOC entry 150 (class 1259 OID 17197)
-- Dependencies: 151 6
-- Name: logbooks_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE logbooks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.logbooks_id_seq OWNER TO postgres;

--
-- TOC entry 2082 (class 0 OID 0)
-- Dependencies: 150
-- Name: logbooks_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE logbooks_id_seq OWNED BY logbooks.id;


--
-- TOC entry 2083 (class 0 OID 0)
-- Dependencies: 150
-- Name: logbooks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('logbooks_id_seq', 3, true);


--
-- TOC entry 153 (class 1259 OID 17208)
-- Dependencies: 6
-- Name: magazine_editors; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE magazine_editors (
    id integer NOT NULL,
    magazine_id integer,
    editor_id integer,
    publish_date timestamp without time zone
);


ALTER TABLE public.magazine_editors OWNER TO postgres;

--
-- TOC entry 152 (class 1259 OID 17206)
-- Dependencies: 153 6
-- Name: magazine_editors_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE magazine_editors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.magazine_editors_id_seq OWNER TO postgres;

--
-- TOC entry 2084 (class 0 OID 0)
-- Dependencies: 152
-- Name: magazine_editors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE magazine_editors_id_seq OWNED BY magazine_editors.id;


--
-- TOC entry 2085 (class 0 OID 0)
-- Dependencies: 152
-- Name: magazine_editors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('magazine_editors_id_seq', 1, false);


--
-- TOC entry 155 (class 1259 OID 17214)
-- Dependencies: 1934 1935 1936 1937 494 6
-- Name: magazine_files; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE magazine_files (
    id integer NOT NULL,
    magazine_id integer,
    file text,
    name character varying(50) DEFAULT NULL::character varying,
    type type_file,
    title character varying(255) DEFAULT NULL::character varying,
    edition character varying(255) DEFAULT NULL::character varying,
    color character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE public.magazine_files OWNER TO postgres;

--
-- TOC entry 154 (class 1259 OID 17212)
-- Dependencies: 6 155
-- Name: magazine_files_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE magazine_files_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.magazine_files_id_seq OWNER TO postgres;

--
-- TOC entry 2086 (class 0 OID 0)
-- Dependencies: 154
-- Name: magazine_files_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE magazine_files_id_seq OWNED BY magazine_files.id;


--
-- TOC entry 2087 (class 0 OID 0)
-- Dependencies: 154
-- Name: magazine_files_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('magazine_files_id_seq', 1, false);


--
-- TOC entry 157 (class 1259 OID 17227)
-- Dependencies: 6
-- Name: magazine_papers; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE magazine_papers (
    id integer NOT NULL,
    magazine_id integer,
    paper_id integer,
    "order" integer
);


ALTER TABLE public.magazine_papers OWNER TO postgres;

--
-- TOC entry 156 (class 1259 OID 17225)
-- Dependencies: 6 157
-- Name: magazine_papers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE magazine_papers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.magazine_papers_id_seq OWNER TO postgres;

--
-- TOC entry 2088 (class 0 OID 0)
-- Dependencies: 156
-- Name: magazine_papers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE magazine_papers_id_seq OWNED BY magazine_papers.id;


--
-- TOC entry 2089 (class 0 OID 0)
-- Dependencies: 156
-- Name: magazine_papers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('magazine_papers_id_seq', 1, false);


--
-- TOC entry 159 (class 1259 OID 17233)
-- Dependencies: 1940 1941 1942 485 6
-- Name: magazines; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE magazines (
    id integer NOT NULL,
    name character varying(50) DEFAULT NULL::character varying,
    created timestamp without time zone,
    modified timestamp without time zone,
    title character varying(255) DEFAULT NULL::character varying,
    exemplary integer,
    status status_list DEFAULT 'ONCONSTRUCTION'::status_list NOT NULL
);


ALTER TABLE public.magazines OWNER TO postgres;

--
-- TOC entry 158 (class 1259 OID 17231)
-- Dependencies: 159 6
-- Name: magazines_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE magazines_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.magazines_id_seq OWNER TO postgres;

--
-- TOC entry 2090 (class 0 OID 0)
-- Dependencies: 158
-- Name: magazines_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE magazines_id_seq OWNED BY magazines.id;


--
-- TOC entry 2091 (class 0 OID 0)
-- Dependencies: 158
-- Name: magazines_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('magazines_id_seq', 1, false);


--
-- TOC entry 161 (class 1259 OID 17242)
-- Dependencies: 1944 6
-- Name: mapped_messages; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mapped_messages (
    id integer NOT NULL,
    message_id integer,
    user_id integer,
    is_read character varying(20) DEFAULT NULL::character varying
);


ALTER TABLE public.mapped_messages OWNER TO postgres;

--
-- TOC entry 160 (class 1259 OID 17240)
-- Dependencies: 6 161
-- Name: mapped_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mapped_messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.mapped_messages_id_seq OWNER TO postgres;

--
-- TOC entry 2092 (class 0 OID 0)
-- Dependencies: 160
-- Name: mapped_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mapped_messages_id_seq OWNED BY mapped_messages.id;


--
-- TOC entry 2093 (class 0 OID 0)
-- Dependencies: 160
-- Name: mapped_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mapped_messages_id_seq', 1, false);


--
-- TOC entry 163 (class 1259 OID 17249)
-- Dependencies: 1946 1947 1948 6
-- Name: messages; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE messages (
    id integer NOT NULL,
    content character varying(255) DEFAULT NULL::character varying,
    body character varying(255) DEFAULT NULL::character varying,
    type character varying(20) DEFAULT NULL::character varying,
    sender integer
);


ALTER TABLE public.messages OWNER TO postgres;

--
-- TOC entry 162 (class 1259 OID 17247)
-- Dependencies: 6 163
-- Name: messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.messages_id_seq OWNER TO postgres;

--
-- TOC entry 2094 (class 0 OID 0)
-- Dependencies: 162
-- Name: messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE messages_id_seq OWNED BY messages.id;


--
-- TOC entry 2095 (class 0 OID 0)
-- Dependencies: 162
-- Name: messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('messages_id_seq', 1, false);


--
-- TOC entry 165 (class 1259 OID 17261)
-- Dependencies: 1950 1951 1952 1953 1954 1955 1956 1957 6
-- Name: news; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE news (
    id integer NOT NULL,
    headline character varying(255) DEFAULT NULL::character varying,
    summary character varying(512) DEFAULT NULL::character varying,
    content text,
    created timestamp without time zone,
    updated timestamp without time zone,
    photo_url character varying(255) DEFAULT NULL::character varying,
    more_info_url character varying(255) DEFAULT NULL::character varying,
    video_url character varying(255) DEFAULT NULL::character varying,
    author character varying(50) DEFAULT NULL::character varying,
    "order" character varying(20) DEFAULT NULL::character varying,
    status character varying(20) DEFAULT NULL::character varying
);


ALTER TABLE public.news OWNER TO postgres;

--
-- TOC entry 164 (class 1259 OID 17259)
-- Dependencies: 6 165
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE news_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.news_id_seq OWNER TO postgres;

--
-- TOC entry 2096 (class 0 OID 0)
-- Dependencies: 164
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE news_id_seq OWNED BY news.id;


--
-- TOC entry 2097 (class 0 OID 0)
-- Dependencies: 164
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('news_id_seq', 2, true);


--
-- TOC entry 167 (class 1259 OID 17278)
-- Dependencies: 6
-- Name: paper_authors; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE paper_authors (
    id integer NOT NULL,
    paper_id integer,
    author_id integer
);


ALTER TABLE public.paper_authors OWNER TO postgres;

--
-- TOC entry 166 (class 1259 OID 17276)
-- Dependencies: 167 6
-- Name: paper_authors_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE paper_authors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.paper_authors_id_seq OWNER TO postgres;

--
-- TOC entry 2098 (class 0 OID 0)
-- Dependencies: 166
-- Name: paper_authors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE paper_authors_id_seq OWNED BY paper_authors.id;


--
-- TOC entry 2099 (class 0 OID 0)
-- Dependencies: 166
-- Name: paper_authors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('paper_authors_id_seq', 1, false);


--
-- TOC entry 169 (class 1259 OID 17284)
-- Dependencies: 1960 6
-- Name: paper_comments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE paper_comments (
    id integer NOT NULL,
    paper_id integer,
    evaluator_id integer,
    comment character varying(255) DEFAULT NULL::character varying,
    created timestamp without time zone
);


ALTER TABLE public.paper_comments OWNER TO postgres;

--
-- TOC entry 168 (class 1259 OID 17282)
-- Dependencies: 6 169
-- Name: paper_comments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE paper_comments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.paper_comments_id_seq OWNER TO postgres;

--
-- TOC entry 2100 (class 0 OID 0)
-- Dependencies: 168
-- Name: paper_comments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE paper_comments_id_seq OWNED BY paper_comments.id;


--
-- TOC entry 2101 (class 0 OID 0)
-- Dependencies: 168
-- Name: paper_comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('paper_comments_id_seq', 1, false);


--
-- TOC entry 171 (class 1259 OID 17291)
-- Dependencies: 1962 6
-- Name: paper_editors; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE paper_editors (
    id integer NOT NULL,
    paper_id integer,
    editor_id integer,
    comments character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.paper_editors OWNER TO postgres;

--
-- TOC entry 170 (class 1259 OID 17289)
-- Dependencies: 171 6
-- Name: paper_editors_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE paper_editors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.paper_editors_id_seq OWNER TO postgres;

--
-- TOC entry 2102 (class 0 OID 0)
-- Dependencies: 170
-- Name: paper_editors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE paper_editors_id_seq OWNED BY paper_editors.id;


--
-- TOC entry 2103 (class 0 OID 0)
-- Dependencies: 170
-- Name: paper_editors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('paper_editors_id_seq', 1, false);


--
-- TOC entry 173 (class 1259 OID 17298)
-- Dependencies: 1964 491 6 586
-- Name: paper_evaluators; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE paper_evaluators (
    id integer NOT NULL,
    paper_id integer,
    evaluator_id integer,
    comment text,
    type type_evaluator,
    status status_paper_evaluators DEFAULT 'ASIGNED'::status_paper_evaluators NOT NULL
);


ALTER TABLE public.paper_evaluators OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 17296)
-- Dependencies: 173 6
-- Name: paper_evaluators_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE paper_evaluators_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.paper_evaluators_id_seq OWNER TO postgres;

--
-- TOC entry 2104 (class 0 OID 0)
-- Dependencies: 172
-- Name: paper_evaluators_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE paper_evaluators_id_seq OWNED BY paper_evaluators.id;


--
-- TOC entry 2105 (class 0 OID 0)
-- Dependencies: 172
-- Name: paper_evaluators_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('paper_evaluators_id_seq', 3, true);


--
-- TOC entry 175 (class 1259 OID 17308)
-- Dependencies: 1966 1967 1968 6
-- Name: paper_files; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE paper_files (
    id integer NOT NULL,
    paper_id integer,
    raw text,
    name character varying(255) DEFAULT NULL::character varying,
    type character varying(20) DEFAULT NULL::character varying,
    url character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.paper_files OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 17306)
-- Dependencies: 6 175
-- Name: paper_files_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE paper_files_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.paper_files_id_seq OWNER TO postgres;

--
-- TOC entry 2106 (class 0 OID 0)
-- Dependencies: 174
-- Name: paper_files_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE paper_files_id_seq OWNED BY paper_files.id;


--
-- TOC entry 2107 (class 0 OID 0)
-- Dependencies: 174
-- Name: paper_files_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('paper_files_id_seq', 1, false);


--
-- TOC entry 177 (class 1259 OID 17320)
-- Dependencies: 1970 1971 482 488 6
-- Name: papers; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE papers (
    id integer NOT NULL,
    name character varying(50) DEFAULT NULL::character varying,
    created timestamp without time zone,
    modified timestamp without time zone,
    evaluation_type evaluation_type_list,
    status status_papers DEFAULT 'UNSENT'::status_papers NOT NULL
);


ALTER TABLE public.papers OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 17318)
-- Dependencies: 177 6
-- Name: papers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE papers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.papers_id_seq OWNER TO postgres;

--
-- TOC entry 2108 (class 0 OID 0)
-- Dependencies: 176
-- Name: papers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE papers_id_seq OWNED BY papers.id;


--
-- TOC entry 2109 (class 0 OID 0)
-- Dependencies: 176
-- Name: papers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('papers_id_seq', 1, false);


--
-- TOC entry 179 (class 1259 OID 17328)
-- Dependencies: 1973 1974 6
-- Name: reader_comments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE reader_comments (
    id integer NOT NULL,
    magazine_id integer,
    reader_id integer,
    comment character varying(255) DEFAULT NULL::character varying,
    created timestamp without time zone,
    status character varying(20) DEFAULT NULL::character varying
);


ALTER TABLE public.reader_comments OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 17326)
-- Dependencies: 179 6
-- Name: reader_comments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE reader_comments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reader_comments_id_seq OWNER TO postgres;

--
-- TOC entry 2110 (class 0 OID 0)
-- Dependencies: 178
-- Name: reader_comments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE reader_comments_id_seq OWNED BY reader_comments.id;


--
-- TOC entry 2111 (class 0 OID 0)
-- Dependencies: 178
-- Name: reader_comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('reader_comments_id_seq', 1, false);


--
-- TOC entry 181 (class 1259 OID 17336)
-- Dependencies: 6
-- Name: readers; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE readers (
    id integer NOT NULL,
    user_id integer
);


ALTER TABLE public.readers OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 17334)
-- Dependencies: 6 181
-- Name: readers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE readers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.readers_id_seq OWNER TO postgres;

--
-- TOC entry 2112 (class 0 OID 0)
-- Dependencies: 180
-- Name: readers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE readers_id_seq OWNED BY readers.id;


--
-- TOC entry 2113 (class 0 OID 0)
-- Dependencies: 180
-- Name: readers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('readers_id_seq', 1, false);


--
-- TOC entry 183 (class 1259 OID 17342)
-- Dependencies: 1977 1978 1979 1980 6
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(50) NOT NULL,
    role character varying(20) DEFAULT NULL::character varying,
    created timestamp without time zone,
    modified timestamp without time zone,
    last_login timestamp without time zone,
    first_name character varying(50) DEFAULT NULL::character varying,
    last_name character varying(50) DEFAULT NULL::character varying,
    tokenhash character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 17340)
-- Dependencies: 6 183
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 2114 (class 0 OID 0)
-- Dependencies: 182
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- TOC entry 2115 (class 0 OID 0)
-- Dependencies: 182
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 1, false);


--
-- TOC entry 1924 (class 2604 OID 17178)
-- Dependencies: 142 143 143
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY admins ALTER COLUMN id SET DEFAULT nextval('admins_id_seq'::regclass);


--
-- TOC entry 1925 (class 2604 OID 17184)
-- Dependencies: 144 145 145
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authors ALTER COLUMN id SET DEFAULT nextval('authors_id_seq'::regclass);


--
-- TOC entry 1926 (class 2604 OID 17190)
-- Dependencies: 146 147 147
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY editors ALTER COLUMN id SET DEFAULT nextval('editors_id_seq'::regclass);


--
-- TOC entry 1927 (class 2604 OID 17196)
-- Dependencies: 149 148 149
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluators ALTER COLUMN id SET DEFAULT nextval('evaluators_id_seq'::regclass);


--
-- TOC entry 1928 (class 2604 OID 17202)
-- Dependencies: 150 151 151
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY logbooks ALTER COLUMN id SET DEFAULT nextval('logbooks_id_seq'::regclass);


--
-- TOC entry 1932 (class 2604 OID 17211)
-- Dependencies: 153 152 153
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY magazine_editors ALTER COLUMN id SET DEFAULT nextval('magazine_editors_id_seq'::regclass);


--
-- TOC entry 1933 (class 2604 OID 17217)
-- Dependencies: 154 155 155
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY magazine_files ALTER COLUMN id SET DEFAULT nextval('magazine_files_id_seq'::regclass);


--
-- TOC entry 1938 (class 2604 OID 17230)
-- Dependencies: 157 156 157
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY magazine_papers ALTER COLUMN id SET DEFAULT nextval('magazine_papers_id_seq'::regclass);


--
-- TOC entry 1939 (class 2604 OID 17236)
-- Dependencies: 159 158 159
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY magazines ALTER COLUMN id SET DEFAULT nextval('magazines_id_seq'::regclass);


--
-- TOC entry 1943 (class 2604 OID 17245)
-- Dependencies: 160 161 161
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mapped_messages ALTER COLUMN id SET DEFAULT nextval('mapped_messages_id_seq'::regclass);


--
-- TOC entry 1945 (class 2604 OID 17252)
-- Dependencies: 162 163 163
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY messages ALTER COLUMN id SET DEFAULT nextval('messages_id_seq'::regclass);


--
-- TOC entry 1949 (class 2604 OID 17264)
-- Dependencies: 165 164 165
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY news ALTER COLUMN id SET DEFAULT nextval('news_id_seq'::regclass);


--
-- TOC entry 1958 (class 2604 OID 17281)
-- Dependencies: 167 166 167
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_authors ALTER COLUMN id SET DEFAULT nextval('paper_authors_id_seq'::regclass);


--
-- TOC entry 1959 (class 2604 OID 17287)
-- Dependencies: 169 168 169
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_comments ALTER COLUMN id SET DEFAULT nextval('paper_comments_id_seq'::regclass);


--
-- TOC entry 1961 (class 2604 OID 17294)
-- Dependencies: 170 171 171
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_editors ALTER COLUMN id SET DEFAULT nextval('paper_editors_id_seq'::regclass);


--
-- TOC entry 1963 (class 2604 OID 17301)
-- Dependencies: 173 172 173
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_evaluators ALTER COLUMN id SET DEFAULT nextval('paper_evaluators_id_seq'::regclass);


--
-- TOC entry 1965 (class 2604 OID 17311)
-- Dependencies: 174 175 175
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_files ALTER COLUMN id SET DEFAULT nextval('paper_files_id_seq'::regclass);


--
-- TOC entry 1969 (class 2604 OID 17323)
-- Dependencies: 176 177 177
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY papers ALTER COLUMN id SET DEFAULT nextval('papers_id_seq'::regclass);


--
-- TOC entry 1972 (class 2604 OID 17331)
-- Dependencies: 178 179 179
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reader_comments ALTER COLUMN id SET DEFAULT nextval('reader_comments_id_seq'::regclass);


--
-- TOC entry 1975 (class 2604 OID 17339)
-- Dependencies: 180 181 181
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY readers ALTER COLUMN id SET DEFAULT nextval('readers_id_seq'::regclass);


--
-- TOC entry 1976 (class 2604 OID 17345)
-- Dependencies: 183 182 183
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- TOC entry 2048 (class 0 OID 17175)
-- Dependencies: 143
-- Data for Name: admins; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY admins (id, user_id) FROM stdin;
1	1
\.


--
-- TOC entry 2049 (class 0 OID 17181)
-- Dependencies: 145
-- Data for Name: authors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authors (id, user_id) FROM stdin;
1	2
\.


--
-- TOC entry 2050 (class 0 OID 17187)
-- Dependencies: 147
-- Data for Name: editors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY editors (id, user_id) FROM stdin;
\.


--
-- TOC entry 2051 (class 0 OID 17193)
-- Dependencies: 149
-- Data for Name: evaluators; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY evaluators (id, user_id) FROM stdin;
1	4
\.


--
-- TOC entry 2052 (class 0 OID 17199)
-- Dependencies: 151
-- Data for Name: logbooks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY logbooks (id, user_id, description, created, ip, type) FROM stdin;
3	4	Se ha asiginado el articulo Artículo para revista 1 para evaluar</strong>.	2014-10-27 22:00:39	127.0.0.1	NOTIFICATION
2	3	Se ha creado la noticia <strong>asdasd</strong>.	2014-10-27 19:27:04	127.0.0.1	NOTIFICATION
\.


--
-- TOC entry 2053 (class 0 OID 17208)
-- Dependencies: 153
-- Data for Name: magazine_editors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY magazine_editors (id, magazine_id, editor_id, publish_date) FROM stdin;
\.


--
-- TOC entry 2054 (class 0 OID 17214)
-- Dependencies: 155
-- Data for Name: magazine_files; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY magazine_files (id, magazine_id, file, name, type, title, edition, color) FROM stdin;
\.


--
-- TOC entry 2055 (class 0 OID 17227)
-- Dependencies: 157
-- Data for Name: magazine_papers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY magazine_papers (id, magazine_id, paper_id, "order") FROM stdin;
1	1	11	1
2	1	12	2
3	1	13	3
4	1	10	4
\.


--
-- TOC entry 2056 (class 0 OID 17233)
-- Dependencies: 159
-- Data for Name: magazines; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY magazines (id, name, created, modified, title, exemplary, status) FROM stdin;
1	Mag Agosto	2013-08-03 00:00:00	2013-08-03 00:00:00	AugustMag	1	ONCONSTRUCTION
2	Mag Julio	2013-08-03 00:00:00	2013-08-03 00:00:00	Mag Julio	1234	ARCHIVED
3	hola	2013-09-04 18:07:36	2013-09-04 18:07:36	hola	\N	ARCHIVED
\.


--
-- TOC entry 2057 (class 0 OID 17242)
-- Dependencies: 161
-- Data for Name: mapped_messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mapped_messages (id, message_id, user_id, is_read) FROM stdin;
\.


--
-- TOC entry 2058 (class 0 OID 17249)
-- Dependencies: 163
-- Data for Name: messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY messages (id, content, body, type, sender) FROM stdin;
\.


--
-- TOC entry 2059 (class 0 OID 17261)
-- Dependencies: 165
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY news (id, headline, summary, content, created, updated, photo_url, more_info_url, video_url, author, "order", status) FROM stdin;
1	asdasd	asda	\t\t\t\t\t\t\t<h1>Contenido de la Noticia</h1><br><br><br>\t\t\t\t\t\t	2014-10-27 19:25:41	2014-10-27 19:25:41	\N	\N	\N	3	\N	NEWS
2	asdasd	asda	\t\t\t\t\t\t\t<h1>Contenido de la Noticia</h1><br><br><br>\t\t\t\t\t\t	2014-10-27 19:27:04	2014-10-27 19:27:04	\N	\N	\N	3	\N	NEWS
\.


--
-- TOC entry 2060 (class 0 OID 17278)
-- Dependencies: 167
-- Data for Name: paper_authors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paper_authors (id, paper_id, author_id) FROM stdin;
7	10	1
8	11	1
9	12	1
10	13	1
11	14	1
\.


--
-- TOC entry 2061 (class 0 OID 17284)
-- Dependencies: 169
-- Data for Name: paper_comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paper_comments (id, paper_id, evaluator_id, comment, created) FROM stdin;
\.


--
-- TOC entry 2062 (class 0 OID 17291)
-- Dependencies: 171
-- Data for Name: paper_editors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paper_editors (id, paper_id, editor_id, comments) FROM stdin;
\.


--
-- TOC entry 2063 (class 0 OID 17298)
-- Dependencies: 173
-- Data for Name: paper_evaluators; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paper_evaluators (id, paper_id, evaluator_id, comment, type, status) FROM stdin;
3	11	1	\N	PRINCIPAL	ASIGNED
\.


--
-- TOC entry 2064 (class 0 OID 17308)
-- Dependencies: 175
-- Data for Name: paper_files; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paper_files (id, paper_id, raw, name, type, url) FROM stdin;
15	10	<h1>ARTICULO PARA PROBAR</h1><p><span style="color: rgb(119, 119, 119); font-style: italic; line-height: 1.45em; -webkit-text-stroke-color: transparent;"><p><span style="line-height: 1.45em; font-style: normal; -webkit-text-stroke-color: transparent;"><br></span><span style="line-height: 1.45em; font-style: normal; -webkit-text-stroke-color: transparent;">hiasfhasfhasdf</span></p><p><span style="line-height: 1.45em; font-style: normal; -webkit-text-stroke-color: transparent;">&nbsp;</span><img src="../files/eab726448e0b03cfdb2fc6c4352aa2bd.jpg" style="cursor: nw-resize;"></p></span></p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ornare augue quis libero condimentum facilisis sit amet at enim. Ut auctor vel dui vitae ultricies. Mauris id sapien a nulla cursus scelerisque sit amet eget lectus. Mauris rhoncus quam vel dapibus tincidunt. Pellentesque molestie semper nulla, non luctus metus venenatis ut. Donec at quam eget enim facilisis commodo vitae id tortor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sed vulputate justo, non condimentum tortor. Duis viverra facilisis posuere. Nam tristique venenatis varius. Aliquam dapibus suscipit felis.</p><p>Nulla bibendum est eros, egestas placerat ante adipiscing ac. Nunc sit amet libero id neque lobortis fringilla. Maecenas venenatis eget risus non luctus. Quisque erat ipsum, pharetra consequat feugiat nec, eleifend mollis diam. Donec cursus, sem sit amet imperdiet euismod, mi erat sollicitudin ligula, eget cursus tellus massa non ligula. Proin cursus commodo imperdiet. Nullam blandit ultrices aliquet. Donec varius cursus interdum.</p><p>Vivamus dui sapien, bibendum et erat lacinia, vestibulum pellentesque dui. Fusce sed rutrum tortor. Integer venenatis tortor et metus adipiscing hendrerit. Maecenas accumsan ullamcorper tellus eu feugiat. Aenean ornare mattis erat, sit amet lobortis felis sagittis eu. Quisque nisi nisi, ornare ac pellentesque ut, pretium ac tellus. Aenean at nulla pellentesque, lobortis dolor in, laoreet est. Pellentesque malesuada congue sapien, nec gravida risus porta nec. Vestibulum scelerisque commodo nunc eu feugiat. Curabitur sit amet erat neque.</p><p>Aliquam velit turpis, lacinia quis magna nec, laoreet imperdiet elit. Ut sollicitudin tempor diam, ac tempus mauris commodo vel. Vivamus in vehicula augue. Sed condimentum tortor sit amet libero consequat, ac tincidunt orci vulputate. Morbi euismod risus in vestibulum eleifend. Aenean tellus nibh, lobortis id varius ut, dictum ac risus. Vivamus consectetur at risus volutpat molestie. Fusce porttitor dui tempus ligula mollis, ut ornare libero pulvinar. Nunc pellentesque arcu justo, ut tempus dui sagittis eleifend. Duis adipiscing turpis tellus, nec varius lacus feugiat nec. Praesent nec pretium sapien. Nam leo eros, tincidunt id laoreet a, ultrices id est. Fusce ornare, sapien sit amet convallis aliquet, augue odio fringilla quam, in pulvinar nunc ante ut lorem. Aliquam vel justo non dolor aliquet convallis. Nulla eu sollicitudin est.</p><p>Phasellus sit amet mi vestibulum, viverra mauris faucibus, hendrerit nisl. Nunc lacus ipsum, ultricies et est ac, egestas ultricies erat. Morbi sit amet nulla a risus semper pharetra et quis dui. Vestibulum dignissim lectus et massa auctor ullamcorper. Duis sagittis porta faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultricies urna non tellus cursus tincidunt. Fusce augue sapien, tincidunt eget mi vitae, mollis porta quam. Quisque eu interdum orci. Donec gravida posuere ligula eu tincidunt. Cras ac odio augue. Vivamus pretium tempor consequat. Mauris scelerisque dictum leo a posuere. Aenean sit amet porttitor metus. Mauris et nisl nec odio varius laoreet ac id odio. Nam dictum, lacus a pulvinar adipiscing, lacus elit dictum erat, et porta felis felis eget ipsum.</p><br><p></p>\r\n	articulo 1	text/html	DB
16	11	<h1>Artículo 1</h1><div><br></div><div>Prueba para la revista.</div><div><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis nisl ut congue accumsan. Cras ac imperdiet ante. Nullam fringilla varius rutrum. Etiam non tincidunt turpis. Integer quis eros vel lacus suscipit blandit. Mauris eu pharetra nunc. Ut pharetra diam tortor, at posuere quam posuere a. Vestibulum tristique congue est, sit amet elementum ligula adipiscing lacinia. Aenean mattis elementum magna, ac malesuada dui dapibus eu.</p><p>Nullam rhoncus, nisl non pretium congue, sapien turpis consectetur enim, sed congue est felis ut mauris. Cras at tortor a enim blandit vehicula. Aliquam commodo sed lectus in dignissim. Morbi at tellus consectetur, fermentum sem at, suscipit erat. Maecenas ante nunc, convallis id turpis sit amet, dictum posuere nisl. Aenean odio massa, iaculis et pellentesque vel, convallis placerat est. Etiam aliquet eget elit vel tempor. Quisque ut turpis adipiscing, consequat velit at, convallis ante. Donec vulputate augue nulla, elementum bibendum metus rhoncus non. Nullam pretium dignissim nisl vitae bibendum. Phasellus nec consectetur tortor, ut gravida dui.</p><p>Duis a arcu a purus convallis sollicitudin ut eget lectus. Nulla urna sapien, elementum eget eleifend non, suscipit ut erat. Phasellus sit amet lobortis mi. Nullam consequat, leo eget condimentum gravida, elit dolor facilisis diam, ac placerat orci quam et lorem. Maecenas eget est ultricies, rhoncus metus placerat, feugiat justo. Integer eget tortor eu augue egestas scelerisque. Integer nec augue eget sapien congue convallis. Integer eu mi non est feugiat eleifend. Nullam semper lacinia eros vitae suscipit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse in mattis arcu, eu vestibulum eros. Proin volutpat et nunc non bibendum. Nunc placerat turpis felis. Etiam euismod ligula vitae dui ornare fringilla. Duis vel neque feugiat, mollis nulla ut, interdum risus.</p><p>Sed pulvinar, orci venenatis interdum facilisis, nulla risus venenatis nibh, a sagittis felis nisl sit amet diam. Duis lacus sapien, volutpat ac ligula eu, ornare laoreet quam. Suspendisse orci libero, convallis nec leo at, lacinia blandit turpis. Aliquam dictum eget dui et tincidunt. Sed aliquam velit ut purus aliquam, in sagittis dui feugiat. Aenean dictum, arcu eget tincidunt pretium, risus diam interdum odio, vel pharetra diam purus imperdiet enim. Donec sed magna sit amet lacus consequat vehicula. Fusce dignissim ante et sem adipiscing porttitor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi vitae nibh eget magna euismod dignissim id in lacus. Donec dictum eleifend risus, ac molestie dui laoreet quis. Morbi vitae nisi ut sem hendrerit congue a ac tellus. Nullam ipsum justo, facilisis eu massa non, placerat auctor nulla. Donec eu porttitor sem.</p><p>Nulla posuere ipsum quis aliquet imperdiet. Curabitur a fermentum sapien. Donec est urna, tincidunt id venenatis non, posuere non lacus. Fusce vel ante id nunc accumsan vehicula. Sed elementum nisi sit amet nibh tincidunt aliquam. Suspendisse id luctus lectus, sed consequat lorem. Mauris eu dignissim neque, vel pellentesque massa. Donec in lacus placerat, ultrices purus vel, pellentesque nisl. Suspendisse adipiscing semper urna quis iaculis. Donec laoreet sit amet lectus at varius. Ut aliquet lorem lobortis porttitor fringilla. Quisque pretium urna in est pretium, vel hendrerit arcu dapibus. Fusce auctor lacus at accumsan mattis. Aliquam elementum gravida dapibus. Cras egestas viverra nulla blandit dictum. Aliquam ut leo adipiscing lacus dapibus faucibus ac a libero.</p><p>Mauris condimentum nisl non lacus eleifend mollis. Cras nec dolor tincidunt, ornare metus et, tincidunt eros. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris faucibus tortor sit amet quam tempor, at luctus sem vehicula. Mauris vestibulum mi lorem, a convallis purus hendrerit a. Fusce congue ipsum et diam ultrices, at interdum sem viverra. Vivamus pretium, purus ut sollicitudin ultrices, mauris sapien laoreet erat, nec semper enim tortor ut lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque in placerat lectus.</p><p>Aliquam ac libero sit amet massa pharetra suscipit non a sapien. Mauris luctus purus vitae aliquet lobortis. Duis malesuada sit amet diam sit amet congue. Nunc volutpat arcu sed felis pellentesque, sit amet hendrerit justo egestas. Nullam sem dolor, lacinia eget arcu vehicula, tristique lacinia neque. Suspendisse vitae vulputate mi. Maecenas urna odio, rhoncus et venenatis quis, porta quis mi. In hac habitasse platea dictumst. Mauris malesuada neque in iaculis porttitor. Nulla malesuada fermentum eleifend. Mauris odio ante, pulvinar quis convallis id, commodo eu lectus. Duis ac malesuada magna. Suspendisse potenti. Praesent vitae adipiscing purus. Sed pretium sed dui vel pulvinar.</p><p>Curabitur nec augue fringilla, vestibulum leo sit amet, dignissim velit. Etiam sit amet bibendum lorem. Sed eu vestibulum ante. Nunc in laoreet ligula. Donec vel neque a mi iaculis adipiscing a non magna. Nullam non felis enim. Fusce dapibus non augue eu sollicitudin. Nullam quis varius magna. Nulla sollicitudin eros placerat consequat luctus. Mauris consequat tempus erat, non tincidunt felis consequat et. Morbi ac adipiscing elit, ac condimentum tortor. Nam lobortis id tellus vel lobortis. Nam non arcu eu dui sollicitudin suscipit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam erat volutpat.</p><p>Phasellus eget purus vel velit lacinia laoreet. Quisque porta, mauris non euismod dictum, eros tortor pellentesque leo, id mattis ligula arcu sit amet ante. Donec in bibendum lorem. Aliquam id enim ultricies, malesuada elit vel, eleifend sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis quis dolor a sem porttitor aliquam id nec erat. Nullam eget tortor venenatis, tempor augue at, accumsan nunc. Vivamus eu erat convallis, venenatis tellus ac, adipiscing nisi. Donec dolor nisi, adipiscing ut elit in, volutpat adipiscing justo. Sed gravida elit auctor, tincidunt erat in, sagittis justo. Aliquam erat volutpat. Suspendisse sollicitudin et augue pellentesque lobortis. In a mauris adipiscing, hendrerit turpis non, posuere tortor.</p><p>Suspendisse vitae lacus quis purus interdum laoreet. Curabitur in bibendum odio. Praesent sodales orci felis, a lobortis nunc laoreet ac. Phasellus imperdiet augue ante, ultricies lobortis nisl porttitor ut. Nulla bibendum turpis egestas tincidunt luctus. Duis lobortis erat metus, et feugiat magna tristique eu. Phasellus gravida tellus sit amet ante hendrerit, eu hendrerit erat facilisis. Maecenas cursus at velit a suscipit. Praesent lacus odio, adipiscing in molestie in, pellentesque eget quam. Nam nec lectus massa. Vestibulum non tempor arcu. Morbi fringilla scelerisque euismod. Duis tempor commodo urna a pulvinar. Proin et sollicitudin neque.</p><p>Duis mauris nisi, molestie et auctor a, luctus pretium quam. Quisque at nisl turpis. Integer at felis elit. Nam consequat magna eget lorem imperdiet facilisis. Cras egestas luctus tortor, id consectetur orci consectetur eget. Curabitur tempus ut justo sed posuere. Pellentesque et enim dictum, faucibus nibh et, viverra turpis. Proin quis vulputate risus. Phasellus hendrerit enim dapibus ligula mattis auctor. Nullam cursus sit amet dui at tincidunt. Nulla ultricies leo nunc, ut viverra mauris pulvinar at. Curabitur blandit imperdiet rutrum. Vestibulum ac nulla eros.</p><p>Integer dapibus purus et tortor pellentesque, non volutpat turpis consequat. Nulla auctor ut tortor ut sagittis. Etiam quis lacus aliquam, lacinia eros ac, porttitor felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dictum lorem vel dui blandit hendrerit. Nunc cursus quis mi in ullamcorper. Quisque varius congue sollicitudin. Nulla auctor faucibus lorem, ut consequat orci dapibus et.</p><p>Pellentesque magna nibh, tempor nec arcu non, consectetur malesuada urna. Etiam sit amet pharetra diam. Sed pretium pretium ultrices. Donec mollis leo et volutpat facilisis. Mauris id odio molestie, posuere orci aliquet, vestibulum est. Integer sed justo ac eros volutpat pretium at et arcu. Integer consectetur cursus sapien. Curabitur semper viverra tellus, id sagittis urna commodo ac. Ut libero velit, malesuada in lectus ac, elementum malesuada mi. Ut at imperdiet arcu. Aliquam erat volutpat. Duis tempor tincidunt eros eget malesuada. Nullam tincidunt, elit vitae semper pretium, est tortor pharetra libero, vitae feugiat dui turpis eu purus. Morbi nec erat ultrices, aliquet lorem at, volutpat lacus. Donec non pulvinar eros. Vestibulum semper et justo quis ornare.</p><p>Morbi placerat sem non tempus pharetra. Pellentesque eros risus, tincidunt vitae velit in, tempus congue nibh. Curabitur eget lectus eget neque porta consequat et a metus. Duis sit amet ipsum in tellus semper dapibus. Phasellus facilisis ligula at nisl mattis, venenatis consectetur diam viverra. Nullam massa enim, pulvinar non mi vel, congue facilisis orci. Sed sed egestas augue, ac sagittis erat.</p><p>Morbi quis ipsum tortor. Pellentesque ut nisi mauris. Nulla eu aliquet felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tempor odio id iaculis fermentum. Curabitur placerat at elit id placerat. Nam mattis, felis ac ullamcorper euismod, ipsum mi dignissim tortor, ac blandit tellus dui et tellus. Maecenas faucibus neque ligula, posuere blandit libero ultricies non. Nam mollis tortor tempus, pulvinar diam ac, tempor mi. In hac habitasse platea dictumst. Vivamus sit amet gravida nulla. Quisque malesuada nisl tincidunt ligula egestas, suscipit ullamcorper nibh eleifend. Integer mi sapien, iaculis et mattis id, congue in neque. Aliquam condimentum in mi a adipiscing.</p><p>Mauris nibh est, dignissim et libero et, venenatis sagittis nibh. Donec quis felis tincidunt nunc venenatis malesuada porttitor eu ante. Fusce tristique viverra nunc, in ultricies ligula sodales nec. Morbi volutpat viverra ultrices. Pellentesque ut urna in nisi fermentum luctus porta non arcu. Pellentesque convallis sapien nisi, eget aliquam magna tristique a. Nunc fringilla interdum justo at ultrices. Nunc quis feugiat lorem. Morbi condimentum turpis elit, vitae consectetur metus suscipit vitae. Aenean fermentum, lorem vel facilisis rutrum, enim nunc laoreet erat, eget semper felis metus in lorem. Sed egestas semper fringilla. Praesent et dictum velit, ut mollis leo. Aliquam tempus libero eros, a accumsan lectus sagittis ac. Maecenas aliquam, sem et vulputate euismod, nunc tortor blandit massa, ac consequat elit neque nec arcu. Donec rhoncus lorem tortor, eu egestas nisl feugiat a.</p><p>Donec pharetra, libero vel eleifend rhoncus, risus augue bibendum nibh, sit amet condimentum sem libero eget neque. Phasellus ut ligula at magna pretium semper a at nulla. Ut at lorem volutpat, sagittis velit nec, fringilla ligula. Donec nisi orci, luctus in nisl id, placerat dignissim risus. Ut tincidunt tortor non ultrices condimentum. Proin porttitor massa lacus, vitae dapibus eros fringilla sed. Curabitur consectetur pharetra felis. Proin at justo felis.</p><p>Aenean egestas, leo eu convallis blandit, metus odio porttitor ipsum, ac pulvinar ipsum enim sed nisi. Aenean sodales arcu sed magna commodo, at ultricies enim ultrices. Mauris cursus magna in ipsum tempor, a pharetra augue luctus. Praesent ornare ac nisl quis fringilla. Quisque fringilla ullamcorper vulputate. Integer aliquet adipiscing sem. Phasellus tincidunt lacus et ullamcorper sollicitudin. Sed dignissim ligula ornare tellus laoreet, a mattis nisi auctor. Etiam dictum mi sit amet adipiscing blandit. Suspendisse enim dui, porta quis quam vel, placerat hendrerit mi.</p><p>Morbi ac mattis nibh. Ut sit amet libero quis mauris fermentum rutrum quis venenatis magna. Vestibulum euismod nisl a velit porta, eget luctus justo tempus. In hac habitasse platea dictumst. Nunc sagittis congue purus nec semper. In dui justo, laoreet et cursus eu, adipiscing ut purus. Vivamus elementum lorem at turpis dapibus gravida. Suspendisse porta ultrices luctus. Ut sapien nulla, rutrum ac ante nec, rhoncus convallis lorem. Proin facilisis, justo non consectetur volutpat, nulla erat dictum ligula, vel sagittis ligula justo vel nisl. Vivamus vitae sem a urna vestibulum mollis. Ut non leo elementum, sollicitudin lectus vitae, mollis nunc. Etiam condimentum mi non turpis rutrum laoreet. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam vestibulum congue congue. Aliquam tortor magna, posuere in massa nec, molestie pharetra leo.</p><p>Praesent tempor lacinia lacus, non malesuada augue pretium in. Suspendisse lacus velit, mollis at sapien at, sollicitudin pharetra odio. Etiam dui nulla, sagittis semper ante in, bibendum viverra sem. Sed iaculis semper dolor. Phasellus pretium dignissim quam in accumsan. Quisque quis suscipit libero, eu adipiscing eros. Donec venenatis consectetur varius. Nulla ut arcu sit amet turpis convallis dignissim vel vel nunc. Integer pellentesque, nisl eu volutpat imperdiet, orci sem vestibulum libero, ut rutrum ipsum dolor commodo libero. Phasellus scelerisque volutpat risus, vitae ultricies libero tempus eu. Nullam sit amet faucibus nisi. Ut cursus vehicula metus, a porta lectus vulputate et. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc a quam imperdiet, gravida neque ut, cursus quam. Mauris et mauris eu metus porttitor semper sed quis enim. Nam pharetra consectetur mollis.</p><br></div><div><br></div><p></p>\r\n	Artículo para revista 1	text/html	DB
17	12	<h1>Artículo 2</h1><div><br></div><div>Segundo articulo de prueba</div><div><br></div><div><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lacinia in felis at rutrum. Phasellus vitae sapien libero. Duis placerat tortor nec lacus luctus, a tempor augue posuere. Aliquam in placerat mi, ac consectetur nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus elit arcu, fermentum vel quam porta, elementum faucibus magna. Integer a gravida neque, eu scelerisque elit.</p><p>Praesent commodo, dui nec bibendum pellentesque, felis nunc dignissim libero, eget dictum purus nisl a massa. Quisque risus nisi, posuere ut consectetur rutrum, volutpat non dolor. Sed rhoncus vehicula odio, non auctor lorem vehicula vitae. Integer non elit eget justo sollicitudin posuere quis id diam. Aliquam erat volutpat. Curabitur et ante porttitor enim semper laoreet nec vitae leo. Maecenas porttitor commodo elit sit amet lacinia. Vestibulum semper bibendum libero, sed iaculis nisi tincidunt id. Integer risus massa, egestas eleifend ante ut, aliquam placerat ante. Integer at erat nisi. Pellentesque tristique nisl ut libero molestie, ac elementum risus lobortis.</p><p>Phasellus condimentum risus justo, id commodo nibh commodo sit amet. Mauris molestie iaculis leo quis porta. Suspendisse laoreet gravida orci ut vehicula. Praesent pellentesque, eros eget dignissim fringilla, ipsum enim ornare nisl, interdum rhoncus nibh felis eget ipsum. Pellentesque in gravida massa. Ut bibendum vehicula odio. Vivamus porttitor accumsan arcu, sit amet egestas felis varius id.</p><p>Integer et quam convallis, convallis massa eget, faucibus leo. Nunc sit amet congue sapien, nec euismod odio. Etiam metus purus, sagittis ut consectetur eget, rhoncus non urna. Donec porta sit amet nulla eu vehicula. Fusce tortor mi, dictum sit amet enim sed, aliquam sagittis tellus. Praesent rutrum tortor id blandit ullamcorper. Sed pretium, sapien a cursus mollis, risus ipsum dictum ligula, a blandit sapien nisl ultrices nisl.</p><p>Etiam purus libero, mattis sit amet tortor sit amet, molestie feugiat lorem. Duis tincidunt eget sem eget dapibus. In non leo quis libero suscipit luctus. Suspendisse vel nulla ligula. Maecenas molestie nisi vestibulum, pretium nisi quis, malesuada nisl. Vivamus eget enim egestas sem cursus hendrerit et et leo. Pellentesque at neque orci. Morbi massa nisl, fringilla non diam a, pretium facilisis neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam ornare a nisi quis pellentesque. Sed in ante egestas, molestie dui in, ornare velit. Vivamus eleifend in quam in imperdiet. Nunc lacinia nec augue tempus egestas. Etiam lacinia hendrerit dapibus. Phasellus venenatis enim et mi iaculis bibendum.</p><p>Quisque auctor imperdiet elit, eu rutrum metus adipiscing ut. Nulla fermentum consequat justo in scelerisque. Pellentesque feugiat aliquam massa nec sagittis. In eu fringilla mauris, ut iaculis urna. Vestibulum id est id quam ullamcorper gravida. Donec adipiscing consequat leo nec dignissim. Sed luctus eget odio quis feugiat. Phasellus aliquam leo sit amet felis vehicula, vitae consequat velit faucibus. Donec at sem ut justo aliquet ullamcorper sit amet quis velit. Nunc vel mauris luctus, fermentum risus vel, lacinia lectus. Proin vel accumsan quam. Fusce tempus lacus at nibh tempor faucibus. Sed erat nisi, interdum in tempor non, ornare eget leo. Suspendisse justo erat, tempor at diam in, suscipit lobortis ipsum. Suspendisse sit amet sodales arcu.</p><p>Sed metus ante, euismod sit amet lorem non, scelerisque condimentum eros. Suspendisse vitae fringilla odio. Pellentesque eget tempor lorem. Maecenas sagittis rutrum consectetur. Nullam sed lobortis nisl. Cras ut sollicitudin diam. Vivamus leo sapien, vulputate sed sollicitudin vitae, fermentum id nulla. Praesent nisi risus, luctus in neque eget, dapibus lacinia dolor. Ut pellentesque consequat sem, sit amet convallis felis vulputate id. Nullam at nisl nibh. Proin vehicula, turpis in lacinia pulvinar, nisl eros fermentum mauris, eget placerat libero justo vitae ligula. Nam ac ante enim. Aliquam vel libero vitae tortor ultrices consequat eget eu turpis. Morbi et odio in diam pulvinar accumsan euismod at lacus. Pellentesque venenatis eu magna sit amet cursus.</p><p>Cras aliquet diam urna, in pellentesque nunc hendrerit eget. Duis nec hendrerit felis. Etiam fermentum augue at adipiscing lobortis. Nullam risus magna, ultricies quis enim vel, feugiat consectetur urna. In nec risus ipsum. Morbi tempor purus sit amet lacinia blandit. Vestibulum interdum justo vitae aliquam semper. In hac habitasse platea dictumst. Pellentesque tincidunt pulvinar ligula, sed euismod orci aliquam ut. Maecenas eget mattis erat. Vivamus non faucibus justo. Maecenas quis dignissim dolor.</p><p>Nullam bibendum molestie aliquam. Praesent id fringilla justo, at posuere tortor. Aliquam erat volutpat. Etiam id fermentum turpis. Proin id facilisis libero. Donec turpis lacus, feugiat a magna luctus, tincidunt luctus arcu. Pellentesque iaculis ornare lorem, id elementum nibh venenatis ac. Etiam tortor arcu, ultricies vel nisl vitae, cursus ullamcorper arcu. Donec dignissim quam purus, eu venenatis nisi imperdiet eget. Donec gravida pharetra consectetur. Quisque sagittis euismod porta. Ut libero risus, pulvinar eu ornare vitae, malesuada vel nunc.</p><p>Proin a arcu non tortor ultricies cursus a ac ipsum. Proin turpis justo, porttitor pellentesque nisl a, imperdiet fringilla arcu. Phasellus non molestie velit. Sed vitae venenatis nunc. Maecenas at magna in elit molestie venenatis. Vivamus a semper sapien, ac gravida est. In orci metus, tristique eget velit ac, tincidunt semper massa. Morbi quis aliquam sapien. Vivamus iaculis tincidunt elit ut rhoncus. Ut sagittis ornare metus vitae bibendum.</p><p>Donec at enim erat. Mauris a massa placerat, suscipit enim et, iaculis purus. Suspendisse id ullamcorper diam. Nulla ac aliquam ipsum, id fermentum lacus. Vestibulum massa magna, molestie vitae auctor a, dictum sit amet lacus. Suspendisse quis hendrerit sapien. Donec posuere imperdiet magna sit amet tristique. Quisque lacinia rhoncus felis at laoreet. Cras ac lectus fringilla, dictum lacus quis, consectetur tortor. Sed vel laoreet urna. Nulla sapien dui, cursus aliquam vulputate sed, gravida ut tellus. Morbi vitae ante non leo ornare gravida vitae vel diam. Vivamus posuere pellentesque nibh, in commodo sem egestas eu. Praesent ut magna est. Fusce varius faucibus libero, sit amet laoreet elit tempus non. Sed iaculis bibendum erat et convallis.</p><p>Etiam massa nulla, viverra non pharetra at, lacinia sed enim. Aenean tincidunt malesuada pharetra. Integer mattis purus in velit blandit dapibus. Suspendisse in varius nunc. Duis ut elit id purus tempor placerat. Suspendisse aliquet lorem eu lacus tincidunt vestibulum. Vivamus eu purus in erat dignissim eleifend sed eu nulla. Aliquam laoreet nisl nibh, id ullamcorper quam dictum vitae.</p><p>Etiam bibendum, dolor id vulputate elementum, orci justo scelerisque dui, eu egestas ipsum tellus non lorem. Aenean dignissim eros ut rhoncus pretium. Nunc sodales turpis nisl. Donec quis enim vitae eros porta ultricies. Integer dignissim velit vitae eros hendrerit pretium. Morbi euismod quam a pretium volutpat. Ut consequat mollis dui a sagittis. Phasellus vehicula nec leo gravida suscipit. Nulla eu libero quis odio viverra rutrum eu et felis. Etiam nec fermentum mi. Nunc et diam id nunc mattis molestie vitae vitae tellus. Sed massa nisi, interdum in semper ut, tincidunt vel lorem. Maecenas a viverra leo. Morbi at est gravida, dictum sapien eu, pulvinar ante. Aenean at porttitor odio. Donec posuere varius lectus sit amet lacinia.</p><p>In volutpat ultricies luctus. Pellentesque posuere imperdiet erat sed venenatis. In quis mauris sollicitudin arcu convallis posuere. Vestibulum sed sollicitudin enim, quis ultrices augue. Sed convallis fermentum tellus, et elementum mi accumsan at. Praesent euismod molestie orci non mattis. Vivamus ullamcorper turpis eget fringilla mattis. Integer non sollicitudin nisi. Vivamus id fermentum urna. Nullam diam nunc, placerat vitae mollis at, luctus nec nisl. Donec faucibus diam tellus, a luctus neque egestas sed. Donec sit amet ligula sed felis placerat interdum.</p><p>Praesent sagittis in urna at aliquet. Phasellus hendrerit velit eget nisi imperdiet mattis. Duis rutrum tortor nec felis molestie scelerisque. Vestibulum quis odio eu justo sodales vulputate at ac tellus. Donec dapibus erat nec leo ultricies, sit amet pretium massa consectetur. Mauris varius lorem quis diam porta, id mollis augue condimentum. Mauris posuere justo ut augue interdum venenatis. Ut adipiscing ultricies elit, ut viverra velit. Ut et egestas ligula, scelerisque vulputate nibh. Aliquam sem nisl, eleifend feugiat turpis eu, ultrices lobortis neque. Maecenas sed tortor nisl.</p><p>Donec blandit suscipit scelerisque. Etiam ac faucibus est. Morbi cursus sem ac urna sagittis, vitae rhoncus turpis mollis. Sed eleifend mi nec neque accumsan rutrum. Mauris at hendrerit erat. Nam dui lorem, pharetra sit amet egestas nec, euismod quis sapien. Etiam vel commodo turpis. Praesent varius molestie tortor lacinia venenatis. Phasellus convallis, mi eget lacinia suscipit, neque dolor fringilla ligula, sit amet consectetur dui turpis sit amet ante. Nam id diam eu urna tincidunt egestas.</p><p>Nullam tempus mollis lobortis. In rhoncus turpis congue, pretium nibh ut, mollis nisi. Duis at sollicitudin risus. Integer convallis diam et tempus dignissim. Mauris et varius neque. Integer scelerisque mi at velit luctus accumsan. Etiam aliquam arcu et lacus mollis elementum. Aenean interdum lectus ligula, in placerat leo eleifend vel. Nullam malesuada consectetur risus. Duis ut ipsum non sapien varius aliquet eu vel erat.</p><p>Suspendisse sed lacinia dolor. Sed convallis lorem quis elit pulvinar, at eleifend libero aliquet. Etiam mollis ipsum felis, ut dignissim nunc pellentesque eu. Nullam tincidunt purus sagittis urna mattis volutpat. Proin lorem felis, elementum nec nibh et, varius ultricies justo. Vivamus sem odio, tincidunt eget nisi ut, rutrum fermentum lorem. Maecenas pellentesque est nec turpis pulvinar convallis. Ut quis sollicitudin risus. Proin vel magna nisi. Sed ut lacus et.</p><br></div><p></p>\r\n	Artículo para revista 2	text/html	DB
18	13	<h1></h1>\r\n\t\t\r\n\t\r\n\t\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>1. CAPÍTULO – REVISTAS DIGITALES\r\n</p>\r\n\t\t\t\t\t<p>En un principio muchos autores asumieron su propia definición en cuanto al\r\ntérmino de revista digital. Para Lancaster (1995), en el estudio de las publicaciones\r\nelectrónicas de la investigación, una revista electrónica es aquella creada para el\r\nmedio electrónico y, además solo es disponible en ese medio. Por otra parte, para\r\nCarbó y Hatada (1996) además de ser una revista en formato electrónico, también\r\nconsideran que pueden admitir elementos multimedia; y son distribuidas por\r\ninternet, con un costo menor y publicadas más rápidamente que su versión\r\nimpresa, en caso de poseerla.\r\n</p>\r\n\t\t\t\t\t<p>Partiendo de las ideas expuestas anteriormente podemos decir que una\r\nrevista digital académica es aquella publicación periódica creada mediante medios\r\nelectrónicos que comparten un conjunto de características con las revistas\r\nimpresas y disponen de una arquitectura, interacciones, funcionalidades y\r\ndistribución relacionados con la especificidad del entorno digital.\r\n</p>\r\n\t\t\t\t\t<p>Gracias a las facilidades que presentan tecnologías existentes, las revistas\r\ndigitales cuentan con un enriquecimiento en cuanto a la presentación de su\r\ncontenido y pueden tener un mayor alcance gracias a internet. Asimismo, Abadal y\r\nRius (2006) ofrecen una muestra significativa del incremento de revistas digitales\r\naño tras año, se puede recurrir a uno de los repositorios de revistas científicas más\r\nconsolidado y prestigioso a nivel mundial Ulrich’s Periodical Directory, al realizar\r\nuna consulta de este repositorio en febrero de 2013 obtenemos 216.000 revistas\r\nacadémicas activas, las cuales en su mayoría están disponibles en formato digital.\r\n</p>\r\n\t\t\t\t\t<p>Información más reciente y localizada en el área latinoamericana se puede\r\nobtener en el portal LATINDEX (2012), que es el sistema regional de información\r\nen línea para revistas científicas de América Latina, el Caribe, España y Portugal.\r\nEste sitio presenta un resumen de cifras para lo que va de año de las revistas\r\ningresadas en el año 2012 por país, la estadística se encuentra en la figura 1,\r\nmostrada a continuación.\r\n</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t\t<p>\r\n\t\t\t\t</p><div>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Figura 1 - Total de revistas por país para el 2012, LATINDEX(2012).\r\n</p>\r\n\t\t\t\t\t<p>Esta distribución por país da un total de 1074 revistas introducidas en el 2012, de\r\nesta cifra, la cantidad de revistas digitales introducidas para el 2012 es de 600,\r\nesto es un 55,86%, porcentaje que va aumentando gradualmente debido a las\r\npolíticas académicas y el alcance de las redes de información.\r\n</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t\t<p>\r\n\t\t\t\t</p><div>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>1.1. CARACTERÍSTICAS\r\n</p>\r\n\t\t\t\t\t<p>Actualmente existen infinidad de revistas digitales, estén disponibles en\r\ninternet o en papel. Pero generalmente presentan unas características básicas que\r\nlas diferencian, según CINDOC-CSIC (2004) estas son:\r\n</p>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Reducción considerable del plazo de espera para la edición. En algunos\r\ncasos, se presentan los trabajo antes de estar completamente terminados,\r\nlo que se conoce como preprints.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Facilidad de acceso. Las revistas electrónicas pueden ser consultadas\r\nindependientemente del lugar en el que se esté y de la hora a la que se\r\nquiera acceder a ellas. Como cualquier producto presente en Internet, las\r\nlimitaciones espacio-temporales son inexistentes. De igual forma, la\r\nconsulta a una revista no está limitada a un solo usuario, ya que varias\r\npersonas pueden leer el mismo artículo de forma simultánea.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Reducción de los costos de producción, adquisición, almacenamiento y\r\nconservación. Resulta difícil estimar una diferencia entre la producción de\r\nuna revista digital frente a producir una impresa.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Actualización inmediata. La característica principal de las publicaciones en\r\nserie es que periódicamente aportan nuevos contenidos. Esta circunstancia\r\nse cumple en las revistas electrónica y se mejora, ya que el usuario podrá\r\ndisponer de la información nada más que esta se publique, incluso antes,\r\nya que en ocasiones se ofrecen servicios de pre-publicación, en los que se\r\ninforma de los artículos que serán incluidos en los próximos números. La\r\nrapidez con la que las revistas electrónicas se actualizan dinamiza la\r\ninvestigación, ya que los resultados de la misma se difunden en el\r\nmomento.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Capacidad de interacción con el lector. Las revistas electrónicas suelen\r\nacompañar cada artículo con la dirección electrónica del autor, con lo cual\r\nel intercambio de impresiones entre los responsables de un texto y sus\r\nlectores pueden hacerse de forma muy sencilla e incluso discusión entre\r\nlectores.\r\n</p>\r\n\t\t\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></li></ul></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Posibilidades de la consulta. La recuperación en las revistas electrónica es\r\nmuy sencilla, ya que todas poseen un motor de búsqueda, al tiempo que\r\npermiten la consulta por números publicados. Sus buscadores suelen\r\nofrecer la posibilidad de emplear búsquedas avanzadas e incluso asistidas,\r\ncon lo que las consultas en las mismas es muy sencilla y completa.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Sistema de recuperación de artículo a texto completo rápido y fácil.\r\nHabitualmente los artículos se encuentran almacenados en una base de\r\ndatos y su acceso se realiza por medio de procedimientos de los sistemas\r\nde recuperación documentales.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Independencia de los documentos. No siempre es necesario estar suscrito\r\na una publicación electrónica para poder consultar su contenido.\r\nIntegración de redes sociales. Las revistas digitales pueden llegar a los\r\nlectores por medio de las redes sociales. Contando con información de\r\ninterés en ellas. Hoy en día, las redes sociales están dominando el mundo\r\nvirtual y esta integración sin duda alguna traerá consigo mayor interés a la\r\nhora de publicación.\r\n</p>\r\n\t\t\t\t\t\t\t<p>1.2. ELEMENTOS\r\n</p>\r\n\t\t\t\t\t\t\t<p>Los elementos de una revista pueden variar dependiendo de la tónica de la\r\nmisma, para Martin (2003) estas mantienen un mismo eje que se puede resumir\r\nen los siguientes:\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t</ul>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Titulo completo: representa el tópico tratado dentro de la revista, colocado\r\nen una frase breve que pueda contener el eje central de la revista. Para\r\nmayor identificación debería ser fácil de recordar.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Comité editorial: representa un grupo de personas especializadas\r\nencargadas en la evaluación de los artículos posibles a publicación. Que\r\ntienen la potestad de realizar cambio a través del tiempo de vida de la\r\nrevista.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Instituciones o autores publicadores: son el conjunto de instituciones o\r\nautores únicos que envían artículos para ser evaluados por el comité\r\neditorial y puedan ser publicados. Existen casos en que la revista pueden\r\ncambiar sus autores por cuestiones ajenas a la publicación.\r\n</p>\r\n\t\t\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></li></ul></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Objetivos: en esta sección se describe un objetivo general a través de los\r\nverbos respectivos y una serie de objetivos específicos que describen\r\nhacia donde se va a dirigir la temática de la revista.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Misión: definición de la gestión que viene a cumplir la revista digital.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Área de interés de la revista: descripción general y específica de las\r\náreas que abracan la publicación de contenidos, estudios e investigaciones\r\ndentro del portal de la revista.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Historia de la revista: breve reseña histórica del origen de la revista.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Periodicidad: período de tiempo con el que se publicaran tirajes, ya sea,\r\n</p>\r\n\t\t\t\t\t\t\t<p>diario, semanal, quincenal, mensual trimestral, semestral o anual.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Titulo abreviado: contribuye a recordar el nombre de la revista.\r\nGeneralmente, se utilizan las iniciales del nombre completo.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Indización: de acuerdo a la norma ISO 5963 (1985) la indización es el\r\nproceso de describir o representar el contenido temático de un recurso de\r\ninformación. Este proceso da como resultado un índice de términos de\r\nindización que será utilizado como herramienta de búsqueda y acceso al\r\ncontenido de recursos en sistemas de recuperación de información. Para un\r\nrevista es muy importante pertenecer a un servicio de indización, debido a\r\nque, le permite difundirse más allá de las instituciones u organismos que la\r\neditan. Esto permite que sean citadas y leídas en una comunidad más\r\namplia, y así alcanzar niveles de audiencia mayor.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Patrocinantes: grupo de instituciones u organizaciones que patrocinen el\r\nportal de la revista digital.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Instituciones o autores publicadores: son el conjunto de instituciones o\r\nautores únicos.\r\n</p>\r\n\t\t\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></li></ul></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>1.3. ESTRUCTURA\r\n</p>\r\n\t\t\t\t\t<p>A continuación se presenta la estructura básica de una revista digital, al\r\nigual que las partes de la revista, esta estructura puede estar sujeta a cambios\r\ndependiendo de dónde se publique. A continuación le presentaremos el enfoque\r\ngeneral creado por Martín(2003).\r\n</p>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Página principal: es la primera página que visualiza el lector. En ella, es\r\nrecomendable colocar una breve presentación, el titulo de algunos artículos\r\nque se encuentran en el número actual de la revista, el modo de\r\nvisualización de la misma, así como también, todos los hipervínculos que\r\nlleven al lector a las demás estructuras de dicha revista.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Editorial: la editorial básicamente se centra en dar la opinión personal de\r\nreconocido editorialista, quien generalmente es el director de la revista,\r\nsobre algún artículo de gran importancia ligado a la actualidad o que traiga\r\nconsecuencias en la actualidad.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Ejemplares: una sección donde se deben listar todos los ejemplares que\r\nhan sido publicados hasta la fecha actual. Generalmente, se suele observar\r\nel número del ejemplar, la fecha, el título y un resumen, con el fin de dar\r\nuna idea al lector acerca de dicho ejemplar.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Información de la revista: es de suma importancia observar información\r\nsobre la revista, ya sea, su misión, sus objetivos, su idea de creación, su\r\ncomité fundador, su comité editorial, entre otras para lograr el sentido de\r\nconfianza con los lectores.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Artículos Originales: son todos los artículos, estudios, resúmenes de\r\ninvestigaciones que cuenten con un contenido de gran valor, de alta\r\ncalidad, de un profundo estudio y demás criterios establecidos,\r\ndesarrollados por parte del comité editorial. Se debe tener un alto\r\nporcentaje de estos documentos con sus respectivos avales técnicos,\r\ninformes y comunicaciones en congresos para poder ser calificada como\r\ncontenido de calidad.\r\n</p>\r\n\t\t\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></li></ul></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Artículos de Revisión: son aquellos artículos que se encuentra en el\r\nproceso de investigación. Son analizados por medio de criterios de\r\nevaluación creados por grupos de estudios para su futura publicación.\r\nGeneralmente esta revisión se realiza por parte del comité editorial, que son\r\naquellas personas que poseen la responsabilidad de cambiar el contenido\r\nsegún sea el caso.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Sección de información: son todos aquellos enlaces de interés, como\r\npublicaciones, notas del autor, De esta forma, se da la facilidad de crear un\r\nenlace con otros sitios relacionados con la revista y mantener la\r\ninteractividad con los lectores y temas afines.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Sección de contacto: como bien se estableció en las características\r\ngenerales de las revistas digitales, estas cuentan con una interacción activa\r\nentre lector-revista. Por lo tanto, es indispensable contar con una sección\r\nde contacto, que contenga teléfonos, e-mail e incluso formulario de\r\nsugerencia de utilidad para el lector.\r\n</p>\r\n\t\t\t\t\t\t\t<p>1.4. APLICACIONES CIENTÍFICAS DE REVISTAS DIGITALES\r\n</p>\r\n\t\t\t\t\t\t\t<p>Existen cientos de ejemplos en revistas digitales y tantos tópicos como\r\ntemas científicas existan, podemos hablar de algunos ejemplos. Como la revista\r\ndigital de la universidad Nacional autónoma de México, ya con un catálogo\r\nimportante de ejemplares. Esta revista tiene como objetivo:\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t</ul>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Construir un espacio de innovación, desarrollo, aplicación y formación en\r\npublicación digital para artículos de investigación, análisis, creación y\r\nreflexión.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Difundir mediante recursos digitales la investigación, el análisis, la creación\r\ny la reflexión universitaria entre la sociedad mexicana e internacional.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Formar una comunidad virtual alrededor de la revista, que permita\r\nestableces vínculos entre autores, editores y lectores.\r\n</p>\r\n\t\t\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></li></ul></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Esta revista mantiene un comité editorial, un comité fundador de 8 personas, todos\r\nprofesores de la universidad, un comité fundador de alrededores de 20 personas\r\ntambién pertenecientes a la academia y esta indizada en 5 sitios distintos para su\r\ndivulgación. En cuestiones de almacenamiento, mantiene una base de datos de\r\nalrededor de 1,31Tb de información repartidos entre visitas, paginas, archivos y\r\naccesos. En la figura 2 se presenta el grafico de estos datos.\r\n</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t\t<p>\r\n\t\t\t\t</p><div>\r\n\t\t\t\t\t<p>Figura 2 - Estadísticas de la revista UNAM, UNAM(2012)\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>1.5. REQUERIMIENTOS\r\n</p>\r\n\t\t\t\t\t<p>Los requerimientos de una revista vienen muy relacionados con el esquema\r\nde normalización y estandarización. Los portales que contienen los<br>\r\nRegistros pueden variar los requerimientos dependiendo de las necesidades de su\r\nsistema. Siguiendo el esquema de LATINDEX podemos enumerar los siguientes\r\nrequerimientos.\r\n</p>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Mención del cuerpo Editorial: el cuerpo editorial se puede conformar por\r\nel director general, A editor responsable, editor ejecutivo, secretario de\r\nredacción, entre otros. En las revistas electrónicas deberá constar en la\r\npágina de inicio directamente o bien con un enlace que permita desde ella\r\nacceder a los datos con un simple clic.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Contenido: para calificar positivamente, al menos el 40% de los\r\ndocumentos publicados en los fascículos a calificar estará constituido por:\r\nartículos originales; artículos de revisión; informes técnicos; comunicaciones\r\nen congresos; comunicaciones cortas; cartas al editor; estados del arte;\r\nreseñas de libro, entre otros tipos de documento. En todos los casos deberá\r\nprivar el contenido científico académico.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Generación continúa de contenidos: debe demostrar la generación de\r\nnuevos contenidos en un año.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Identificación de los autores: los trabajos deben estar firmados por los\r\nautores con nombre y apellidos o declaración de autor institucional.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Entidad editora: deberá hacerse constar en lugar visible la entidad o\r\ninstitución editora de la revista. Deberá ser de toda solvencia, aparecerá en\r\nla página de inicio directamente o bien con un enlace que permita desde\r\nella acceder con un simple clic.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Mención del director: en la revista deberá constarse el nombre del director\r\nde la publicación, responsable editorial o equivalente.\r\n</p>\r\n\t\t\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></li></ul></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>• Mención de la dirección de la revista: deberá aportarse en lugar visible la\r\ndirección postal o de correo electrónico de la administración de la revista a\r\nefectos de solicitud de suscripciones, canjes, envío de trabajos, acciones de\r\nseguimiento, entre otras.\r\n</p>\r\n\t\t\t\t\t<p>1.5.1. NORMALIZACIÓN\r\n</p>\r\n\t\t\t\t\t<p>Cuando se habla de normalización, se hace referencia a un conjunto de\r\ncriterios generarles que se establecen para las revistas científicas, ya sean\r\nimpresas o digitales. Muchos de estos criterios, se han convertido en norma\r\noficiales que han sido apoyadas por las instituciones científicas, tal es el caso, del\r\norganismo internacional ISO.\r\n</p>\r\n\t\t\t\t\t<p>Por su parte Barruecos (2000) considera que estas normas nos e llevan\r\ncompletamente a cabo por que no son imperativas, simplemente orientativa.\r\nAdicionalmente, agrega que las normas están hechas de bibliotecarios para\r\nbibliotecarios, con muy poca aportación por los editores.\r\n</p>\r\n\t\t\t\t\t<p>Como consecuencia, el autor define un ejemplo de la tabla de contenidos,\r\ndonde según la ISO, debería ubicarse en la primera página después de la cubierta.\r\nPero, en muchos casos el interés económico obliga al editor a reservar las partes\r\nmás visibles de la revista para la publicación publicitaria.\r\n</p>\r\n\t\t\t\t\t<p>Teniendo esto en cuenta, se listan los aspectos formales que debe seguir\r\nuna revista científica según Abadal y Rius.\r\n</p>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Cumplimiento de la periodicidad. Para lograr un aumento en la credibilidad\r\nde los lectores, es indispensable cumplir con la periodicidad establecida\r\ndesde un principio: de esta forma, también se gana credibilidad por parte de\r\nlos autores colaboradores.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Presencia de sumario. Descripción detallada su ámbito en actuación.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t</ul>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t\t<p>\r\n\t\t\t\t</p><div>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Presencia de ISSN. Este aspecto es uno de los más importantes. Toda\r\nrevista debe tener un ISSN (International Standard Serials Numbers), este\r\nserial debe estar precedido de las sigas.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Inclusión de resúmenes en los artículos. Este resumen. Dara un idea\r\ngeneral del artículo, y además, debe venir en 2 idiomas. Los pasos para la\r\nelaboración de este resumen están recogidos en la ISO 214.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Inclusión de palabras claves en los artículos en 2 idiomas.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Inclusión de referencia bibliográfica al principio. Según López Cozar (1996),\r\neste membrete bibliográfico está destinado a facilitar la clasificación de la\r\nrevista y la compilación de referencias, fundamentalmente en repertorios y\r\nbases de datos bibliográficos y otras publicaciones bibliográficas.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Datos identificativos en la Portada. Tales como, nombre de la revista, logo,\r\nfecha de publicación, numero de revista, etc.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Fecha de recepción y aceptación de los originales.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Para los autores: nombres, indicación del puesto de trabajo, referencias\r\n</p>\r\n\t\t\t\t\t\t\t<p>bibliográficas, envió de originales y resumen.\r\n</p>\r\n\t\t\t\t\t\t\t<p>Aquí tenemos otro ejemplo de lineamientos de normalización sacado de\r\nLATINDEX.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t</ul>\r\n\t\t\t\t\t<p>• ISSN. Las revistas electrónicas deben contar con su propio ISSN. No se da por\r\ncumplido si aparece únicamente el ISSN de la versión impresa.\r\n</p>\r\n\t\t\t\t\t<p>• Definición de la revista. En la revista deberá mencionarse el objetivo y\r\ncobertura temática o en su defecto el público al que va dirigida.\r\n</p>\r\n\t\t\t\t\t<p>• Sistema de arbitraje. En la revista deberá constar el procedimiento empleado\r\npara la selección de los artículos a publicar.\r\n</p>\r\n\t\t\t\t\t<p>• Evaluadores externos. Se deberá mencionar que el sistema de arbitraje\r\nrecurre a evaluadores externos a la entidad o institución editora de la revista.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Autores externos. Al menos el 50% de los trabajos publicados deben provenir\r\nde autores externos a la entidad editora. En el caso de las revistas editadas por\r\nasociaciones se considerarán autores pertenecientes a la entidad editora los\r\nque forman parte de la directiva de la asociación o figuran en el equipo de la\r\nrevista.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Apertura editorial. Al menos dos terceras partes del consejo editorial deberán\r\nser ajenas a la entidad editora.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Servicios de información. Califica positivamente si la revista está incluida en\r\nalgún servicio de índices y resúmenes, directorios, catálogos, hemerotecas\r\nvirtuales y listas del núcleo básico de revistas nacionales, entre otros servicios\r\nde información. Este campo califica positivamente tanto si el servicio de\r\ninformación es mencionado por la propia revista como si lo agrega el\r\ncalificador.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Cumplimiento de la periodicidad. Califica positivamente si la revista cumple\r\ncon la declaración de periodicidad.\r\n</p>\r\n\t\t\t\t\t\t\t<p>1.5.2. ADECUACIÓN AL MEDIO\r\n</p>\r\n\t\t\t\t\t\t\t<p>Cuando se habla de los aspectos propios del formato digital en la\r\nproducción de revista, según Abadal y Rius (2006), han surgido normas de facto,\r\ndesarrolladas por organizaciones o incluso empresas, tales como, W·C,\r\nInternational DOI Foundation y Dublin Core.\r\n</p>\r\n\t\t\t\t\t\t\t<p>La lista de indicadores para la evaluación de recursos digitales, en especial\r\nde revista, dependerán del autor, de la calidad de contenido, del acceso a la\r\ninformación y de la ergonomía. Los dos primeros aspectos fueron tomados en\r\ncuenta en el punto anterior, ya que coinciden con la formalidad tanto de revistas\r\ndigitales, como impresas. En cambio, el acceso y la ergonomía, son aspectos\r\npropios del medio digital, ellos permiten la conservación de las revistas digitales.\r\n</p>\r\n\t\t\t\t\t\t\t<p>Distintos autores han presentado listas de indicadores para la evaluación de\r\nrecursos digitales que pueden tomarse como base para su aplicación a las\r\nrevistas, para estudiar los indicadores de calidad en las revista digitales científicas\r\nsegún Abadal y Rius (2006), es indispensable describirlos en tres grupos:\r\n</p>\r\n\t\t\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></li></ul></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>• Accesibilidad y usabilidad<span>El grado de usabilidad y accesibilidad de un revista digital se evalúa\r\n</span></p>\r\n\t\t\t\t\t<p>mediante los misinos criterios establecidos para un portal o página web.\r\nEsta lista de indicadores se caracteriza principalmente por la facilidad de\r\nuso y acceso, cumpliendo con una serie de características generales que se\r\ntoman en cuenta en este punto:\r\n</p>\r\n\t\t\t\t\t<p>o Formato: debe ir en función a las necesidad des de la revista y del\r\ncontexto de lectura de sus lectores. Pero por otra parte, el CINDOC-\r\nCSIC (2004) establece que el formato de una revista, puede variar\r\npara satisfacer distintas necesidades.\r\n</p>\r\n\t\t\t\t\t<p>o Sumario: hoy en día, muchas revistas digitales, e incluso sitios web,\r\ncuentan con un sumario o una lista de contenidos que permite\r\nesquematizar la información que está en el portal y/o el número de\r\nejemplares publicados. Esta característica es muy útil y es un\r\nrequisito específico en muchos modelos de evaluación.\r\n</p>\r\n\t\t\t\t\t<p>o Sistema de Recuperación de la información: es importante que la\r\nrevista cuenta con un sistema que permita recuperar de forma\r\nrápida, sencilla y precisa, del contenido, ya sea por medio de una\r\nbúsqueda simple o una búsqueda avanzada estructurada.\r\n</p>\r\n\t\t\t\t\t<p>o Metadatos: permiten describir básicamente los contenidos de la\r\npágina web, información del formato, la propiedad intelectual y la\r\nidentificación. Abadal y Rius (2006), consideran que los formatos\r\nprincipales y más extendidos para los metadatos son Dublin Core y\r\nResource Description Framework.\r\n</p>\r\n\t\t\t\t\t<p>o Navegación: uno de los principios de usabilidad, es el control que\r\ndebe tener el usuario en una aplicación web; en este caso, el lector.\r\nLa revista debe permitir al lector moverse entre todas las páginas y\r\ndar a conocer en que sitio se encuentra, de esta forma el lector\r\npuede situar la ruta de acceso hacia los contenidos. Además debe\r\npermitir al lector llegar a donde quiere con el mínimo número de\r\nclicks; este factor es muy importante a la hora de valorar el acceso a\r\nla información de la revista.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>o Compatibilidades y normas de accesibilidad: es indispensable\r\nque un sitio web pueda ser accedido y entendido por personas, así\r\nestas tengan alguna discapacidad. Por lo tanto, se recomienda que\r\nel sitio web cuente con una serie de pautas que permitan hacer llegar\r\nla información desde medios diferentes, ya sea visual o auditivo.\r\nAdemás, el uso de metáforas, que sirva de apoyo al lector, para\r\nidentificar los enlaces del sitio, así también, tratar de ser los más\r\nespecífico posible en los enlaces de hipertexto, haciendo que la\r\npalabra enlazada tenga sentido fuera del contexto.\r\n</p>\r\n\t\t\t\t\t<p>o Periodicidad: el factor de periodicidad juega un papel fundamental,\r\ntanto en revistas científicas impresas como en digitales. Por lo tanto\r\npara una revista digital, es importante cumplir con la periodicidad\r\nestablecida desde el inicio por cuestiones de confiabilidad con el\r\nlector, e incluso, con los autores\r\n</p>\r\n\t\t\t\t\t<p>• Ergonomía<span>Es la disciplina tecnológica que trata del diseño de lugares de trabajo,\r\n</span></p>\r\n\t\t\t\t\t<p>herramientas y tareas que coinciden con las características fisiológicas,\r\nanatómicas (humano-máquina-ambiente), para lo cual\r\nelabora métodos de estudio de la persona, de la técnica y de\r\nla organización.\r\n</p>\r\n\t\t\t\t\t<p>Por su parte, cuando se habla de ergonomía en las revistas digitales\r\nse refiere al bienestar del hombre con el portal web de la revista. Para\r\nlograr esta armonía, influyen varios factores, mencionados por Abadal y\r\nRius(2006), como:\r\n</p>\r\n\t\t\t\t\t<p>o La legibilidad, que viene dada por la tipografía, por el contraste entre\r\ntexto y fondo, la distribución y cantidad del contenido y el\r\nestablecimiento de niveles de importancia.\r\n</p>\r\n\t\t\t\t\t<p>o El diseño gráfico del portal.<span>o El uso moderado de recursos que complementen el sitio, ya sean,\r\n</span></p>\r\n\t\t\t\t\t<p>imágenes, animaciones, videos.<span>o La facilidad de uso con opciones intuitivas.\r\n</span></p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Todos estos factores mencionados anteriormente cumplen con los criterios\r\nde visualización para el uso del portal. Es importante que el lector no se incomode\r\nal momento de leer, ni mucho menos fuerce su visión.\r\n</p>\r\n\t\t\t\t\t<p>• Conservación<span>CINDOC-CSIC (2004) dice que debido al inmenso y rápido desarrollo de\r\n</span></p>\r\n\t\t\t\t\t<p>la tecnología constantemente, nace un nuevo problema, para las producciones\r\nde las revistas científicas digitales que afecta al factor conservación, dicho\r\ninconveniente viene dado por la tecnología con la que se produce la misma. El\r\npunto importante en este riesgo es la elección de la tecnología en la que se va\r\na trabajar, de tal forma, que no se convierta obsoleta al poco tiempo de ser\r\ndesarrollada la revista. Para CINDOC (Instituto de estudios documentales\r\nsobre ciencia y tecnología, ahora llamado CSIC)(2004) , siguiendo todas las\r\nnormas y estándares internacionales se puede afirmar que un documento\r\nimpreso podría ser leído durante 5 siglos, en cambio es difícil certificar un\r\nperiodo de tiempo fijo, donde se tenga la total certeza de que un documento\r\nelectrónico pueda ser leído y recuperado para leerse: peor ante esto, nace una\r\ngran interrogante sobre el responsable de la conservación de revistas digitales.\r\nSi bien es cierto que las bibliotecas nacionales son las responsables de la\r\nconservación de todas las publicaciones editadas en el país correspondiente,\r\nen el caso de las publicaciones en formato digital no existen infraestructuras\r\nreconocidas, por lo tanto la responsabilidad de su conservación queda sujeta a\r\nvarias iniciativas voluntarias.\r\n</p>\r\n\t\t\t\t\t<p>Sin embargo, ya en EEUU, La fundación internacional de identificación\r\nde objetos digitales (conocido por sus siglas en inglés, como DOI) ha\r\ndesarrollado un sistema de identificación de los objetos contenidos en el\r\nentorno digital. Este sistema es una norma internacional ISO y proporciona un\r\nmarco para la identificación permanente por medio de un código alfanumérico\r\nque distingue inequívocamente un documento digital con información actual y\r\ndirección donde se encuentra en internet. Así, un recurso digital puede\r\ncambiar a través del tiempo, incluyendo su dirección de acceso, pero su\r\ncódigo DOI no cambiará.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Además, el sistema DOI proporciona gestión de contenido y propiedad\r\nintelectual, de metadatos y de medios de comunicación. Según fuentes oficiales de\r\nla página de DOI, para el mes de abril del año 2011 se ha asignado más de 51\r\nmillones de nombres DOI en EEUU, Australia y Europa. Por su parte, es una\r\niniciativa de suma importancia para el desarrollo de la producción de revista\r\ndigitales, ya que el código DOI puede servir para una publicación, para un artículo\r\no simplemente parte de contenido.\r\n</p>\r\n\t\t\t\t\t<p>1.5.3. DIFUSIÓN DE CONTENIDOS\r\n</p>\r\n\t\t\t\t\t<p>Las revistas científicas tienen sentido en la medida en que aquello que\r\npublican incide positivamente en la evolución del saber. Para que esto ocurra,\r\naparte de editar contribuciones de interés, tienen que conseguir que los contenidos\r\nlleguen a los destinatarios. Para conocer en qué grado este último objetivo se\r\ncumple, es imprescindible disponer de unos indicadores que permitan medirlo.\r\n</p>\r\n\t\t\t\t\t<p>El CINDOC-CSIC (2004) describe dos tipos de difusión: directa e indirecta.\r\nLa difusión directa, se relaciona con el número de ejemplares que se editan y\r\nproducen; es importante señalar que no todos los ejemplares tiene el mismo valor\r\nde difusión. Por lo que la presencia de las bibliotecas especiales es un factor\r\nimportante para la difusión de las revistas científicas. En el caso de la difusión. Por\r\nlo que la presencia de las bibliotecas especiales es un factor importante para la\r\ndifusión de las revistas científicas. En el caso de la difusión indirecta se consigue\r\ncon la de indexación de la revista en bases de datos, directorios de internet y\r\ncatálogos. La presencia de una revista en uno de estos medios de difusión\r\ngarantiza un aumento en la visualización de la misma.\r\n</p>\r\n\t\t\t\t\t<p>También es importante mencionar las medidas de impacto de una revista\r\nsobre la población interesada en el área que abarca la misma, es decir, la\r\ninfluencia que se propone la revista frente a los lectores científicos. Es\r\nindispensable tener conocimiento acerca del impacto sobre los lectores, por lo\r\ntanto, se deben definir los indicadores que contribuyan a la medición de dicho\r\nimpacto. En el estudio realizado por Abadal y Rius(2006), se describieron cuatro\r\nfactores importantes.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Estadísticas de uso: se refiere al hecho de tener conocimiento sobre la\r\ncantidad de lectores que ingresan al portal para la visualización de la\r\nrevista, el número de ejemplar más leído, el articulo más visitado, la\r\ncantidad de lectores suscritos y no suscritos que ingresan, etc. De esta\r\nforma se pueden determinar estadísticas que apoyen al continuo cambio\r\ndel impacto sobre la población.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Suscripciones: este también es considerado un factor importante ya\r\nque por medio del mismo se puede evaluar el interés generado por los\r\ncontenidos de la revista, así como, la evolución de los lectores\r\ninteresados en hacer seguimiento a las publicaciones por su alto nivel de\r\ncalidad y credibilidad.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Visibilidad: como ya se ha dicho anteriormente, dicho término es muy\r\nimportante en la producción de las revistas científicas digitales porque\r\nes uno de los objetivos que persigue la misma: aumentar la\r\nvisualización. Así También, este indicador influye en las medidas de\r\nimpacto por generar aumento de interés sobre los lectores en el tiempo.\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Factor de impacto: este factor es considerado el más importante en la\r\nmedida de impacto y el más ampliamente aceptado por la comunidad\r\ncientífica para la evaluación de los artículos de una revista digital. Este\r\nfactor se basa en dos elementos: el numerador, que es el número de\r\nlectores en el año en un artículo publicado en cualquier ejemplar de la\r\nrevista en los últimos 2 años; y el denominador, que es el mismo número\r\nde artículos publicados en el año en curso.\r\n</p>\r\n\t\t\t\t\t\t\t<p>1.5.4. SISTEMAS DE INDEXACIÓN\r\n</p>\r\n\t\t\t\t\t\t\t<p>La NFAIS que es la federación nacional de servicios de información\r\navanzada, declara que la publicación en revistas científicas data de por lo menos\r\n50.000 que publicaban cerca de medio millón de artículos por año. Debido a este\r\ncrecimiento vertiginoso, un grupo conformado por los países desarrollados\r\nemprendieron la tarea de constituir una base de datos con dos propósitos: Apoyar\r\na las comunidades científicas e identificar los trabajos de investigación más\r\nimpertinentes contenidos en un área de conocimiento, además de proveer los\r\nautores y editores una posibilidad de mayor cobertura.\r\n</p>\r\n\t\t\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></li></ul></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Por su parte, le indexación se refiera al proceso de agregar los datos de una\r\nrevista a un servicio de índices, desarrollado por alguna institución u organización\r\nde gran prestigio. Por lo tanto, es un objetivo importante que una revista logre ser\r\nindexada por algunos de estos servicios, ya que como se ha dicho, consigue\r\nampliar su visibilidad y mayor cobertura.\r\n</p>\r\n\t\t\t\t\t<p>Para poder estudiar la indexación de las revistas, se dividirá la presencia de\r\nlas mismas en dos categorías: Presencia de revistas en Directorios de\r\npublicaciones periódicas y presencia de revistas a los servicios de indexación y\r\nresumen, las cuales se describen a continuación:\r\n</p>\r\n\t\t\t\t\t<p>o Presencia de revista en directorios de publicaciones periódicas:<span>Un directorio es un servicio que permite describir a una revista como\r\nun todo, ofreciendo información de las características generales de la\r\nrevista pero sin dar detalles de sus fascículos, ni artículos que publican.\r\nAdemás, para Alonso (2010), buscan ser exhaustivos y son útiles para\r\nbuscar y seleccionar revistas. Por su parte, la función principal de un\r\ndirectorio de publicaciones periódicas, es facilitar datos bibliográficos de\r\nuna revista y dar fe de su existencia, ya sea en formato impreso o\r\n</span></p>\r\n\t\t\t\t\t<p>electrónico.\r\n</p>\r\n\t\t\t\t\t<p>Son de suma importancia las publicaciones periódicas desarrollados\r\nhoy en día, según Román (2010), son herramientas indispensables para\r\nlocalizar y seleccionar revistas de una forma determinada. Los directorios\r\nson el primer recurso para conocer la existencia de una revista. En la\r\nmayoría de los casos estos sitios de indexación son gratuitos o tienen un\r\nsistema de registro relacionado con algún identificador que te relacione con\r\ncualquiera de las instituciones permitidas.\r\n</p>\r\n\t\t\t\t\t<p>Presencia de revistas en servicios de indexación y resumen (SIR):\r\n</p>\r\n\t\t\t\t\t<p>Los sistemas de servicio de indexación y resumen, para Murcia\r\n(2005), no solo ofrece información bibliográfica de la revista, como los\r\ndirectorios; sino que también integran de manera continua, parcial o\r\ncompleta, sus contenidos. Son bases de datos que almacenan la\r\ninformación bibliográfica de las revista y de los contenido publicados en la\r\nmismas, cumpliendo con los criterios de calidad que son los contenidos, por\r\nmedio de análisis y evaluación.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Según Charum (2002), el lugar que ocupan los SIR dentro de la\r\ncomunidad científica puede ser comprendido a partir del modelo clásico, por\r\nel acceso a las publicaciones y sus documentos, mediante los metadatos; y\r\na partir del modelo moderno, ya que permiten la ubicación y presencia de\r\nlos documentos, señalando la diversidad de formatos de presentación y sus\r\nrelaciones con otros documentos dentro del medio electrónico. En su\r\ndefinición permite tres tipos de SIR:\r\n</p>\r\n\t\t\t\t\t<p>o Índices bibliográficos y resumen: generalmente son avalados y\r\nproducidos por instituciones o asociaciones científicas de\r\nreconocimiento internacional, universidades, instituciones\r\nacadémicas, institutos especializados en el análisis de información\r\ncientífica o agencias que apoyan la actividad científica. Utilizan\r\ncriterios científicos explícitos, mediante estrictas exigencias\r\ncientíficas y editoriales, para la selección de revista; y además,\r\nofrece acceso, ya sea directo o por medio de un intermediario, al\r\ntexto completo.\r\n</p>\r\n\t\t\t\t\t<p>o Bases bibliográficas y resumen: principalmente son avaladas por\r\ninstituciones o asociaciones científicas, universidades, instituciones\r\nacadémicas. A diferencia de los índices bibliográficos, centran su\r\nobjetivo en la selección de artículos de investigación publicados en\r\nrevistas arbitradas.\r\n</p>\r\n\t\t\t\t\t<p>o Índices bibliográficos de citaciones: Son producidos por el\r\nInstitute for Scientific Information. Establecen un factor de impacto,\r\nen base al número de citas que reciben las revistas y de ahí\r\nconstituye un ordenamiento.\r\n</p>\r\n\t\t\t\t\t<p>o Índices bibliométricos: en la conferencia desarrollada por Alonso\r\n(2010), en Nicaragua, el autor establece los llamados índices\r\nbibliométricos. Estos denominados índices determinan la corriente\r\nprincipal de la ciencia, ya que generan indicadores bibliométricos\r\nampliamente utilizados, como: factor de impacto, análisis de citas,\r\níndice de vida media, entre otros. Para el autor estos indicies\r\nrepresentan los más difíciles de alcanzar para las revista\r\nlatinoamericanas, ya que abarcan revistas mundialmente.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Después de haber visto los directorios los servicios de indexación y\r\nresumen y los índices bibliométricos, por los que pueden ser indexadas las revista\r\nimpresas y digitales, a continuación en la figura 3, se presenta una pirámide de\r\nindexación de revista, desarrollada por Alonso Gamboa(2006).\r\n</p>\r\n\t\t\t\t\t<p>SI\r\nBibliométricos\r\n</p>\r\n\t\t\t\t\t<p>SI\r\ninternacionales\r\n</p>\r\n\t\t\t\t\t<p>SI regionales\r\n</p>\r\n\t\t\t\t\t<p>Directorios internacionales\r\n</p>\r\n\t\t\t\t\t<p>Directorios regionales\r\n</p>\r\n\t\t\t\t\t<p>Figura 3 - Pirámide de indexación de Alonso Gamboa, Gamboa(2006)\r\n</p>\r\n\t\t\t\t\t<p>En la pirámide de Alonso, se puede apreciar que las revista\r\nlatinoamericanas deben buscar primeramente ser indexadas por directorios\r\nregionales, que son las bases de datos de una determinada región como\r\nLATINDEX, seguidamente lograr ser indexadas por directorios internacionales\r\ncomo ULRICHS, luego buscar indexación por SIR regionales e internacionales,\r\ncumpliendo con los criterios de calidad y por ultimo llegar a la indexación\r\nbibliométrica. De esta forma, la revista garantiza una mayor distribución y difusión\r\nde su material y por lo tanto, logra mayor visualización. Así también se gana\r\ncredibilidad para su contenido y editorial.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>1.5.5. SISTEMAS DE ARBITRAJE\r\n</p>\r\n\t\t\t\t\t<p>En el ambiente académico, el sistema de arbitraje es un método usado para\r\nvalidar trabajos escritos y solicitudes de financiación con el fin de evaluar su\r\ncalidad, originalidad, factibilidad, rigor científico, antes de su publicación.\r\n</p>\r\n\t\t\t\t\t<p>La calidad de las publicaciones depende de la evaluación que realizan los\r\nexpertos. El proceso denominado sistema de revisión por expertos o pares (o peer\r\nreview, en inglés) consiste en que dos o más revisores leen y analizan los\r\nartículos para determinar tanto la validez de las ideas y los resultados como su\r\nimpacto potencial en el mundo de la ciencia. La elección de evaluadores es una de\r\nlas atribuciones tradicionales de los editores de las revistas académicas. Se\r\nbuscan entre los investigadores con más prestigio en las diferentes disciplinas.\r\nLos evaluadores no siempre reciben reconocimiento económico, aunque sí cierto\r\nprestigio y acceso privilegiado a información.\r\n</p>\r\n\t\t\t\t\t<p>o Metodología del sistema de evaluación de trabajos\r\n</p>\r\n\t\t\t\t\t<p>Esta metodología es propuesta por Giordanino (2006) y la función de los\r\nárbitros consiste en evaluar el trabajo presentado y dictaminar una de cuatro\r\nopciones:\r\n</p>\r\n\t\t\t\t\t<p>1) Aceptarlo.<br>\r\n2) Aceptarlo con cambios menores.<br>\r\n3) Devolverlo para su revisión y corrección.\r\n4) Rechazarlo.\r\n</p>\r\n\t\t\t\t\t<p>Los trabajos escritos son recibidos por el editor/director de la revista y luego\r\nsuelen enviarse a los árbitros sin el nombre del autor y su filiación, para evitar\r\ndistorsiones en la evaluación. Los editores reciben el informe de los árbitros y\r\ncuando informan al autor el dictamen, no detallan el nombre de los árbitros\r\n(proceso denominado blind review, o revisión "ciega"). Cuando el director\r\ncompara, coteja y reenvía a los evaluadores todos los informes sin detallar los\r\nnombres de los evaluadores, el proceso es denominado "doble ciego", tanto los\r\nautores como los evaluadores ignoran o desconocen a los demás participantes de\r\nla evaluación. De todos modos, los lectores/autores pueden hacer hipótesis sobre\r\nla identidad de los árbitros basándose en la lista de los miembros del comité\r\neditorial de la publicación. En algunos casos el arbitraje es abierto, es decir,\r\nautores y evaluadores conocen su identidad. El sistema se ha aplicado a revistas\r\nen papel y electrónicas.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>En aquellos casos en que surja una gran divergencia en los informes de los\r\nevaluadores, el director puede recurrir a la opinión de un árbitro externo. Si bien\r\nlos evaluadores dictaminan sobre los trabajos de sus pares, la decisión final queda\r\nen mano del director o de los editores de la publicación. La mayoría de las revistas\r\ncientíficas suelen incluir, además de instrucciones a los autores, instrucciones para\r\nlos árbitros evaluadores.\r\n</p>\r\n\t\t\t\t\t<p>Aun cuando el arbitraje puede ser muy riguroso en términos cualitativos de\r\nun trabajo, al final la decisión de publicarlo o de financiarlo recae en el editor, y\r\nestá sometida a algunas restricciones. Por ejemplo, si el espacio para publicar los\r\nartículos es limitado (como los de conferencias científicas) o si hay muchas\r\nsolicitudes de financiamiento, puede ocurrir la no aceptación de trabajos con la\r\ncalidad necesaria o negación de financiamiento a proyectos bien sustentados.\r\nInversamente, puede suceder que una publicación no haya recibido suficientes\r\ntrabajos claramente publicables y decida aceptar mayor cantidad de artículos\r\ncalificados “con aceptación condicionada”.\r\n</p>\r\n\t\t\t\t\t<p>En publicaciones comoScienceyNaturese dispone de un sistema de\r\narbitraje muy restrictivo. A veces, cuando evalúan que un artículo no representa\r\navance significativo en su ramo, ocurre que lo rechazan, aunque sea de buena\r\ncalidad científica. Otras publicaciones, como el Astrophysical Journal y la Physical\r\nReview, utilizan la revisión por pares para eliminar trabajos con errores obvios o\r\nsin sentido.\r\n</p>\r\n\t\t\t\t\t<p>La tasa de artículos aceptados denota este tipo de criterios. Por ejemplo, de\r\nlos artículos sometidos a evaluación, en Nature se acepta sólo el 5%, y\r\nenAstrophysical Journalse publica cerca del 70%. Las diferentes tasas de\r\naceptación también se notan en la cantidad de páginas de las publicaciones. Con\r\nel fin de preservar la integridad del proceso de revisión por pares, en algunas\r\npublicaciones los árbitros no conocen la identidad de los autores. De este modo se\r\nespera que en la decisión no influyan prejuicios por el prestigio autoral. Mediante\r\nesta modalidad de revisión, la versión enviada a arbitraje debe no contener\r\nreferencias que revelen a los árbitros la identidad de los autores.\r\n</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t\t<p>\r\n\t\t\t\t</p><div>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>1.6. REVISTAS CIENTÍFICAS LATINOAMERICANAS\r\n</p>\r\n\t\t\t\t\t<p>El campo investigativo latinoamericano ha crecido considerablemente estas\r\nultimas décadas, era inevitable que la necesidad de compartir información entre\r\ndistintas instituciones surgieran, las herramientas web también facilitaran este\r\nproceso.\r\n</p>\r\n\t\t\t\t\t<p>Las revistas latinoamericanas no difieren mucho en lo que se refiere a su\r\nestructura del resto del mundo, salvo las propiedades del idioma de la región\r\ndonde se este trabajando. Podemos empezar en el ámbito nacional, muchas de\r\nlas facultades de las instituciones mas importantes del país cada cierto tiempo\r\nrealizan publicaciones sobre temas de interés en el campo investigativo; como\r\nejemplo podemos tomar la revista de la facultad Ingeniería de la Universidad\r\nCentral de Venezuela (registrada en SciELO), que hasta el momento cuenta con\r\n28 números registrados que hace referencia a temas de interés en el campo de la\r\ningeniería y sus asociados. Otro ejemplo es la Revista de obstetricia y ginecología\r\nde Venezuela (también registrada por SciELO), que consta de 48 números\r\nregistrados hasta el día de hoy. Ahora en el ámbito latinoamericano, una de los\r\nejemplos mas representativos es la revista digital de la UNAM que cuenta con mas\r\nde 100 números que mas adelante explicaremos en detalle.\r\n</p>\r\n\t\t\t\t\t<p>1.7. FONACIT\r\n</p>\r\n\t\t\t\t\t<p>En Venezuela se encuentra el FONACIT, que es el fondo nacional de\r\nciencia tecnología e innovación, este es el órgano publico que ejecuta\r\nfinancieramente las políticas estratégicas del ministerio del poder popular para\r\nciencia, tecnología e industrias intermedias. Tiene como objetivo impulsar la\r\nciencia, tecnología e innovación para el desarrollo de proyectos que fortalezcan el\r\naparato científico. El FONACIT mantiene un centro de documentación, que\r\nrecopila todos los proyectos realizados en su ámbito, un índice que presenta la\r\ninformación bibliográfica para su posterior búsqueda, además de revistas tanto\r\nelectrónicas como físicas, también mantiene una base de información en lo\r\nreferente a libros y trabajos especiales de grado. El formato de los datos de los\r\ndocumentos registrados es el siguiente:\r\n</p>\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Autor\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Titulo\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Cota\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Empresa productora\r\n</p>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li>\r\n\t\t\t\t\t\t\t<p>Fecha\r\n</p>\r\n\t\t\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></li></ul></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>En la siguiente figura (figura 4) presentamos el formato de los documentos\r\nque cumplieron las condiciones para que FONACIT pudiera registrarlas.\r\n</p>\r\n\t\t\t\t\t<p>Figura 4 - Resultados de Búsqueda en el centro de documentación FONACIT (2012)\r\n</p>\r\n\t\t\t\t\t<p>1.8. BIBLIOTECAS DIGITALES\r\n</p>\r\n\t\t\t\t\t<p>Desde hace años, las instituciones, asociaciones y colectivos educativos\r\nmas importantes del mundo buscan la digitalización de contenidos tanto propios\r\ncomo foráneos, para que los mismos sirvan de apoyo en la educación e\r\ninvestigación en todos los niveles.\r\n</p>\r\n\t\t\t\t\t<p>Para esto, muchas de estas instituciones realizaron proyectos de bibliotecas\r\ndigitales, las cuales son una gran novedad que nos aporta la Web y ayuda a que\r\nlos conocimientos y contenidos sean bienes globales. Estas bibliotecas no solo\r\nson bases de datos, sino que son bases de datos, sino que son un tipo de motores\r\nde búsqueda y acceso al conocimiento desde cualquier parte del mundo y al\r\nmayor numero posible de obras y proyectos, ya sean públicos o privados.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Este tipo de bibliotecas ya se han establecido en todas partes del mundo,\r\naunque la mayoría sigue estando en países como Estados Unidos, Brasil y los\r\npaíses integrantes de Europa, pero actualmente hay muchas existentes en\r\nAmérica Latina, entre las que podemos destacar la Biblioteca Científico-\r\nElectrónica en Línea (SciELO), con penetración en muchos países de\r\nLatinoamérica, entre los que están Venezuela, Colombia, Argentina, entre otros, y\r\nla Biblioteca Virtual en Salud Venezuela (BVS Venezuela) que posee una gran\r\ncantidad de repositorios con información, artículos y obras que educan a los\r\ninteresados en el área de la salud de forma gratuita.\r\n</p>\r\n\t\t\t\t\t<p>SciELO es la Biblioteca Científico-Electrónica con mas reconocimiento en\r\nAmérica Latina, ubicada en Argentina, Bolivia, Brasil, Chile, Colombia, Cuba,\r\nEspaña y Venezuela, esta asociada en Venezuela a la FONACIT y pertenece al\r\nregistro Nacional de Publicaciones Periódicas.\r\n</p>\r\n\t\t\t\t\t<p>Esta Biblioteca posee una gran cantidad de revistas y artículos\r\ndesarrollados por venezolanos en sus bases de datos y esta siendo desarrollado\r\nen Venezuela por Sistema Nacional de Documentación e Información Biomédica\r\n(SINADIB), el Ministerio del Poder Popular para Ciencia, Tecnología e Innovación\r\n(MCTI), el Fondo Nacional de Tecnología e Innovación (FONACIT), la Fundación\r\nCentro Nacional de Innovación Tecnológica (CENIT) y cuenta con el apoyo de\r\nBIREME/OPS/OMS y de la Facultad de Medicina de la Universidad Central de\r\nVenezuela.\r\n</p>\r\n\t\t\t\t\t<p>Hay 33 títulos Venezolanos vigentes actualmente y otros 22 descontinuados\r\nen esta biblioteca, en la figura 5 podemos observar algunos de estos.\r\n</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t\t<p>\r\n\t\t\t\t</p><div>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Figura 5 – Revistas Venezolanas en SciELO (2012)\r\n</p>\r\n\t\t\t\t\t<p>Como podemos observar en la figura 5, hay revistas de muchas de las\r\nuniversidades y facultades mas importantes del país, además, nos indica cuantos\r\nnúmeros existen actualmente de cada una, pero además de esto, SciELO nos\r\npermite buscar artículos por nombre, autor, país del autor o el articulo, materia,\r\nentre otras cosas.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>1.6 EJEMPLOS DE REVISTAS DIGITALES\r\n</p>\r\n\t\t\t\t\t<p>En la web, hay una gran cantidad de revistas digitales, pero la gran mayoría\r\nde estas no pasan por un proceso editorial totalmente en línea, solamente son\r\nactualizadas mediante administradores de los sitios web que colocan en línea\r\ntodos los nuevos ejemplares editados en las empresas de las cuales salen dichas\r\nrevistas, como ejemplo de esto tenemos la revista digital tecnológica gratuita de\r\nGoogle, la cual es llamada “Think Quarterly” y nos muestra problemas y soluciones\r\ntecnológicas de la compañía y la vida informática cotidiana, esta revista tiene una\r\nperiodicidad de un mes, por lo que se puede ver en la figura 6, donde se aprecia la\r\npagina principal de dicha revista, el numero correspondiente a cada mes ya\r\ntranscurrido.\r\n</p>\r\n\t\t\t\t\t<p>Figura 6 – Página principal revista “Think Quarterly”, Google® (2012)\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p></div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Aquí podemos observar los números de dicha revista así como la\r\nopción para visualizar la ultima o descargarla en formato PDF. En la figura 7\r\nse muestra dicho numero en formato online.\r\n</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t\t<p>\r\n\t\t\t\t</p><div>\r\n\t\t\t\t\t<p>Figura 7 – Revista “The Open Issue” de Google”, Google® (2012)\r\n</p>\r\n\t\t\t\t\t<p>Se visualiza una noticia desplegada y a la derecha se permite una\r\nnavegación por los diferentes artículos que posee dicha revista, también\r\ntiene contenido multimedia embebido en estos, por lo que lo hace una\r\nrevista muy dinámica y con información en diversas tecnologías.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO\r\n</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t\t<p>\r\n\t\t\t\t</p><div>\r\n\t\t\t\t\t<p><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;">Al hacer clic en el botón “Download PDF” (descargar PDF) en la\r\nfigura 6, se puede visualizar sin estar en línea en formato PDF, ya que se\r\nguarda en la maquina en la que el usuario requirió descargarlo, en la figura\r\n8 podemos observar como se visualiza en el formato PDF dicha revista.</span></p></div></div><div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t\t<p>\r\n\t\t\t\t</p><div>\r\n\t\t\t\t\t<p>Figura 8 – Revista “The Open Issue” de Google en formato PDF”, Google® (2012)\r\n</p>\r\n\t\t\t\t\t<p>Además de esta revista digital, existen otras que son basadas en un\r\nblog, y hacen publicaciones periódicas de sus artículos reseñados en\r\ndichos blogs, como ejemplo de este tipo de revistas podemos observar la\r\nfigura 9, la cual nos muestra el blog educativo tecnológico “Nonprofit Tech”,\r\nque posee una gran cantidad de noticias, artículos y proyectos publicados y\r\nse muestran en el paradigma de Revista Digital.\r\n</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t\t\r\n\t\t\t<p>\r\n\t\t\t\t</p><div>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO</p>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<p>\r\n\t\t\t\r\n\t\t\t</p><div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<p>Figura 9 – Revista “Nonprofit tech”\r\n</p>\r\n\t\t\t\t\t<p>También poseen revistas digitales tecnológicas ciertas universidades\r\ne institutos tecnológicos educativos, en las cuales muestran las\r\ninvestigaciones y proyectos creados o culminados durante el transcurso del\r\ntiempo entre números de su revista digital, para ejemplificarlo, se tiene la\r\nrevista de la Universidad Nacional Autónoma de México, (UNAM), llamada\r\nRevista Digital Universitaria, la cual se estableció y publico su primer\r\nnumero en marzo del año 2000, cuando se realizaban cuatro entregas\r\nanuales, a partir del año 2003, esta revista comenzó a tener una\r\nperiodicidad de un mes en sus publicaciones, donde cada mes se hablaba\r\nde un tipo de estudio según fuera el interés en dicho mes. En la Figura 10\r\npodemos observar la revista digital universitaria de la UNAM.\r\n</p>\r\n\t\t\t\t\t<p>ESTUDIO TEÓRICO PARA LA CONSTRUCCIÓN DE UNA REVISTA DIGITAL UTILIZANDO TECNOLOGÍAS WEB Y SISTEMAS MANEJADORES\r\nDE CONTENIDO.</p></div></div><div><div>\r\n\t\t\t\t<p></p>\r\n\t\t\t</div>\r\n\t\t</div><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;"><ul><li><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;"><strike></strike></span></li></ul></span><p></p>\r\n	Artículo 3 copiado de un pdf	text/html	DB
19	14	<h1>PRUEBA</h1><p></p><p><img src="../../files/f6a2f00d6194ae1062359a535b66f931.jpg" style=""></p><br><p></p><p></p>\r\n	prueba	text/html	DB
\.


--
-- TOC entry 2065 (class 0 OID 17320)
-- Dependencies: 177
-- Data for Name: papers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY papers (id, name, created, modified, evaluation_type, status) FROM stdin;
10	articulo 1	2013-08-15 02:59:25	2013-08-19 02:39:08	BLIND	PUBLISHED
12	Artículo para revista 2	2013-09-02 18:29:17	2013-09-02 18:29:17	BLIND	SENT
13	Artículo 3 copiado de un pdf	2013-09-02 18:32:04	2013-09-02 18:32:04	BLIND	SENT
14	prueba	2013-09-03 03:27:30	2013-09-04 01:26:39	BLIND	UNSENT
11	Artículo para revista 1	2013-09-02 18:28:03	2014-10-27 22:00:39	BLIND	ONREVISION
\.


--
-- TOC entry 2066 (class 0 OID 17328)
-- Dependencies: 179
-- Data for Name: reader_comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY reader_comments (id, magazine_id, reader_id, comment, created, status) FROM stdin;
\.


--
-- TOC entry 2067 (class 0 OID 17336)
-- Dependencies: 181
-- Data for Name: readers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY readers (id, user_id) FROM stdin;
\.


--
-- TOC entry 2068 (class 0 OID 17342)
-- Dependencies: 183
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id, username, email, password, role, created, modified, last_login, first_name, last_name, tokenhash) FROM stdin;
1	ale	alejandro.pardo.r@gmail.com	f6caa9aaf55160618260aac07fab499a70e8e941	admin	2013-06-29 15:43:00	2013-07-10 16:22:29	2013-07-02 19:14:10	Alejandro	Pardo	1b8fb4d1830b5cea8564c11e61c981fb50d34576
2	author	author@laclomag.com	f6caa9aaf55160618260aac07fab499a70e8e941	author	2013-06-29 15:43:00	2013-09-04 01:25:23	2013-09-04 01:25:23	Test	Author	384b05616ce2e1c3495c82573aa388e4fbfdfa85a4329453f2e6abe96c10f00485c81adf61851c2ce66cbb295d2addd2715eb9e5c2c4948bd6263a97cc425fd2
4	evaluator	evaluator@laclomag.com	f6caa9aaf55160618260aac07fab499a70e8e941	evaluator	2013-08-19 01:21:00	2013-09-02 18:32:56	2013-09-02 18:32:56	test	evaluator	\N
3	editor	editor@laclomag.com	f6caa9aaf55160618260aac07fab499a70e8e941	editor	2013-06-29 15:43:00	2014-10-27 19:25:29	2014-10-27 19:25:29	Test	Editor	384b05616ce2e1c3495c82573aa388e4fbfdfa85a4329453f2e6abe96c10f00485c81adf61851c2ce66cbb295d2addd2715eb9e5c2c4948bd6263a97cc425fd2
\.


--
-- TOC entry 1982 (class 2606 OID 17354)
-- Dependencies: 143 143
-- Name: admins_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY admins
    ADD CONSTRAINT admins_pkey PRIMARY KEY (id);


--
-- TOC entry 1984 (class 2606 OID 17356)
-- Dependencies: 145 145
-- Name: authors_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authors
    ADD CONSTRAINT authors_pkey PRIMARY KEY (id);


--
-- TOC entry 1986 (class 2606 OID 17358)
-- Dependencies: 147 147
-- Name: editors_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY editors
    ADD CONSTRAINT editors_pkey PRIMARY KEY (id);


--
-- TOC entry 1988 (class 2606 OID 17360)
-- Dependencies: 149 149
-- Name: evaluators_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY evaluators
    ADD CONSTRAINT evaluators_pkey PRIMARY KEY (id);


--
-- TOC entry 1990 (class 2606 OID 17362)
-- Dependencies: 151 151
-- Name: logbooks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY logbooks
    ADD CONSTRAINT logbooks_pkey PRIMARY KEY (id);


--
-- TOC entry 1992 (class 2606 OID 17364)
-- Dependencies: 153 153
-- Name: magazine_editors_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY magazine_editors
    ADD CONSTRAINT magazine_editors_pkey PRIMARY KEY (id);


--
-- TOC entry 1994 (class 2606 OID 17366)
-- Dependencies: 155 155
-- Name: magazine_files_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY magazine_files
    ADD CONSTRAINT magazine_files_pkey PRIMARY KEY (id);


--
-- TOC entry 1996 (class 2606 OID 17368)
-- Dependencies: 157 157
-- Name: magazine_papers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY magazine_papers
    ADD CONSTRAINT magazine_papers_pkey PRIMARY KEY (id);


--
-- TOC entry 1998 (class 2606 OID 17370)
-- Dependencies: 159 159
-- Name: magazines_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY magazines
    ADD CONSTRAINT magazines_pkey PRIMARY KEY (id);


--
-- TOC entry 2000 (class 2606 OID 17372)
-- Dependencies: 161 161
-- Name: mapped_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mapped_messages
    ADD CONSTRAINT mapped_messages_pkey PRIMARY KEY (id);


--
-- TOC entry 2002 (class 2606 OID 17374)
-- Dependencies: 163 163
-- Name: messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY messages
    ADD CONSTRAINT messages_pkey PRIMARY KEY (id);


--
-- TOC entry 2004 (class 2606 OID 17376)
-- Dependencies: 165 165
-- Name: news_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- TOC entry 2006 (class 2606 OID 17378)
-- Dependencies: 167 167
-- Name: paper_authors_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY paper_authors
    ADD CONSTRAINT paper_authors_pkey PRIMARY KEY (id);


--
-- TOC entry 2008 (class 2606 OID 17380)
-- Dependencies: 169 169
-- Name: paper_comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY paper_comments
    ADD CONSTRAINT paper_comments_pkey PRIMARY KEY (id);


--
-- TOC entry 2010 (class 2606 OID 17382)
-- Dependencies: 171 171
-- Name: paper_editors_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY paper_editors
    ADD CONSTRAINT paper_editors_pkey PRIMARY KEY (id);


--
-- TOC entry 2012 (class 2606 OID 17384)
-- Dependencies: 173 173
-- Name: paper_evaluators_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY paper_evaluators
    ADD CONSTRAINT paper_evaluators_pkey PRIMARY KEY (id);


--
-- TOC entry 2014 (class 2606 OID 17386)
-- Dependencies: 175 175
-- Name: paper_files_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY paper_files
    ADD CONSTRAINT paper_files_pkey PRIMARY KEY (id);


--
-- TOC entry 2016 (class 2606 OID 17388)
-- Dependencies: 177 177
-- Name: papers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY papers
    ADD CONSTRAINT papers_pkey PRIMARY KEY (id);


--
-- TOC entry 2018 (class 2606 OID 17390)
-- Dependencies: 179 179
-- Name: reader_comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY reader_comments
    ADD CONSTRAINT reader_comments_pkey PRIMARY KEY (id);


--
-- TOC entry 2020 (class 2606 OID 17392)
-- Dependencies: 181 181
-- Name: readers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY readers
    ADD CONSTRAINT readers_pkey PRIMARY KEY (id);


--
-- TOC entry 2022 (class 2606 OID 17394)
-- Dependencies: 183 183
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 2024 (class 2606 OID 17396)
-- Dependencies: 183 183 183 183
-- Name: users_username_id_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_username_id_email_key UNIQUE (username, id, email);


--
-- TOC entry 2025 (class 2606 OID 17397)
-- Dependencies: 2021 143 183
-- Name: admins_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY admins
    ADD CONSTRAINT admins_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2026 (class 2606 OID 17402)
-- Dependencies: 145 2021 183
-- Name: authors_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authors
    ADD CONSTRAINT authors_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2027 (class 2606 OID 17407)
-- Dependencies: 2021 147 183
-- Name: editors_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY editors
    ADD CONSTRAINT editors_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2028 (class 2606 OID 17412)
-- Dependencies: 183 149 2021
-- Name: evaluators_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluators
    ADD CONSTRAINT evaluators_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2029 (class 2606 OID 17417)
-- Dependencies: 1985 153 147
-- Name: magazine_editors_editor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY magazine_editors
    ADD CONSTRAINT magazine_editors_editor_id_fkey FOREIGN KEY (editor_id) REFERENCES editors(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2030 (class 2606 OID 17422)
-- Dependencies: 153 1997 159
-- Name: magazine_editors_magazine_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY magazine_editors
    ADD CONSTRAINT magazine_editors_magazine_id_fkey FOREIGN KEY (magazine_id) REFERENCES magazines(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2031 (class 2606 OID 17427)
-- Dependencies: 155 159 1997
-- Name: magazine_files_magazine_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY magazine_files
    ADD CONSTRAINT magazine_files_magazine_id_fkey FOREIGN KEY (magazine_id) REFERENCES magazines(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2032 (class 2606 OID 17432)
-- Dependencies: 1997 159 157
-- Name: magazine_papers_magazine_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY magazine_papers
    ADD CONSTRAINT magazine_papers_magazine_id_fkey FOREIGN KEY (magazine_id) REFERENCES magazines(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2033 (class 2606 OID 17437)
-- Dependencies: 2015 157 177
-- Name: magazine_papers_paper_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY magazine_papers
    ADD CONSTRAINT magazine_papers_paper_id_fkey FOREIGN KEY (paper_id) REFERENCES papers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2034 (class 2606 OID 17442)
-- Dependencies: 2001 161 163
-- Name: mapped_messages_message_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mapped_messages
    ADD CONSTRAINT mapped_messages_message_id_fkey FOREIGN KEY (message_id) REFERENCES messages(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2035 (class 2606 OID 17447)
-- Dependencies: 183 2021 161
-- Name: mapped_messages_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mapped_messages
    ADD CONSTRAINT mapped_messages_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2036 (class 2606 OID 17452)
-- Dependencies: 145 167 1983
-- Name: paper_authors_author_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_authors
    ADD CONSTRAINT paper_authors_author_id_fkey FOREIGN KEY (author_id) REFERENCES authors(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2037 (class 2606 OID 17457)
-- Dependencies: 167 2015 177
-- Name: paper_authors_paper_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_authors
    ADD CONSTRAINT paper_authors_paper_id_fkey FOREIGN KEY (paper_id) REFERENCES papers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2038 (class 2606 OID 17462)
-- Dependencies: 169 1987 149
-- Name: paper_comments_evaluator_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_comments
    ADD CONSTRAINT paper_comments_evaluator_id_fkey FOREIGN KEY (evaluator_id) REFERENCES evaluators(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2039 (class 2606 OID 17467)
-- Dependencies: 169 177 2015
-- Name: paper_comments_paper_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_comments
    ADD CONSTRAINT paper_comments_paper_id_fkey FOREIGN KEY (paper_id) REFERENCES papers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2040 (class 2606 OID 17472)
-- Dependencies: 1985 171 147
-- Name: paper_editors_editor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_editors
    ADD CONSTRAINT paper_editors_editor_id_fkey FOREIGN KEY (editor_id) REFERENCES editors(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2041 (class 2606 OID 17477)
-- Dependencies: 171 177 2015
-- Name: paper_editors_paper_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_editors
    ADD CONSTRAINT paper_editors_paper_id_fkey FOREIGN KEY (paper_id) REFERENCES papers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2043 (class 2606 OID 17561)
-- Dependencies: 149 1987 173
-- Name: paper_evaluators_evaluator_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_evaluators
    ADD CONSTRAINT paper_evaluators_evaluator_id_fkey FOREIGN KEY (evaluator_id) REFERENCES evaluators(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2042 (class 2606 OID 17556)
-- Dependencies: 173 177 2015
-- Name: paper_evaluators_paper_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_evaluators
    ADD CONSTRAINT paper_evaluators_paper_id_fkey FOREIGN KEY (paper_id) REFERENCES papers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2044 (class 2606 OID 17492)
-- Dependencies: 177 175 2015
-- Name: paper_files_paper_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paper_files
    ADD CONSTRAINT paper_files_paper_id_fkey FOREIGN KEY (paper_id) REFERENCES papers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2045 (class 2606 OID 17497)
-- Dependencies: 159 1997 179
-- Name: reader_comments_magazine_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reader_comments
    ADD CONSTRAINT reader_comments_magazine_id_fkey FOREIGN KEY (magazine_id) REFERENCES magazines(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2046 (class 2606 OID 17502)
-- Dependencies: 179 2019 181
-- Name: reader_comments_reader_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reader_comments
    ADD CONSTRAINT reader_comments_reader_id_fkey FOREIGN KEY (reader_id) REFERENCES readers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2047 (class 2606 OID 17507)
-- Dependencies: 181 2021 183
-- Name: readers_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY readers
    ADD CONSTRAINT readers_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id);


--
-- TOC entry 2073 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2014-10-27 17:32:45

--
-- PostgreSQL database dump complete
--

