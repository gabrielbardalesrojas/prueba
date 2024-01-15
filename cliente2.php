

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Realizar la solicitud SOAP al servidor
    $options = [
        'location' => 'http://localhost:80/soap1/servidor.php',
        'uri' => 'http://localhost:80/soap1/servidor.php',
    ];

    try {
        $client = new SoapClient(null, $options);
        $result = $client->getEstudiantes();
    } catch (SoapFault $e) {
        $result = "Error en la solicitud SOAP: " . $e->getMessage();
    }

    // Manejar el formulario de envío a la base de datos
    if (isset($_POST['enviar_seleccionados'])) {
        $seleccionados = $_POST['seleccionados'];
        $estudiantesSeleccionados = [];

        if (is_array($result)) {
            foreach ($result as $row) {
                if (in_array($row['id'], $seleccionados)) {
                    $estudiantesSeleccionados[] = $row;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente SOAP</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    color: #333;
    margin: 0;
    padding: 0;
}

h2 {
    color: #008080; /* Un tono de verde azulado oscuro */
}

form {
    margin-bottom: 20px;
}

button {
    background-color: #008080;
    color: #fff;
    padding: 10px 15px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #005454; /* Un tono más oscuro al pasar el ratón */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #008080;
    color: #fff;
}

input[type="checkbox"] {
    margin-right: 5px;
}

ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    margin-bottom: 10px;
}

/* Estilos para la sección de estudiantes seleccionados */
div[style="float: right;"] {
    float: right;
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    width: 300px;
    margin-top: 20px;
}

h3 {
    color: #008080;
}

    </style>
</head>

<body>
    <h2>Consulta de Estudiantes</h2>

    <!-- Formulario de consulta -->
    <form method="post" action="">
        <button type="submit" name="consulta">Consultar Estudiantes de la fiis</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <!-- Mostrar resultados de la consulta -->
        <form method="post" action="">
            <h3>Resultados de estudiantes:</h3>

            <?php if (is_array($result)): ?>
                <table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>facultad</th>
                        <th>Seleccionar</th>
                        
                    </tr>

                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nombre'] ?></td>
                            <td><?= $row['edad'] ?></td>
                            <td><?=$row['facultad'] ?></td>
                            <td><input type="checkbox" name="seleccionados[]" value="<?= $row['id'] ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <button type="submit" name="enviar_seleccionados">Mostrar</button>
            <?php else: ?>
                <p><?= $result ?></p>
            <?php endif; ?>
        </form>

        <?php if (isset($estudiantesSeleccionados) && is_array($estudiantesSeleccionados) && count($estudiantesSeleccionados) > 0): ?>
    <!-- Mostrar estudiantes seleccionados -->
    <div>
        <h3>Estudiantes Seleccionados del comedor:</h3>
        <ul>
            <?php foreach ($estudiantesSeleccionados as $estudiante): ?>
                <li>
                    <?= $estudiante['nombre'] ?> (ID: <?= $estudiante['id'] ?>) - Edad: <?= $estudiante['edad'] ?> facultad: <?=$estudiante['facultad'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <?php endif; ?>
</body>

</html>