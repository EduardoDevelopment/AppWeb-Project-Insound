<?php

// Se crea una nueva instancia de la clase Database, que permite la conexión a la base de datos
$db = new Database();
$con = $db->conectar();

/* Se obtienen los parámetros 'id' y 'token' de la URL, y se asignan a las variables $id y $token respectivamente. 
En caso de que no se reciban estos parámetros, se muestra un mensaje de error y se detiene la ejecución del script. */
$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

/* Validación */

if($id == '' || $token == ''){
    echo 'Error no se pudo validar la informacion.';
    exit;
} else{
    // Se genera un token temporal para validar que el id recibido coincide con el token original
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    // Si el token recibido coincide con el temporal, se procede a obtener la información del producto
    if($token == $token_tmp){

        // Se verifica si existe algún registro en la base de datos con el id recibido y que esté activo
        $sql = $con-> prepare("SELECT count(id), nombre, tipo, precio FROM productos WHERE id=? AND activo=1");
        $sql-> execute([$id]);

        // Si se encuentra al menos un registro, se obtienen los datos del producto y se asignan a variables
        if($sql -> fetchColumn() > 0){
            $sql = $con-> prepare("SELECT count(id), nombre, tipo, precio, descripcion, descuento FROM productos WHERE id=? AND activo=1");
            $sql-> execute([$id]);
            $row = $sql -> fetch(PDO::FETCH_ASSOC);
            $precio = $row['precio'];
            $nombre = $row['nombre'];
            $tipo = $row['tipo'];
            $descripcion = $row['descripcion'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
            $dir_images = 'img/' . $id . '/';

            // Se obtiene la ruta de la imagen principal del producto. Si no existe, se asigna una imagen por defecto
            $rutaimg = $dir_images . 'principal.webp';
            if(!file_exists($rutaimg)){
                $rutaimg = 'img/No-image-found.webp';
            }

            // Se crea un array de imágenes adicionales, si es que existen
            $imagenes = array();
            if(file_exists($dir_images)){
                $dir = dir($dir_images);
                while(($archivo = $dir->read()) != false){
                    if($archivo != 'principal.webp' && (strpos($archivo, 'webp') || strpos($archivo, 'webp'))){
                        $imagenes[] = $dir_images . $archivo;
                    }
                }
                $dir -> close();
            }
        }
    }else{
        echo '<h4>Error no se pudo validar la informacion.</h4>';
        exit;
    }
}

/* Se realiza una consulta a la base de datos para obtener los productos activos, y se asigna el resultado a la variable $resultado */
$con = $db->conectar();
$sql = $con-> prepare("SELECT id, nombre, tipo, precio FROM productos WHERE activo=1");
$sql-> execute();
$resultado = $sql->fetchall(PDO::FETCH_ASSOC);

?>
