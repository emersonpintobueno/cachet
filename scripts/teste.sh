#! /bin/bash
if curl -sSfv -XGET -H "Accept: application/json" http://friasnet-rest.vistahost.com.br/imoveis/listarcampos?key=ca7a62804c677136dd505a7c775933b2 | grep "200 OK" > /dev/null; then
echo "responde"
else
echo "não respondeu"
fi
