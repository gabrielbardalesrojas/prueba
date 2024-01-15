<?php
// client_add_subtract.php

$soapOptions = [
    'location' => 'http://192.168.1.53:80/soap/server.php',
    'uri'      => 'http://192.168.1.53:80/soap/server.php',
];

$client = new SoapClient(null, $soapOptions);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = isset($_POST['num1']) ? intval($_POST['num1']) : 0;
    $num2 = isset($_POST['num2']) ? intval($_POST['num2']) : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

    if ($operation === 'add') {
        $result = $client->__soapCall('add', [$num1, $num2]);
        echo 'Resultado de Suma: ' . $result;
    } elseif ($operation === 'subtract') {
        $result = $client->__soapCall('subtract', [$num1, $num2]);
        echo 'Resultado de Resta: ' . $result;
    } else {
        echo 'Operación no válida.';
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cliente 1</title>
        <style>
            body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h2 {
    color: #333;
}

form {
    max-width: 400px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
}

input, select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

        </style>
    </head>
    <body>
        <h2>Cliente 1</h2>
        <form method="post">
            <label for="num1">Número 1:</label>
            <input type="text" name="num1" id="num1" required>
            <br>
            <label for="num2">Número 2:</label>
            <input type="text" name="num2" id="num2" required>
            <br>
            <label for="operation">Operación:</label>
            <select name="operation" id="operation">
                <option value="add">Sumar</option>
                <option value="subtract">Restar</option>
            </select>
            <br>
            <button type="submit">Calcular</button>
        </form>
    </body>
    </html>
    <?php
}
?>
