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

// Example: &query=auge
if (isset($_GET['query'])) {
    $params['query'] = (string) $_GET['query'];
}

$params['filter'] = array(
    array(
        'property' => 'type',
        'value' => 'fd6f26da-4f34-4316-81b6-69bf0c5f2a92', // Key Visual
        'operator' => '=', // equals
        'type' => 'string',
    ),
);

$params['sort'] = array(
    array(
        'property' => 'created_on',
        'direction' => 'desc',
    ),
);

$client = InsideClient::factory($config);

$response = $client->listAssets($params);

var_dump($response->toArray());
