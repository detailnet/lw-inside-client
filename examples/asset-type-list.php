<?php

use Lwi\Client\InsideClient;

$config = require 'bootstrap.php';
$params = array();

$client = InsideClient::factory($config);

$response = $client->listAssetTypes($params);

echo $response;
