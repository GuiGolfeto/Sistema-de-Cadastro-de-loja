<?php
if (isset($_POST['btnExcluir'])) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $produtoExcluir = filter_input(INPUT_POST, 'nomeProdutoDelete');

    if (file_exists("./produtos.json")) {
        $arqProdutos = './produtos.json';
        $arqProdutos = file_get_contents($arqProdutos);
        $arqProdutos = json_decode($arqProdutos, true);
    }

    foreach ($arqProdutos as $key => $value) {
        if ($produtoExcluir == $value['nomeProduto']) {
            unset($arqProdutos[$key]);
            $valid = true;
        }
    }

    if (isset($valid)) {
        $json = json_encode($arqProdutos);
        if (file_put_contents("produtos.json", $json)) {
            $_SESSION['exclusaoSuccess'] = true;
            header("Refresh: 1, url=../pages/gerenciaProdutos.php");
        } else {
            $_SESSION['exclusaoErro'] = true;
            header("Refresh: 1, url=../pages/gerenciaProdutos.php");
        }
    }
}
