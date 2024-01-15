<?php
// client_multiply_divide.php

$soapOptions = [
    'location' => 'http://192.168.1.53:80/soap/server.php',
    'uri'      => 'http://192.168.1.53:80/soap/server.php',
];

$client = new SoapClient(null, $soapOptions);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = isset($_POST['num1']) ? intval($_POST['num1']) : 0;
    $num2 = isset($_POST['num2']) ? intval($_POST['num2']) : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

    if ($operation === 'multiply') {
        $result = $client->__soapCall('multiply', [$num1, $num2]);
        echo 'Resultado de Multiplicación: ' . $result;
    } elseif ($operation === 'divide') {
        $result = $client->__soapCall('divide', [$num1, $num2]);
        echo 'Resultado de División: ' . $result;
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
        <title>Cliente 2</title>
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
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input,
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

button {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

        </style>
    </head>
    <body>
        <h2>Cliente 2</h2>
        <form method="post">
            <label for="num1">Número 1:</label>
            <input type="text" name="num1" id="num1" required>
            <br>
            <label for="num2">Número 2:</label>
            <input type="text" name="num2" id="num2" required>
            <br>
            <label for="operation">Operación:</label>
            <select name="operation" id="operation">
                <option value="multiply">Multiplicar</option>
                <option value="divide">Dividir</option>
            </select>
            <br>
            <button type="submit">Calcular</button>
        </form>
    </body>
    </html>
    <?php
}
?>
