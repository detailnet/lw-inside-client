<?php

use Lwi\Client\InsideClient;

$config = require 'bootstrap.php';
$params = array();

$params['product_id'] = isset($_GET['product_id']) ? $_GET['product_id'] : null;

if (!$params['product_id']) {
    throw new RuntimeException('Missing or invalid parameter "product_id"');
}

// Example: ?page=2
if (isset($_GET['page'])) {
    $params['page'] = (int) $_GET['page'];
}

// Example: &page_size=20
if (isset($_GET['page_size'])) {
    $params['page_size'] = (int) $_GET['page_size'];
}

$client = InsideClient::factory($config);

$response = $client->listProductTexts($params);

var_dump($response);
