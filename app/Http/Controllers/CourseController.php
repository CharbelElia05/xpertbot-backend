<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        return Course::with('track')->get();
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());

        return response()->json([
            'message' => 'Course created successfully.',
            'course' => $course
        ]);
    }

    public function show(string $id)
    {
        $course = Course::with('track')->findOrFail($id);

        return response()->json($course);
    }

    public function update(StoreCourseRequest $request, string $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->validated());

        return response()->json([
            'message' => 'Course updated successfully.',
            'course' => $course
        ]);
    }

    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json([
            'message' => 'Course deleted successfully.'
        ]);
    }
}

