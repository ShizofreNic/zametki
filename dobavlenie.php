<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Добавление</title>
	<link rel="stylesheet" type="text/css" href="CSS/dobavlenie.css">
</head>
<body>
	<div class="wrap">
		<form style="width: 100%;" method="POST" action="obrabotchk_dobavlenie.php">
			<div class="header" method="POST" action="obrabotchk_dobavlenie.php">
				<div style="width: 50%; text-align: left;"><button name="nazad"><b><</b> Заметки</button></div>
				<div style="width: 50%; text-align: right;"><button name="dobavit">Готово</button></div>
			</div>
			<div class="conteiner_kontent">
					<textarea maxlength="200" autofocus="" name="zagolovok">
						
					</textarea>
					<textarea maxlength="5000" style="font-size: 120%;" name="text">
					
					</textarea>
			</div>
		</form>
		<div style="color:#a8a8a8; text-align: center;">
		<?php
		$mesaci = ["января", "февраля", "марта","апреля","мая","июня","июля","авуста","сентября","октября","ноября","декабря"];
		$den = date("j");
		$mes = $mesaci[date("n")-1];
		$god = date("Y");
		echo $den." ".$mes." ".$god." ";
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