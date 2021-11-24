<?php

require_once '../config/config.php';
require_once "../lib/help-functions.php";
require_once "../config/constants.php";
require_once "connectToDataBase.php";

function getGenresList(mysqli $database): array
{
	$query = "SELECT * FROM genre";
	$result = mysqli_query($database, $query);
	if (!$result)
	{
		trigger_error($database->error, E_USER_ERROR);
	}
	$rowData = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return formatDatabaseRawData($rowData, gKeyName);
}

function getMoviesList(mysqli $database, string $addToQuery = ""): array
{
	$query = "SELECT  m.ID,m.TITLE,m.ORIGINAL_TITLE,m.DESCRIPTION,m.DURATION,
       m.AGE_RESTRICTION,m.RELEASE_DATE,m.RATING,d.NAME,
       (SELECT  GROUP_CONCAT(mg.GENRE_ID)
           FROM movie_genre mg WHERE mg.MOVIE_ID=m.ID) as GENRES,
       (SELECT  GROUP_CONCAT(ma.ACTOR_ID)
           FROM movie_actor ma WHERE ma.MOVIE_ID=m.ID) as MOVIE_ACTORS
		FROM 
		movie m inner join director d on m.DIRECTOR_ID = d.ID " . $addToQuery;
	$result = mysqli_query($database, $query);
	if (!$result)
	{
		trigger_error($database->error, E_USER_ERROR);
	}
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getMoviesListOnGenres(mysqli $database, array $genreList, int $genreCode = -1): array
{
	$genreSelector = "";
	if ($genreCode > 0)
	{
		$genreSelector = "inner join movie_genre mg on m.ID=mg.MOVIE_ID WHERE mg.GENRE_ID=$genreCode";
	}
	$rawData = getMoviesList($database, $genreSelector);
	return changeIdsOnNames($rawData, $genreList, mGenres, gName);
}

function getMovieById(mysqli $database, int $movieId): array
{
	if ($movieId <= 0)
	{
		return [];
	}
	$movieSelector = "WHERE m.ID=$movieId";
	$movie = getMoviesList($database, $movieSelector);
	if (empty($movie))
		return [];
	$actors = getActorsListOnMovieId($database, $movieId);
	return changeIdsOnNames($movie, $actors, maNames, aName)[0];
}

function getActorsListOnMovieId(mysqli $database, int $movieId): array
{
	$query = "SELECT a.ID, a.NAME
	FROM movie_actor ma inner join actor a on ma.ACTOR_ID = a.ID WHERE ma.MOVIE_ID=$movieId";
	$result = mysqli_query($database, $query);
	if (!$result)
	{
		trigger_error($database->error, E_USER_ERROR);
	}
	$rowData = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return formatDatabaseRawData($rowData, aID);
}

function getMoviesByTitle(mysqli $database, array $genreList, string $searchStr): array
{
	$searchStr = mysqli_escape_string($database, $searchStr);
	$query = "WHERE LOCATE('{$searchStr}',m.TITLE)!=0";
	return changeIdsOnNames(getMoviesList($database, $query), $genreList, mGenres, gName);
}


