<?php
session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Verifica si se envió el formulario para crear un nuevo informe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $programa_id = $_POST['programa_id']; // ID del programa asociado
    $tipo = $_POST['tipo']; // Tipo de informe (Impacto o Educativo)
    $contenido = addslashes(file_get_contents($_FILES['contenido']['tmp_name'])); // Contenido del informe

    // Inserta el informe en la base de datos
    $sqlInsertInforme = "INSERT INTO informes (programa_id, tipo, contenido, created_at, updated_at)
                         VALUES ('$programa_id', '$tipo', '$contenido', NOW(), NOW())";

    if ($conn->query($sqlInsertInforme) === TRUE) {
        echo "Informe creado exitosamente.";
    } else {
        echo "Error al crear el informe: " . $conn->error;
    }
}

// Consulta para obtener los informes
$sqlInformes = "SELECT * FROM informes";
$resultInformes = $conn->query($sqlInformes);

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="../../Resources/Images/logo.png" width="45" height="45" class="d-inline-block align-top" alt="Equal Education Logo">
            Equal Education
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Administrador-Dashboard.php' ? 'active' : ''; ?>" href="Administrador-Dashboard.php"><i class="fas fa-home"></i> Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Donaciones.php' ? 'active' : ''; ?>" href="Donaciones.php"><i class="fas fa-donate"></i> Registro de Donaciones y Gastos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Monitoreo.php' ? 'active' : ''; ?>" href="Monitoreo.php"><i class="fas fa-chart-line"></i> Monitoreo de Indicadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Informes.php' ? 'active' : ''; ?>" href="Informes.php"><i class="fas fa-file-alt"></i> Generación de Informes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Usuarios.php' ? 'active' : ''; ?>" href="Usuarios.php"><i class="fas fa-users-cog"></i>Usuarios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../Login/Logout.php">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h1 class="mb-4">Gestión de Informes</h1>

        <!-- Formulario para crear un nuevo informe -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Crear Nuevo Informe</h5>
                <form action="Informes.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="programa_id">ID del Programa</label>
                        <input type="number" class="form-control" id="programa_id" name="programa_id" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Informe</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="Impacto">Impacto</option>
                            <option value="Educativo">Educativo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contenido">Contenido del Informe</label>
                        <input type="file" class="form-control" id="contenido" name="contenido" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Informe</button>
                </form>
            </div>
        </div>

        <!-- Tabla para visualizar los informes -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informes Registrados</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Programa</th>
                            <th>Tipo</th>
                            <th>Fecha de Creación</th>
                            <th>Ver Informe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultInformes->num_rows > 0): ?>
                            <?php while($row = $resultInformes->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['programa_id']; ?></td>
                                    <td><?php echo $row['tipo']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td><a href="ver_informe.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Ver</a></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No hay informes registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
