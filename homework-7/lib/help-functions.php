<?php

function getLayoutPathName(string $layoutName): string
{
	return "../layouts/${layoutName}";
}

function getMoviesByGenre(array $movies, string $genre): array
{
	return array_filter($movies, function ($movie) use ($genre) {
		if (in_array($genre, $movie['genres']))
		{
			return $movie;
		}
	});
}

function getMovieById(array $movies, string $id): array
{
	foreach ($movies as $movie)
	{
		if (strval($movie['id']) === $id)
		{
			return $movie;
		}
	}
	return [];
}

function formatDurationForHoursAndMinutes(int $durationInMinutes): string
{
	$hours = str_pad(floor($durationInMinutes / 60), 2, '0', STR_PAD_LEFT);
	$minutes = str_pad($durationInMinutes % 60, 2, '0', STR_PAD_LEFT);

	return "${durationInMinutes} мин. / ${hours}:${minutes}";
}

function searchMoviesByTitle(array $movies, string $search): array
{
	if ($search === "")
	{
		return $movies;
	}
	return array_filter($movies, function ($movie) use ($search) {
		if (mb_stripos($movie['title'], $search, 0, "UTF-8") !== false)
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
			$movie[mGenres][]=$genreData[$id]['NAME'];
	}
	return $moviesData;
}