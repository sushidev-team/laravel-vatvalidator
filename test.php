<?php
$vatid = 'ATU69434329'; // Hier die zu überprüfende UID-Nummer einsetzen

$vatid = str_replace(array(' ', '.', '-', ',', ', '), '', trim($vatid));
$cc = substr($vatid, 0, 2);
$vn = substr($vatid, 2);
$client = new SoapClient("http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl");

if($client){
    $params = array('countryCode' => $cc, 'vatNumber' => $vn);
    try{
        $r = $client->checkVat($params);
        if($r->valid == true){
            // USt-ID ist gültig
        } else {
            // USt-ID ist ungültig
        }

	// Alle Ergebniszeilen durchlaufen lassen und ausgeben
        foreach($r as $k=>$prop){
            echo $k . ': ' . $prop;
        }

    } catch(SoapFault $e) {
        echo 'Error, see message: '.$e->faultstring;
    }
} else {
    // Verbindungsfehler, WSDL-Datei nicht erreichbar (passiert manchmal)
    echo "error";
}
?>