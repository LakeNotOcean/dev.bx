<?php


function connectToDataBase(array $connectionSetting):mysqli
{
	$database = mysqli_init();
	$connectionResult = mysqli_real_connect(
		$database,
		$connectionSetting['host'],
		$connectionSetting['username'],
		$connectionSetting['password'],
		$connectionSetting['dbName']
	);
	if (!$connectionResult)
	{
		$error = mysqli_connect_errno() . ": ". mysqli_connect_error();
		trigger_error($error, E_USER_ERROR);
	}
	$charsetResult=mysqli_set_charset($database,'utf8');
	if (!$charsetResult)
	{
		trigger_error($database->error,E_USER_ERROR);
	}
	return $database;
}