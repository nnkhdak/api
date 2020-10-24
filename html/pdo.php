<?php
require_once('Statics.php');

$endpoint = 'jido0121-dev-vpc.co7zjbyi7iqo.ap-northeast-1.rds.amazonaws.com';
$port = 1521;
$dbname = 'eikendb';
$username = 'eikenuser';
$passwd = 'hife84ty';

$dsn = "oci:dbname=//$endpoint:$port/$dbname";
$param = array(
      Statics::DSN_CONST => $dsn
    , Statics::USER_CONST => $username
    , Statics::PASS_CONST => $passwd
);

$conn = Statics::connectDatabase($param);

$sql = "SELECT * FROM T_GROUP Where GROUPID like '5000%'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
    echo var_export($row['GROUPID'], true);
    echo "\n<br/>";
}
?>