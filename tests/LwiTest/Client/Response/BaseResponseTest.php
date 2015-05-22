<?php

namespace LwiTest\Client\Response;

use DateTime;

use Lwi\Client\Response\BaseResponse;

class BaseResponseTest extends ResponseTestCase
{
    public function testResultCanBeGet()
    {
        $resultKey = 'key';
        $resultValue = 'value';
        $result = array($resultKey => $resultValue);

        $response = $this->getResponse($result);

        $this->assertEquals($result, $response->getResult());
        $this->assertArrayHasKey($resultKey, $response->getResult());
        $this->assertEquals($resultValue, $response->getResult($resultKey));
        $this->assertNull($response->getResult('non-existing-key', false));

        $this->setExpectedException('Lwi\Client\Exception\RuntimeException');
        $response->getResult('non-existing-key');
    }

    public function testDateResultCanBeGet()
    {
        $resultKey = 'date';
        $resultValue = '2015-01-19T15:08:28+0100';
        $result = array($resultKey => $resultValue);

        $response = $this->getResponse($result);

        $this->assertInstanceOf('DateTime', $response->getDateResult($resultKey));
        $this->assertEquals(new DateTime($resultValue), $response->getDateResult($resultKey));
        $this->assertNull($response->getDateResult('non-existing-key', false));

        $this->setExpectedException('Lwi\Client\Exception\RuntimeException');
        $response->getDateResult('non-existing-key');
    }

    /**
     * @param array $data
     * @param string $class
     * @return BaseResponse
     */
    protected function getResponse(array $data = array(), $class = null)
    {
        if ($class === null) {
            $class = 'Lwi\Client\Response\BaseResponse';
        }

        return parent::getResponse($data, $class);
    }
}
