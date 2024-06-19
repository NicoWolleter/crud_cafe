<?php
function getConnection()
{
    require_once 'configs.php';
    try {

        /**
         * Establishes a connection to the MySQL database.
         *
         * @param string $url The URL of the MySQL server.
         * @param string $user The username to use when connecting to the database.
         * @param string $password The password to use when connecting to the database.
         * @param string $dbname The name of the database to use when connecting to the database.
         * @return PDO The PDO object representing the database connection.
         */

        $user = 'pma';
        $password = '';
        $conexion = new PDO("mysql:host=localhost;dbname=test", $user, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
?>