<?php

session_start();

include '../../DB/DB.php';

$programa_id = $_POST["programa_id"];
$nombre = $_POST["nombreAct"];
$fecha = $_POST["fechaAct"];
$hora = $_POST["hora"];
$descripcion = $_POST["descripcionAct"];

// Preparar la consulta SQL para insertar datos
$sql = "INSERT INTO actividades (programa_id, nombre, descripcion, fecha, hora)
        VALUES ('$programa_id', '$nombre', '$descripcion', '$fecha', '$hora')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    header("Location: /EqualEducation/Controllers/Coordinador/Cordi-Dashboard.php");
    die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

?>