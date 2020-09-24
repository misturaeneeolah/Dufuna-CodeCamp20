<?php

class DB {
    protected $db_hostname = 'localhost';
    protected $db_username = 'root';
    protected $db_password = 'admin';
    protected $db_name = 'slim_app';

    public function DBConnect()
    {
        $mysql_connect_str = "mysql:host={$this->db_hostname};dbname={$this->db_name}";
        $pdo = new PDO($mysql_connect_str, $this->db_username, $this->db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}
