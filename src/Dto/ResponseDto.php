<?php

namespace App\Dto;

use OpenApi\Attributes as OA;

class ResponseDto
{
    public ?string $error;

    #[OA\Property(
        type: 'object',
        nullable: true,
    )]
    public mixed $data;

    public static function withError(string $error): ResponseDto
    {
        $dto = new ResponseDto();
        $dto->error = $error;

        return $dto;
    }

    public static function withData(mixed $data): ResponseDto
    {
        $dto = new ResponseDto();
        $dto->data = $data;

        return $dto;
    }
}
