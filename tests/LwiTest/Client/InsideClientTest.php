<?php

namespace LwiTest\Client;

use PHPUnit_Framework_TestCase as TestCase;

//use Guzzle\Service\Description\ServiceDescription;

use Lwi\Client\InsideClient;

class InsideClientTest extends TestCase
{
    public function provideConfigValues()
    {
        return array(
            array(
                array(
//                    'app_id' => 'some-app-id',
//                    'app_key' => 'some-app-key',
                ),
            ),
        );
    }

    /**
     * @param array $config
     * @dataProvider provideConfigValues
     */
    public function testFactoryReturnsClient(array $config)
    {
        $client = InsideClient::factory($config);

        $this->assertInstanceOf('Lwi\Client\InsideClient', $client);
//        $this->assertEquals($config['application_id'], $client->getDefaultOption('query')['application_id']);
        $this->assertEquals('application/json', $client->getDefaultOption('headers')['Accept']);
        $this->assertEquals('https://lw-inside.detailnet.ch/api', $client->getConfig('base_url'));
    }

//    /**
//     * @expectedException \Lwi\Client\Exception\InvalidArgumentException
//     */
//    public function testFactoryThrowsExceptionOnMissingConfigurationOptions()
//    {
//        $config = array();
//
//        InsideClient::factory($config);
//    }
//
//    /**
//     * @expectedException \Lwi\Client\Exception\InvalidArgumentException
//     */
//    public function testFactoryThrowsExceptionOnBlankConfigurationOptions()
//    {
//        $config = array();
//
//        InsideClient::factory($config);
//    }

    /**
     * @param array $config
     * @dataProvider provideConfigValues
     */
    public function testClientHasCommands(array $config)
    {
        $client = InsideClient::factory($config);

        $this->assertInstanceOf('Guzzle\Service\Command\OperationCommand', $client->getCommand('listAssets'));
        $this->assertInstanceOf('Guzzle\Service\Command\OperationCommand', $client->getCommand('fetchAsset'));
        $this->assertInstanceOf('Guzzle\Service\Command\OperationCommand', $client->getCommand('listAssetTypes'));
    }
}
