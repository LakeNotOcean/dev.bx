<?php

/** @var array $movies */
/** @var string $homeworkPath */
/** @var string $clockImagePath */
/** @var string $moviesImagePath */
/** @var array $genres */
/** @var string $searchBarLayout */

require_once dirname(__FILE__) . "/../../pathVariables.php";
require_once ROOT . "${homeworkPath}/lib/template-functions.php";
require_once ROOT . "${homeworkPath}/data/movies.php";
require_once ROOT . "${homeworkPath}/lib/help-functions.php";
require_once ROOT . "${homeworkPath}/data/genres.php";
require_once ROOT . "${homeworkPath}/data/generatedLayouts.php";

if (is_null($searchBarLayout))
{
	$searchBarLayout = renderSearchBarLayout();
}

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

echo renderFullPageWithContent($menuLayout, $searchBarLayout, $movieDetailLayout);


