<?php
require_once "./app/Bridge.php";

$app = new App();
$router = $app->getRouter();
$app->run();
