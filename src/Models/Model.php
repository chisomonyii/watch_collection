<?php

namespace App\Models;

class Model extends Db
{
    public static function create($data,$table)
    {
        $cols = "";
        $placeholder = "";

        foreach ($data as $key =>$value) {
            $cols .= "$key,";
            $placeholder .= ":$key,";
        }

        $cols = substr($cols, 0, -1);
        $placeholder = substr($placeholder, 0, -1);

        $sql = "INSERT INTO `$table` ($cols) VALUES ($placeholder)";

        // Use parent::connect() instead of self::connect()
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute($data);

        return $data;
    }

    public static function find($parameters,$table)
    {
        $col = "";

        foreach ($parameters as $key =>$val) {
            $col =$key;
        }

        $sql = "SELECT * FROM `{$table}` WHERE $col = :$col LIMIT 1 ";

        // Use parent::connect() instead of self::connect()
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute($parameters);
        $result =$stmt->fetch();

        if ($result) {
            return $result;
        }

        return [];
    }
}