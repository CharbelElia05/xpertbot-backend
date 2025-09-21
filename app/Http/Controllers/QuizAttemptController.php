<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreQuizAttemptRequest;
use App\Models\QuizAttempt;

class QuizAttemptController extends Controller
{
    public function index()
    {
        return QuizAttempt::with(['user', 'quiz'])->get();
    }

    public function store(StoreQuizAttemptRequest $request)
    {
        $attempt = QuizAttempt::create($request->validated());

        return response()->json([
            'message' => 'Quiz attempt recorded successfully.',
            'attempt' => $attempt
        ]);
    }

    public function show(string $id)
    {
        $attempt = QuizAttempt::with(['user', 'quiz'])->findOrFail($id);

        return response()->json($attempt);
    }

    public function update(StoreQuizAttemptRequest $request, string $id)
    {
        $attempt = QuizAttempt::findOrFail($id);
        $attempt->update($request->validated());

        return response()->json([
            'message' => 'Quiz attempt updated successfully.',
            'attempt' => $attempt
        ]);
    }

    public function destroy(string $id)
    {
        $attempt = QuizAttempt::findOrFail($id);
        $attempt->delete();

        return response()->json([
            'message' => 'Quiz attempt deleted successfully.'
        ]);
    }
}
