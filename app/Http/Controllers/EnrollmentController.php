<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {
        return Enrollment::with(['user', 'track', 'currentCourse'])->get();
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $enrollment = Enrollment::create($request->validated());

        return response()->json([
            'message' => 'Enrollment created successfully.',
            'enrollment' => $enrollment
        ]);
    }

    public function show(string $id)
    {
        $enrollment = Enrollment::with(['user', 'track', 'currentCourse'])->findOrFail($id);

        return response()->json($enrollment);
    }

    public function update(StoreEnrollmentRequest $request, string $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update($request->validated());

        return response()->json([
            'message' => 'Enrollment updated successfully.',
            'enrollment' => $enrollment
        ]);
    }

    public function destroy(string $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return response()->json([
            'message' => 'Enrollment deleted successfully.'
        ]);
    }
}
