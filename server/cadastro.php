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
				header("Refresh: 1, url=../pages/cadastro.php");
			}
		}

		if (!isset($_SESSION['emailIgual'])) {
			array_push($arquivo, $data);
			$json = json_encode(array_values($arquivo));

			if (file_put_contents("data.json", $json)) {
				$_SESSION['cadastroSuccess'] = true;
				header("Refresh: 1, url=../index.php");
			} else {
				$_SESSION['cadastroErro'] = true;
				header("Refresh: 1, url=../pages/cadastro.php");
			}
		}
	}else {

		$data = array(0 => $data);

		$defaultAdm = array(
			"nomeCompleto" => "DefaultADM",
			"email" => "adm@adm.com",
			"passwd" => "827ccb0eea8a706c4c34a16891f84e7b",
			"cidade" => "adm",
			"estado" => "adm",
			"cep" => "99999-999",
			"nasc" => "0000-00-00",
			"sexo" => "adm",
			"nivel" => "1"
		);

		array_push($data, $defaultAdm);

		$json = json_encode(array_values($data));
		if (file_put_contents("data.json", $json)) {
			$_SESSION['cadastroSuccess'] = true;
			header("Refresh: 1, url=../index.php");
		} else {
			$_SESSION['cadastroErro'] = true;
			header("Refresh: 1, url=../pages/cadastro.php");
		}
	}
}
