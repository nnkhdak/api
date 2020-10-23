<?php
require_once('DaoUtils.php');

$endpoint = 'jido0121-dev-vpc.co7zjbyi7iqo.ap-northeast-1.rds.amazonaws.com';
$port = 1521;
$dbname = 'eikendb';
$username = 'eikenuser';
$passwd = 'hife84ty';

$dsn = "oci:dbname=//$endpoint:$port/$dbname";
$conn = DaoUtils::connect($dsn, $username, $passwd);

$sql = "SELECT * FROM T_GROUP Where GROUPID like '5000%'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
    echo var_export($row['GROUPID'], true);
}
?>