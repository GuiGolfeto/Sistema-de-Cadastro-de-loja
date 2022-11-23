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

        $arqProd = './produtos.json';
        $arqProd = file_get_contents($arqProd);
        $arqProd = json_decode($arqProd, true);

        foreach ($arqUsers as $key => $value) {
            if ($emailExluir == $value['email']) {
                unset($arqUsers[$key]);
                $validUser = true;
            }
        }

        foreach ($arqLojas as $key => $value) {
            if ($emailExluir == $value['emailGerente']) {
                $nameLoja = $value['nomeLoja'];
                unset($arqLojas[$key]);
                $validLoja = true;
            }
        }

        if (isset($validLoja)){
            foreach ($arqProd as $key => $value) {
                if ($nameLoja == $value['loja']) {
                    unset($arqProd[$key]);
                }
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
            $jsonProd = json_encode(array_values($arqProd));
            if (file_put_contents("lojas.json", $json) && file_put_contents("produtos.json", $jsonProd)) {
                $_SESSION['exclusaoSuccess'] = true;
                header("Refresh: 1, url=../pages/gerenciaCadastros.php");
            } else {
                $_SESSION['exclusaoErro'] = true;
                header("Refresh: 1, url=../pages/gerenciaCadastros.php");
            }
        }
    }
}
