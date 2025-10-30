<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupplyResource;
use App\Models\Supply;
use App\SupplyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class SupplyController extends Controller
{
    public function list(Request $request)
    {
        $filter = $request->query('filter');

        $supplies = Supply::when(
            $filter,
            fn($q) =>
            $q->where("type", $filter)
        )->get();


        return SupplyResource::collection($supplies);
    }

    public function show(Supply $supply)
    {
        return SupplyResource::make($supply);
    }

    public function update(Request $request, Supply $supply)
    {
        $request->validate([
            "name" => "min:2",
            "quantity" => "integer|min:1",
            "unit" => "string",
            "type" => [Rule::enum(SupplyType::class)]
        ]);

        $supply->update($request->all());

        return response()->json([
            'message' => "Supply updated successfully",
            'supply' => $supply
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:2",
            "quantity" => "required|integer|min:1",
            "unit" => "required|string",
            "type" => ["required", Rule::enum(SupplyType::class)]
        ]);

        $supply = Supply::firstOrNew([
            'name' => $request->name,
            'unit' => $request->unit,
            'type' => $request->type,
        ]);

        if ($supply->exists) {
            $supply->quantity += $request->quantity;
        } else {
            $supply->quantity = $request->quantity;
        }

        $supply->save();

        return response()->json([
            'message' => 'Your supply was added successfully!',
            'supply' => $supply
        ], 201);
    }
}
