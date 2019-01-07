<?php
/*
 * Para testes apenas
 */
require_once ('cl_servicos.php');

$comps = new c_comp($urlComponents);

$lista = $comps->listaComp;
echo $lista;
?>
