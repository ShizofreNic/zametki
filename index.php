<?php 
session_start();
if (isset($_SESSION['udalenie'])) {
	$udalenie = 1;
}
if (isset($_SESSION['zakrep'])) {
	$zakrep = 1;
}
if (isset($_SESSION['status'])) {
	$status = $_SESSION['status'];
}
else{
	$status = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Главная</title>
	<link rel="stylesheet" type="text/css" href="CSS/index.css">
</head>
<body>
	<?php if(($udalenie == 1) || ($zakrep == 1)):?>
		<div class="opoveshenie">
			<?php if($udalenie == 1):?>
				<form style="background: black; padding: 2% 3%; color: white; font-size: 120%;" method="POST" action="obrabotchik_index.php">
					<p style="width: 100%;text-align: right; margin: 0%; margin-bottom: 5%;"><button style="background: none; color:white; cursor: pointer; border:none;" name="udalenie_net">X</button></p>
					Вы действительно хотите произвести удаление данной записи?
					<p style="display: flex; width: 100%; margin:0%; margin-top: 10%;"><button style="margin-right: 5%;" class="button_vibor" name="udalenie_da">Да</button> <button class="button_vibor" name="udalenie_net">Нет</button></p>
				</form>
			<?php endif;?>
			<?php if($zakrep == 1):?>
				<form style="background: black; padding: 2% 3%; color: white; font-size: 120%;" method="POST" action="obrabotchik_index.php">
					<p style="width: 100%;text-align: right; margin: 0%; margin-bottom: 5%;"><button style="background: none; color:white; cursor: pointer; border:none;" name="zakreplenie_net">X</button></p>
					Вы действительно хотите произвести <?php if($status == 0):?> закрепление <?php endif;?>  <?php if($status == 1):?> открепление <?php endif;?> данной записи?
					<p style="display: flex; width: 100%; margin:0%; margin-top: 10%;"><button style="margin-right: 5%;" class="button_vibor" name="zakreplenie_da">Да</button> <button class="button_vibor" name="zakreplenie_net">Нет</button></p>
				</form>
			<?php endif;?>
		</div>
	<?php endif;?>
	<div class="wrap">
		<div style="width: 100%;">
			<h2 style="color:white;margin:0%; margin-bottom: 1%;">Заметки</h2>
			<div style="margin: 1.5% 0%; text-align: center; color: white;">
				<?php
				$mesaci = ["января", "февраля", "марта","апреля","мая","июня","июля","авуста","сентября","октября","ноября","декабря"];
				$den = date("j");
				$mes = $mesaci[date("n")-1];
				$god = date("Y");
				echo $den." ".$mes." ".$god." ";
				?>
			</div>
			<div class="conteiner_kontent">
				<?php
					$dbs="mysql:host=localhost;dbname=zadanie";
					$db = new PDO($dbs,"root","");
					$rik = $db->query("SELECT id FROM zametka WHERE status = 1 ORDER BY id DESC LIMIT 1");
					$id_poslednee = $rik->fetch();
					$res=$db->query("SELECT * FROM zametka WHERE status = 1");
					$zakreplen = $res->rowCount();
				?>
				<?php if ($zakreplen != 0): ?>
					<h3 style="margin-bottom:2%;">Закреплено</h3>
					<form style="background: #282828; border-radius: 5px; padding: 2%; width:95%;" method="POST" action="obrabotchik_index.php">
						<?php 
						$dbs="mysql:host=localhost;dbname=zadanie";
						$db = new PDO($dbs,"root","");
						$res=$db->query("SELECT * FROM zametka WHERE status = 1");
						$zakreplen = $res->rowCount();
						While ($row=$res->fetch(PDO::FETCH_ASSOC)){
							$data = $row['data'];
							$data = new DateTime($data);
							$data = $data->format("m.d.Y");
						?>
						<div style="display: flex;">
							<div style="width: 90%;">
								<button class="kontent" name="zapis" value="<?php echo $row['id'];?>">
									<input type="hidden" name="id_zapisi" value="<?php echo $row['id'];?>">
									<h3 style="color:white; text-overflow: ellipsis; overflow: hidden; margin: 0%; margin-bottom:2%;white-space: nowrap;">
										<?php if($row['zagolovok'] !="") {
											echo $row['zagolovok'];
										}
										else{
											echo $row['text'];
										}
										?>	
									</h3>
									<p style="text-overflow: ellipsis; overflow: hidden; margin: 0%; color: #a8a8a8; white-space: nowrap;">
										<?php 
										echo $data." ";
										if ($row['text'] == "") {
											echo "Нет дополнительного текста";
										}
										else{
											if(($row['text']!="") && ($row['zagolovok']!="")){
												echo  $row['text'];
											}
											else{
												echo "Нет дополнительного текста";
											}
										}
										?>	
									</p>
								</button>
							</div>
							<div style="width: 10%;">
								<button class="vozmojnost" style="margin-bottom: 3%;" name="zakrep"><img src="img/zacrep.svg" style="width: 100%;"></button><br>
								<button class="vozmojnost" name="udalit"><img src="img/udalenie.svg" style="width: 100%;"></button>
							</div>
						</div>
							<?php if ($row['id'] != $id_poslednee['id']) :?>
								<hr style="width: 70%; text-align: center;border-bottom: 1px solid #0f0f0f;">
							<?php endif;?>
						<?php }?>
					</form>
				<?php endif ?>
				<form style="background: #282828; border-radius: 5px; padding: 2%; width:95%; margin-top: 5%;" method="POST" action="obrabotchik_index.php">
					<?php 
					$riv = $db->query("SELECT * FROM zametka");
					$kolichestvo = $riv->rowCount();
					$rik = $db->query("SELECT id FROM zametka WHERE status = 0 ORDER BY id DESC LIMIT 1");
					$id_poslednee = $rik->fetch();
					$res=$db->query("SELECT * FROM zametka WHERE status = 0");
					While ($row=$res->fetch(PDO::FETCH_ASSOC)){
						$data = $row['data'];
						$data = new DateTime($data);
						$data = $data->format("m.d.Y");
					?>
					<div style="display: flex;">
						<div style="width: 90%;">
							<button class="kontent" name="zapis" value="<?php echo $row['id'];?>">
								<input type="hidden" name="id_zapisi" value="<?php echo $row['id'];?>">
								<h3 style="color:white; text-overflow: ellipsis; overflow: hidden; margin: 0%; margin-bottom:2%;white-space: nowrap;">
									<?php if($row['zagolovok'] !="") {
										echo $row['zagolovok'];
									}
									else{
										echo $row['text'];
									}
									?>	
								</h3>
								<p style="text-overflow: ellipsis; overflow: hidden; margin: 0%; color: #a8a8a8;white-space: nowrap;">
									<?php 
									echo $data." ";
									if ($row['text'] == "") {
										echo "Нет дополнительного текста";
									}
									else{
										if(($row['text']!="") && ($row['zagolovok']!="")){
											echo $row['text'];
										}
										else{
											echo "Нет дополнительного текста";
										}
									}
									?>	
								</p>
							</button>
						</div>
						<div style="width: 10%;">
							<button class="vozmojnost" style="margin-bottom: 3%;" name="zakrep"><img src="img/zacrep.svg" style="width: 100%;"></button><br>
							<button class="vozmojnost" name="udalit"><img src="img/udalenie.svg" style="width: 100%;"></button>
						</div>
					</div>
						<?php if ($row['id'] != $id_poslednee['id']) :?>
							<hr style="width: 70%; text-align: center;border-bottom: 1px solid #0f0f0f;">
						<?php endif;?>
					<?php }?>
				</form>
			</div>
			<div class="deistvia">
				<div style="color: white; text-align: right; width: 55%;">
					<?php 	
						$kolichestvo = (string)$kolichestvo;
						$kolichestvo_simvol = str_split($kolichestvo);
						if (($kolichestvo_simvol[strlen($kolichestvo)-1] == 0) || ((strlen($kolichestvo) > 1) && ($kolichestvo_simvol[strlen($kolichestvo)-1] > 4)) || ((strlen($kolichestvo) == 1) && ($kolichestvo_simvol[strlen($kolichestvo)-1] > 4)) || ((strlen($kolichestvo) == 2) && (($kolichestvo>9) && ($kolichestvo<21)))){
							$nadpis = "заметок";
						}
						elseif (($kolichestvo_simvol[strlen($kolichestvo)-1] == 1) || ((strlen($kolichestvo) > 1) && ($kolichestvo_simvol[strlen($kolichestvo)-1] == 1))){
							$nadpis = "заметка";
						}
						else{
							if (($kolichestvo_simvol[strlen($kolichestvo)-1] >1) && ($kolichestvo_simvol[strlen($kolichestvo)-1] < 5)) {
									$nadpis = "заметки";
							}
						}
						echo $kolichestvo." ".$nadpis;
					?>
				</div>
				<form style="text-align: right; width: 45%;" method="POST" action="obrabotchik_index.php">
					<button style="background: none; width:20%; cursor: pointer; border:none;" name="dobavlenie"><img src="img/dobavlenie.svg" style="width: 100%;"></button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>