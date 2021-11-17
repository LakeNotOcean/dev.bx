<?php

/** @var array $movies */
/** @var array $genres */

require_once "../lib/template-functions.php";
require_once "../data/movies.php";
require_once "../lib/help-functions.php";
require_once "../data/genres.php";

$menuLayout = renderMenuLayout('main');
$movieDetailLayout = "Фильм с запрошенным id отсутствует в базе данных";

if (isset($_GET['id']))
{
	$movie = getMovieById($movies, $_GET['id']);

	if (!empty($movie))
	{
		$movieDetailLayout = renderMovieDetailLayout($movie);
	}
}

echo renderFullPageWithContent($menuLayout, $movieDetailLayout);


