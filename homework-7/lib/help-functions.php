<?php

require_once "../databaseFunctions/moviesDatabaseQueries.php";
require_once "../config/constants.php";

function getLayoutPathName(string $layoutName): string
{
	return "../layouts/${layoutName}";
}

function formatDurationForHoursAndMinutes(int $durationInMinutes): string
{
	$hours = str_pad(floor($durationInMinutes / 60), 2, '0', STR_PAD_LEFT);
	$minutes = str_pad($durationInMinutes % 60, 2, '0', STR_PAD_LEFT);

	return "${durationInMinutes} мин. / ${hours}:${minutes}";
}

function formatDatabaseRawData(array $data, string $keyName): array
{
	$result = [];
	foreach ($data as $row)
	{
		$keyValue = strval($row[$keyName]);
		$result[$keyValue] = [];
		foreach ($row as $key => $value)
		{
			if ($key !== $keyName)
			{
				$result[$keyValue][$key] = $value;
			}
		}
	}
	return $result;
}

function changeIdsOnNames(array $moviesData, array $namesData, string $movieKeyName, string $recordName): array
{
	foreach ($moviesData as &$movie)
	{
		$namesIdList = array_map('intval', explode(',', $movie[$movieKeyName]));
		$movie[$movieKeyName] = [];
		foreach ($namesIdList as $id)
		{
			$movie[$movieKeyName][] = $namesData[$id][$recordName];
		}
	}
	return $moviesData;
}

