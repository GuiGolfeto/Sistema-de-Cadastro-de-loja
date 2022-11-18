<?php
if (isset($_POST['btnLoja'])) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $lojas = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $lojas['passwd'] = md5($lojas['passwd']);
    unset($lojas['btnLoja']);

    if (file_exists("lojas.json")) {
        $arquivo = file_get_contents("lojas.json");
        $arquivo = json_decode($arquivo, true);
        array_push($arquivo, $lojas);

        $json = json_encode(array_values($arquivo));
        if (file_put_contents("lojas.json", $json)) {
            $_SESSION['cadastroLojaSuccess'] = true;
            header("Refresh: 1, url=../pages/gerenciaCadastros.php");
        } else {
            $_SESSION['CadastroLojaError'] = true;
            header("Refresh: 1, url=../pages/gerenciaCadastros.php");
        }
    } else {

        $lojas = array(0 => $lojas);

        $json = json_encode(array_values($lojas));
        if (file_put_contents("lojas.json", $json)) {
            $_SESSION['cadastroLojaSuccess'] = true;
            header("Refresh: 1, url=../pages/gerenciaCadastros.php");
        } else {
            $_SESSION['CadastroLojaError'] = true;
            header("Refresh: 1, url=../pages/gerenciaCadastros.php");
        }
    }
}
