<?php

class Conexion_wp extends PDO
{
    private $tipo_de_base = 'mysql';
    private $host = 'localhost';
    private $nombre_de_base = 'u887467577_clubsky';
    private $usuario = 'u887467577_clubsky';
    private $contrasena = '6jy^O1]tP';


    public function __construct()
    {
        try {
            parent::__construct($this->tipo_de_base . ':host=' . $this->host . ';dbname=' . $this->nombre_de_base, $this->usuario, $this->contrasena, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
        }
    }
}


