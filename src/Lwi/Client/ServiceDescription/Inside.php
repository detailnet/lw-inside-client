<?php

return array(
    'name'        => 'Louis Widmer Inside',
    'operations'  => array(
        'listAssets' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'assets',
            'summary'          => 'List assets',
//            'documentationUrl' => 'http://tbd',
            'parameters'       => array(
                'page' => array(
                    'description' => 'The number of the page',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'page_size' => array(
                    'description' => 'The number of assets to list on a page',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
            ),
            'responseClass' => 'Lwi\Client\Response\AssetList',
        ),
        'fetchAsset' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'assets/{asset_id}',
            'summary'          => 'Fetch an asset',
//            'documentationUrl' => 'http://tbd',
            'parameters'       => array(
                'asset_id' => array(
                    'description' => 'The ID of the asset you wish to fetch',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true,
                ),
            ),
            'responseClass' => 'Lwi\Client\Response\Asset',
        ),
    ),
);
