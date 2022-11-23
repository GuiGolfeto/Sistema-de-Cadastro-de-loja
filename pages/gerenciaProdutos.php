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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.min.js" integrity="sha512-bmWnTgJbKAahKJMepeBM13yCyMAel0GedaOFP2WB4dP9dUHlEVvYiM42MMNLgIX2Mn72IfP1TnnpFVpoJ7PI1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.min.js" integrity="sha512-bmWnTgJbKAahKJMepeBM13yCyMAel0GedaOFP2WB4dP9dUHlEVvYiM42MMNLgIX2Mn72IfP1TnnpFVpoJ7PI1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.all.js" integrity="sha512-+0tPlhsgiMzkhKthIz4FQhetcy4YsrQG5fJxAU5QVfH228YEGVAt0SGoTxvt+9/2bjBy8Tp2cTERmUOu3vL5Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.js" integrity="sha512-OAPFOVKf42/r/THJck860lJL95grhu7y22Ouan+Qw74eCD/gTZ0lpQx2p/c8MkkFo19H7SJfN/F7BJmyqRzq5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.css" integrity="sha512-JzSVRb7c802/njMbV97pjo1wuJAE/6v9CvthGTDxiaZij/TFpPQmQPTcdXyUVucsvLtJBT6YwRb5LhVxX3pQHQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

	<!-- Alertas começo -->
	<script>
		if (typeof CadastroProdutoError === "undefined") {
			console.log('A variavel CadastroProdutoError não existe!');
		}else if (CadastroProdutoError == true) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Não foi possivel realizar o cadastro, por favor tente novamente!',
			});
		}
	</script>
	<script>
		if (typeof cadastroProdutoSuccess === "undefined") {
			console.log('A variavel cadastroProdutoSuccess não existe!');
		}else if (cadastroProdutoSuccess == true) {
			Swal.fire({
				icon: 'success',
				title: 'Cadastro realizado com sucesso!',
			});
		}
	</script>
	<script>
		if (typeof exclusaoSuccess === "undefined") {
			console.log('A variavel exclusaoSuccess não existe!');
		}else if (exclusaoSuccess == true) {
			Swal.fire({
				icon: 'success',
				title: 'Produto excluido com sucesso!',
			});
		}
	</script>
	<script>
		if (typeof exclusaoErro === "undefined") {
			console.log('A variavel exclusaoErro não existe!');
		}else if (exclusaoErro == true) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Não foi possivel excluir o produto!',
			});
		}
	</script>
	<!-- Alertas fim -->

	<!-- animação do form -->
	<script src="../src/scripts/formularios/animation.js"></script>
</body>

</html>