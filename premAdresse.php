<?php
function plageIP($ip, $masque){
    $SR1 = 32 - $masque;
    $nbrdeMachine = pow(2, $SR1) - 2;
 
    //converti masque en bit
    $SR2 = $masque;
    $masquebinaire = "";
    $i=0;
    while ($i<32){
        if($SR2<=0){
            $masquebinaire.="0";
        }else{
            $masquebinaire.="1";
            $SR2-=1;
        }
        $i++;
    }
 
    //$converti ip en bit
    $i=0;
    foreach ($ip as $element) {
        $ip[$i] = decbin(intval($element));
        while(strlen($ip[$i])<8){
            $ip[$i] = intval("O").$ip[$i];
        }
        $i++;
    }
    
    $adressIpBinaire = join( '' , $ip);
    $adressReseau = decoupageIp($adressIpBinaire, $SR1, 0, 0);
    $adressBroadcast = decoupageIp($adressIpBinaire, $SR1, 1, 1);
    $adressePremiereMachine = decoupageIp($adressIpBinaire, $SR1, 0, 1);
    $adresseDerniereMachine = decoupageIp($adressIpBinaire, $SR1, 1, 0);  
 
    return $list = [join( '.' , $adressReseau),
                    join( '.' , listeIp($masquebinaire)),
                    join( '.' , $adressBroadcast),
                    $nbrdeMachine,
                    join( '.' , $adressePremiereMachine),
                    join( '.' , $adresseDerniereMachine),];
}
 
function listeIp($IpBinaire){
    $listeIp = array();
    array_push($listeIp, bindec(substr($IpBinaire, 0, -24)));
    array_push($listeIp, bindec(substr($IpBinaire, 8, -16)));
    array_push($listeIp, bindec(substr($IpBinaire, 16, -8)));
    array_push($listeIp, bindec(substr($IpBinaire, 24)));
    return $listeIp;
}
 
function decoupageIp($adressIp, $SR1, $intval1, $intval2){
    $return = substr($adressIp, 0, -$SR1);
    while(strlen($return)<31){
            $return .=intval("$intval1");
    }
    $return .=intval("$intval2");
    return listeIp($return);
}