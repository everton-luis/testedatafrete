<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Projeto Cadastro de Viagens</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
        
        </style>

        <?php

            include('functions.php');

            //Instâncias
            $functions = new Functions();
            $listagem_viagens = $functions->ListagemViagens();

            //var_dump($listagem_viagens);


        ?>

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Projeto Cadastro de Viagens</h1>

                    <br/>

                    <a href="cadastrarcep.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Cadastrar Cep</a>
                    <a href="cadastrarviagem2.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Cadastrar Viagem</a>
                </div>
            </div>

            <br/>
            <hr/>
            <div class="row">
                <div class="col-12">
                    <h3>Listagem de Viagens</h3>

                    <table id="mytable">
                        <thead>
                            <tr>
                                <th>Cep Origem</th>
                                <th>Cep Destino</th>
                                <th>Distância</th>
                                <th>Hora Cadastro</th>
                                <th>Hora Alteração</th>
                                <th>Ações</th>
                                
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach($listagem_viagens as $viagens): ?>                            
                                <tr>
                                    <td><?php echo $viagens['cep_origem']; ?></td>
                                    <td><?php echo $viagens['cep_destino']; ?></td>
                                    <td><?php echo $viagens['distancia']; ?> Km</td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($viagens['hora_cadastro'])); ?></td>
                                    <td>
                                        <?php 
                                        if($viagens['hora_alteracao'] == '0000-00-00 00:00:00'){
                                            echo 'Não houve alteração';
                                        }else{
                                            echo date('d/m/Y H:i', strtotime($viagens['hora_alteracao'])); 
                                        } 
                                         
                                        ?>
                                    </td>
                                    <td>
                                        <a href="editarviagem.php?id=<?php echo $viagens['id']; ?>" class="btn btn-primary" role="button" aria-pressed="true">Editar Viagem</a>
                                        <a href="deletarviagem.php?id=<?php echo $viagens['id']; ?>" class="btn btn-danger" role="button" aria-pressed="true"
                                        onclick="return confirm('Tem certeza que deseja deletar esta viagem?')">
                                            Deletar Viagem
                                        </a>
                                    </td>
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