<?php
require_once('DaoUtils.php');

$endpoint = 'jido0121-dev-vpc.co7zjbyi7iqo.ap-northeast-1.rds.amazonaws.com';
$port = 1521;
$dbname = 'eikendb';
$username = 'eikenuser';
$passwd = 'hife84ty';

$dsn = DaoUtils::toDSN($endpoint,$port,$dbname);
$conn = DaoUtils::connect($dsn, $username, $passwd);

$sql = 'SELECT count(1) as cnt FROM T_ACCOUNT WHERE stepid = "nona"';
foreach ($conn->query($sql) as $row) {
    echo var_export($row, true);
}
?>
hehe