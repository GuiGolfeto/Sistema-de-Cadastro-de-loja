<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

$nivel_necessario = 3;

if ($_SESSION['nivel'] != $nivel_necessario) {
	$_SESSION['failSessionGerencia'] = true;
	header("Refresh: 1, url=./lojas.php");
	exit;
}



// Produto success
if (isset($_SESSION['cadastroProdutoSuccess'])) {
	if ($_SESSION['cadastroProdutoSuccess'] == true) {
		echo "<script>var cadastroProdutoSuccess = true</script>";
		unset($_SESSION['cadastroProdutoSuccess']);
	}
}

// Produto error
if (isset($_SESSION['CadastroProdutoError'])) {
	if ($_SESSION['CadastroProdutoError'] == true) {
		echo "<script>var CadastroProdutoError = true</script>";
		unset($_SESSION['CadastroProdutoError']);
	}
}

// exlusão success
if (isset($_SESSION['exclusaoSuccess'])) {
	if ($_SESSION['exclusaoSuccess'] == true) {
		echo "<script>var exclusaoSuccess = true</script>";
		unset($_SESSION['exclusaoSuccess']);
	}
}

// exlusão error
if (isset($_SESSION['exclusaoErro'])) {
	if ($_SESSION['exclusaoErro'] == true) {
		echo "<script>var exclusaoErro = true</script>";
		unset($_SESSION['exclusaoErro']);
	}
}


if (isset($_POST['btnVoltar'])) {
	header('Location: lojas.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Cadastrar Produtos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="../css/gerenciaCadastros/tabs.css">
	<link rel="stylesheet" href="../css/main.css">
	<script src="../src/scripts/verificação/index.js" defer></script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="sweetalert2.all.min.js"></script>
	<script src="sweetalert2.min.js"></script>
	<link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body>
	<div class="page">
		<h1>Gerenciamento de Produtos <?php echo $_SESSION['nome']; ?></h1>

		<!-- tabs -->
		<div class="pcss3t pcss3t-effect-scale pcss3t-theme-1">
			<input type="radio" name="pcss3t" checked id="tab1" class="tab-content-first">
			<label for="tab1"><i class="icon-group"></i><strong>Produtos Cadastrados</strong></label>

			<input type="radio" name="pcss3t" id="tab2" class="tab-content-2">
			<label for="tab2"><i class="icon-user"></i><strong>Cadastro de produto</strong></label>

			<input type="radio" name="pcss3t" id="tab3" class="tab-content-3">
			<label for="tab3"><i class="icon-remove-sign"></i><strong>Excluir produto</strong></label>

			<ul>
				<li class="tab-content tab-content-first typography">
					<h1>Produtos</h1>
					<?php
					if (file_exists('../server/produtos.json')) {
						$arqProdutos = '../server/produtos.json';
						$arqProdutos = file_get_contents($arqProdutos);
						$arqProdutos = json_decode($arqProdutos, true);
						
						foreach ($arqProdutos as $key => $value) {
							if ($_SESSION['nome'] == $value['loja']) {
								$validateLoop = true;
								echo "<h3>Cadastro => " . $key . "</h3>";
								echo "<br>";
								foreach ($value as $dataValue => $a) {
									echo "<strong>" . $dataValue . ": " . "</strong>" . $a;
									echo "<br>";
								}
							} else if (isset($validateLoop)) {
								echo "<h3>Ainda não há produtos cadastrados</h3>";
							}
						}
					} else {
						echo '<h3>Ainda não há produtos cadastrados!</h3>';
					}
					?>
				</li>

				<li class="tab-content tab-content-2 typography">
					<h1>Cadastro de Produto</h1>
					<form class="login-form" action="../server/cadastroProdutos.php" method="post" autocomplete="off" enctype=”multipart/form-data”>
						<div class="wrap-input margin-top-35 margin-bottom-35">
							<input class="input-form" type="text" name="nomeProduto" id="nomeProduto" autocomplete="off">
							<span class="focus-input-form" data-placeholder="Nome do produto"></span>
						</div>

						<div class="wrap-input margin-top-35 margin-bottom-35">
							<input class="input-form" type="number" step="0.01" min="0.01" name="preco" id="preco" autocomplete="off" required>
							<span class="focus-input-form" data-placeholder="Preço"></span>
						</div>

						<div class="wrap-input margin-top-35 margin-bottom-35">
							<input class="input-form" type="text" name="descricao" id="descricao" autocomplete="off">
							<span class="focus-input-form" data-placeholder="Descrição do produto"></span>
						</div>

						<div class="wrap-input margin-top-35 margin-bottom-35">
							<input class="input-form" type="text" name="fotoProduto" id="fotoProduto" autocomplete="off">
							<span class="focus-input-form" data-placeholder="Link da foto do produto"></span>
						</div>

						<input hidden="" type="text" name="loja" id="loja" value="<?php echo $_SESSION['nome']; ?>">

						<div class="container-login-form-btn">
							<button class="login-form-btn" id="btn" name="btn">
								Cadastrar
							</button>
						</div>
					</form>
				</li>

				<li class="tab-content tab-content-3 typography">
					<h1>Excluir Produto</h1>
					<form action="../server/excluirProduto.php" method="post">
						<div class="wrap-input margin-top-35 margin-bottom-35">
							<input class="input-form" type="text" name="nomeProdutoDelete" id="nomeProdutoDelete" autocomplete="off">
							<span class="focus-input-form" data-placeholder="Nome do produto"></span>
						</div>
						<div class="container-login-form-btn">
							<button class="login-form-btn" id="btnExcluir" name="btnExcluir">
								Excluir
							</button>
						</div>
					</form>
				</li>
			</ul>
		</div>
		<form action="" method="post">
			<div class="container-login-form-btn margin-top-35">
				<button class="login-form-btn" id="btnVoltar" name="btnVoltar">
					Voltar
				</button>
			</div>
		</form>
		<!--/ tabs -->
	</div>

	<!-- Script cadastro loja erro -->
	<script>
		if (CadastroProdutoError == true) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Não foi possivel realizar o cadastro, por favor tente novamente!',
			});
		}
	</script>

	<!-- Script cadastro loja erro -->
	<script>
		if (cadastroProdutoSuccess == true) {
			Swal.fire({
				icon: 'success',
				title: 'Cadastro realizado com sucesso!',
			});
		}
	</script>

	<script>
		if (exclusaoSuccess == true) {
			Swal.fire({
				icon: 'success',
				title: 'Produto excluido com sucesso!',
			});
		}
	</script>

	<script>
		if (exclusaoErro == true) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Não foi possivel excluir o produto!',
			});
		}
	</script>


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