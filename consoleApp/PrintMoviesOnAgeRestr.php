<?php
include "ReadConsoleData.php";
include "./movies/movies.php";
include "PrintConsoleData.php";


function printMoviesOnAgeRestr() {
	printHelloMessage("Добро пожаловать в базу данных фильмов!");
	while(true){
		$age=readIntData("Введите возраст: ",
						 "Возраст должен быть неотрицательным целым числом!",0);
		foreach (movies as $movie)
		{
			if ($movie["age_restriction" ]<=$age)
				printObject(formatMovieString($movie));
		}
	}
}

function formatMovieString(&$movie):string{
	return "{$movie["title"]} ({$movie['release_year']}), {$movie['age_restriction']}+ Rating - {$movie['rating']}";
}