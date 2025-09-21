<?php
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        return Question::with(['quiz', 'options'])->get();
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = Question::create($request->validated());

        return response()->json([
            'message' => 'Question created successfully.',
            'question' => $question
        ]);
    }

    public function update(StoreQuestionRequest $request, string $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->validated());

        return response()->json([
            'message' => 'Question updated successfully.',
            'question' => $question
        ]);
    }

    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json([
            'message' => 'Question deleted successfully.'
        ]);
    }
}