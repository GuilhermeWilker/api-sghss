<?php

namespace App\Http\Controllers;

use App\AppointmentStatus;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class AppointmentsController extends Controller
{
    public function list(Request $request)
    {
        $filter = $request->query('filter');

        $appointments = Appointment::with(['doctor.user', 'patient.user'])
            ->when(
                Auth::user()->hasRole('paciente'),
                fn($q) =>
                $q->where('patient_id', Auth::id())
            )
            ->when(
                Auth::user()->hasRole('doctor'),
                fn($q) =>
                $q->where('doctor_id', Auth::user()->doctor->id)
            )
            ->when(
                $filter,
                fn($q) =>
                $q->where('status', $filter)
            );

        return AppointmentResource::collection($appointments->get());
    }

    public function show(Appointment $appointment)
    {
        $appointments = Appointment::with(['doctor.user', 'patient.user'])
            ->where('id', $appointment->id)
            ->when(Auth::user()->hasRole('paciente'), fn($q) => $q->where('patient_id', Auth::id()))
            ->when(Auth::user()->hasRole('doctor'), fn($q) => $q->where('doctor_id', Auth::user()->doctor->id))
            ->get();

        return AppointmentResource::collection($appointments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'scheduled_at' => 'required|date|after:now',
            'reason' => 'required|string|max:255',
        ]);

        $doctor = Doctor::where('user_id', $request->doctor_id)->first();

        if (!$doctor) {
            return response()->json([
                'message' => 'O médico informado não existe.'
            ], 404);
        }

        $appointment = Appointment::create([
            'doctor_id' => $doctor->id,
            'patient_id' => Auth::id(),
            'scheduled_at' => $request->scheduled_at,
            'reason' => $request->reason ?? 'Não especificada.',
            'doctor' => $doctor
        ]);

        return response()->json($appointment, 201);
    }

    public function changeStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => ['required', new Enum(AppointmentStatus::class)]
        ]);

        if (
            (Auth::user()->hasRole('paciente') && $appointment->doctor_id !== Auth::id())
        ) {
            return response()->json(['message' => 'Acesso negado.'], 403);
        }

        $appointment->status = $request->status;
        $appointment->save();

        $appointments = Appointment::with(['doctor.user', 'patient.user'])
            ->where('id', $appointment->id)
            ->when(Auth::user()->hasRole('paciente'), fn($q) => $q->where('patient_id', Auth::id()))
            ->when(Auth::user()->hasRole('doctor'), fn($q) => $q->where('doctor_id', Auth::user()->doctor->id))
            ->get();

        return AppointmentResource::collection($appointments);
    }
}
