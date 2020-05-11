<?php
function criaTabela ($servername, $username, $password, $dbname){
// Cria conexao
    $conn = new mysqli($servername, $username, $password, $dbname);
// Checa conexao
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// criando tabela
    $sql = "CREATE TABLE tarefas (tarefa_id int not null PRIMARY KEY AUTO_INCREMENT,
                      usuario_id int not null,
                      tarefa varchar(255) not null,
                      descricao varchar (255) not null,
                      concluido int                   
                      
)";

    if ($conn->query($sql) === TRUE) {
        echo " Tabela criada com sucesso ";
    } else {
        echo " -Erro ao criar tabela: " . $conn->error;
    }

    $conn->close();
}
