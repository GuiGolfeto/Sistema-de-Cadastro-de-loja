<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

if ($_SESSION['nivel'] == 1) {
	$nivel = 'Admin';
} else if ($_SESSION['nivel'] == 2) {
	$nivel = 'Usuario Comum';
}else if ($_SESSION['nivel'] == 3){
	$nivel = 'Lojista';
}

if (isset($_POST['btnVoltar'])) {
	header('Location: home.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Perfil</title>

	<link rel="stylesheet" href="../css/main.css">
	<link rel="icon" href="../images/assets/grid.svg">
	<link href="../css//perfil/effect.css" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
	<div class="container">
		<div class="hex-grid">
			<div class="grid"></div>
			<div class="light"></div>
			<div class="light-1"></div>
		</div>
	</div>
	<div class="glasscard">
		<div class="imgBX">
			<img src="../images/userIcon.png" alt="perfil imagen">
		</div>
		<div class="content">
			<div class="details" style="margin-bottom: 50px;">
				<?php echo "<h2>" . $_SESSION['nome'] . " <br><span>" . $nivel . "</span></h2>" ?>
			</div>
		</div>
		<form action="" class="login-form" method="post">
			<div class="container-login-form-btn" style="margin-top: 450px;">
				<button class="login-form-btn" id="btnVoltar" name="btnVoltar">
					voltar
				</button>
			</div>
		</form>
	</div>
	<script src="js/index.js"></script>
</body>

</html>