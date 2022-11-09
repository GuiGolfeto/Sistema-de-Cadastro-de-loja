<?php
if (isset($_POST['btn'])) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $email = filter_input(INPUT_POST, 'email');
    $senha = md5(filter_input(INPUT_POST, 'newPasswd'));

    if (file_exists("./data.json") || file_exists('./lojas.json')) {
        $arqUsers = './data.json';
		$arqUsers = file_get_contents($arqUsers);
		$arqUsers = json_decode($arqUsers, true);

		$arqLojas = './lojas.json';
		$arqLojas = file_get_contents($arqLojas);
		$arqLojas = json_decode($arqLojas, true);

        foreach ($arqUsers as $key => $value) {
            if ($email == $value['email']) {
                $arqUsers[$key]['passwd'] = $senha;
                $validUser = true;
            }
        }

        foreach ($arqLojas as $key => $value) {
            if ($email == $value['emailGerente']) {
                $arqLojas[$key]['passwd'] = $senha;
                $validLoja = true;
            }
        }

        if (isset($validUser)){
            $json = json_encode($arqUsers);
            if (file_put_contents("data.json", $json)) {
                $_SESSION['senhaAttSuccess'] = true;
                header("Refresh: 1, url=../index.php");
            } else {
                $_SESSION['senhaAttError'] = true;
                header("Refresh: 1, url=../pages/recupearSenha.php");
            }
        }

        if (isset($validLoja)){
            $json = json_encode($arqLojas);
            if (file_put_contents("lojas.json", $json)) {
                $_SESSION['senhaAttSuccess'] = true;
                header("Refresh: 1, url=../index.php");
            } else {
                $_SESSION['senhaAttError'] = true;
                header("Refresh: 1, url=../pages/recupearSenha.php");
            }
        }

    }else {
		$_SESSION['noData'] = true;
		header("Refresh: 1, url=../index.php");
		exit;
	}
}
