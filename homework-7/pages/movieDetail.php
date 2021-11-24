<?php

/** @var array $genres */
/**    @var mysqli $database */

require_once "../lib/template-functions.php";
require_once "../lib/help-functions.php";
require_once "../onPageOpen.php";
require_once "../databaseFunctions/moviesDatabaseQueries.php";


$menuLayout = renderMenuLayout("", $genres);
$movieDetailLayout = "Фильм с запрошенным id отсутствует в базе данных";

if (!empty($_GET[getMovieIdStr]))
{
	$movieId=intval( $_GET[getMovieIdStr]);
	if ($movieId>0)
	{
		$movie = getMovieById($database, $movieId);
	}

	if (!empty($movie))
	{
		$movieDetailLayout = renderMovieDetailLayout($movie);
	}
}

echo renderFullPageWithContent($menuLayout, $movieDetailLayout);


