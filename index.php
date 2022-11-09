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
<html lang="pt-br">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/main.css">

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="sweetalert2.all.min.js"></script>
	<script src="sweetalert2.min.js"></script>
	<link rel="stylesheet" href="sweetalert2.min.css">

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

	<!-- Script cadastro success -->
	<script>
		if (cadastroSuccess == true) {
			Swal.fire({
				icon: 'success',
				title: 'Cadastro Realizado com Sucesso',
			});
		}
	</script>

	<!-- Script para se der erro de campo incorreto -->
	<script>
		if (campoIncorreto == true) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Campo incorreto!',
			});
		}
	</script>

	<!-- Script para se der erro de DataBase -->
	<script>
		if (noData == true) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Não temos uma base de dados no momento!',
				footer: '<a href="./pages/cadastro.php">Gostaria de ser o primeiro do banco?</a>'
			});
		}
	</script>

	<!-- senha alterada success -->
	<script>
		if (senhaAttSuccess == true) {
			Swal.fire({
				icon: 'success',
				title: 'Senha alterada com sucesso!',
			});
		}
	</script>



	<!-- animação do form -->
	<script>
		let inputs = document.getElementsByClassName('input-form');
		for (let input of inputs) {
			input.addEventListener("blur", function() {
				if (input.value.trim() != "") {
					input.classList.add("has-val");
				} else {
					input.classList.remove("has-val");
				}
			});
		}
	</script>

</body>

</html>