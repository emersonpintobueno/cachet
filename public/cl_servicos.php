<?php
/*
 * Aqui iremos fazer as funções de consulta dos serviços
 */
require_once ('api.php');

$chave = new Chave();
$urlComponents=$chave->urlComp;
$key=$chave->token;
$urlComponents=$urlComponents.'?'.$key;

function retComp($urlComponents)
{
    $json = json_decode(file_get_contents($urlComponents), true);
    foreach($json as $key => $value) {

        for ($i = 0; $i < count($json) + 1; $i++) {
            $value[$i]["id"];
            $value[$i]["name"];
            $value[$i]["description"];
            $value[$i]["link"];
            $value[$i]["status"];
            $value[$i]["order"];
            $value[$i]["group_id"];
            $value[$i]["created_at"];
            $value[$i]["updated_at"];
            $value[$i]["deleted_at"];
            $value[$i]["status_name"];
        }
    }
    return $value;
}

?>
