<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// erro cadastro
if (isset($_SESSION['cadastroErro'])) {
	if ($_SESSION['cadastroErro'] == true) {
		echo "<script>var cadastroErro = true</script>";
		unset($_SESSION['cadastroErro']);
	}
}

// erro email igual
if (isset($_SESSION['emailIgual'])) {
	if ($_SESSION['emailIgual'] == true) {
		echo "<script>var emailIgual = true</script>";
		unset($_SESSION['emailIgual']);
	}
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>cadastrar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<script src="../src/scripts/verificação/index.js" defer></script>

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
				<form class="login-form" action="../server/cadastro.php" method="post" autocomplete="off">
					<span class="login-form-title">
						Faça o seu cadastro
					</span>

					<div class="wrap-input margin-top-35 margin-bottom-35">
						<input class="input-form" type="text" name="nomeCompleto" id="nomeCompleto" autocomplete="off">
						<span class="focus-input-form" data-placeholder="Nome completo"></span>
					</div>

					<div class="wrap-input margin-top-35 margin-bottom-35">
						<input class="input-form" type="email" name="email" id="email" autocomplete="off" required>
						<span class="focus-input-form" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input margin-top-35 margin-bottom-35">
						<input class="input-form" type="password" name="passwd" id="passwd" minlength="6" maxlength="12" autocomplete="off">
						<span class="focus-input-form" data-placeholder="Senha"></span>
					</div>

					<div class="wrap-input margin-top-35 margin-bottom-35">
						<input class="input-form" type="text" name="cidade" id="cidade" autocomplete="off">
						<span class="focus-input-form" data-placeholder="Cidade"></span>
					</div>

					<div class="margin-bottom-35">
						<select class="input-form" id="estado" name="estado">
							<option value="">Escolha seu estado</option>
							<option value="AC">Acre</option>
							<option value="AL">Alagoas</option>
							<option value="AP">Amapá</option>
							<option value="AM">Amazonas</option>
							<option value="BA">Bahia</option>
							<option value="CE">Ceará</option>
							<option value="DF">Distrito Federal</option>
							<option value="ES">Espírito Santo</option>
							<option value="GO">Goiás</option>
							<option value="MA">Maranhão</option>
							<option value="MT">Mato Grosso</option>
							<option value="MS">Mato Grosso do Sul</option>
							<option value="MG">Minas Gerais</option>
							<option value="PA">Pará</option>
							<option value="PB">Paraíba</option>
							<option value="PR">Paraná</option>
							<option value="PE">Pernambuco</option>
							<option value="PI">Piauí</option>
							<option value="RJ">Rio de Janeiro</option>
							<option value="RN">Rio Grande do Norte</option>
							<option value="RS">Rio Grande do Sul</option>
							<option value="RO">Rondônia</option>
							<option value="RR">Roraima</option>
							<option value="SC">Santa Catarina</option>
							<option value="SP">São Paulo</option>
							<option value="SE">Sergipe</option>
							<option value="TO">Tocantins</option>
							<option value="EX">Estrangeiro</option>
						</select>
					</div>

					<div class="wrap-input margin-top-35 margin-bottom-35">
						<input class="input-form" type="text" name="cep" id="cep" autocomplete="off">
						<span class="focus-input-form" data-placeholder="CEP"></span>
					</div>

					<div class="wrap-input margin-top-35 margin-bottom-35">
						<input class="input-form" type="date" id="nasc" name="nasc">
					</div>

					<div class="margin-bottom-35">
						<select class="input-form" id="sexo" name="sexo">
							<option value="">Defina seu sexo</option>
							<option value="Feminino">Feminino</option>
							<option value="Masculino">Masculino</option>
							<option value="NaoBinario">Não Binario</option>
							<option value="LGBT">LGBT</option>
						</select>
					</div>

					<div class="margin-bottom-35" id="nivel">
						<select class="input-form" id="nivel" name="nivel">
							<option value="2">user</option>
							<option value="1">adm</option>
						</select>
					</div>

					<div class="container-login-form-btn">
						<button class="login-form-btn" id="btn" name="btn">
							Cadastrar
						</button>
					</div>

					<li>
						<span class="text1">
							Já tem conta?
						</span>

						<a href="../index.php" class="text2">
							Login
						</a>
					</li>
					</ul>
				</form>
			</div>
			<img src="../images/cadastro.png" width="300" height="300" class="margin-left-50" />

			<!-- Esconde escolha de nivel -->
			<script>
				document.getElementById('nivel').style.display = 'none'
			</script>

			<script>
				if (typeof cadastroErro === "undefined") {
					console.log('A variavel cadastroErro não existe!');
				} else if (cadastroErro == true) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Não foi possivel realizar o cadastro, por favor tente novamente!',
					});
				}
			</script>
			<script>
				if (typeof emailIgual === "undefined") {
					console.log('A variavel emailIgual não existe!');
				} else if (emailIgual == true) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Esse email já esta cadastrado, por favor coloque um email valido!',
					});
				}
			</script>
			<!-- Alertas fim -->

			<!-- animação do form -->
			<script src="../src/scripts/formularios/animation.js"></script>

</body>

</html>