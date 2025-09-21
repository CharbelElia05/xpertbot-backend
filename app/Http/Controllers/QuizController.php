<?php
use App\Http\Requests\StoreQuizRequest;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        return Quiz::with('track')->get();
    }

    public function store(StoreQuizRequest $request)
    {
        $quiz = Quiz::create($request->validated());

        return response()->json([
            'message' => 'Quiz created successfully.',
            'quiz' => $quiz
        ]);
    }

    public function show(string $id)
    {
        $quiz = Quiz::with(['track', 'questions.options'])->findOrFail($id);

        return response()->json($quiz);
    }

    public function update(StoreQuizRequest $request, string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->validated());

        return response()->json([
            'message' => 'Quiz updated successfully.',
            'quiz' => $quiz
        ]);
    }

    public function destroy(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return response()->json([
            'message' => 'Quiz deleted successfully.'
        ]);
    }
}