<?php
require_once "../databaseFunctions/connectToDataBase.php";
require_once "../config/config.php";

$database=connectToDataBase(databaseConfig);

$genres=getGenresList($database);
$movies=[];
