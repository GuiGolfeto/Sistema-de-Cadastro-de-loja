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
    <link rel="stylesheet" href="../css//produtos/cardLojas.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="../css/produtos/navbar.css">
    <link rel="stylesheet" href="../css/elements/buttonOne.css">



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.min.js" integrity="sha512-bmWnTgJbKAahKJMepeBM13yCyMAel0GedaOFP2WB4dP9dUHlEVvYiM42MMNLgIX2Mn72IfP1TnnpFVpoJ7PI1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.min.js" integrity="sha512-bmWnTgJbKAahKJMepeBM13yCyMAel0GedaOFP2WB4dP9dUHlEVvYiM42MMNLgIX2Mn72IfP1TnnpFVpoJ7PI1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.all.js" integrity="sha512-+0tPlhsgiMzkhKthIz4FQhetcy4YsrQG5fJxAU5QVfH228YEGVAt0SGoTxvt+9/2bjBy8Tp2cTERmUOu3vL5Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.js" integrity="sha512-OAPFOVKf42/r/THJck860lJL95grhu7y22Ouan+Qw74eCD/gTZ0lpQx2p/c8MkkFo19H7SJfN/F7BJmyqRzq5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.css" integrity="sha512-JzSVRb7c802/njMbV97pjo1wuJAE/6v9CvthGTDxiaZij/TFpPQmQPTcdXyUVucsvLtJBT6YwRb5LhVxX3pQHQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.11/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            echo "<a href='./home.php'>Voltar</a>";
            echo "<a href='./perfil.php'>" . $_SESSION['nome'] . " <i class='icon-user'></i></a>";
            ?>
        </div>
    </div>


    <div class="container">
        <div class="container-login" style="padding-bottom: 360px;">
            <?php
            if (file_exists("../server/lojas.json")) {
                $arqLojas = '../server/lojas.json';
                $arqLojas = file_get_contents($arqLojas);
                $arqLojas = json_decode($arqLojas, true);

                foreach ($arqLojas as $key => $value) {
                    $nomeLoja = $value['nomeLoja'];
                    echo "<div class='card card-1'>";
                    echo "<div class='card__icon'><i class='icon-shopping-cart'></i></div>";
                    echo "<h2 class='card__title'>" . $nomeLoja . "</h2>";
                    echo "<p class='card__apply'><button><a style='text-decoration:none;' href=\"produtos.php?lojaName={$value['nomeLoja']}\">Ver Produtos</a></button></p>";
                    echo "</div>";
                }
            } else {
                echo "<span class='login-form-title'>Não há lojas cadastrados!</span>";
            }
            ?>
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