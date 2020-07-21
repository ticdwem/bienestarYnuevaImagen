<?php

/* 
 * creamos la conexion a la base de datos en una clase estatica
 */
class Database{
    static function connect(){
        $db = new mysqli('107.180.26.91', 'SaludBienestar', '!]2t#ya8}&p)', 'saludbienestar');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}

