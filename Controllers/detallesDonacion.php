<?php

session_start();

include '../DB/DB.php';

// Recibir los datos JSON
$detallesJSON = file_get_contents('php://input');

// Convertir la cadena JSON a un objeto PHP
$detalles = json_decode($detallesJSON);

$cantidad = $detalles['amt'];

// Preparar la consulta SQL para insertar datos
$sql = "INSERT INTO donaciones (monto)
        VALUES ('$cantidad')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Registro agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

?>