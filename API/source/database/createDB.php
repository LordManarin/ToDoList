<?php


function criarDB($servername, $username, $password,$databasename){

// Cria conexao
    $conn = new mysqli($servername, $username, $password);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
// criando banco de dados
    $sql = "CREATE DATABASE $databasename";
    if ($conn->query($sql) === TRUE) {
        echo " Banco de dados criada com sucesso ";
    } else {
        echo " -Erro ao criar banco de dados: " . $conn->error;
    }
    $conn->close();
};