<?php
if (isset($_POST['btn'])) {
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}

	$email = filter_input(INPUT_POST, 'email');
	$senha = md5(filter_input(INPUT_POST, 'passwd'));

	if (file_exists("./data.json") || file_exists('./lojas.json')) {
		$arqUsers = './data.json';
		$arqUsers = file_get_contents($arqUsers);
		$arqUsers = json_decode($arqUsers);

		$arqLojas = './lojas.json';
		$arqLojas = file_get_contents($arqLojas);
		$arqLojas = json_decode($arqLojas);

		for ($i = 0; $i < count($arqUsers); $i++) {
			if ($email === $arqUsers[$i]->email && $senha === $arqUsers[$i]->passwd) {
				$_SESSION['email'] = $arqUsers[$i]->email;
				$_SESSION['senha'] = $arqUsers[$i]->passwd;
				$_SESSION['nome'] = $arqUsers[$i]->nomeCompleto;
				$_SESSION['nivel'] = $arqUsers[$i]->nivel;


				header('Location: ../pages/home.php');
			}
		}

		for ($i = 0; $i < count($arqLojas); $i++) {
			if ($email === $arqLojas[$i]->emailGerente && $senha === $arqLojas[$i]->passwd) {
				$_SESSION['email'] = $arqLojas[$i]->emailGerente;
				$_SESSION['senha'] = $arqLojas[$i]->passwd;
				$_SESSION['nome'] = $arqLojas[$i]->nomeLoja;
				$_SESSION['nivel'] = $arqLojas[$i]->nivel;


				header('Location: ../pages/home.php');
			}
		}

		if (!isset($_SESSION['email'])) {
			$_SESSION['campoIncorreto'] = true;
			header("Refresh: 1, url=../index.php");
			exit;
		}
	} else {
		$_SESSION['noData'] = true;
		header("Refresh: 1, url=../index.php");
		exit;
	}
}
