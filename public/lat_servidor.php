<?php
/*
 * Neste iremos fazer as verificações de latência
 */
require_once ('api.php');
require_once('cl_servicos.php');

$chave = new Chave();
$token=$chave->token;
$urlComponents=$chave->urlComp;
$urlMetrics=$chave->urlMetrics;
$urlCompKey=$urlComponents.'?'.$key;

$servidores = array(
    array('novovista.com.br',2,80),
    array('vws-01.novovista.com.br',3,80),
    array('vws-02.novovista.com.br',4,80),
    array('vws-03.novovista.com.br',5,80),
    array('db-vwc-01.vistahost.com.br',6,3306),
    //array('mysql-producao.cwc1g77rsraq.sa-east-1.rds.amazonaws.com',7)
    //array('rds.amazonaws.com',7,3306)
);

LatAtual($urlMetrics,$token,$servidores);

function LatAtual($urlMetrics,$token,$servidores)
{
    for ($i=0;$i<count($servidores);$i++){


        $ping = pingDominio($servidores[$i][0],$servidores[$i][2]);
        if ($ping == (-1)) {
            // Vamos abrir ocorrência para o caso do site estar off
            //$array=retComp($urlCompKey);

        } else {

            //$inData = array("status" => 1, "id" => $servidores[$i][1], "enabled" => true);
            $data = array("value" => $ping, "timestamp" => time());

            $data_string = json_encode($data);
            $url=$urlMetrics.'/'.$servidores[$i][1].'/points';


            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','X-Cachet-Token:'.$token));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_exec($ch);
        }
    }
}


echo "<hr>";


function pingDominio($domain,$port){

    for ($i=0; $i<10; $i++){
        $starttime = microtime(true);
        $file      = fsockopen ($domain, $port, $errno, $errstr, 10);
        $stoptime  = microtime(true);

        if (!$file){
            return -1;
        }
        else {
            fclose($file);
            $status = ($stoptime - $starttime)* 1000;
            $status = round($status,3);
            $p[$i]=$status;
            }
    }
    $p = array_filter($p);
    $media = array_sum($p)/count($p);

    return round($media,3);
}

$json = json_decode(file_get_contents($chave->urlIncidentes),true);
/*

echo "<hr>";
foreach($json as $key => $value) {

    for ($i = 0; $i < count($json) + 1; $i++) {
        echo $value[$i]["id"]."<br>";
        echo $value[$i]["created_at"];
        echo $value[$i]["is_resolved"];
        echo $value[$i]["component_id"];
        echo $value[$i]["human_status"];
    }
}
function ValidaCriarIncidente($cid,$tempo){

}*/
?>
