/*Требуент наличия справочника языка и начальной таблицы
  фильмов*/

INSERT INTO language (ID, NAME)
VALUES ('ru', 'Russian'),
       ('en', 'English'),
       ('de', 'German');

INSERT INTO movie_title (MOVIE_ID, TITLE, LANGUAGE_ID)
SELECT ID, TITLE, 'ru' AS LANGUAGE
FROM movie;


