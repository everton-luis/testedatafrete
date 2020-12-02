<?php

include('functions.php');

$functions = new Functions();

$id_viagem = $_GET['id'];

$deletar_viagem = $functions->DeletarViagem($id_viagem);

echo "<script>alert('Viagem Deletada com Sucesso!');</script>";
echo "<script>location.href='index.php';</script>";


?>