<?php
class Conexion {
    static public function conectar() {
        try {
            $base = new PDO("mysql:host=localhost:3306;dbname=Premium", "root", "");
            $base->exec("set names utf8");
            return $base;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>
