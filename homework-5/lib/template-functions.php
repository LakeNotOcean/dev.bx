<?php

/** @var array $menuConstItems */
/** @var array $genres */


require_once "../data/genres.php";
require_once "../config/menu.php";
require_once "../lib/help-functions.php";

function renderTemplate(string $path, array $templateData = []): string
{
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


function renderFullPageWithContent(string $menuLayout, string $content): string
{
	$data = [
		'content' => $content,
		'menuLayout' => $menuLayout,
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
	];
	return renderTemplate(getLayoutPathName('movieDetailLayout.php'), $data);
}
