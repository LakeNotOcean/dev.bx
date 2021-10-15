<?php
include "ReadConsoleData.php";
include "./movies/movies.php";
include "PrintConsoleData.php";


function printMoviesOnAgeRestriction()
{
	printHelloMessage("Добро пожаловать в базу данных фильмов!");
	while(true)
	{
		$personAge=readIntData("Введите возраст: ",
						 "Возраст должен быть неотрицательным целым числом!",0);
		foreach (MOVIES_LIST as $movie)
		{
			if ($movie["age_restriction" ]<=$personAge)
				printObjectGeneral(formatMovieString($movie));
		}
	}
}

function formatMovieString(&$movie):string
{
	return "{$movie["title"]} ({$movie['release_year']}), {$movie['age_restriction']}+ Rating - {$movie['rating']}";
}