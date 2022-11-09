<?php
if (isset($_POST['btn'])) {
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	$data['passwd'] = md5($data['passwd']);
	unset($data['btn']);

	if (file_exists("data.json")) {
		$arquivo = file_get_contents("data.json");
		$arquivo = json_decode($arquivo, true);

		foreach ($arquivo as $key => $value) {
			if ($data['email'] == $value['email']) {
				$_SESSION['emailIgual'] = true;
				header("Refresh: 1, url=../pages/gerenciaCadastros.php");
			}
		}

		if (!isset($_SESSION['emailIgual'])) {
			array_push($arquivo, $data);

			$json = json_encode($arquivo);
			if (file_put_contents("data.json", $json)) {
				$_SESSION['cadastroAdmSuccess'] = true;
				header("Refresh: 1, url=../pages/gerenciaCadastros.php");
			} else {
				$_SESSION['cadastroAdmErro'] = true;
				header("Refresh: 1, url=../pages/gerenciaCadastros.php");
			}
		}
	} else {

		$data = array(0 => $data);

		$json = json_encode($data);
		if (file_put_contents("data.json", $json)) {
			$_SESSION['cadastroAdmSuccess'] = true;
			header("Refresh: 1, url=../pages/gerenciaCadastros.php");
		} else {
			$_SESSION['cadastroAdmErro'] = true;
			header("Refresh: 1, url=../pages/gerenciaCadastros.php");
		}
	}
}
