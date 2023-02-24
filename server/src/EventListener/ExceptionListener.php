<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;

use App\Exception\InternalServerException;
use App\Exception\InvalidRequestDataException;

/**
 * Class ExceptionListener.
 */
class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();

        /** @var int|null $responseCode */
        $responseStatusCode = null;

        $additionalResponseData = [];

        /** @var string|null $messageOverride */
        $messageOverride = null;

        $responseHeaders = [];

        if ($throwable instanceof NotFoundHttpException) {
            $responseStatusCode = Response::HTTP_NOT_FOUND;
        } else if ($throwable instanceof UnauthorizedHttpException) {
            $responseStatusCode = Response::HTTP_UNAUTHORIZED;
            /** @var UnauthorizedHttpException $typedException */
            $typedException = $throwable;
            $responseHeaders = $typedException->getHeaders();
        } elseif ($throwable instanceof NotNormalizableValueException) {
            $responseStatusCode = Response::HTTP_BAD_REQUEST;
            $messageOverride = 'Request body does not conform to expected schema';
        } else if ($throwable instanceof BadRequestHttpException) {
            $responseStatusCode = Response::HTTP_BAD_REQUEST;
        } else if ($throwable instanceof InternalServerException) {
            $responseStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $messageOverride = '';
        } else if ($throwable instanceof InvalidRequestDataException) {
            $responseStatusCode = Response::HTTP_BAD_REQUEST;
            /** @var InvalidRequestDataException $invalidRequestDataException */
            $invalidRequestDataException = $throwable;
            $additionalResponseData = ['validationErrors' => $invalidRequestDataException->getMessage()];
        } else {
            return;
        }

        $messageArray = [];
        if ($message = $messageOverride ?? $throwable->getMessage()) {
            $messageArray = ['message' => $message];
        }
        if ($messageArray || $additionalResponseData) {
            $response = new JsonResponse(
                array_merge(
                    $messageArray,
                    $additionalResponseData
                ),
                $responseStatusCode,
                $responseHeaders
            );
        } else {
            $response = new Response('', $responseStatusCode, $responseHeaders);
        }
        $event->setResponse($response);
    }
}
