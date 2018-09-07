<?php
$tarih=$_GET['tarih'];
$konum=$_GET['konum'];
$gidis=$_GET['gidis'];
$ch = curl_init();
$url = 'https://api.turkishairlines.com/test/getAvailability';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "ReducedDataIndicator":false,
  "RoutingType":"O",
  "PassengerTypeQuantity":[
    {
      "Code":"adult",
      "Quantity":1
    }
  ],
  "OriginDestinationInformation":[
    {
      "DepartureDateTime":{
        "WindowAfter":"P0D",
        "WindowBefore":"P0D",
        "Date":"' . $tarih . '"
      },
      "OriginLocation":{
        "LocationCode":"' . $konum. '",
        "MultiAirportCityInd":false
      },
      "DestinationLocation":{
        "LocationCode":"' . $gidis. '",
        "MultiAirportCityInd":false
      },
      "CabinPreferences":[
        {
          "Cabin":"ECONOMY"
        }
      ]
    }
 
  ]
}');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisecret: a83dd8f6cf1c4513b0c4597a95981d9a','apikey: l7xxd24fc01c90604192b25c79939c9e633d','Content-Type: application/json'));
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response,TRUE);
$x=count($data["data"]["availabilityOTAResponse"]["createOTAAirRoute"]["extraOTAAvailabilityInfoListType"]["extraOTAAvailabilityInfoList"]["extraOTAFlightInfoListType"]["extraOTAFlightInfoList"]);
$ucuz=$data["data"]["availabilityOTAResponse"]["createOTAAirRoute"]["extraOTAAvailabilityInfoListType"]["extraOTAAvailabilityInfoList"]["extraOTAFlightInfoListType"]["extraOTAFlightInfoList"][0]["bookingPriceInfoType"]["PTC_FareBreakdowns"]["PTC_FareBreakdown"]["PassengerFare"]["BaseFare"]["Amount"];
$ucuzindis=0;
for ($i=1; $i <$x ; $i++) { 
if($data["data"]["availabilityOTAResponse"]["createOTAAirRoute"]["extraOTAAvailabilityInfoListType"]["extraOTAAvailabilityInfoList"]["extraOTAFlightInfoListType"]["extraOTAFlightInfoList"][$i]["bookingPriceInfoType"]["PTC_FareBreakdowns"]["PTC_FareBreakdown"]["PassengerFare"]["BaseFare"]["Amount"]<$ucuz){
  $ucuz=$data["data"]["availabilityOTAResponse"]["createOTAAirRoute"]["extraOTAAvailabilityInfoListType"]["extraOTAAvailabilityInfoList"]["extraOTAFlightInfoListType"]["extraOTAFlightInfoList"][$i]["bookingPriceInfoType"]["PTC_FareBreakdowns"]["PTC_FareBreakdown"]["PassengerFare"]["BaseFare"]["Amount"];
  $ucuzindis=$i;
}
}



$zaman=$data["data"]["availabilityOTAResponse"]["createOTAAirRoute"]["OTA_AirAvailRS"]["OriginDestinationInformation"]["OriginDestinationOptions"]["OriginDestinationOption"][$ucuzindis]["FlightSegment"]["ArrivalDateTime"];



//var_dump($response);


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

     body{
        
 

      }
</style>
    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col" style="margin-top: 50px">

<?php
if(is_null($zaman)){

  echo '<center><div class="alert alert-danger" role="alert" style="height: 50%">
  <h1>Malesef Hiç Bilet Bulamadık , Böyle Bir Uçuş Olmayacak:(</h1><br><i class="fas fa-exclamation-triangle fa-6x"></i> </center>

';
}
else{
   echo '<center><div class="alert alert-success" role="alert" style="height: 50%">
  <h1>Bilet bulduk , hemde sizin için en ucuzunu getirdik</h1></center>

';
}


?>



</div>
</div>

<?php
if(!is_null($zaman)){
  echo '<div class="row">
  <div class="col-6" style="margin-top: 5px">
<div class="card">
  <div class="card-header">
  <center> Bilet Ücreti</center>
  </div>
  <div class="card-body">
   
    <p class="card-text">'.'<center>'.$ucuz.' tl'.'</center>
     </p>
    
  </div>
</div>
 </div>
  <div class="col-6" style="margin-top: 5px">
    <div class="card">
  <div class="card-header">
  <center> Kalkış Zamanı</center>
  </div>
  <div class="card-body">
   
    <p class="card-text"><center>'.$zaman.'</center></p>
    
  </div>
</div>
  </div>
  </div>';
}
?>
<div class="row">
  <div class="col">
    <br>
    <a href="mert.php"><button type="button" class="btn btn-primary btn-lg btn-block">Ana Sayfaya Dön</button></a>
  </div>
</div>
</div>






   </body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

 
</html>