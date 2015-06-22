<?php

use Lwi\Client\InsideClient;

$config = require 'bootstrap.php';
$params = array();

// Example: ?page=2
if (isset($_GET['page'])) {
    $params['page'] = (int) $_GET['page'];
}

// Example: &page_size=20
if (isset($_GET['page_size'])) {
    $params['page_size'] = (int) $_GET['page_size'];
}

// Example: &name=Auge
if (isset($_GET['name'])) {
    $params['filter'] = array(
        array(
            'property' => 'name',
            'value' => '%' . $_GET['name'] . '%',
            'operator' => 'like',
            'type' => 'string',
        ),
    );
}

$params['sort'] = array(
    array(
        'property' => 'created_on',
        'direction' => 'desc',
    ),
);

$client = InsideClient::factory($config);

$response = $client->listProducts($params);

var_dump($response);
