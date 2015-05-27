<?php

return array(
    'name'        => 'Louis Widmer Inside',
    'operations'  => array(
        'listAssets' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'assets',
            'summary'          => 'List assets',
            'parameters'       => array(
                'page' => array(
                    'description' => 'The number of the page',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'page_size' => array(
                    'description' => 'The number of items to list on a page',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'query' => array(
                    'description' => 'Full text search query (currently searches only in asset name)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'filter' => array(
                    '$ref' => 'FilterParam',
                ),
                'sort' => array(
                    '$ref' => 'SortParam',
                ),
            ),
            'responseClass' => 'Lwi\Client\Response\AssetList',
        ),
        'fetchAsset' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'assets/{asset_id}',
            'summary'          => 'Fetch an asset',
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
    'models' => array(
        'Filter' => array(
            'type' => 'object',
            'properties' => array(
                'property' => array(
                    'description' => 'The property to filter against',
                    'type'        => 'string',
                    'required'    => true,
                ),
                'value' => array(
                    'description' => 'The value to filter against',
                    'type'        => 'string',
                    'required'    => true,
                ),
                'operator' => array(
                    'description' => 'The operator the use for filtering',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'type' => array(
                    'description' => 'The data type of the value',
                    'type'        => 'string',
                    'required'    => false,
                ),
            ),
        ),
        'FilterParam' => array(
            'description' => 'An array of filters',
            'location'    => 'query',
            'type'        => 'array',
            'required'    => false,
            'items'       => array(
                '$ref' => 'Filter',
            ),
        ),
        'Sort' => array(
            'type' => 'object',
            'properties' => array(
                'property' => array(
                    'description' => 'The property use for sorting',
                    'type'        => 'string',
                    'required'    => true,
                ),
                'direction' => array(
                    'description' => 'The sorting direction (either "asc" or "desc")',
                    'type'        => 'string',
                    'required'    => false,
                ),
            ),
        ),
        'SortParam' => array(
            'description' => 'An array of sorters',
            'location'    => 'query',
            'type'        => 'array',
            'required'    => false,
            'items'       => array(
                '$ref' => 'Sort',
            ),
        ),
    ),
);
