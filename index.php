<html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Teko" rel="stylesheet"> 

    <title>Calculatron</title>
    <script language="JAVASCRIPT">
     <!--
//fonction ip (ip à rentrer)
nGlobal=0;
function ClearBroadcast(f) {
  f.Broadcast.value = "";
  f.Reseau.value = "";
}
function MasqueCalcul2(nMasque) {
  if (nMasque < 1) { return 0; }
  nCalc = 0;
  for (nX = 7;nX > -1 ; nX--) {
    nCalc=nCalc + raiseP(2 , nX);
    nMasque = nMasque -1;
    nGlobal = nMasque;
    if (nMasque <1) { return nCalc; }
  } return nCalc;
}
function raiseP(x,y) {
  total=1;
  for (j=0; j < y; j++) { total*=x; } return total; //result of x raised to y power
}
function CalcLen2Mask(f) {
  if ((f.idReseau.value < 0)|| (f.idReseau.value>32)) {
    alert("Votre masque doit être compris entre 1 et 32");
    return 0;
  }
  nIdReseau = f.idReseau.value;
  f.IP1.value=MasqueCalcul2(nIdReseau);
  f.IP2.value=MasqueCalcul2(nGlobal);
  f.IP3.value=MasqueCalcul2(nGlobal);
  f.IP4.value=MasqueCalcul2(nGlobal);
}
function CalcMask2Len(f) {
  var m = new Array(1,2,3,4);
  m[0] = f.IP1.value; m[1] = f.IP2.value;
  m[2] = f.IP3.value; m[3] = f.IP4.value;
  ipcheck=TestMasqueSousReseau(m[0],m[1],m[2],m[3]);
  if (ipcheck > 0) { alert("Le masque n'est pas valide"); return 0; }
  masque = 0;
  for (loop=0; loop<4; loop++) {
    div = 256;
    while (div > 1) {
      div = div/2;
      test = m[loop]-div;
      if ( test >-1) { masque = masque+1; m[loop] = test; } else { break; }
    }
  } f.idReseau.value = masque;
}
function CalcBroadcast(f) {
  ClearBroadcast(f);
  var ipcheck=TestIP(f.IP1.value,f.IP2.value,f.IP3.value,f.IP4.value);
  if (ipcheck > 0) { alert("Mauvaise adresse IP!"); return 0; }
  ipcheck=TestMasqueSousReseau(f.SR1.value,f.SR2.value,f.SR3.value,f.SR4.value);
  if (ipcheck > 0) { alert("Mauvais masque de sous réseau!" ); return 0; }
  // This calculates net address
  var nOctA1=f.IP1.value & f.SR1.value
  var nOctA2=f.IP2.value & f.SR2.value
  var nOctA3=f.IP3.value & f.SR3.value
  var nOctA4=f.IP4.value & f.SR4.value
  // This calculates broadcast address
  var nOctB1=f.IP1.value | (f.SR1.value ^ 255)
  var nOctB2=f.IP2.value | (f.SR2.value ^ 255)
  var nOctB3=f.IP3.value | (f.SR3.value ^ 255)
  var nOctB4=f.IP4.value | (f.SR4.value ^ 255)
  f.Broadcast.value = nOctB1+"."+nOctB2+"."+nOctB3+"."+nOctB4
  f.Reseau.value = nOctA1+"."+nOctA2+"."+nOctA3+"."+nOctA4
}

function CalcNetworks(f) {
  // Check IP validity
  var ipcheck=TestIP(f.IP1.value,f.IP2.value,f.IP3.value,f.IP4.value);
  if (ipcheck > 0) { alert("Mauvaise adresse IP!"); return 0; }
  alert("L'adresse IP est bonne");	
}
function TestIP(IP1, IP2, IP3, IP4) {
  // alert(IP1+"."+IP2+"."+IP3+"."+IP4)
  if ((IP1 > 255) || (IP1 < 1)) { return 1; }
  if ((IP2 > 255) || (IP2 < 0)) { return 2; }
  if ((IP3 > 255) || (IP3 < 0)) { return 3; }
  if ((IP4 > 255) || (IP4 < 0)) { return 4; }
  return 0;
}
function TestMasqueSousReseau(IP1, IP2, IP3, IP4) {
  // alert(IP1+"."+IP2+"."+IP3+"."+IP4)
  if ((IP1 > 255) || (IP1 < 0)) { return 1; }
  if ((IP2 > 255) || (IP2 < 0)) { return 2; }
  if ((IP3 > 255) || (IP3 < 0)) { return 3; }
  if ((IP4 > 255) || (IP4 < 0)) { return 4; }
  var IPX =5;
  // Determine where IP changes
  if (IP1 < 255) {
    if((IP2 > 0) || (IP3 > 0) || (IP4 > 0)) { return 5; }
    IPX = IP1;
    } else {
      if (IP2 < 255) {
        if((IP3 > 0) || (IP4 > 0)) { return 6; }
        IPX = IP2;
      } else {
        if (IP3 < 255) {
          if ((IP4 > 0)) { return 7; }
	  IPX = IP3;
        } else { IPX = IP4; }
      }
    }
    // Determine if IPX is good
    switch (IPX) {
      case "255":
      case "128":
      case "192":
      case "224":
      case "240":
      case "248":
      case "252":
      case "254":
      case "0":
        return 0;
      default:
        return 8;
    } return 0;
  }
  
      //-->
    </script>
</head>
<body>

    <div class="Titre">
        <h1> Calculatron </h1>

    </div>

<div ALIGN="CENTER" class="blocCentrale"> 
    <table class="bloc">
  <tr >
          <br>
          <td >
            <table>
              <tr >
                <td >
                    <form name="fCalcBroadcast">
                      
            <table>
              <tr> 
                <td colspan=2 ><b> Calculer l'adresse du broadcast ainsi que l'adresse du réseau 
                  <br>
                  <hr noshade>
                  Adresse IP et l'identifiant du réseau</b> </td>
              </tr>
              <tr> 
                <td > 
                  <div >Entrez votre adresse IP :</div>
                </td>
                <td> 
                  <input type="text" name="IP1" size="3" maxlength="3" onClick="ClearBroadcast(this.form)">
                   
                  <input type="text" name="IP2" size="3" maxlength="3" onClick="ClearBroadcast(this.form)">
                   
                  <input type="text" name="IP3" size="3" maxlength="3" onClick="ClearBroadcast(this.form)">
                
                  <input type="text" name="IP4" size="3" maxlength="3" onClick="ClearBroadcast(this.form)">
                </td>
              </tr>

              <tr> 

                <td> 
                  <div>Entrez le masque de sous réseau :</div>
                </td>
                <td> 
                  <input type="text" name="SR1" size="3" value="255" maxlength="3" onClick="ClearBroadcast(this.form)">
                  
                  <input type="text" name="SR2" size="3" maxlength="3" value="255" onClick="ClearBroadcast(this.form)">
                  
                  <input type="text" name="SR3" size="3" maxlength="3" value="255" onClick="ClearBroadcast(this.form)">
                  
                  <input type="text" name="SR4" size="3" maxlength="3" value="0" onClick="ClearBroadcast(this.form)">
                  
                  <input type="button" value="Calculer" name="B1" onClick="CalcBroadcast(this.form)"></p> 
                </td>
              </tr>
              <tr> 
                <td colspan=2><p class="resultats">Résultats :</p> </td>
              </tr>
              <tr> 
                <td> 
                  <div>Adresse du Broadcast : </div>
                </td>
                <td> 
                  <input type="text" name="Broadcast" size="20">
                </td>
              </tr>
              <tr> 
                <td> 
                  <div>Adresse réseau : </div>
                </td>
                <td> 
                  <input type="text" name="Reseau" size="20">
                </td>
              </tr>

            </form>
              <form name="fLen2Mask">
                <tr> 
                  <td colspan=2> &nbsp; 
                    <p> 
                  </td>
                </tr>
                <tr> 
                  <td colspan=2 ><b>Calculer le masque de sous-réseau à parir de l'identifiant de réseau</b> 
                    <hr>
                  </td>
                </tr>
                <tr> 
                  <td>Entrez votre identifiant de réseau : </td>
                  <td> 
                    <input type="text" name="idReseau" size="2" maxlength="2" value="24">
                    <input type="button" value="Calculer" name="B1" onClick="CalcLen2Mask(this.form)">
                  </td>
                </tr>
                <tr> 
                  <td> <p class="resultats">Résultats:</p> </td>
                  <td> 
                    <input type="text" name="IP1" size="3" maxlength="3">
                    
                    <input type="text" name="IP2" size="3" maxlength="3">
                    
                    <input type="text" name="IP3" size="3" maxlength="3">

                    <input type="text" name="IP4" size="3" maxlength="3">
                  </td>
                </tr>
              </form>
              <form name="fMasqueCalcul2">
                <tr> 
                  <td colspan=2> &nbsp; 
                    
                  </td>
                </tr>
                <tr> 
                  <td colspan=2 ><b>Calculer le masque à partir de l'identifiant de réseaux</b> 
                    <hr>
                  </td>
                </tr>
                <tr> 
                  <td> Entrer votre identifiant de réseau : </td>
                  <td> 
                    <input type="text" name="IP1" size="3" maxlength="3" value="255">
                     
                    <input type="text" name="IP2" size="3" maxlength="3" value="255">
                    
                    <input type="text" name="IP3" size="3" maxlength="3" value="255">
                    
                    <input type="text" name="IP4" size="3" maxlength="3" value="0">
                    <input type="button" value="Calculer" name="B1" onClick="CalcMask2Len(this.form)">
                    
                  </td>
                </tr>
                <tr> 
                  <td> <p class="resultats">Résultats :</p> </td>
                  <td> 
                    <input type="text" name="idReseau" size="2" maxlength="2">
                  </td>
                </tr>
              
              <tr> 
                <td colspan=2> &nbsp; 
                  <p> 
                </td>
              </tr>
        </tr>
            </table>
                    </form>
            


</body>
</html>