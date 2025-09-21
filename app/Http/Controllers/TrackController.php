<?php
use App\Http\Requests\StoreTrackRequest;
use App\Models\Track;

class TrackController extends Controller
{
    public function index()
    {
        return Track::with('courses')->get();
    }

    public function store(StoreTrackRequest $request)
    {
        $track = Track::create($request->validated());

        return response()->json([
            'message' => 'Track created successfully.',
            'track' => $track
        ]);
    }

    public function show(string $id)
    {
        $track = Track::with('courses')->findOrFail($id);

        return response()->json($track);
    }

    public function update(StoreTrackRequest $request, string $id)
    {
        $track = Track::findOrFail($id);
        $track->update($request->validated());

        return response()->json([
            'message' => 'Track updated successfully.',
            'track' => $track
        ]);
    }

    public function destroy(string $id)
    {
        $track = Track::findOrFail($id);
        $track->delete();

        return response()->json([
            'message' => 'Track deleted successfully.'
        ]);
    }
}
