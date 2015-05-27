<?php

use Lwi\Client\InsideClient;

$config = require 'bootstrap.php';

$assetId = isset($_GET['asset_id']) ? $_GET['asset_id'] : null;

if (!$assetId) {
    throw new RuntimeException('Missing or invalid parameter "asset_id"');
}

$client = InsideClient::factory($config);

$response = $client->fetchAsset(array('asset_id' => $assetId));

var_dump($response->toArray());
