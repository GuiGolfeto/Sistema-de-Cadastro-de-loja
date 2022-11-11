<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

$nivel_necessario = 3;

if ($_SESSION['nivel'] != $nivel_necessario){
	$_SESSION['failSessionGerencia'] = true;
    header("Refresh: 1, url=./lojas.php");
    exit;
}

if (isset($_POST['btnVoltar'])) {
    header('Location: home.php');
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
					if(file_exists('../server/produtos.json')){
						 echo 'produtao po';
					} else {
						echo '<h3>Ainda não há produtos cadastrados!</h3>';
					}   
					?>
				</li>

				<li class="tab-content tab-content-2 typography">
					<h1>Cadastro de Produto</h1>
					<form class="login-form" action="../server/cadastroProduto.php" method="post" autocomplete="off">
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

						<div class="margin-top-35 margin-bottom-35">
							<label class="text1" data-placeholder="Foto do produto" style="font-size: 20px;">Foto do produto</label>
							<input class="input-form" type="file" name="fotoProduto" id="fotoProduto" autocomplete="off">
						</div>

						<div class="container-login-form-btn">
							<button class="login-form-btn" id="btn" name="btn">
								Cadastrar
							</button>
						</div>
					</form>
				</li>

				<li class="tab-content tab-content-3 typography">
					<h1>Excluir Produto</h1>
					<form action="../server/excluirUser.php" method="post">
						<div class="wrap-input margin-top-35 margin-bottom-35">
							<input class="input-form" type="text" name="emailDelete" id="emailDelete" autocomplete="off">
							<span class="focus-input-form" data-placeholder="Email do usuario"></span>
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