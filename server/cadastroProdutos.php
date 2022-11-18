<?php
if (isset($_POST['btn'])) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $produto = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    unset($produto['btn']);

    if (file_exists("produtos.json")) {
        $arquivo = file_get_contents("produtos.json");
        $arquivo = json_decode($arquivo, true);
        array_push($arquivo, $produto);

        $json = json_encode(array_values($arquivo));
        if (file_put_contents("produtos.json", $json)) {
            $_SESSION['cadastroProdutoSuccess'] = true;
            header("Refresh: 1, url=../pages/gerenciaProdutos.php");
        } else {
            $_SESSION['CadastroProdutoError'] = true;
            header("Refresh: 1, url=../pages/gerenciaProdutos.php");
        }
    } else {

        $produto = array(0 => $produto);

        $json = json_encode(array_values($produto));
        if (file_put_contents("produtos.json", $json)) {
            $_SESSION['cadastroProdutoSuccess'] = true;
            header("Refresh: 1, url=../pages/gerenciaProdutos.php");
        } else {
            $_SESSION['CadastroProdutoError'] = true;
            header("Refresh: 1, url=../pages/gerenciaProdutos.php");
        }
    }
}
