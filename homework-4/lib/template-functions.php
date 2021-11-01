<?php

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


function renderLayout(array $templateData=[]):string
{
	return renderTemplate('./homework-4/pages/layout.php',$templateData);
}