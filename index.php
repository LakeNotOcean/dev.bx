<?php

/** @var array $movies */
/** @var string $homeworkPath */
/** @var string $clockImagePath */
/** @var string $moviesImagePath */
/** @var array $genres */
/** @var string $searchBarLayout */

require_once dirname(__FILE__) . '/pathVariables.php';
require_once ROOT . "${homeworkPath}/lib/template-functions.php";
require_once ROOT . "${homeworkPath}/data/movies.php";
require_once ROOT . "${homeworkPath}/lib/help-functions.php";
require_once ROOT . "${homeworkPath}/data/genres.php";
require_once ROOT . "${homeworkPath}/data/generatedLayouts.php";

$currentActiveTitle = 'main';

if (isset($_GET['genre']))
{
	$genre = $genres[$_GET['genre']];
	if (!empty($genre))
	{
		$movies = getMoviesByGenre($movies, $genre);
		$currentActiveTitle = $_GET['genre'];
	}
}
elseif (isset($_GET['search']))
{
	$search = $_GET['search'];
	$movies = searchMoviesByTitle($movies, $search);
}

$menuLayout = renderMenuLayout($currentActiveTitle);
if (is_null($searchBarLayout))
{
	$searchBarLayout = renderSearchBarLayout();
}

if (!empty($movies))
{
	$content = renderTemplate(getLayoutPathName("moviesLayout.php"), [
		'movies' =>
			$movies,
		'clockImagePath' => $clockImagePath,
		'moviesImagePath' => $moviesImagePath,
	]);
}
else
{
	$content = "Нет подходящих фильмов";
}

echo renderFullPageWithContent($menuLayout, $searchBarLayout, $content);








