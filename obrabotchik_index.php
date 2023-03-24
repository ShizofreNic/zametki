<?php
session_start();
if (isset($_POST['dobavlenie'])){
	header('location:dobavlenie.php');
}
if (isset($_POST['udalit'])) {
	$_SESSION['udalenie'] = 1;
	$_SESSION['id'] = $_POST['id_zapisi'];
	header('location:index.php');
}
if (isset($_POST['zakrep'])) {
	$id_zapisi = $_POST['id_zapisi'];
	$_SESSION['zakrep'] = 1;
	$dbs="mysql:host=localhost;dbname=zadanie";
	$db = new PDO($dbs,"root","");
	$res = $db->query("SELECT * FROM zametka WHERE id ='$id_zapisi'");
	$myrrow = $res->fetch();
	if ($myrrow['status'] == 0) {
		$_SESSION['status'] = 0;
	}
	else{
		$_SESSION['status'] = 1;
	}
	$_SESSION['id'] = $_POST['id_zapisi'];
	header('location:index.php');
}
if (isset($_POST['udalenie_da'])) {
	$id_zapisi = $_SESSION['id'];
	$dbs="mysql:host=localhost;dbname=zadanie";
	$db = new PDO($dbs,"root","");
	$res = $db->query("DELETE FROM zametka WHERE id = '$id_zapisi'");
	unset($_SESSION['udalenie']);
	header('location:index.php');
}
if (isset($_POST['udalenie_net'])) {
	unset($_SESSION['udalenie']);
	unset($_SESSION['id']);
	header('location:index.php');
}
if (isset($_POST['zakreplenie_da'])) {
	$id_zapisi = $_SESSION['id'];
	$status = $_SESSION['status'];
	$dbs="mysql:host=localhost;dbname=zadanie";
	$db = new PDO($dbs,"root","");
	if ($status == 1) {
		$res = $db->query("UPDATE zametka SET status = 0 WHERE id = '$id_zapisi'");
	}
	else{
		$res = $db->query("UPDATE zametka SET status = 1 WHERE id = '$id_zapisi'");
	}
	unset($_SESSION['zakrep']);
	header('location:index.php');
}
if (isset($_POST['zakreplenie_net'])) {
	unset($_SESSION['zakrep']);
	unset($_SESSION['id']);
	unset($_SESSION['status']);
	header('location:index.php');
}
if (isset($_POST['zapis'])) {
	$id = $_POST['zapis'];
	$_SESSION['id']= $id;
	$dbs="mysql:host=localhost;dbname=zadanie";
	$db = new PDO($dbs,"root","");
	$res = $db->query("SELECT * FROM zametka WHERE id = '$id'");
	$myrrow = $res ->fetch();
	$_SESSION['kolichestvo_1'] = substr_count($myrrow['zagolovok'],"\n");
	$_SESSION['kolichestvo_2'] = substr_count($myrrow['text'],"\n");
	header('location:redaktirovanie.php');
}
?>