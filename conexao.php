<?php 

$host = "localhost";
$db = "crud_clientes";
$user = "root";
$pass = "";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    die("Falha na conexação do banco de dados");
}

function format_data($data) {
    return implode('/', array_reverse(explode('-',$data)));
}

function formatar_telefone($telefone) {
        $addd = substr ($telefone, 0, 2);
        $parte1 = substr ($telefone, 2, 5);
        $parte2 = substr ($telefone, 7);
        return "($addd) $parte1-$parte2";
}


?>