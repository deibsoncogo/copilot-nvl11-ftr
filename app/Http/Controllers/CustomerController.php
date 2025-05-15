<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        if ($customers->isEmpty()) {
            return response()->json(["message" => "No customers found"], 404);
        }

        return response()->json($customers, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                "email" => "required|string|email|unique:customer,email",
                "phone" => "nullable|string|max:15",
            ]);

            $customer = Customer::create($validatedData);

            return response()->json($customer, 201);
        } catch (ValidationException $e) {
            return response()->json(["errors" => $e->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::getById($id);


        if ($customer) {
            return response()->json($customer, 200);
        } else {
            return response()->json(["error" => "Customer not found"], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            $validatedData = request()->validate([
                "name" => "sometimes|required|string|max:255",
                "email" => "sometimes|required|string|email|unique:customer,email",
                "phone" => "sometimes|nullable|string|max:15",
            ]);

            $customer->update($validatedData);

            return response()->json($customer, 200);
        } else {
            return response()->json(["error" => "Customer not found"], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            $customer->delete();

            return response()->json(null, 204);
        } else {
            return response()->json(["error" => "Customer not found"], 404);
        }
    }
}
