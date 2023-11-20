<?php

namespace App\Controller;

use App\Dto\NumberResponseDto;
use App\Dto\ResponseDto;
use App\Dto\SimpleCalculateRequest;
use App\Service\InvalidCalculatorOperationException;
use App\Service\SimpleCalculatorService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class SimpleCalculatorController extends AbstractController
{
    public function __construct(
        private readonly SimpleCalculatorService $calculatorService,
    ) {
    }

    #[Route('/api/v1/calculate', name: 'api_v1_calculate', methods: ['POST'])]
    #[OA\RequestBody(
        description: 'Calculate request with two numbers and operation',
        content: new Model(type: SimpleCalculateRequest::class),
    )]
    #[OA\Response(
        response: 200,
        description: 'Successful response with the result of calculation',
        content: new Model(type: NumberResponseDto::class),
    )]
    #[OA\Response(
        response: 400,
        description: 'Invalid request response',
        content: new Model(type: ResponseDto::class),
    )]
    #[OA\Post(summary: 'Calculate an operation on 2 numbers')]
    #[OA\Tag('Calculator')]
    public function calculate(
        #[MapRequestPayload] SimpleCalculateRequest $request,
    ): JsonResponse {
        try {
            $result = $this->calculatorService
                ->calculate($request->arg1, $request->arg2, $request->operation);

            return $this->json(ResponseDto::withData($result));
        } catch (InvalidCalculatorOperationException) {
            return $this->json(ResponseDto::withError('invalid operation'), 400);
        }
    }
}
