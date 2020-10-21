<?php
$method = strtolower(array_key_exists('_method', $_POST) ? $_POST['_method'] : $_SERVER["REQUEST_METHOD"]);

$params = explode('/', $_REQUEST['___url']);
if (count($params) < 2 || empty($params[0]) || empty($params[1])) {
    http_response_code(400);
    echo "Bad Request.";
    return;
}

$version = $params[0];
$prefix = $params[1];
$clazz = $prefix . '_' . $version;
array_shift($params);
array_shift($params);
$query = array_merge($_REQUEST);
unset($query['___url']);
$params = array_merge($params, $query);

$file = "$clazz.php";
require_once($file);

$instance = new $clazz;
echo var_export($instance, true);
echo "<br>\n";
echo var_export($method, true);
echo "<br>\n";
echo $instance->$method($params);
echo "<br>\n";

?>
<input type='button' onclick='javascript:history.back(-1);' value='back' />