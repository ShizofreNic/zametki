<?php
session_start();
if (isset($_POST['nazad'])) {
	unset($_SESSION['id']);
	unset($_SESSION['kolichestvo_1']);
	unset($_SESSION['kolichestvo_2']);
	header('location:index.php');
}
if (isset($_POST['dobavit'])) {
	$id = $_SESSION['id'];
	$zagolovok = $_POST['zagolovok'];
	$text = $_POST['text'];
	$zagolovok = trim($zagolovok);
	$text = trim($text);
	$data = date("Y-m-d");
	if ((strlen($zagolovok) == 0) && (strlen($text) == 0)) {
		$dbs="mysql:host=localhost;dbname=zadanie";
		$db = new PDO($dbs,"root","");
		$res = $db->query("DELETE FROM zametka WHERE id='$id'");
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
		$res = $db->query("SELECT * FROM zametka WHERE zagolovok='$zagolovok' AND text = '$text' AND id='$id'");
		$row = $res->fetch();
		if ($row == 0) {
			$res = $db->query("UPDATE zametka SET zagolovok='$zagolovok',text='$text',data='$data' WHERE id='$id'");
		}
		header('location:index.php');
	}
}
?>