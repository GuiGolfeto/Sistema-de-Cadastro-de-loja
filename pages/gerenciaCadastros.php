<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$nivel_necessario = 1;

if ($_SESSION['nivel'] == $nivel_necessario) {
    // pega o arquivo json dos usuarios
    $arqUsers = '../server/data.json';
    $arqUsers = file_get_contents($arqUsers);
    $arqUsers = json_decode($arqUsers);

    // pega o arquivo json dos lojistas
    $arqLojas = '../server/lojas.json';
    $arqLojas = file_get_contents($arqLojas);
    $arqLojas = json_decode($arqLojas);
} else {
    $_SESSION['failSessionGerencia'] = true;
    header("Refresh: 1, url=./home.php");
    exit;
}

// Suceeso cadastro
if (isset($_SESSION['cadastroAdmSuccess'])) {
    if ($_SESSION['cadastroAdmSuccess'] == true) {
        echo "<script>var cadastroAdmSuccess = true</script>";
        unset($_SESSION['cadastroAdmSuccess']);
    }
}

// erro cadastro
if (isset($_SESSION['cadastroAdmErro'])) {
    if ($_SESSION['cadastroAdmErro'] == true) {
        echo "<script>var cadastroAdmErro = true</script>";
        unset($_SESSION['cadastroAdmErro']);
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

// erro email igual
if (isset($_SESSION['emailIgual'])) {
    if ($_SESSION['emailIgual'] == true) {
        echo "<script>var emailIgual = true</script>";
        unset($_SESSION['emailIgual']);
    }
}

// Loja success
if (isset($_SESSION['cadastroLojaSuccess'])) {
    if ($_SESSION['cadastroLojaSuccess'] == true) {
        echo "<script>var cadastroLojaSuccess = true</script>";
        unset($_SESSION['cadastroLojaSuccess']);
    }
}

// Loja error
if (isset($_SESSION['CadastroLojaError'])) {
    if ($_SESSION['CadastroLojaError'] == true) {
        echo "<script>var CadastroLojaError = true</script>";
        unset($_SESSION['CadastroLojaError']);
    }
}

if (isset($_POST['btnVoltar'])) {
    header('Location: home.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Cadastros</title>

    <script src="../src/scripts/verificação/index.js" defer type="module"></script>

    <link rel="stylesheet" href="../css/gerenciaCadastros/tabs.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/main.css">


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">


</head>

<body>
    <div class="page">
        <h1>Gerenciamento de Usuarios</h1>
        <!-- tabs -->
        <div class="pcss3t pcss3t-effect-scale pcss3t-theme-2 height-tabs">
            <input type="radio" name="pcss3t" checked id="tab1" class="tab-content-first">
            <label for="tab1"><i class="icon-group"></i><strong>Usuarios Cadastrados</strong></label>

            <input type="radio" name="pcss3t" id="tab2" class="tab-content-2">
            <label for="tab2"><i class="icon-group"></i><strong>Lojas Cadastrados</strong></label>

            <input type="radio" name="pcss3t" id="tab3" class="tab-content-3">
            <label for="tab3"><i class="icon-user"></i><strong>Cadastrar ADM's</strong></label>

            <input type="radio" name="pcss3t" id="tab4" class="tab-content-4">
            <label for="tab4"><i class="icon-shopping-cart"></i><strong>Cadastrar Loja</strong></label>

            <input type="radio" name="pcss3t" id="tab5" class="tab-content-5">
            <label for="tab5"><i class="icon-remove-sign"></i><strong>Excluir Usuario/Loja</strong></label>

            <ul>
                <li class="tab-content tab-content-first typography">
                    <h1>Usuarios</h1>
                    <?php
                    if (file_exists('../server/data.json')) {
                        foreach ($arqUsers as $key => $value) {
                            echo "<h3>Cadastro => " . $key . "</h3>";
                            echo "<br>";
                            foreach ($value as $dataValue => $a) {
                                echo "<strong>" . $dataValue . ": " . "</strong>" . $a;
                                echo "<br>";
                            }
                        }
                    } else {
                        echo "<h3> Não há usuarios cadastrados!</h3>";
                    }
                    ?>
                </li>

                <li class="tab-content tab-content-2 typography">
                    <h1>Lojas</h1>
                    <?php
                    if (file_exists('../server/lojas.json')) {
                        foreach ($arqLojas as $key => $value) {
                            echo "<h3>Cadastro => " . $key . "</h3>";
                            echo "<br>";
                            foreach ($value as $dataValue => $a) {
                                echo "<strong>" . $dataValue . ": " . "</strong>" . $a;
                                echo "<br>";
                            }
                        }
                    } else {
                        echo "<h3> Não há lojas cadastrados!</h3>";
                    }
                    ?>
                </li>

                <li class="tab-content tab-content-3 typography">
                    <h1>Cadastrar ADM</h1>
                    <form class="login-form" action="../server/cadastroAdm.php" method="post" autocomplete="off">
                        <div class="wrap-input margin-top-35 margin-bottom-35">
                            <input class="input-form" type="text" name="nomeCompleto" id="nomeCompleto" autocomplete="off">
                            <span class="focus-input-form" data-placeholder="Nome completo"></span>
                        </div>

                        <div class="wrap-input margin-top-35 margin-bottom-35">
                            <input class="input-form" type="email" name="email" id="email" autocomplete="off" required>
                            <span class="focus-input-form" data-placeholder="Email"></span>
                        </div>

                        <div class="wrap-input margin-top-35 margin-bottom-35">
                            <input class="input-form" type="password" name="passwd" id="passwd" autocomplete="off">
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
                    </form>
                </li>

                <li class="tab-content tab-content-4 typography">
                    <h1>Cadastrar lojas</h1>
                    <form class="login-form" action="../server/cadastroLoja.php" method="post" autocomplete="off">
                        <div class="wrap-input margin-top-35 margin-bottom-35">
                            <input class="input-form" type="text" name="nomeLoja" id="nomeLoja" autocomplete="off">
                            <span class="focus-input-form" data-placeholder="Nome da Loja"></span>
                        </div>

                        <div class="wrap-input margin-top-35 margin-bottom-35">
                            <input class="input-form" type="text" name="emailGerente" id="emailGerente" autocomplete="off">
                            <span class="focus-input-form" data-placeholder="Email do Gerente"></span>
                        </div>

                        <div class="wrap-input margin-top-35 margin-bottom-35">
                            <input class="input-form" type="password" name="passwd" id="passwd" autocomplete="off">
                            <span class="focus-input-form" data-placeholder="Senha"></span>
                        </div>

                        <div class="margin-bottom-35" id="ocultar">
                            <select class="input-form" id="nivel" name="nivel">
                                <option value="3">Lojista</option>
                                <option value="2">user</option>
                                <option value="1">adm</option>
                            </select>
                        </div>

                        <div class="margin-bottom-35">
                            <select class="input-form" id="estado" name="estado">
                                <option value="">Selecione o estado da sede</option>
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

                        <div class="container-login-form-btn">
                            <button class="login-form-btn" id="btnLoja" name="btnLoja">
                                Cadastrar
                            </button>
                        </div>
                    </form>
                </li>

                <li class="tab-content tab-content-5 typography">
                    <h1>Excluir Usuario/Loja</h1>
                    <form action="../server/excluirUser.php" method="post">
                        <div class="wrap-input margin-top-35 margin-bottom-35">
                            <input class="input-form" type="text" name="emailDelete" id="emailDelete" autocomplete="off">
                            <span class="focus-input-form" data-placeholder="Email do usuario ou loja"></span>
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

    <!-- Oculta uma div -->
    <script>
        document.getElementById('ocultar').style.display = 'none'
    </script>


    <!-- Alertas começo -->
    <script>
        if (cadastroAdmSuccess == true) {
            Swal.fire({
                icon: 'success',
                title: 'Cadastro Realizado com Sucesso',
            });
        }
    </script>
    <script>
        if (cadastroLojaSuccess == true) {
            Swal.fire({
                icon: 'success',
                title: 'Cadastro Realizado com Sucesso',
            });
        }
    </script>
    <script>
        if (exclusaoSuccess == true) {
            Swal.fire({
                icon: 'success',
                title: 'Usuario excluido com sucesso!',
            });
        }
    </script>
    <script>
        if (exclusaoErro == true) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Não foi possivel excluir o usuario!',
            });
        }
    </script>
    <script>
        if (cadastroAdmErro == true) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Não foi possivel realizar o cadastro, por favor tente novamente!',
            });
        }
    </script>
    <script>
        if (CadastroLojaError == true) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Não foi possivel realizar o cadastro, por favor tente novamente!',
            });
        }
    </script>
    <script>
        if (emailIgual == true) {
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