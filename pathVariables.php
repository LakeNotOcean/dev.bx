<?php

$homeworkPath = './homework-5';
const ROOT = __DIR__;

$httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https';
$baseURL = $httpProtocol . '://' . $_SERVER['HTTP_HOST'] . '/';

$searchIconPath = "${homeworkPath}/assets/icons/search1.svg";
$sidebarLogoPath = "${homeworkPath}/assets/icons/Bitflix.svg";
$moviesImagePath = "${homeworkPath}/assets/img";
$clockImagePath = "${homeworkPath}/assets/icons/clock1.svg";
$favIconsPath = "${homeworkPath}/assets/icons/favIcons/";

$pagesPath = "${homeworkPath}/pages";

