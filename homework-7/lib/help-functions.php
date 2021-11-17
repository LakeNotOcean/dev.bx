<?php

require_once "../databaseFunctions/moviesDatabaseQueries.php";
require_once "../config/constants.php";

function getLayoutPathName(string $layoutName): string
{
	return "../layouts/${layoutName}";
}


function formatDurationForHoursAndMinutes(int $durationInMinutes): string
{
	$hours = str_pad(floor($durationInMinutes / 60), 2, '0', STR_PAD_LEFT);
	$minutes = str_pad($durationInMinutes % 60, 2, '0', STR_PAD_LEFT);

	return "${durationInMinutes} мин. / ${hours}:${minutes}";
}

function getMoviesByTitle(mysqli $database,string $search): array
{
	$movies=getMoviesList($database);
	return array_filter($movies, function ($movie) use ($search) {
		if (mb_stripos($movie[mTitle], $search, 0, "UTF-8") !== false)
		{
			return $movie;
		}
	});
}

function formatDatabaseRawData(array $data, string $keyName): array
{
	$result = [];
	foreach ($data as $row)
	{
		$keyValue=strval($row[$keyName]);
		$result[$keyValue] = [];
		foreach ($row as $key=>$value)
			if ($key!==$keyName)
				$result[$keyValue][$key]=$value;
	}
	return $result;
}

function formatDatabaseRawDataMovies(array $moviesData,array $genreData):array
{
	foreach($moviesData as &$movie)
	{
		$genreIdList=array_map('intval',explode(',',$movie[mGenres]));
		$movie[mGenres]=[];
		foreach ($genreIdList as $id)
			$movie[mGenres][]=$genreData[$id][gName];
	}
	return $moviesData;
}