<?php
class MySOAPService
{
    public function getEstudiantes()
    {
        // Configuración de la conexión a la base de datos (ajústala según tu entorno)
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'estudiantes';

        try {
            // Conexión a la base de datos
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta para obtener datos de la tabla estudiantes (ajústala según tu esquema)
            $query = "SELECT * FROM estudiante";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // Obtener resultados como un array asociativo
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Devolver resultados
            return $result;
        } catch (PDOException $e) {
            // Manejar errores de la base de datos
            return "Error en la conexión: " . $e->getMessage();
        }
    }
}

// Configuración del servidor SOAP
$options = [
    'uri' => 'http://localhost:80/soap1/servidor.php',
];
$server = new SoapServer(null, $options);
$server->setClass('MySOAPService');

// Manejar la petición del cliente.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar la solicitud SOAP
    $server->handle();
} else {
    // Si es una solicitud GET, mostrar un mensaje informativo
    echo "Este archivo se utiliza para manejar solicitudes SOAP. No se puede acceder directamente.";
}
?>
