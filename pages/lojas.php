<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lojas</title>

    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="../css/produtos/navbar.css">
    <link rel="stylesheet" href="../css//produtos/cardLojas.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" />

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body>

    <!-- navbar -->
    <div class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
            <div class="nav-title">
                <i class='icon-shopping-cart'></i> Lojas
            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>

        <div class="nav-links">
            <?php
            $nivel_necessarioADM = 1;
            $nivel_necessarioLojista = 3;
            if ($_SESSION['nivel'] == $nivel_necessarioADM || $_SESSION['nivel'] == $nivel_necessarioLojista) {
                echo "<a href='#' target='_blank'>Cadastrar Produtos</a>";
            }
            echo "<a href='./home.php'>Voltar</a>";
            echo "<a href='./perfil.php'>" . $_SESSION['nome'] . " <i class='icon-user'></i></a>";
            ?>
        </div>
    </div>


    <div class="container">
        <div class="container-login" style="padding-bottom: 250px;">
            <?php
            if (file_exists("../server/lojas.json")) {
                $arqLojas = '../server/lojas.json';
                $arqLojas = file_get_contents($arqLojas);
                $arqLojas = json_decode($arqLojas, true);

                foreach ($arqLojas as $key => $value) {
                    echo "<div class='card card-1'>";
                    echo "<div class='card__icon'><i class='icon-shopping-cart'></i></div>";
                    echo "<h2 class='card__title'>" . $value['nomeLoja'] . "</h2>";
                    echo "<p class='card__apply'><a class='card__link' href='#'>Ver produtos<i class='fas fa-arrow-right'></i></a></p>";
                    echo "</div>";
                }
            } else {
                echo "<span class='login-form-title'>Não há lojas cadastrados!</span>";
            }
            ?>
        </div>
    </div>
</body>

</html>