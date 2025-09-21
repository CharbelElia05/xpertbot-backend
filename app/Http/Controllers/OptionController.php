<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreOptionRequest;
use App\Models\Option;

class OptionController extends Controller
{
    public function index()
    {
        return Option::with('question')->get();
    }

    public function store(StoreOptionRequest $request)
    {
        $option = Option::create($request->validated());

        return response()->json([
            'message' => 'Option created successfully.',
            'option' => $option
        ]);
    }

    public function update(StoreOptionRequest $request, string $id)
    {
        $option = Option::findOrFail($id);
        $option->update($request->validated());

        return response()->json([
            'message' => 'Option updated successfully.',
            'option' => $option
        ]);
    }

    public function destroy(string $id)
    {
        $option = Option::findOrFail($id);
        $option->delete();

        return response()->json([
            'message' => 'Option deleted successfully.'
        ]);
    }
}