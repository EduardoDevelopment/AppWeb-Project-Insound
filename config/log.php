<?php
function registrarLog($evento) {
    $archivo = 'logs.txt';
    $fechaHora = date('Y-m-d H:i:s');
    $registro = "$fechaHora - $evento\n";
    file_put_contents($archivo, $registro, FILE_APPEND);
}
?>
