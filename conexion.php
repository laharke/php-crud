<?php
function conexion() {
    $host = "host=localhost";
    $port = "port=5432";
    $dbname = "dbname=crud";
    $user = "user=mauro";
    $password = "password=dw3dn41jf32";

    $db = pg_connect("$host $port $dbname $user $password");

    return $db;
}
?>