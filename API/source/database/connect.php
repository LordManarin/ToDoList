<?php
require "config.php";
require "createDB.php";
require "createTable.php";

criarDB($servername, $username, $password);
criaTabela($servername, $username, $password, $dbname);