<?php

/* 
 * creamos la conexion a la base de datos en una clase estatica
 */
class Database{
    static function connect(){
        $db = new mysqli('localhost', 'root', '', 'tienda_master');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}

