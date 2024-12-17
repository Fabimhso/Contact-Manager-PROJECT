<?php
class Database {
    public static function connect() {
        $dotenv = parse_ini_file('.env');
        $host = $dotenv['DB_HOST'];
        $name = $dotenv['DB_NAME'];
        $user = $dotenv['DB_USER'];
        $pass = $dotenv['DB_PASS'];

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$name;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro na conexão com o banco: " . $e->getMessage());
        }
    }
}