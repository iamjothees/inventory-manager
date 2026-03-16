<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Cookie;

class ApiResponse implements Responsable
{
    protected ?Cookie $cookie = null;

    public function __construct(protected $data = null, protected int $httpCode = 200)
    {
    }

    public function withCookie(Cookie $cookie): self
    {
        $this->cookie = $cookie;
        return $this;
    }

    public function toResponse($request): \Illuminate\Http\JsonResponse
    {
        $response = response()->json(
            data: $this->data,
            status: $this->httpCode,
            options: JSON_UNESCAPED_UNICODE
        );

        if ($this->cookie !== null) {
            $response = $response->withCookie(cookie: $this->cookie);
        }

        return $response;
    }
}