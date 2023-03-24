<?php
session_start();
if (isset($_POST['nazad'])) {
	header('location:index.php');
}
if (isset($_POST['dobavit'])) {
	$zagolovok = $_POST['zagolovok'];
	$text = $_POST['text'];
	$zagolovok = trim($zagolovok);
	$text = trim($text);
	$data = date("Y-m-d");
	if ((strlen($zagolovok) == 0) && (strlen($text) == 0)) {
		header('location:index.php');
	}
	else{
		if (strlen($zagolovok) == 0) {
			$zagolovok="";
		}
		if (strlen($text) == 0) {
			$text="";
		}
		$dbs="mysql:host=localhost;dbname=zadanie";
		$db = new PDO($dbs,"root","");
		$res = $db->query("INSERT INTO zametka (id,zagolovok,text,status,data) VALUES (null,'$zagolovok','$text',0,'$data')");
		header('location:index.php');
	}
}
?>