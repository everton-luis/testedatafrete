<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastrar Cep</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
        
            .breadcrumb{
                background-color: white !important;
            }
        </style>

        <?php

            include('functions.php');
            include('api.php');

            //Instâncias
            $functions = new Functions();
            $api = new ServiceAPI();

            $lista_ceps = $functions->GetAllCeps();

            //var_dump($lista_ceps);

            if(isset($_POST['cep'])){
                //echo 'teste';
                $cep = $_POST['cep'];
                $dados_api = $api->getCep($cep);
                $obj = json_decode($dados_api);
                $cep = $obj->cep;

                if($cep == ""){
                    echo "<script>alert('cep inválido'); </script>";
                    // echo "<script>location.reload();; </script>";
                    echo "<script>location.href='cadastrarcep.php';</script>"; 
                }else{

                    $verificar_cadastro_cep = $functions->VerificarCep($cep);

                    if($verificar_cadastro_cep == true){
                        echo "<script>alert('este cep já está cadastrado!'); </script>";
                    }else{

                        $altitude = $obj->altitude;
                        $latitude = $obj->latitude;
                        $longitude = $obj->longitude;
                        $logradouro = $obj->logradouro;
                        $bairro = $obj->bairro;
                        $cidade = $obj->cidade->nome;
                        $estado = $obj->estado->sigla;

                        $registrar_cep = $functions->InserirCep($altitude,$cep,$latitude,$longitude,$logradouro,$bairro,$cidade,$estado);
                        
                        echo "<script>alert('cep cadastrado com sucesso!'); </script>";
                        

                        echo "<script>location.href='cadastrarcep.php';</script>";
                    } 
                }

            }



        ?>

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Cadastrar Cep</h1>

                    <br/>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cadastrar Cep</li>
                        </ol>
                    </nav>

                    <br/>

                    
                </div>
            </div>
        
        

            <div class="row">
                <div class="col-12">

                    <form method="POST">
            
                        <div class="form-group row">
                            <label for="inputCep" class="col-sm-1 col-form-label">Cep</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="cep" id="inputCep" placeholder="Digite Cep" required="required"
                                pattern="[0-9]{8}$" >
                                <small id="ceplHelp" class="form-text text-muted">
                                    Digite o cep no formato ex: 88810360(somente números contendo oito dígitos) </small>
                            </div>
                        </div>

                        <br/>

                        <button type="submit" class="btn btn-primary">Cadastrar Cep</button>


                    </form>

                </div>


            </div>

            <hr/>

            <div class="row">
                <div class="col-12">

                    <h3>Listagem de Ceps</h3>

                    <table id="mytable">
                        <thead>
                            <tr>
                                <th>Altitude</th>
                                <th>Cep</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Logradouro</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($lista_ceps as $ceps): ?>
                                <tr>
                                    <td><?php echo $ceps['altitude']; ?></td>
                                    <td><?php echo $ceps['cep']; ?></td>
                                    <td><?php echo $ceps['latitude']; ?></td>
                                    <td><?php echo $ceps['longitude']; ?></td>
                                    <td><?php echo $ceps['logradouro']; ?></td>
                                    <td><?php echo $ceps['bairro']; ?></td>
                                    <td><?php echo $ceps['cidade']; ?></td>
                                    <td><?php echo $ceps['estado']; ?></td>

                                </tr>


                            <?php endforeach; ?>




                        </tbody>



                    </table>


                </div>


            </div>


        </div>




      

    

            

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.3.1.js"></script>
        <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
        <script type="text/javascript" src="datatables/datatables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
        $('#mytable').DataTable( {
            
        } );
        } );
        </script>
    </body>

</html>