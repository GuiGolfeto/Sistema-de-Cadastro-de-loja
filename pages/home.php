<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


$arqUsers = '../server/data.json';
$arqUsers = file_get_contents($arqUsers);
$arqUsers = json_decode($arqUsers);

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
        header("Location: ./produtos.php");
    }

    if (isset($_POST['sair'])) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: ../index.php");
        exit;
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
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

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

    <script>
        if (failSession == true) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Você não tem acesso a esse setor!',
            });
        }
    </script>
</body>

</html>