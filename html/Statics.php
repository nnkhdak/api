<?php
class Statics {

    const DSN_CONST = 'dsn';
    const USER_CONST = 'user';
    const PASS_CONST = 'pass';
    const OPTION_CONST = 'option';

    /**
     * DBに接続する。
     * @param param array パラメータ
     * arrayには以下で設定する
     * dsn string DSN
     * username string ユーザ名
     * passwd string パスワード
     * option array オプション
     */
    public static function connectDatabase($param) {
        $dsn = $param[self::DSN_CONST];
        $username = $param[self::USER_CONST];
        $passwd = $param[self::PASS_CONST];
        $pdo = new PDO($dsn, $username, $passwd);
        return $pdo;
    }

    /**
     * 環境設定ファイル(key=value改行 形式)を読み込みputenvする。
     * @param string  path ファイルパス
     * @param boolean throwException エラー発生時に例外をthrowするか(true:する, false:戻り値)
     */
    public static function putEnvironment($path = '/etc/environment', $throwException = true) {
        $envs = Statics::readKeyValueFile($path, $throwException);
        foreach ($envs as $key => $val) {
            $env = "$key=$val";
            putenv($env);
        }
    }

    /**
     * PHPのiniファイルを読み込む。
     * 読み込んだ際に接尾語に環境名のファイルが存在するならその値で上書く。
     * @param string  path ファイルパス
     * @param boolean throwException エラー発生時に例外をthrowするか(true:する, false:戻り値)
     * @return array(string => string) key=valueの連想配列
     */
    public static function readIniFile($name, $dir = './', $throwException = true) {
    }

    /**
     * key=value改行 形式のファイルを読み込み連想配列で返す。
     * @param string  path ファイルパス
     * @param boolean throwException エラー発生時に例外をthrowするか(true:する, false:戻り値)
     * @return array(string => string) key=valueの連想配列
     */
    public static function readKeyValueFile($path, $throwException = true) {
        if (!file_exists($path)) {
            $result = "notfound[$path]";
            if ($throwException) {
                throw new Exception($result);
            } else{
                return $result;
            }
        }

        $contents = file_get_contents($path);
        if ($contents === false) {
            $result = "read fail[$path]";
            if ($throwException) {
                throw new Exception($result);
            } else{
                return $result;
            }
        }

        if (empty($contents)) {
            return array();
        }

        $contents = preg_replace("/\r\n/", "\n", $contents);
        $pairs = explode("\n", $contents);
        $result = array();
        foreach ($pairs as $key => $pair) {
            $pair = explode("=", $pair);
            if (empty($pair) || count($pair) != 2) {
                continue;
            }
            $k = $pair[0];
            $v = $pair[1];
            $result[$k] = $v;
        }
        return $result;
    }
}
?>