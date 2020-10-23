<?php

class DaoUtils {

    public static function connect(
          $dsn
        , $username
        , $passwd
        , $option = null
        ) {
        $pdo = new PDO($dsn, $username, $passwd, $option);
        return $pdo;
    }

    public static function toDSN(
          $endpoint
        , $port
        , $dbname
        ) {
        $dsn = "oci:dbname=//$endpoint:$port/$dbname";
        return $dsn;
    }
}
?>