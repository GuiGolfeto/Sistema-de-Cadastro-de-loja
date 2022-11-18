<?php
if (isset($_POST['btnExcluir'])) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $emailExluir = filter_input(INPUT_POST, 'emailDelete');

    if (file_exists("./data.json") || file_exists('./lojas.json')) {
        $arqUsers = './data.json';
        $arqUsers = file_get_contents($arqUsers);
        $arqUsers = json_decode($arqUsers, true);

        $arqLojas = './lojas.json';
        $arqLojas = file_get_contents($arqLojas);
        $arqLojas = json_decode($arqLojas, true);

        foreach ($arqUsers as $key => $value) {
            if ($emailExluir == $value['email']) {
                unset($arqUsers[$key]);
                $validUser = true;
            }
        }

        foreach ($arqLojas as $key => $value) {
            if ($emailExluir == $value['emailGerente']) {
                unset($arqLojas[$key]);
                $validLoja = true;
            }
        }

        if (isset($validUser)) {
            $json = json_encode(array_values($arqUsers));
            if (file_put_contents("data.json", $json)) {
                $_SESSION['exclusaoSuccess'] = true;
                header("Refresh: 1, url=../pages/gerenciaCadastros.php");
            } else {
                $_SESSION['exclusaoErro'] = true;
                header("Refresh: 1, url=../pages/gerenciaCadastros.php");
            }
        }

        if (isset($validLoja)) {
            $json = json_encode(array_values($arqLojas));
            if (file_put_contents("lojas.json", $json)) {
                $_SESSION['exclusaoSuccess'] = true;
                header("Refresh: 1, url=../pages/gerenciaCadastros.php");
            } else {
                $_SESSION['exclusaoErro'] = true;
                header("Refresh: 1, url=../pages/gerenciaCadastros.php");
            }
        }
    }
}
