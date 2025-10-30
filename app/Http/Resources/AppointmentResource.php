<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (Auth::user()->hasRole('paciente')) {
            return [
                'id' => $this->id,
                'scheduled_at' => $this->scheduled_at,
                'reason' => $this->reason,
                'status' => $this->status,

                'doctor' => [
                    'name' => $this->doctor->user->name,
                    'crm' => $this->doctor->crm,
                    'speacialty' => $this->doctor->speacialty,
                ],
            ];
        }

        if (Auth::user()->hasRole('medico') || Auth::user()->hasRole('enfermeiro')) {
            return [
                'id' => $this->id,
                'scheduled_at' => $this->scheduled_at,
                'reason' => $this->reason,
                'status' => $this->status,
                'patient' => [
                    'name' => $this->patient->user->name,
                    'email' => $this->patient->user->email,
                    'health_plan' => $this->patient->health_plan ?? 'Não informado',
                    'blood_type' => $this->patient->blood_type ?? 'Não informado',
                ],
            ];
        }

        return [];
    }
}
