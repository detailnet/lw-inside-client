<?php

use Lwi\Client\InsideClient;

$config = require 'bootstrap.php';
$params = array();

if (isset($_GET['page'])) {
    $params['page'] = (int) $_GET['page'];
}

if (isset($_GET['page_size'])) {
    $params['page_size'] = (int) $_GET['page_size'];
}

$client = InsideClient::factory($config);

$response = $client->listAssets($params);

var_dump($response->getResult());
