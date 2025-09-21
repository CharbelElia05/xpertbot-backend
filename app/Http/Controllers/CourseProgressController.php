<?php
use App\Http\Requests\StoreCourseProgressRequest;
use App\Models\CourseProgress;

class CourseProgressController extends Controller
{
    public function index()
    {
        return CourseProgress::with(['user', 'course'])->get();
    }

    public function store(StoreCourseProgressRequest $request)
    {
        $progress = CourseProgress::create($request->validated());

        return response()->json([
            'message' => 'Course progress recorded successfully.',
            'progress' => $progress
        ]);
    }

    public function update(StoreCourseProgressRequest $request, string $id)
    {
        $progress = CourseProgress::findOrFail($id);
        $progress->update($request->validated());

        return response()->json([
            'message' => 'Course progress updated successfully.',
            'progress' => $progress
        ]);
    }

    public function destroy(string $id)
    {
        $progress = CourseProgress::findOrFail($id);
        $progress->delete();

        return response()->json([
            'message' => 'Course progress deleted successfully.'
        ]);
    }
}
