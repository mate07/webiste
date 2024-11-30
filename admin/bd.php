<?php

# Creando variables unversales para la cadena de conexión vía PDO
$servidor = "localhost";
$baseDatos = "website";
$usuario = "root";
$password = "";

# Creamos la conexión vía PDO
try{
    $cn = new PDO("mysql:host=$servidor; dbname=$baseDatos", $usuario, $password);
    echo "Conexión Realizada 😊 ...";
}
catch(Exception $error){
    echo $error->getMessage();
}