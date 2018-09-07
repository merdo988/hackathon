<?php

$ch = curl_init();
    $url = 'https://api.turkishairlines.com/test/getPortList';
    $queryParams = '?' . urlencode('airlineCode') . '=' . urlencode('TK') . '&' . urlencode('languageCode') . '=' . urlencode('TR');
    curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisecret: a83dd8f6cf1c4513b0c4597a95981d9a','apikey: l7xxd24fc01c90604192b25c79939c9e633d'));
    $response = curl_exec($ch);
    curl_close($ch);
$data = json_decode($response, true);
$sayac=count($data["data"]["Port"]);
$a=0;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<style>
.card:hover{
  background-color: red;
  width: 25rem;
}
     body{
        
 

      }
</style>
    <title>Hello, world!</title>
  </head>
  <body>
  	<center><h2>THY test/getPortList Tests</h2></center>
    <center><h2>THY test/getAvailability</h2></center>
  	<br>
  	<center><h5>Bu sayfa verileri THY DEV.API den otomatik olarak çeker.Port Listesi için Ülke kodu TR(Türkiye) , havaalanı kodu TK(Turkish Airlines) olarak girilmiştir.</h5></center>
 
    <div class="container">
      <div class="row">
        <div class="col">
<div class="card" style="width: 18rem;">
  <div class="card-header">
   <center>Havaalanı Kısaltmaları</center>
  </div>
  
  <ul class="list-group list-group-flush">
    <?php
for ($i=0; $i <$sayac ; $i++) { 
    if($data["data"]["Port"][$i]["Country"]["Code"]=="TR"){
    	echo '<li class="list-group-item">'.'<center>'.$data["data"]["Port"][$i]["Code"].'</center>'.'</li>';
      
     
    }
}





    ?>
  </ul>
</div>



  
      </div>
         <div class="col">
<div class="card" style="width: 18rem;">
  <div class="card-header">
  <center>Enlem-Boylam</center> 
  </div>
  
  <ul class="list-group list-group-flush">
    <?php
for ($i=0; $i <$sayac ; $i++) { 
    if($data["data"]["Port"][$i]["Country"]["Code"]=="TR"){


    	echo '<li class="list-group-item">'.'<center>'.$data['data']['Port'][$i]['Coordinate']['latitude']."-".$data['data']['Port'][$i]['Coordinate']['longitude'].'<a target="_blank" rel="noopener noreferrer" href="https://www.google.com/maps/search/'.$data['data']['Port'][$i]['Coordinate']['latitude'].','.$data['data']['Port'][$i]['Coordinate']['longitude'].'">'.'<i class="fas fa-external-link-square-alt"></i>'.'</a>'.'</center>'.'</li>';
  
    }
}





    ?>
  </ul>
</div>



  
      </div>
               <div class="col" style="border-color: black;border-width: 5px"><center>
                <div class="card-header">
    Bilet Bulma Alanı
  </div>
<form action="biletbak.php" method="GET">
  <div class="form-group">
    <label for="exampleInputEmail1">Bulunduğunuz İlin Havaalanı Kodu</label>
    <input type="text" name="konum" placeholder="IST">

  </div>
  <div class="form-group">
   <label for="exampleInputEmail1">Gideceğiniz İlin Havalimanı Kodu</label>
    <input type="text" name="gidis" placeholder="IZM">
  </div>
<div class="form-group">
   <label for="exampleInputEmail1">Gideceğiniz Bilet Tarih Girinz </label>
    <input type="text" name="tarih" placeholder="14SEP">
  </div>
  <button type="submit" class="btn btn-primary">Bilet Bul</button>
</form>



  </center>
  <br>
  <p>Şehirin kısa kodunu giriniz.Tarihi gün+ayın kısa kodu olarak giriniz</p>
  <p>Örnek Bir kaç sorgu :IST MQM 15SEP , IST BGG 17SEP </p> ,
  <br>
  <br>
  ADA Adana
ADF Adiyaman
AFY Afyon
AJI Agri
ANK Ankara
AYT Antalya
MQJ Balikesir
BZI Balikesir
BDM Bandirma
BAL Batman
BXN Bodrum
BTZ Bursa
BGG Bingöl
CKZ Canakkale
DLM Dalaman
DNZ Denizli
DIY Diyarbakir
EDO Edremit Korfez
EZS Elazig
ERC Erzincan
ERZ Erzurum
ESK Eskisehir
GZT Gaziantep
GZP Gazipaşa
ISE Isparta
IST Istanbul (Atatürk)
SAW Istanbul (Sabiha Gökçen)
IZM Izmir
QST Izmit
KCM Kahramanmaras
KSY Kars
KFS Kastamonu
KZR Zafer Havalimanı (kütahya)
ASR Kayseri
KCO Kocaeli
KYA Konya
XKU Kusadasi
MLX Malatya
MQM Mardin
QRQ Marmaris
QIN Mersin
MZH Merzifon
MSR Mus
NAV Nevsehir
OGU Ordu-Giresun Havalimanı
QOR Ordu
QRI Rize
SSX Samsun
SFQ Sanliurfa
SXZ Siirt
SIC Sinop
SQD Sinop
VAS Sivas
TEQ Tekirdag
TJK Tokat
TZX Trabzon
USQ Usak
VAN Van
ONQ Zonguldak
YKO Hakkari Yüksekova
      </div>
    </div>
  </div>
  <br>

   </body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

 <center><a href="https://www.linkedin.com/in/mert-i-9a1ba410b/">Mert İnal</a></center>
</html>