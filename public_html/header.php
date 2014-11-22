<? include_once("functions.php"); ?>
<!doctype html>
<html>
<head>
<? if (isset_notempty($page_title)) {
	$page_title = ": " . $page_title;
} else {
	$page_title = "s";
} ?>
	<title>Audio Demo<?=$page_title?></title>
	<meta charset="utf-8" />
	<link href="./assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<main>


<?
/* */ // end of file