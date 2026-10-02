<?php

namespace App\Models;

class Model extends Db
{
    /**
     * @param array $parameters : should just be a single element
     */

    public static function create($data, $table)
{
    $cols = "";
    $placeholder = "";

    foreach ($data as $key => $value) {
        $cols .= "$key,";
        $placeholder .= ":$key,";
    }

    $cols = substr($cols, 0, -1);
    $placeholder = substr($placeholder, 0, -1);

    $sql = "INSERT INTO `$table` ($cols) VALUES ($placeholder)";

    $stmt = self::connect()->prepare($sql);
    $stmt->execute($data);

    return $data;
}

    public static function find($parameters, $table)
    {
        $col = "";

        foreach ($parameters as $key => $val) {
            $col = $key;
        }
        $sql = "SELECT * FROM `{$table}` WHERE $col = :$col LIMIT 1 ";
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($parameters);
        $result = $stmt->fetch();
        if ($result) {
            return $result;
        }
        return [];
    }
}
