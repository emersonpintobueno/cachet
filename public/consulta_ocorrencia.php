<?php
require_once ('api.php');

$chave = new Chave();
/*
echo $chave->Chave;
echo "<br>";
echo $chave->urlComp;
echo "<br>";
*/
echo "<hr>";
echo pingDominio('novovista.com.br');

echo "<hr>";
function pingDominio($domain){
    $starttime = microtime(true);
    $file      = fsockopen ($domain, 80, $errno, $errstr, 10);
    $stoptime  = microtime(true);
    $status    = 0;

    if (!$file) $status = -1;  // Site is down
    else {
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    return $status;
}

$json = json_decode(file_get_contents($chave->urlIncidentes),true);


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

}
?>