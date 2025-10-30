<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "type" => $this->type,
            "name" => $this->name,
            "description" => $this->description ?? "Descrição não fornecida.",
            "quantity" => $this->quantity,
            "unit" => $this->unit,
        ];
    }
}
