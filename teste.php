<?php

    include('functions.php');

    $functions = new Functions();

    $lista_ceps = $functions->GetAllCeps();

    //var_dump($lista_ceps);

    echo '<br/>';

    //$cep = $functions->GetCep();
    //echo $cep['cep'];

    echo 'teste';
    echo '<br/>';

    $number = 1234.56784654654;
    echo $number;
    $number = number_format($number,2,'.','');
    echo '<br/>';

    echo $number;
    echo '<br/>';

    $ceporigem = 80020010;
    $dados_cep_origem = $functions->GetCep1($ceporigem);
    $latitude_cep_origem = $dados_cep_origem['latitude'];
    echo $latitude_cep_origem;


?>