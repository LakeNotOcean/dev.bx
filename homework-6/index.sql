# 1. Вывести список фильмов, в которых снимались одновременно Арнольд Шварценеггер* и Линда Хэмилтон*.
#   Формат: ID фильма, Название на русском языке, Имя режиссёра.

SELECT m.ID,
       mt.TITLE,
       d.NAME
FROM movie m
	     LEFT JOIN movie_title mt on m.ID = mt.MOVIE_ID
	     LEFT JOIN director d on m.DIRECTOR_ID = d.ID
WHERE mt.LANGUAGE_ID = 'ru'
  AND m.ID IN (SELECT m.ID
               from movie m
	                    LEFT JOIN movie_actor ma on m.ID = ma.MOVIE_ID
	                    LEFT JOIN actor a on ma.ACTOR_ID = a.ID
               WHERE a.NAME = 'Арнольд Шварценеггер'
	              OR a.NAME = 'Линда Хэмилтон'
               GROUP BY m.ID
               HAVING COUNT(m.ID) = 2);



# 2. Вывести список названий фильмов на англйском языке с "откатом" на русский, в случае если название на английском не задано.
#    Формат: ID фильма, Название.
#


SELECT m.ID,
       mt.TITLE
FROM movie m
	     LEFT JOIN movie_title mt on m.ID = mt.MOVIE_ID
WHERE mt.LANGUAGE_ID = 'en'
UNION
SELECT m.ID,
       mt.TITLE
FROM movie m
	     LEFT JOIN movie_title mt on m.ID = mt.MOVIE_ID
WHERE mt.LANGUAGE_ID = 'ru'
  AND m.ID NOT IN (SELECT m.ID
                   FROM movie m
	                        LEFT JOIN movie_title mt on m.ID = mt.MOVIE_ID
                   WHERE mt.LANGUAGE_ID = 'en');

# 3. Вывести самый длительный фильм Джеймса Кэмерона*.
#  Формат: ID фильма, Название на русском языке, Длительность.
# (Бонус – без использования подзапросов)

SELECT m.ID,
       mt.TITLE,
       m.LENGTH
FROM movie m
	     left join
     director d on m.DIRECTOR_ID = d.ID
	     left join
     movie_title mt on m.ID = mt.MOVIE_ID
WHERE mt.LANGUAGE_ID = 'ru'
  AND d.NAME = 'Джеймс Кэмерон'
HAVING max(m.LENGTH);

# 4. ** Вывести список фильмов с названием, сокращённым до 10 символов. Если название короче 10 символов – оставляем как есть. Если длиннее – сокращаем до 10 символов и добавляем многоточие.
#  Формат: ID фильма, сокращённое название

SELECT m.ID,
       IF(CHAR_LENGTH(mt.TITLE) > 10, CONCAT(SUBSTR(mt.TITLE, 1, 10), '...'), mt.TITLE) as TITLE
FROM movie m
	     LEFT JOIN movie_title mt on m.ID = mt.MOVIE_ID
where mt.LANGUAGE_ID = 'ru'
ORDER BY m.ID;

# 5. Вывести количество фильмов, в которых снимался каждый актёр.
#    Формат: Имя актёра, Количество фильмов актёра.

SELECT a.NAME,
       COUNT(m.ID)
FROM actor a
	     LEFT JOIN movie_actor ma on a.ID = ma.ACTOR_ID
	     LEFT JOIN movie m on ma.MOVIE_ID = m.ID
GROUP BY a.ID
ORDER BY COUNT(m.ID) DESC;


# 6. Вывести жанры, в которых никогда не снимался Арнольд Шварценеггер*.
#   Формат: ID жанра, название

SELECT g.ID,
       g.NAME
FROM genre g
WHERE g.ID NOT IN
      (SELECT DISTINCT mg.GENRE_ID
       FROM actor a
	            LEFT JOIN movie_actor ma on a.ID = ma.ACTOR_ID
	            LEFT JOIN movie m on ma.MOVIE_ID = m.ID
	            LEFT JOIN movie_genre mg on m.ID = mg.MOVIE_ID
       WHERE a.NAME = 'Арнольд Шварценеггер');

# 7. Вывести список фильмов, у которых больше 3-х жанров.
#   Формат: ID фильма, название на русском языке

SELECT m.ID,
       mt.TITLE
FROM movie m
	     LEFT JOIN movie_genre mg on m.ID = mg.MOVIE_ID
	     LEFT JOIN movie_title mt on m.ID = mt.MOVIE_ID
WHERE LANGUAGE_ID = 'ru'
GROUP BY m.ID
HAVING COUNT(mg.GENRE_ID) > 3;

# 8. Вывести самый популярный жанр для каждого актёра.
# Формат вывода: Имя актёра, Жанр, в котором у актёра больше всего фильмов.


SELECT
	prev.actorName,
    prev.genreName
FROM
(SELECT a.ID,
       a.NAME as actorName,
       mg.GENRE_ID,
       g.NAME as genreName,
       COUNT(mg.GENRE_ID) as countGenres
FROM actor a
	     LEFT JOIN movie_actor ma on a.ID = ma.ACTOR_ID
	     LEFT JOIN movie_genre mg on ma.MOVIE_ID = mg.MOVIE_ID
	     LEFT JOIN genre g on mg.GENRE_ID = g.ID
group by a.ID, mg.GENRE_ID ORDER BY countGenres desc) as prev group by prev.ID
