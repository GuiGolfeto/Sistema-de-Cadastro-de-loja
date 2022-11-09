<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Recuperação de Senha</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="../src/scripts/verificação/index.js" defer></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

</head>

<body>
    <div class="container">
        <div class="container-login">
            <div class="wrap-login">
                <form action="../server/recuperarSenha.php" class="login-form" method="post" autocomplete="off">
                    <span class="login-form-title">
                        Recupere sua senha
                    </span>

                    <div class="wrap-input margin-top-35 margin-bottom-35">
                        <input class="input-form" type="email" name="email" id="email">
                        <span class="focus-input-form" data-placeholder="Email"></span>
                    </div>

                    <div class="wrap-input margin-bottom-35">
                        <input class="input-form" type="password" name="newPasswd" id="newPasswd">
                        <span class="focus-input-form" data-placeholder="Nova Senha"></span>
                    </div>

                    <div class="container-login-form-btn">
                        <button class="login-form-btn" id="btn" name="btn">
                            Redefinir
                        </button>
                    </div>

                </form>
            </div>
            <img src="../images/recuperar.png" width="300" height="300" class="margin-left-50" />
        </div>
    </div>

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