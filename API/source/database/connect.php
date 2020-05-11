<?php
require "config.php";
require "createDB.php";
require "createTable.php";

criarDB($servername, $username, $password,$dbname);
echo "</br>";
criaTabela($servername, $username, $password, $dbname);