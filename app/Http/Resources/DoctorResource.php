<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'crm' => $this->crm,
            'name' => $this->user->name,
            'gender' => $this->user->gender,
            'speacialty' => $this->speacialty,
            'email' => $this->user->email,
        ];
    }
}
