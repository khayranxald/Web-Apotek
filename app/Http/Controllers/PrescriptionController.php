<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Services\PrescriptionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PrescriptionController extends Controller
{
    public function __construct(protected PrescriptionService $prescriptionService)
    {
    }

    public function index(Request $request): View
    {
        $prescriptions = $request->user()
            ->prescriptions()
            ->latest()
            ->paginate(10);

        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create(): View
    {
        return view('prescriptions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'file' => ['required', 'file', 'max:5120'],
        ]);

        $this->prescriptionService->upload($request->user(), $validated['file']);

        return redirect()->route('prescriptions.index')
            ->with('success', 'Resep berhasil diunggah. Menunggu review dari apoteker.');
    }

    public function download(Request $request, Prescription $prescription): StreamedResponse
    {
        $this->authorize('download', $prescription);

        return Storage::disk('prescriptions')->download(
            $prescription->file_path,
            $prescription->original_filename
        );
    }
}