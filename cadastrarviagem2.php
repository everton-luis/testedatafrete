<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Cadastrar Viagem</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <style>
        
            .breadcrumb{
                background-color: white !important;
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function(){

                //alert('teste');

                var ceporigem = "";
                var cepdestino = "";

                $("#FormCepOrigem").change(function(){
                    //alert('cep origem');
                    ceporigem = $("#FormCepOrigem").val();
                    //var ceporigem = $("#FormCepOrigem").val();
                    //alert(ceporigem);
                    
                    if(ceporigem == ""){

                    }else{
                        //alert('asdf');
                        //alert(ceporigem);
                        $.ajax({
                            
                            url:'processa.php',
                            data: {ceporigem : ceporigem, cepdestino : cepdestino},
                            type: 'POST',
                            dataType: 'json',
                            success: function(retorno){
                                if(retorno.erro == 1){
                                    alert(retorno.msg);
                                }else{
                                    $(".ceporigem").html('');
                                    $(".ceporigem").html(retorno.ceporigem);
                                    $(".latitudeceporigem").html('');
                                    $(".latitudeceporigem").html(retorno.ceporigemlatitude);
                                    $(".longitudeceporigem").html('');
                                    $(".longitudeceporigem").html(retorno.ceporigemlongitude);
                                    $(".cepdestino").html('');
                                    $(".cepdestino").html(retorno.cepdestino);
                                    $(".latitudecepdestino").html('');
                                    $(".latitudecepdestino").html(retorno.cepdestinolatitude);
                                    $(".longitudecepdestino").html('');
                                    $(".longitudecepdestino").html(retorno.cepdestinolongitude);
                                    $(".distancia").html(retorno.distancia);
                                }
                            },
                            error: function(){
                                alert('houve algum erro');
                            }
                        });
                    }
                });

                $("#FormCepDestino").change(function(){
                    //alert('cep destino');
                    cepdestino = $("#FormCepDestino").val();
                    //var cep = $("#FormCepDestino").val();
                    if(cepdestino == ""){

                    }else{
                       //alert(cepdestino);
                       $.ajax({
                            
                            url:'processa.php',
                            data: {ceporigem : ceporigem, cepdestino : cepdestino},
                            type: 'POST',
                            dataType: 'json',
                            success: function(retorno){
                                if(retorno.erro == 1){
                                    alert(retorno.msg);
                                }else{
                                    $(".ceporigem").html('');
                                    $(".ceporigem").html(retorno.ceporigem);
                                    $(".latitudeceporigem").html('');
                                    $(".latitudeceporigem").html(retorno.ceporigemlatitude);
                                    $(".longitudeceporigem").html('');
                                    $(".longitudeceporigem").html(retorno.ceporigemlongitude);
                                    $(".cepdestino").html('');
                                    $(".cepdestino").html(retorno.cepdestino);
                                    $(".latitudecepdestino").html('');
                                    $(".latitudecepdestino").html(retorno.cepdestinolatitude);
                                    $(".longitudecepdestino").html('');
                                    $(".longitudecepdestino").html(retorno.cepdestinolongitude);
                                    $(".distancia").html(retorno.distancia);
                                }
                            },
                            error: function(){
                                alert('Selecione Cep Origem para realizar o cálculo da distância da viagem');
                            }
                        });
                    }
                });

            });


        </script>


        <?php

            include('functions.php');
            include('latlong.php');

            //Instâncias
            $functions = new Functions();
            $lista_ceps = $functions->GetAllCeps();
            //var_dump($lista_ceps);

            
            if(isset($_POST['ceporigem']) && isset($_POST['cepdestino']) ){
                $ceporigem = $_POST['ceporigem'];
                $cepdestino = $_POST['cepdestino'];

                //echo $ceporigem;
                //echo '<br/>';
                //echo $cepdestino;


                $dados_cep_origem = $functions->GetCep1($ceporigem);
                $id_cep_origem = $dados_cep_origem['id'];
                $latitude_cep_origem = $dados_cep_origem['latitude'];
            
                $longitude_cep_origem = $dados_cep_origem['longitude'];
                
                //echo $id_cep_origem;
                //echo '<br/>';
                //echo $latitude_cep_origem;
                //echo '<br/>';
                //echo $longitude_cep_origem;
                //echo '<br/>';
                $dados_cep_destino = $functions->GetCep1($cepdestino);
                $id_cep_destino = $dados_cep_destino['id'];
                $latitude_cep_destino = $dados_cep_destino['latitude'];
                
                $longitude_cep_destino = $dados_cep_destino['longitude'];
                
                //echo '<br/>';
                //echo $id_cep_destino;
                //echo '<br/>';
                //echo $latitude_cep_destino;
                //echo '<br/>';
                //echo $longitude_cep_destino;

                //echo '<br/><br/>';

                $distancia = distance($latitude_cep_origem,$longitude_cep_origem, $latitude_cep_destino, $longitude_cep_destino);

                //echo $distancia;

                $cadastrarViagem = $functions->CadastrarViagem($id_cep_origem,$id_cep_destino,$distancia);


                echo "<script>alert('Cadastro Viagem realizado com Sucesso!');</script>";

                echo "<script>location.href='index.php';</script>";
                

            }


        ?>

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Cadastro Viagem</h1>
                    <br/>

                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Viagem</li>
                    </ol>
                    </nav>

                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <form method="POST">

                    <div class="form-group row">
                        <label for="FormCepOrigem" class="col-sm-2 col-form-label">Cep Origem</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="FormCepOrigem" name="ceporigem" required="required">
                                <option value="">Escolher cep</option>
                                <?php foreach($lista_ceps as $ceps): ?>
                                    <option value="<?php echo $ceps['cep']  ?>"><?php echo $ceps['cep'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="FormCepDestino" class="col-sm-2 col-form-label">Cep Distino</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="FormCepDestino" name="cepdestino" required="required">
                                <option value="">Escolher cep</option>
                                <?php foreach($lista_ceps as $ceps): ?>
                                    <option value="<?php echo $ceps['cep']  ?>"><?php echo $ceps['cep'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <br/>
                    Cep origem:<span class="ceporigem"></span>

                    <br/>
                    Latitude cep origem:<span class="latitudeceporigem"></span>

                    <br/>

                    Longitude cep origem:<span class="longitudeceporigem"></span>

                    <br/>

                    <br/>
                    Cep destino:<span class="cepdestino"></span>

                    <br/>
                    Latitude cep destino:<span class="latitudecepdestino"></span>

                    <br/>

                    Longitude cep destino:<span class="longitudecepdestino"></span>

                    <br/>

                    Distância:<span class="distancia"></span> Km

                    <br/><br/>

                    
                    <input type="submit" class="btn btn-primary" value="Cadastrar" />
                    


                    </form>
                </div>
            </div>

            <div class="row">
                
                




            </div>


        
        </div>

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    </body>

</html>