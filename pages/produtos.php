<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['failSessionGerencia'])) {
    if ($_SESSION['failSessionGerencia'] == true) {
        echo "<script>var failSession = true</script>";
        unset($_SESSION['failSessionGerencia']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lojas</title>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="../css/produtos/navbar.css">
    <link rel="stylesheet" href="../css//produtos/cardProdutos.css">


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
            $nivel_necessarioLojista = 3;
            if ($_SESSION['nivel'] == $nivel_necessarioLojista) {
                echo "<a href='./gerenciaProdutos.php'>Cadastrar Produtos</a>";
            }
            echo "<a href='./lojas.php'>Voltar</a>";
            echo "<a href='./perfil.php'>" . $_SESSION['nome'] . " <i class='icon-user'></i></a>";
            ?>
        </div>
    </div>


    <div class="container">
        <div class="container-login" style="padding-bottom: 250px;">
            <?php
            if (file_exists("../server/produtos.json")) {
                $arqProdutos = '../server/produtos.json';
                $arqProdutos = file_get_contents($arqProdutos);
                $arqProdutos = json_decode($arqProdutos, true);

                foreach ($arqProdutos as $key => $value) {
                    $imgSrc = $value['fotoProduto'];
                    echo "<div class='card'>";
                    echo "<div class='card-header'>";
                    echo "<img src='" . $imgSrc . "' alt='rover' />";
                    echo "</div>";
                    echo "<div class='card-body'>";
                    echo "<h4>" . $value['nomeProduto'] . "</h4>";
                    echo "<p>" . $value['descricao'] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<span class='login-form-title'>Não há lojas cadastrados!</span>";
            }
            ?>
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