<?php

namespace Lwi\Client;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

//use Lwi\Client\Exception;
use Lwi\Client\Subscriber;
use Lwi\Client\Response;

/**
 * Louis Widmer Inside API client.
 *
 * @method Response\AssetList listAssets(array $params = array())
 * @method Response\Asset fetchAsset(array $params = array())
 */
class InsideClient extends Client
{
    const CLIENT_VERSION = '0.1.0';

    public static function factory($options = array())
    {
        $defaultOptions = array(
            'base_url' => 'https://lw-inside.detailnet.ch/api',
            'request.options' => array(
                // Float describing the number of seconds to wait while trying to connect to a server.
                // 0 was the default (wait indefinitely).
                'connect_timeout' => 10,
                // Float describing the timeout of the request in seconds.
                // 0 was the default (wait indefinitely).
                'timeout' => 60, // 60 seconds, may be overridden by individual operations
            ),
        );

//        $requiredOptions = array();
//
//        foreach ($requiredOptions as $optionName) {
//            if (!isset($options[$optionName]) || $options[$optionName] === '') {
//                throw new Exception\InvalidArgumentException(
//                    sprintf('Missing required configuration option "%s"', $optionName)
//                );
//            }
//        }

        $config = Collection::fromConfig($options, $defaultOptions);

        $headers = array(
            'Accept' => 'application/json',
        );

        if (isset($options['app_id'])) {
            $headers['App-ID'] = $options['app_id'];
        }

        if (isset($options['app_key'])) {
            $headers['App-Key'] = $options['app_key'];
        }

        $client = new self($config->get('base_url'), $config);
//        $client->setDefaultOption(
//            'query',
//            array(
//                'application_id' => $config['application_id'],
//            )
//        );
        $client->setDefaultOption('headers', $headers);
        $client->setDescription(
            ServiceDescription::factory(__DIR__ . '/ServiceDescription/Inside.php')
        );
        $client->setUserAgent('lw-inside-client/' . self::CLIENT_VERSION, true);

        $client->getEventDispatcher()->addSubscriber(new Subscriber\ErrorHandlerSubscriber());
        $client->getEventDispatcher()->addSubscriber(new Subscriber\RequestOptionsSubscriber());

        return $client;
    }

    /**
     * @return \Guzzle\Http\Message\RequestFactoryInterface
     */
    public function getRequestFactory()
    {
        return $this->requestFactory;
    }
}
