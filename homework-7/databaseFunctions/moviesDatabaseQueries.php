<?php

require_once '../config/config.php';
require_once "../lib/help-functions.php";

function getGenresList(mysqli $database): array
{
	$query = "SELECT * FROM genre";
	$result = mysqli_query($database, $query);
	if (!$result)
	{
		trigger_error($database->error, E_USER_ERROR);
	}
	$rowData = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return formatDatabaseRawData($rowData, 'ID');
}

function getMoviesList(mysqli $database, array $genreList, int $genreCode = -1): array
{
	$genreSelector="";
	if ($genreCode>0)
		$genreSelector="inner join movie_genre mg on m.ID=mg.MOVIE_ID WHERE mg.GENRE_ID={$genreCode}";
	{
		$query = "SELECT  m.ID,m.TITLE,m.ORIGINAL_TITLE,m.DESCRIPTION,m.DURATION,
       m.AGE_RESTRICTION,m.RELEASE_DATE,m.RATING,d.NAME,
       (SELECT  GROUP_CONCAT(mg.GENRE_ID)
           FROM movie_genre mg WHERE mg.MOVIE_ID=m.ID) as GENRES,
       (SELECT  GROUP_CONCAT(ma.ACTOR_ID)
           FROM movie_actor ma WHERE ma.MOVIE_ID=m.ID) as MOVIE_ACTOR
		FROM 
		movie m inner join director d on m.DIRECTOR_ID = d.ID ".$genreSelector;
	}

	$result = mysqli_query($database, $query);
	if (!$result)
	{
		trigger_error($database->error, E_USER_ERROR);
	}
	$rowData = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return formatDatabaseRawDataMovies($rowData,$genreList);
}

