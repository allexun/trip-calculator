<?php

namespace App\Controller;

use App\Dto\NumberResponseDto;
use App\Dto\ResponseDto;
use App\Dto\TripCalculateRequest;
use App\Service\InvalidTripCalculatorOperationException;
use App\Service\TripPriceCalculatorService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class TripCalculatorController extends AbstractController
{
    public function __construct(
        private readonly TripPriceCalculatorService $calculatorService,
    ) {
    }

    #[Route('/api/v1/calculate-trip-price', name: 'api_v1_calculate_trip_price', methods: ['POST'])]
    #[OA\RequestBody(
        description: 'Trip price calculation parameters',
        content: new Model(type: TripCalculateRequest::class),
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
    #[OA\Post(summary: 'Calculate trip price')]
    #[OA\Tag('Calculator')]
    public function calculate(
        #[MapRequestPayload] TripCalculateRequest $request,
    ): JsonResponse {
        try {
            $result = $this->calculatorService
                ->calculatePrice(
                    $request->base,
                    date_create($request->dob),
                    date_create($request->tripDate ?? 'now'),
                );

            return $this->json(ResponseDto::withData($result));
        } catch (InvalidTripCalculatorOperationException) {
            return $this->json(ResponseDto::withError('invalid operation'), 400);
        }
    }
}
