<?php
// Se instancia un objeto de la clase Database, la cual se encarga de la conexión a la base de datos
$db = new Database();

// Se establece la conexión con la base de datos
$con = $db->conectar();

// Se prepara la consulta SQL para obtener los IDs, nombres y precios de los productos activos
$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo = 1");

// Se ejecuta la consulta SQL preparada
$sql->execute();

// Se almacenan los resultados obtenidos en un array asociativo
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

?>