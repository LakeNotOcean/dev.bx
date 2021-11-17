<?php

/** @var array $movies */
/** @var array $genres */
/**    @var mysqli $database */

require_once "../lib/template-functions.php";
require_once "../lib/help-functions.php";
require_once "../onFirstOpen.php";
require_once "../databaseFunctions/moviesDatabaseQueries.php";

$menuLayout = renderMenuLayout('main', $genres);
$movieDetailLayout = "Фильм с запрошенным id отсутствует в базе данных";

if (isset($_GET[getMovieIdStr]))
{
	$movie = getMovieById($database, $_GET[getMovieIdStr]);

	if (!empty($movie))
	{
		$movieDetailLayout = renderMovieDetailLayout($movie);
	}
}

echo renderFullPageWithContent($menuLayout, $movieDetailLayout);


