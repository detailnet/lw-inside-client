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
                    '$ref' => 'PageParam',
                ),
                'page_size' => array(
                    '$ref' => 'PageSizeParam',
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
            'responseClass' => 'ListAssetsResponse',
        ),
        'fetchAsset' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'assets/{asset_id}',
            'summary'          => 'Fetch an asset',
            'parameters'       => array(
                'asset_id' => array(
                    'description' => 'The ID of the asset to fetch',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true,
                ),
            ),
            'responseClass' => 'Asset',
        ),
        'listAssetTypes' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'asset-types',
            'summary'          => 'List asset-types',
            'parameters'       => array(
                'page' => array(
                    '$ref' => 'PageParam',
                ),
                'page_size' => array(
                    '$ref' => 'PageSizeParam',
                ),
                'filter' => array(
                    '$ref' => 'FilterParam',
                ),
                'sort' => array(
                    '$ref' => 'SortParam',
                ),
            ),
            'responseClass' => 'ListAssetTypesResponse',
        ),
//        'fetchAssetType' => array(
//            'httpMethod'       => 'GET',
//            'uri'              => 'asset-types/{asset_type_id}',
//            'summary'          => 'Fetch an asset-type',
//            'parameters'       => array(
//                'asset_type_id' => array(
//                    'description' => 'The ID of the asset-type to fetch',
//                    'location'    => 'uri',
//                    'type'        => 'string',
//                    'required'    => true,
//                ),
//            ),
//            'responseClass' => 'AssetType',
//        ),
        'listProducts' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'products',
            'summary'          => 'List products',
            'parameters'       => array(
                'page' => array(
                    '$ref' => 'PageParam',
                ),
                'page_size' => array(
                    '$ref' => 'PageSizeParam',
                ),
                'filter' => array(
                    '$ref' => 'FilterParam',
                ),
                'sort' => array(
                    '$ref' => 'SortParam',
                ),
            ),
            'responseClass' => 'ListProductsResponse',
        ),
        'listProductGroups' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'product-groups',
            'summary'          => 'List product groups',
            'parameters'       => array(
                'page' => array(
                    '$ref' => 'PageParam',
                ),
                'page_size' => array(
                    '$ref' => 'PageSizeParam',
                ),
                'filter' => array(
                    '$ref' => 'FilterParam',
                ),
                'sort' => array(
                    '$ref' => 'SortParam',
                ),
            ),
            'responseClass' => 'ListProductGroupsResponse',
        ),
        'listProductTexts' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'products/{product_id}/texts',
            'summary'          => 'List product texts',
            'parameters'       => array(
                'product_id' => array(
                    'description' => 'The ID of the product from which to fetch the texts',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true,
                ),
                'page' => array(
                    '$ref' => 'PageParam',
                ),
                'page_size' => array(
                    '$ref' => 'PageSizeParam',
                ),
                'filter' => array(
                    '$ref' => 'FilterParam',
                ),
                'sort' => array(
                    '$ref' => 'SortParam',
                ),
            ),
            'responseClass' => 'ListProductTextsResponse',
        ),
    ),
    'models' => array(
        'PageParam' => array(
            'description' => 'The number of the page',
            'location'    => 'query',
            'type'        => 'integer',
            'required'    => false,
        ),
        'PageSizeParam' => array(
            'description' => 'The number of items to list on a page',
            'location'    => 'query',
            'type'        => 'integer',
            'required'    => false,
        ),
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
        'PageSizeProperty' => array(
            'description' => 'The page size',
            'location'    => 'json',
            'type'        => 'integer',
        ),
        'PageCountProperty' => array(
            'description' => 'The total number of pages',
            'location'    => 'json',
            'type'        => 'integer',
        ),
        'TotalItemsProperty' => array(
            'description' => 'The total number of items',
            'location'    => 'json',
            'type'        => 'integer',
        ),
        'Asset' => array(
            'type' => 'object',
            // Keep properties dynamic
            'additionalProperties' => array(
                'location' => 'json',
            ),
        ),
        'ListAssetsResponse' => array(
            'type' => 'object',
            'properties' => array(
                'assets' => array(
                    'description' => 'The resulting assets',
                    'location'    => 'json',
                    'type'        => 'array',
                    'items'       => array(
                        '$ref' => 'Asset',
                    ),
                ),
                'page_size' => array(
                    '$ref' => 'PageSizeProperty',
                ),
                'page_count' => array(
                    '$ref' => 'PageCountProperty',
                ),
                'total_items' => array(
                    '$ref' => 'TotalItemsProperty',
                ),
            ),
        ),
        'AssetType' => array(
            'type' => 'object',
            // Keep properties dynamic
            'additionalProperties' => array(
                'location' => 'json',
            ),
        ),
        'ListAssetTypesResponse' => array(
            'type' => 'object',
            'properties' => array(
                'asset_types' => array(
                    'description' => 'The resulting asset-types',
                    'location'    => 'json',
                    'type'        => 'array',
                    'items'       => array(
                        '$ref' => 'AssetType',
                    ),
                ),
                'page_size' => array(
                    '$ref' => 'PageSizeProperty',
                ),
                'page_count' => array(
                    '$ref' => 'PageCountProperty',
                ),
                'total_items' => array(
                    '$ref' => 'TotalItemsProperty',
                ),
            ),
        ),
        'Product' => array(
            'type' => 'object',
            // Keep properties dynamic
            'additionalProperties' => array(
                'location' => 'json',
            ),
        ),
        'ListProductsResponse' => array(
            'type' => 'object',
            'properties' => array(
                'products' => array(
                    'description' => 'The resulting products',
                    'location'    => 'json',
                    'type'        => 'array',
                    'items'       => array(
                        '$ref' => 'Product',
                    ),
                ),
                'page_size' => array(
                    '$ref' => 'PageSizeProperty',
                ),
                'page_count' => array(
                    '$ref' => 'PageCountProperty',
                ),
                'total_items' => array(
                    '$ref' => 'TotalItemsProperty',
                ),
            ),
        ),
        'ProductGroup' => array(
            'type' => 'object',
            // Keep properties dynamic
            'additionalProperties' => array(
                'location' => 'json',
            ),
        ),
        'ListProductGroupsResponse' => array(
            'type' => 'object',
            'properties' => array(
                'product_groups' => array(
                    'description' => 'The resulting product groups',
                    'location'    => 'json',
                    'type'        => 'array',
                    'items'       => array(
                        '$ref' => 'ProductGroup',
                    ),
                ),
                'page_size' => array(
                    '$ref' => 'PageSizeProperty',
                ),
                'page_count' => array(
                    '$ref' => 'PageCountProperty',
                ),
                'total_items' => array(
                    '$ref' => 'TotalItemsProperty',
                ),
            ),
        ),
        'TextBlock' => array(
            'type' => 'object',
            // Keep properties dynamic
            'additionalProperties' => array(
                'location' => 'json',
            ),
        ),
        'ProductText' => array(
            'type' => 'object',
            'properties' => array(
                'block' => array(
                    'type' => 'array',
                    'items' => array(
                        '$ref' => 'TextBlock',
                    ),
                ),
            ),
            // Keep (other) properties dynamic
            'additionalProperties' => array(
                'location' => 'json',
            ),
        ),
        'ListProductTextsResponse' => array(
            'type' => 'object',
            'properties' => array(
                'product_texts' => array(
                    'description' => 'The resulting product texts',
                    'location'    => 'json',
                    'type'        => 'array',
                    'items'       => array(
                        '$ref' => 'ProductText',
                    ),
                ),
                'page_size' => array(
                    '$ref' => 'PageSizeProperty',
                ),
                'page_count' => array(
                    '$ref' => 'PageCountProperty',
                ),
                'total_items' => array(
                    '$ref' => 'TotalItemsProperty',
                ),
            ),
        ),
    ),
);
