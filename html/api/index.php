<?php
$method = strtolower(array_key_exists('_method', $_POST) ? $_POST['_method'] : $_SERVER["REQUEST_METHOD"]);
echo $method;
echo "<br/>\n";
$url = explode('/', $_REQUEST['___url']);
echo var_export($url, true);
echo "<br/>\n";
echo var_export(array_keys($_REQUEST), true);
echo "<br/>\n";
echo var_export($_REQUEST, true);
echo "<br/>\n";
echo "<input type='button' onclick='javascript:history.back(-1);' value='back' />\n";
?>