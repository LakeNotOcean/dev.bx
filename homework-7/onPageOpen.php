<?php

require_once "../databaseFunctions/connectToDataBase.php";
require_once "../config/config.php";
require_once "../config/constants.php";

$database = connectToDataBase(databaseConfig);

$genres = getGenresList($database);


