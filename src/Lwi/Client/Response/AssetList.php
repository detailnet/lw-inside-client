<?php

namespace Lwi\Client\Response;

class AssetList extends ListResponse
{
    /**
     * @var array
     */
    protected $assets;

    /**
     * @param boolean $asPlainResult
     * @return Asset[]|array
     */
    public function getItems($asPlainResult = false)
    {
        return $this->getAssets($asPlainResult);
    }

    /**
     * @param boolean $asPlainResult
     * @return Asset[]|array
     */
    protected function getAssets($asPlainResult = false)
    {
        return $this->getSubResults('assets', array($this, 'createAsset'), $asPlainResult);
    }

    /**
     * @param array $data
     * @return Asset
     */
    protected function createAsset(array $data)
    {
        return new Asset($data);
    }
}
