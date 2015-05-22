<?php

namespace Lwi\Client\Response;

class Asset extends BaseResponse
{
    /**
     * @return string
     */
    public function getId()
    {
        return $this->getResult('id');
    }
}
