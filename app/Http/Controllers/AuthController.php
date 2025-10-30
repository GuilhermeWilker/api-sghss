<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Database\Factories\DoctorFactory;
use Database\Factories\PatientFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'cpf' => 'required|string|unique:users',
            'gender' => 'required',
            'password' => 'required|string|min:3',
            'health_plan' => 'required'
        ]);

        $user = UserFactory::new([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cpf' => $request->cpf,
            'gender' => $request->gender,
        ])->create();

        PatientFactory::new([
            'user_id' => $user->id,
            'blood_type' => $request->blood_type,
            'health_plan' => $request->health_plan
        ])->create();

        return response()->json([
            'message' => 'User registered successfully!',
            'patient' => $user
        ], 201);
    }

    public function registerEmployeeDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'cpf' => 'required|string|unique:users',
            'gender' => 'required',
            'password' => 'required|string|min:3',
            'crm' => 'required',
            'speacialty' => 'required|min:4'
        ]);

        $user = UserFactory::new([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cpf' => $request->cpf,
            'gender' => $request->gender,
        ])->create();

        DoctorFactory::new([
            'user_id' => $user->id,
            'crm' => $request->crm,
            'speacialty' => $request->speacialty
        ])->create();

        return response()->json([
            'message' => 'Employee registered successfully!',
            'doctor' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful!',
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'message' => 'Logged out successfully!',
        ]);
    }
}
