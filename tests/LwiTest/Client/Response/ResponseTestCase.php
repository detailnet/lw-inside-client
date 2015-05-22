<?php

namespace LwiTest\Client\Response;

use PHPUnit_Framework_TestCase as TestCase;

abstract class ResponseTestCase extends TestCase
{
    /**
     * @param array $data
     * @param string $class
     * @return \Lwi\Client\Response\ResponseInterface ResponseInterface
     */
    protected function getResponse(array $data = array(), $class = null)
    {
        if ($class === null) {
            $class = str_replace('LwiTest\\', 'Lwi\\', get_class($this));
        }

        return $this->getMockForAbstractClass($class, array($data));
    }

    /**
     * @param array $data
     * @return \Guzzle\Service\Command\OperationCommand
     */
    protected function getCommand(array $data)
    {
        $response = $this->getMock('Guzzle\Http\Message\Response', array(), array(), '', false);
        $response
            ->expects($this->any())
            ->method('json')
            ->will($this->returnValue($data));

        $command = $this->getMock('Guzzle\Service\Command\OperationCommand');
        $command
            ->expects($this->any())
            ->method('getResponse')
            ->will($this->returnValue($response));

        return $command;
    }
}
