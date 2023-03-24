<?php
session_start();
if (isset($_SESSION['id'])) {
	$id = $_SESSION['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Редактирование</title>
	<link rel="stylesheet" type="text/css" href="CSS/redakritovanie.css">
</head>
<body>
	<div class="wrap">
		<form style="width: 100%;" method="POST" action="obrabotchk_redaktirovanie.php">
			<div class="header" method="POST" action="obrabotchk_dobavlenie.php">
				<div style="width: 50%; text-align: left;"><button name="nazad"><b><</b> Заметки</button></div>
				<div style="width: 50%; text-align: right;"><button name="dobavit">Готово</button></div>
			</div>
			<div class="conteiner_kontent">
				<?php 
					$dbs="mysql:host=localhost;dbname=zadanie";
					$db = new PDO($dbs,"root","");
					$res = $db->query("SELECT * FROM zametka WHERE id='$id;'");
					$myrrow=$res->fetch();
					if (strlen(trim($myrrow['zagolovok'])) != 0) $zagolovok = $myrrow['zagolovok'];
					if (strlen(trim($myrrow['text'])) != 0) $text = $myrrow['text'];
					$zagolovok = trim($zagolovok);
					$text = trim($text);
				?>
					<textarea maxlength="200" rows="<?php echo $_SESSION['kolichestvo_1'];?>" name="zagolovok"><?php echo $zagolovok?></textarea>
					<textarea maxlength="5000" rows="<?php echo $_SESSION['kolichestvo_2'];?>" style="font-size: 120%;" name="text"><?php echo $text?></textarea>
			</div>
		</form>
		<div style="color:#a8a8a8; text-align: center;">
			<?php
			$res = $db->query("SELECT data FROM zametka WHERE id='$id;'");
			$data = $res->fetch();
			$source = $data['data'];
			$data = new DateTime ($source);
			$mesaci = ["января", "февраля", "марта","апреля","мая","июня","июля","авуста","сентября","октября","ноября","декабря"];
			$den = $data -> format("j");
			$mes = $mesaci[($data->format("n"))-1];
			$god = $data -> format("Y");
			echo $den." ".$mes." ".$god." г";
			// echo $data['data'];
			?>
		</div>
	</div>
	
</body>
<script type="text/javascript">
		var soderjimoe_all = document.querySelectorAll("textarea");
		soderjimoe_all.forEach(soderjimoe => {
		soderjimoe.addEventListener("keyup",e =>{
		soderjimoe.style.height ="auto";
		let scHeight = e.target.scrollHeight;
		soderjimoe.style.height = `${scHeight}px`;
		});
		});
</script>
</html>