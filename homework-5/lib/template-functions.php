<?php

/** @var array $menuConstItems */
/** @var array $genres */

/** @var string $searchIconPath */
/** @var string $sidebarLogoPath */
/** @var string $favIconsPath */
/** @var string $moviesImagePath */

/** @var string $homeworkPath */
/** @var string $pagesPath */
/** @var string $baseURL */

require_once dirname(__FILE__) . '/../../pathVariables.php';
require_once ROOT . "${homeworkPath}/data/genres.php";
require_once ROOT . "${homeworkPath}/config/menu.php";
require_once ROOT . "${homeworkPath}/lib/help-functions.php";

function renderTemplate(string $path, array $templateData = []): string
{
	global $homeworkPath, $pagesPath, $baseURL;
	if (!file_exists($path))
	{
		return "";
	}

	extract($templateData, EXTR_OVERWRITE);
	ob_start();

	include $path;

	return ob_get_clean();
}

function renderMenuLayout(string $currentActiveItem): string
{
	global $genres, $menuConstItems;
	return renderTemplate(getLayoutPathName("menuLayout.php"),
		[
			'genreItems' => $genres,
			'currentActiveItem' => $currentActiveItem,
			'menuConstItems' => $menuConstItems,
		]);
}

function renderSearchBarLayout(): string
{
	global $searchIconPath;
	return renderTemplate(getLayoutPathName("searchBarLayout.php"),
		['searchIconPath' => $searchIconPath]);
}

function renderFullPageWithContent(string $menuLayout, string $searchBarLayout, string $content): string
{
	global $sidebarLogoPath;
	$data = [
		'content' => $content,
		'menuLayout' => $menuLayout,
		'headerLayout' => $searchBarLayout,
		'sidebarLogoPath' => $sidebarLogoPath,
	];
	return renderTemplate(getLayoutPathName("layout.php"), $data);
}

function renderMovieDetailLayout(array $movie): string
{
	global $favIconsPath, $moviesImagePath;
	$numbOfActiveRatingSquare = floor($movie['rating']);
	$data = [
		'movie' => $movie,
		'numbOfActiveRatingSquare' => $numbOfActiveRatingSquare,
		'favIconsPath' => $favIconsPath,
		'moviesImagePath' => $moviesImagePath,
	];
	return renderTemplate(getLayoutPathName('movieDetailLayout.php'), $data);
}
