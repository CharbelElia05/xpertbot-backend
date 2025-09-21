<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCertificateRequest;
use App\Models\Certificate;

class CertificateController extends Controller
{
    public function index()
    {
        return Certificate::with(['user', 'track'])->get();
    }

    public function store(StoreCertificateRequest $request)
    {
        $certificate = Certificate::create($request->validated());

        return response()->json([
            'message' => 'Certificate issued successfully.',
            'certificate' => $certificate
        ]);
    }

    public function show(string $id)
    {
        $certificate = Certificate::with(['user', 'track'])->findOrFail($id);

        return response()->json($certificate);
    }

    public function destroy(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();

        return response()->json([
            'message' => 'Certificate deleted successfully.'
        ]);
    }
}
