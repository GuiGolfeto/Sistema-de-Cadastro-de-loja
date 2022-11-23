<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (file_exists('../server/data.json') || file_exists('../server/lojas.json')) {

    // pega o arquivo json dos usuarios
    $arqUsers = '../server/data.json';
    $arqUsers = file_get_contents($arqUsers);
    $arqUsers = json_decode($arqUsers);

    // pega o arquivo json dos lojistas
    $arqLojas = '../server/lojas.json';
    $arqLojas = file_get_contents($arqLojas);
    $arqLojas = json_decode($arqLojas);

    for ($i = 0; $i < count($arqUsers); $i++) {
        if ($_SESSION['email'] === $arqUsers[$i]->email && $_SESSION['senha'] === $arqUsers[$i]->passwd) {
            $validationHome = true;
        }
    }

    for ($i = 0; $i < count($arqLojas); $i++) {
        if ($_SESSION['email'] === $arqLojas[$i]->emailGerente && $_SESSION['senha'] === $arqLojas[$i]->passwd) {
            $validationHome = true;
        }
    }

    if ($validationHome == true) {
        if (isset($_POST['btnPerfil'])) {
            header("Location: perfil.php");
        }

        if (isset($_POST['btnGerenciaCadastros'])) {
            header("Location: ./gerenciaCadastros.php");
        }

        if (isset($_SESSION['failSessionGerencia'])) {
            if ($_SESSION['failSessionGerencia'] == true) {
                echo "<script>var failSession = true</script>";
                unset($_SESSION['failSessionGerencia']);
            }
        }

        if (isset($_POST['btnProdutos'])) {
            header("Location: ./lojas.php");
        }

        if (isset($_POST['sair'])) {
            session_destroy();
            header("Location: ../index.php");
            exit;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">

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
                <form action="" class="login-form" method="post" autocomplete="off">
                    <span class="login-form-title">
                        Escolha o setor!
                    </span>

                    <div class="container-login-form-btn margin-top-35">
                        <button class="login-form-btn" id="btnPerfil" name="btnPerfil">
                            Perfil
                        </button>
                    </div>

                    <div class="container-login-form-btn margin-top-35">
                        <button class="login-form-btn" id="btnGerenciaCadastros" name="btnGerenciaCadastros">
                            Gerenciamento de Cadastros
                        </button>
                    </div>

                    <div class="container-login-form-btn margin-top-35">
                        <button class="login-form-btn" id="btnProdutos" name="btnProdutos">
                            Produtos
                        </button>
                    </div>

                    <div class="container-login-form-btn" style="margin-top: 100px;">
                        <button class="login-form-btn" id="sair" name="sair">
                            Sair
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alerta começo -->
    <script>
        if (typeof failSession === "undefined") {
			console.log('A variavel failSession não existe!');
		}else if (failSession == true) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Você não tem acesso a esse setor!',
            });
        }
    </script>
    <!-- Alerta fim -->
</body>

</html>