<?php

namespace LwiTest\Client;

use PHPUnit_Framework_TestCase as TestCase;

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
        $this->assertEquals('application/json', $client->getHttpClient()->getDefaultOption('headers')['Accept']);
        $this->assertEquals('https://lw-inside.detailnet.ch/api/', $client->getHttpClient()->getBaseUrl());
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

        $this->assertInstanceOf('GuzzleHttp\Command\Command', $client->getCommand('listAssets'));
        $this->assertInstanceOf('GuzzleHttp\Command\Command', $client->getCommand('fetchAsset'));
        $this->assertInstanceOf('GuzzleHttp\Command\Command', $client->getCommand('listAssetTypes'));
    }
}
