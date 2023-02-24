<?php

namespace App\Controller;

use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Serialization\SerializationService;
use App\Exception\InvalidRequestDataException;

abstract class ApiController extends AbstractController
{
    protected const BASE_URL = '/api';

    private SerializationService $serializationService;

    public function __construct(SerializationService $serializationService) {
        $this->serializationService = $serializationService;
    }

    /**
     * @throws InvalidRequestDataException
     * @throws JsonException
     */
    protected function getValidatedDto(Request $request, string $class): object
    {
        return $this->serializationService->getValidatedDto($request, $class);
    }
}
