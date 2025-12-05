<?php

function connect()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'portfolio';

    try {
        // Create MySQLi connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        // Set charset to utf8mb4 for proper character encoding
        $conn->set_charset("utf8mb4");

        // Established connection
        return $conn;
    } catch (Exception $e) {
        // Failed to establish a connection
        error_log($e->getMessage());
        return null;
    }
}
