<?php

// Ejemplo de conexión a diferentes tipos de bases de datos.
# Conectamos a la base de datos
$host='localhost';
$dbname='zorritodb';
$username='root';
$password='';

try {
$GLOBALS ['pdo'] = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$GLOBALS ['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



} catch(PDOException $e) {
echo 'Error: ' . $e->getMessage();
}


//$query de insertar
//$parametros: es un arreglo donde se colocaran todos los registros que se quieren insertar. 
function insertar($query, $parametros){
    $stmt = $GLOBALS['pdo']->prepare($query);
    $stmt->execute($parametros);
    return $stmt->rowCount();

}
function actualizar($query, $parametros){
    $stmt = $GLOBALS['pdo']->prepare($query);
    $stmt->execute($parametros);
    return $stmt->rowCount();

}
function seleccionar($query, $parametros){
        $stmt = $GLOBALS['pdo']->prepare($query);
        $stmt->execute($parametros);
    if($stmt -> rowCount()){
        while($row = $stmt ->fetch()){
            $resultado[] = $row;
        }
        return $resultado;
    }else{
        return array();
    }
}
function eliminar($query, $parametros){
    $stmt = $GLOBALS['pdo']->prepare($query);
    $stmt->execute($parametros);
    return $stmt->rowCount();
}



