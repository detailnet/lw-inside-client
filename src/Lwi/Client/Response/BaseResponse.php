<?php

namespace Lwi\Client\Response;

use DateTime;

use Lwi\Client\Exception;

use Guzzle\Common\Exception\RuntimeException as GuzzleRuntimeException;
use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface as GuzzleResponseInterface;

abstract class BaseResponse implements
    ResponseInterface,
    GuzzleResponseInterface
{
    /**
     * @var array
     */
    protected $result = array();

    /**
     * @param OperationCommand $command
     * @return ResponseInterface
     */
    public static function fromCommand(OperationCommand $command)
    {
        // Note that we should only get successful responses.
        // For 4xx and 5xx errors an exception was thrown by our error handler.
        // The only cases left to handle here is invalid JSON.

        $response = $command->getResponse();

        try {
            $responseData = $response->json();
        } catch (GuzzleRuntimeException $e) {
            throw new Exception\ServerException($e->getMessage(), 0, $e);
        }

        return new static($responseData);
    }

    /**
     * @param array $result
     */
    public function __construct(array $result)
    {
        $this->result = $result;
    }

    /**
     * @param string $key
     * @param boolean $failOnNull
     * @return array|mixed|null
     */
    public function getResult($key = null, $failOnNull = true)
    {
        $result = $this->result;

        if ($key !== null) {
            if (!array_key_exists($key, $result)) {
                if ($failOnNull !== false) {
                    throw new Exception\RuntimeException(sprintf('Result does not contain "%s"', $key));
                } else {
                    return null;
                }
            }

            $result = $result[$key];
        }

        return $result;
    }

    /**
     * @param string $key
     * @param boolean $failOnNull
     * @return DateTime|null
     */
    public function getDateResult($key, $failOnNull = true)
    {
        $date = $this->getResult($key, $failOnNull);

        return ($date !== null) ? new DateTime($date) : null;
    }

    /**
     * @param string $key
     * @param array $factory
     * @param bool $asPlainResult
     * @param boolean $failOnNull
     * @return array|mixed
     */
    protected function getSubResults($key, $factory, $asPlainResult = false, $failOnNull = true)
    {
        $results = $this->getResult($key, $failOnNull);

        if ($asPlainResult === true) {
            return $results;
        }

        if ($this->$key === null) {
            $this->$key = array();

            if (is_array($results)) {
                foreach ($results as $result) {
                    $response = $this->getSubResponse($factory, $result);

                    array_push($this->$key, $response);
                }
            }
        }

        return $this->$key;
    }

    /**
     * @param string $key
     * @param array $factory
     * @param bool $asPlainResult
     * @param boolean $failOnNull
     * @return array|mixed
     */
    protected function getSubResult($key, $factory, $asPlainResult = false, $failOnNull = true)
    {
        $result = $this->getResult($key, $failOnNull);

        if ($asPlainResult === true) {
            return $result;
        }

        if ($this->$key === null && $result !== null) {
            $response = $this->getSubResponse($factory, $result);

            $this->$key = $response;
        }

        return $this->$key;
    }

    /**
     * @param array $factory
     * @param array $result
     * @return ResponseInterface
     */
    private function getSubResponse($factory, $result)
    {
        /** @todo Check if factory is callable */

        $response = call_user_func($factory, $result);

        /** @todo Check if response is an ResponseInterface object */

        return $response;
    }
}
