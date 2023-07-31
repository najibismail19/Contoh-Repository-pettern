<?php 
function getConnection () : PDO {
    $name = "coba_pdo";
    $host = "127.0.0.1";
    $user = "root";
    $password = "";
    
    return  new PDO("mysql:dbname=$name;host=$host", $user, $password);
}

?>