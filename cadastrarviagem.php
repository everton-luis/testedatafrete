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
                    var cep = $("#FormCepOrigem").val();
                    //alert(ceporigem);
                    if(cep == ""){

                    }else{
                        //alert('asdf');
                        $.ajax({
                            
                            url:'processa.php',
                            data: {cep : cep, ceporigem : ceporigem},
                            type: 'POST',
                            dataType: 'json',
                            success: function(retorno){
                                if(retorno.erro == 1){
                                    alert(retorno.msg);
                                }else{
                                    $(".ceporigem").html('');
                                    $(".ceporigem").html(retorno.ceporigem);
                                    $(".latitudeceporigem").html('');
                                    $(".latitudeceporigem").html(retorno.latitudeceporigem);
                                    $(".longitudeceporigem").html('');
                                    $(".longitudeceporigem").html(retorno.longitudeceporigem);
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
                    var cep = $("#FormCepDestino").val();
                    if(cep == ""){

                    }else{
                       //alert(cepdestino);
                       $.ajax({
                            
                            url:'processa.php',
                            data: {cep : cep, ceporigem : ceporigem},
                            type: 'POST',
                            dataType: 'json',
                            success: function(retorno){
                                if(retorno.erro == 1){
                                    alert(retorno.msg);
                                }else{
                                    
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

            //Instâncias
            $functions = new Functions();
            $lista_ceps = $functions->GetAllCeps();
            //var_dump($lista_ceps);

            
            if(isset($_POST['ceporigem']) && isset($_POST['cepdestino']) ){
                $ceporigem = $_POST['ceporigem'];
                $cepdestino = $_POST['cepdestino'];

                echo $ceporigem;
                echo '<br/>';
                echo $cepdestino;

                

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
                    cep origem:<span class="ceporigem"></span>

                    <br/>
                    latitude cep origem:<span class="latitudeceporigem"></span>

                    <br/>

                    longitude cep origem:<span class="longitudeceporigem"></span>

                    <br/>

                    <br/>
                    cep destino:<span class="cepdestino"></span>

                    <br/>
                    latitude cep destino:<span class="latitudecepdestino"></span>

                    <br/>

                    longitude cep destino:<span class="longitudecepdestino"></span>

                    <br/>

                    Distância:<span class="distancia"></span>

                    <br/>

                    
                    <button type="submit" class="btn btn-primary">Cadastrar Viagem</button>
                    


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