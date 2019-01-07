#!/bin/bash
DATE=`date '+%Y-%m-%d %H:%M:%S'`
date_unix=$(date +%s)
date_unix=$((date_unix - 7200))
RESULT_PING=$( ping -c 3 novovista.com.br | tail -1| awk '{print $4}' | cut -d '/' -f 2 )
source /home/suporte/scripts/chaves.sh


while read l; do
IFS='|' read api ur id <<< $l
if [ $api = "api" ]; then
 if curl -sSf -XGET -H "Accept: application/json" $ur  | grep "imoveis" > /dev/null; then
     curl -X PUT \
         -H "Content-Type:application/json;" -H "X-Cachet-Token:$CACHET_KEY" \
         -d '{"status":1,"id":"$id","enabled":true}' \
         "$CACHET_URL/$id"



 else
    curl -X PUT \
        -H "Content-Type:application/json;" -H "X-Cachet-Token:$CACHET_KEY" \
        -d '{"status":3,"id":"$id","enabled":true}' \
        "$CACHET_URL/$id"



#   curl --request POST \
#    -H "Content-Type:application/json;" -H "X-Cachet-Token:$CACHET_KEY" \
#  --url "http://192.168.1.37/api/v1/incidents" \
#  --data '{"params":{"server_id":"$id","created_at":"$DATE"},"visible":1,"name":"Indisponibilidade reportada","message":"Indisponibilidade no servidor reportada","status":1,"component_id":"'$id'","component_status":2,"notify":"false","template":"3","created_at":"$DATE"}'


 fi
fi
if [ $api = "vista" ];then
 if curl -s --head  --request GET $ur | grep "200 OK" > /dev/null; then
     curl -X PUT \
         -H "Content-Type:application/json;" -H "X-Cachet-Token:$CACHET_KEY" \
         -d '{"status":1,"id":"$id","enabled":true}' \
         "$CACHET_URL/$id"

     curl --request POST \
     -H "Content-Type:application/json;" -H "X-Cachet-Token:$CACHET_KEY" \
   --url "http://192.168.1.37/api/v1/metrics/2/points" \
   --data '{"value":"'$RESULT_PING'","timestamp":"'$date_unix'"}'



 else
     curl -X PUT \
         -H "Content-Type:application/json;" -H "X-Cachet-Token:$CACHET_KEY" \
         -d '{"status":3,"id":"$id","enabled":true}' \
         "$CACHET_URL/$id"
 fi
fi
done </home/suporte/scripts/hosts.txt
