<?php

namespace App\Http\Controllers;

use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function list()
    {
        $doctors = Doctor::with('user');

        return DoctorResource::collection($doctors->get());
    }
}
