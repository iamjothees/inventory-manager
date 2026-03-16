<?php

namespace App\Location\Http\Resources;

use App\Address\Http\Resources\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'address' => new AddressResource($this->address),
            'contactPersons' => ContactPersonResource::collection($this->contactPersons),
        ];
    }
}
