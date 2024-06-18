<?php
$environment = getenv('php');
$base_path = '/crud_cafe';
if ($environment == 'produccion') {
    $url = 'http://146.83.194.142:1515';

} else {
    $url = 'http://localhost';
}
?>