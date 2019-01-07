<?php
/*
 * classe responsável por conter os dados de acesso.
 */
class Chave{
    public $token;
    public $urlBase;
    public $urlComp;
    public $urlIncidentes;
    public $urlMetrics;

    function Chave(){
        $this->retornaChave();
        }
    function retornaChave(){
        $this->token = "4A7ixgkU4hcCWFReQ15G";
        $this->urlBase = "http://192.168.1.37/api/v1";
        $this->urlComp = "http://192.168.1.37/api/v1/components";
        $this->urlIncidentes = "http://192.168.1.37/api/v1/incidents";
        $this->urlMetrics = "http://192.168.1.37/api/v1/metrics";
        }
    }
?>
