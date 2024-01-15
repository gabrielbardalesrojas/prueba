<?php
// server.php

class Calculadora {
    public function add($a, $b) {
        return $a + $b;
    }

    public function subtract($a, $b) {
        return $a - $b;
    }

    public function multiply($a, $b) {
        return $a * $b;
    }

    public function divide($a, $b) {
        if ($b != 0) {
            return $a / $b;
        } else {
            return "No se puede dividir por cero.";
        }
    }
}

$options = [
    'uri' => 'http://localhost:80/soap/server.php',
];

$server = new SoapServer(null, $options);
$server->setClass('Calculadora');
$server->handle();
?>
