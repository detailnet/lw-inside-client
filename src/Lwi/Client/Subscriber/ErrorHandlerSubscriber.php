<?php

namespace Lwi\Client\Subscriber;

use Guzzle\Common\Event;
use Guzzle\Common\Exception\RuntimeException as GuzzleRuntimeException;
use Guzzle\Http\Message\Response;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Lwi\Client\Exception;

class ErrorHandlerSubscriber implements
    EventSubscriberInterface
{
    const EVENT_NAME = 'request.exception';

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            self::EVENT_NAME => 'handleException',
        );
    }

    /**
     * @param Event $event
     * @throws Exception\ExceptionInterface
     */
    public function handleException(Event $event)
    {
        /** @var \Guzzle\Http\Message\Response $response */
        $response = $event['response'];

        /** @var \Exception $previousException */
        $previousException = $event['exception'];

        if ($response !== null) {
            $exception = $this->createResponseException($response, $previousException);
        } else {
            $message = ($previousException !== null) ? $previousException->getMessage() : 'Unknown error';
            $exception = $this->createException('BadRequestException', $message, $previousException);
        }

        throw $exception;
    }

    /**
     * @param Response $response
     * @param \Exception $previous
     * @return Exception\ExceptionInterface
     */
    protected function createResponseException(Response $response, \Exception $previous = null)
    {
        $message = $this->getErrorMessage($response);
        $level = floor($response->getStatusCode() / 100);

        if ($level == '4') {
            $label = 'Client error response';
            $className = 'ClientException';
        } elseif ($level == '5') {
            $label = 'Server error response';
            $className = 'ServerException';
        } else {
            $label = 'Unsuccessful response';
            $className = 'BadResponseException';
        }

        return $this->createException($className, sprintf('%s: %s', $label, $message), $previous);
    }

    /**
     * @param string $className
     * @param string $message
     * @param \Exception $previous
     * @return Exception\ExceptionInterface
     */
    protected function createException($className, $message, \Exception $previous = null)
    {
        $class = 'Lwi\Client\Exception\\' . $className;

        if (!class_exists($class)) {
            throw new Exception\RuntimeException(sprintf('Exception class %s does not exist', $class));
        }

        return new $class($message, 0, $previous);
    }

    /**
     * @param Response $response
     * @return string
     */
    protected function getErrorMessage(Response $response)
    {
        // This is the default:
        $error = $response->getReasonPhrase(); // e.g. "Bad Request"

        try {
            // We might be able to fetch an error message from the response
            $responseData = $response->json();

            if (isset($responseData['title'])) {
                $error = $responseData['title'];
            }

            if (isset($responseData['detail'])) {
                $error .= ': ' . $responseData['detail'];
            }
        } catch (GuzzleRuntimeException $e) {
            // Do nothing
        }

        return (string) $error;
    }
}
