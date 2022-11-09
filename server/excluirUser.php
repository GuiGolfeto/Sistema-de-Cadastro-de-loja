<?php
if (isset($_POST['btnExcluir'])) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $emailExluir = filter_input(INPUT_POST, 'emailDelete');

    if (file_exists("data.json")) {
        $arquivo = 'data.json';
        $data = file_get_contents($arquivo);
        $data = json_decode($data, true);

        foreach($data as $key => $value){
            if($emailExluir == $value['email']){
                unset ($data[$key]);
            }
        }

        $json = json_encode($data);
        if (file_put_contents("data.json", $json)) {
            $_SESSION['exclusaoSuccess'] = true;
            header("Refresh: 1, url=../pages/gerenciaCadastros.php");
        } else {
            $_SESSION['exclusaoErro'] = true;
            header("Refresh: 1, url=../pages/gerenciaCadastros.php");
        }
    }
}
