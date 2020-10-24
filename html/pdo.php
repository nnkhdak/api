<?php
require_once('Statics.php');

$env = Statics::readIniFile('environment');
$param = $env['pdo'];
$conn = Statics::connectDatabase($param);

$sql = "SELECT * FROM T_GROUP Where GROUPID like '5000%'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
    echo var_export($row, true);
    echo "\n<br/>";
}
?>