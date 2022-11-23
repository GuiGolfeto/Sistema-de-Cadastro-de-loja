<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
// erro campo incorreto
if (isset($_SESSION['campoIncorreto'])) {
	if ($_SESSION['campoIncorreto'] == true) {
		echo "<script>var campoIncorreto = true</script>";
		unset($_SESSION['campoIncorreto']);
	}
}
// Erro data
if (isset($_SESSION['noData'])) {
	if ($_SESSION['noData'] == true) {
		echo "<script>var noData = true</script>";
		unset($_SESSION['noData']);
	}
}


// Succeso cadastro
if (isset($_SESSION['cadastroSuccess'])) {
	if ($_SESSION['cadastroSuccess'] == true) {
		echo "<script>var cadastroSuccess = true</script>";
		unset($_SESSION['cadastroSuccess']);
	}
}

// Senha alterada Succeso
if (isset($_SESSION['senhaAttSuccess'])) {
	if ($_SESSION['senhaAttSuccess'] == true) {
		echo "<script>var senhaAttSuccess = true</script>";
		unset($_SESSION['senhaAttSuccess']);
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/main.css">

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.min.js" integrity="sha512-bmWnTgJbKAahKJMepeBM13yCyMAel0GedaOFP2WB4dP9dUHlEVvYiM42MMNLgIX2Mn72IfP1TnnpFVpoJ7PI1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.min.js" integrity="sha512-bmWnTgJbKAahKJMepeBM13yCyMAel0GedaOFP2WB4dP9dUHlEVvYiM42MMNLgIX2Mn72IfP1TnnpFVpoJ7PI1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.all.js" integrity="sha512-+0tPlhsgiMzkhKthIz4FQhetcy4YsrQG5fJxAU5QVfH228YEGVAt0SGoTxvt+9/2bjBy8Tp2cTERmUOu3vL5Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.js" integrity="sha512-OAPFOVKf42/r/THJck860lJL95grhu7y22Ouan+Qw74eCD/gTZ0lpQx2p/c8MkkFo19H7SJfN/F7BJmyqRzq5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.css" integrity="sha512-JzSVRb7c802/njMbV97pjo1wuJAE/6v9CvthGTDxiaZij/TFpPQmQPTcdXyUVucsvLtJBT6YwRb5LhVxX3pQHQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
	<div class="container">
		<div class="container-login">
			<div class="wrap-login">
				<form action="./server/login.php" class="login-form" method="post" autocomplete="off">
					<span class="login-form-title">
						Faça o login
					</span>

					<div class="wrap-input margin-top-35 margin-bottom-35">
						<input class="input-form" type="email" name="email" id="email">
						<span class="focus-input-form" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input margin-bottom-35">
						<input class="input-form" type="password" name="passwd" id="passwd">
						<span class="focus-input-form" data-placeholder="Senha"></span>
					</div>

					<div class="container-login-form-btn">
						<button class="login-form-btn" id="btn" name="btn">
							Login
						</button>
					</div>

					<ul class="login-utils">
						<li class="margin-bottom-8 margin-top-8">
							<span class="text1">
								Esqueceu sua
							</span>

							<a href="./pages/recuperarSenha.php" class="text2">
								senha?
							</a>
						</li>

						<li>
							<span class="text1">
								Não tem conta?
							</span>

							<a href="./pages/cadastro.php" class="text2">
								Criar
							</a>
						</li>
					</ul>
				</form>
			</div>
			<img src="images/login.png" width="300" height="300" class="margin-left-50" />
		</div>
	</div>

	<!-- Alertas começo -->
	<!-- <script>
		cadastroSuccess = null;
		campoIncorreto = null;
		noData = null;
		senhaAttSuccess = null;
	</script> -->
	<script>
		if (typeof cadastroSuccess === "undefined") {
			console.log('A variavel cadastroSuccess não existe!');
		} else if (cadastroSuccess === true) {
			console.log(campoIncorreto);
			Swal.fire({
				icon: 'success',
				title: 'Cadastro Realizado com Sucesso',
			});
		}
	</script>
	<script>
		if (typeof campoIncorreto === "undefined") {
			console.log('A variavel campoIncorreto não existe!');
		} else if (campoIncorreto === true) {
			console.log(campoIncorreto);
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Campo incorreto!',
			});
		}
	</script>
	<script>
		if (typeof noData === "undefined") {
			console.log('A variavel noData não existe!');
		}else if (noData === true) {
			console.log(noData);
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Não temos uma base de dados no momento!',
				footer: '<a href="./pages/cadastro.php">Gostaria de ser o primeiro do banco?</a>'
			});
		}
	</script>
	<script>
		if (typeof senhaAttSuccess === "undefined"){
			console.log('A variavel senhaAttSuccess não existe!');
		}else if (senhaAttSuccess == true) {
			console.log(senhaAttSuccess);
			Swal.fire({
				icon: 'success',
				title: 'Senha alterada com sucesso!',
			});
		}
	</script>
	<!-- Alertas fim -->


	<!-- animação do form -->
	<script src="./src/scripts/formularios/animation.js"></script>

</body>

</html>