<?php

include('functions.php');
include('latlong.php');

$functions = new Functions();



$mensagens = array();

//$x = $_POST['x'];
//$y = $_POST['y'];

$cepdestino = $_POST['cepdestino'];
$ceporigem = $_POST['ceporigem'];



$dados_cep_origem = $functions->GetCep1($ceporigem);
$latitude_cep_origem = $dados_cep_origem['latitude'];

$longitude_cep_origem = $dados_cep_origem['longitude'];


if($cepdestino != ""){
    $dados_cep_destino = $functions->GetCep1($cepdestino);
    $latitude_cep_destino = $dados_cep_destino['latitude'];
    
    $longitude_cep_destino = $dados_cep_destino['longitude'];
    
    $distancia = distance($latitude_cep_origem,$longitude_cep_origem,$latitude_cep_destino, $longitude_cep_destino);
}
//$dados_cep_destino = $functions->GetCep1($cepdestino);
//$latitude_cep_destino = $dados_cep_destino['latitude'];
//$longitude_cep_destino = $dados_cep_destino['longitude'];


//$distancia = distance($latitude_cep_origem,$longitude_cep_origem,$latitude_cep_destino, $longitude_cep_destino);


//$mensagens['ceporigem'] = $ceporigem;
//$mensagens['latitudeceporigem'] = $latitude_cep_origem;
//$mensagens['longitudeceporigem'] = $longitude_cep_origem;

//$mensagens['cepdestino'] = $cepdestino;
//$mensagens['latitudecepdestino'] = $latitude_cep_destino;
//$mensagens['longitudecepdestino'] = $longitude_cep_destino;

$mensagens['ceporigem'] = $ceporigem;
$mensagens['cepdestino'] = $cepdestino;
$mensagens['ceporigemlatitude'] = $latitude_cep_origem;
$mensagens['ceporigemlongitude'] = $longitude_cep_origem;
if($cepdestino != ""){
    $mensagens['cepdestinolatitude'] = $latitude_cep_destino;
    $mensagens['cepdestinolongitude'] = $longitude_cep_destino;
    $mensagens['distancia'] = $distancia; 
}

if($cepdestino == ""){
    $mensagens['cepdestinolatitude'] = "";
    $mensagens['cepdestinolongitude'] = "";
    $mensagens['distancia'] = ""; 
}

//$mensagens['cepdestinolatitude'] = $latitude_cep_destino;
//$mensagens['cepdestinolongitude'] = $longitude_cep_destino;

//$mensagens['distancia'] = $distancia;



//$mensagens['cepdestino'] = $cepdestino;

//$mensagens['x'] = $x;
//$mensagens['y'] = $y;

die(json_encode($mensagens));

?>