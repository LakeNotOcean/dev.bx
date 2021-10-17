<?php
include "ReadConsoleData.php";
include "homework-2/movies/movies.php";
include "PrintConsoleData.php";

function printMoviesOnAgeRestriction()
{
	printHelloMessage("Добро пожаловать в базу данных фильмов!");
	$personAge = readIntData("Введите возраст: ",
		"Возраст должен быть неотрицательным целым числом!", 0);
	$countPrintedMovies = 0;
	foreach (MOVIES_LIST as $movie)
	{
		if ($movie['age_restriction'] <= $personAge)
		{
			++$countPrintedMovies;
			printLine("{$countPrintedMovies}. " . formatMovieString($movie));
		}
	}
	printEndMessage("Вывод завершен");
}

function formatMovieString($movie): string
{
	return "{$movie["title"]} ({$movie['release_year']}), {$movie['age_restriction']}+ Rating - {$movie['rating']}";
}